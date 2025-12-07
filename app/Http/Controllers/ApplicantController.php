<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Programme;
use App\Models\AcademicRecord;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function dashboard()
    {
        $applicant = Auth::user()->applicant;
        if (!$applicant) {
            return redirect()->route('applicant.apply');
        }
        $application = $applicant->applications()->latest()->first();

        return view('applicant.dashboard', compact('application'));
    }

    public function applicationForm()
    {
        $programmes = Programme::where('is_active', true)->get();
        return view('applicant.application-form', compact('programmes'));
    }

    public function submitApplication(Request $request)
    {
        try {
            // Debug: Check what's in the request
            // dd($request->all(), $request->file());

            $validated = $request->validate([
                'programme_id' => 'required|exists:programmes,id',
                'personal_details.name' => 'required|string|max:255',
                'personal_details.date_of_birth' => 'required|date',
                'personal_details.gender' => 'required|in:male,female,other',
                'personal_details.nationality' => 'required|string|max:255',
                'personal_details.country' => 'required|string|max:255',
                'personal_details.district' => 'required|string|max:255',
                'personal_details.address' => 'required|string|max:500',
                'personal_details.emergency_contact_name' => 'required|string|max:255',
                'personal_details.emergency_contact_phone' => 'required|string|max:20',
                'personal_details.emergency_contact_relationship' => 'required|string|max:255',

                // O-Level validation
                'academic_records.olevel.school' => 'required|string|max:255',
                'academic_records.olevel.index_number' => 'required|string|max:50',
                'academic_records.olevel.year_obtained' => 'required|integer|min:1980|max:2024',
                'academic_records.olevel.grades' => 'required|string|max:500',
                'academic_records.olevel.certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

                // A-Level validation
                'academic_records.alevel.school' => 'required|string|max:255',
                'academic_records.alevel.index_number' => 'required|string|max:50',
                'academic_records.alevel.year_obtained' => 'required|integer|min:1980|max:2024',
                'academic_records.alevel.grades' => 'required|string|max:500',
                'academic_records.alevel.certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

                // Document uploads
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'id_document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
                'declaration' => 'required|accepted',
            ]);

            $user = Auth::user();

            // Create or update applicant profile
            $applicant = $user->applicant()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'date_of_birth' => $validated['personal_details']['date_of_birth'],
                    'gender' => $validated['personal_details']['gender'],
                    'nationality' => $validated['personal_details']['nationality'],
                    'country' => $validated['personal_details']['country'],
                    'district' => $validated['personal_details']['district'],
                    'address' => $validated['personal_details']['address'],
                    'emergency_contact_name' => $validated['personal_details']['emergency_contact_name'],
                    'emergency_contact_phone' => $validated['personal_details']['emergency_contact_phone'],
                    'emergency_contact_relationship' => $validated['personal_details']['emergency_contact_relationship'],
                ]
            );

            // Handle O-Level academic record
            if ($request->hasFile('academic_records.olevel.certificate')) {
                $olevelPath = $request->file('academic_records.olevel.certificate')->store('academic-certificates', 'public');

                AcademicRecord::create([
                    'applicant_id' => $applicant->id,
                    'institution_name' => $validated['academic_records']['olevel']['school'],
                    'qualification' => 'Uganda Certificate of Education (UCE)',
                    'year_obtained' => $validated['academic_records']['olevel']['year_obtained'],
                    'index_number' => $validated['academic_records']['olevel']['index_number'],
                    'grades' => json_encode(['raw' => $validated['academic_records']['olevel']['grades']]),
                    'certificate_path' => $olevelPath,
                    'level' => 'o_level',
                ]);
            }

            // Handle A-Level academic record
            if ($request->hasFile('academic_records.alevel.certificate')) {
                $alevelPath = $request->file('academic_records.alevel.certificate')->store('academic-certificates', 'public');

                AcademicRecord::create([
                    'applicant_id' => $applicant->id,
                    'institution_name' => $validated['academic_records']['alevel']['school'],
                    'qualification' => 'Uganda Advanced Certificate of Education (UACE)',
                    'year_obtained' => $validated['academic_records']['alevel']['year_obtained'],
                    'index_number' => $validated['academic_records']['alevel']['index_number'],
                    'grades' => json_encode(['raw' => $validated['academic_records']['alevel']['grades']]),
                    'certificate_path' => $alevelPath,
                    'level' => 'a_level',
                ]);
            }

            // Handle photo upload
            $photoPath = $request->file('photo')->store('photos', 'public');

            // Handle ID document upload
            $idPath = $request->file('id_document')->store('id-documents', 'public');

            // Create application
            $application = Application::create([
                'applicant_id' => $applicant->id,
                'programme_id' => $validated['programme_id'],
                'status' => 'submitted',
                'photo_path' => $photoPath,
                'id_path' => $idPath,
            ]);

            return redirect()->route('applicant.payment', $application)
                ->with('success', 'Application submitted successfully! Please complete payment to finalize.');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Application submission error: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'There was an error submitting your application. Please try again.')
                ->withInput();
        }
    }

    public function applicationStatus()
    {
        $applicant = Auth::user()->applicant;
        if (!($applicant)) {
            return redirect()->route('applicant.apply');
        }
        $application = $applicant->applications()->latest()->first();

        return view('applicant.status', compact('application'));
    }

    public function paymentForm(Application $application)
    {
        // Make sure the application belongs to the logged-in applicant
        if ($application->applicant->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('applicant.payment', compact('application'));
    }

    public function processPayment(Request $request, Application $application)
    {
        // Make sure the application belongs to the logged-in applicant
        if ($application->applicant->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'method' => 'required|in:mtn_mobile_money,airtel_money,bank',
            'phone_number' => 'required_if:method,mtn_mobile_money,airtel_money',
        ]);

        // Generate transaction ID
        $transactionId = 'ASUL-PAY-' . time() . '-' . $application->id;

        $payment = Payment::create([
            'application_id' => $application->id,
            'transaction_id' => $transactionId,
            'amount' => $application->programme->application_fee,
            'method' => $validated['method'],
            'phone_number' => $validated['phone_number'] ?? null,
            'status' => 'pending',
        ]);

        // Update application status
        $application->update(['status' => 'under_review']);

        // In a real system, you would integrate with actual payment gateway here
        // For demo purposes, we'll simulate successful payment
        sleep(2); // Simulate payment processing

        $payment->update(['status' => 'completed']);

        return redirect()->route('applicant.dashboard')
            ->with('success', 'Payment processed successfully! Your application is now under review.');
    }
}
