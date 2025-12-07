<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicantProfile;
use App\Models\AcademicRecord;
use App\Models\Programme;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('applicant');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $applicantProfile = $user->applicantProfile;
        $application = null;

        if ($applicantProfile) {
            $application = $applicantProfile->applications->first();
        }

        return view('applicant.dashboard', compact('application'));
    }

    public function create()
    {
        $programmes = Programme::where('is_active', true)->get();
        return view('applicant.application_form', compact('programmes'));
    }

    public function store(Request $request)
    {
        // Validate the request for the application form
        $validated = $request->validate([
            // ApplicantProfile fields
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string',
            'contact_phone' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'district' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',

            // AcademicRecord fields (for O-Level and A-Level, we assume two records for simplicity)
            'o_level_institution' => 'required|string',
            'o_level_qualification' => 'required|string',
            'o_level_year' => 'required|integer',
            'o_level_index' => 'required|string',
            'o_level_grades' => 'required|string', // We'll store as JSON

            'a_level_institution' => 'required|string',
            'a_level_qualification' => 'required|string',
            'a_level_year' => 'required|integer',
            'a_level_index' => 'required|string',
            'a_level_grades' => 'required|string',

            // Application fields
            'programme_id' => 'required|exists:programmes,id',
        ]);

        // Create or update the applicant profile
        $user = Auth::user();
        $applicantProfile = $user->applicantProfile ?? new ApplicantProfile();
        $applicantProfile->user_id = $user->id;
        $applicantProfile->date_of_birth = $validated['date_of_birth'];
        $applicantProfile->gender = $validated['gender'];
        $applicantProfile->nationality = $validated['nationality'];
        $applicantProfile->contact_phone = $validated['contact_phone'];
        $applicantProfile->address = $validated['address'];
        $applicantProfile->country = $validated['country'];
        $applicantProfile->district = $validated['district'];

        // Handle file uploads for photo and id_document
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $applicantProfile->photo_path = $photoPath;
        }

        if ($request->hasFile('id_document')) {
            $idPath = $request->file('id_document')->store('ids', 'public');
            $applicantProfile->id_path = $idPath;
        }

        $applicantProfile->save();

        // Create or update academic records (O-Level and A-Level)
        $oLevelRecord = $applicantProfile->academicRecords()->where('qualification', 'O-Level')->first();
        if (!$oLevelRecord) {
            $oLevelRecord = new AcademicRecord();
        }
        $oLevelRecord->applicant_profile_id = $applicantProfile->id;
        $oLevelRecord->institution = $validated['o_level_institution'];
        $oLevelRecord->qualification = 'O-Level';
        $oLevelRecord->year_obtained = $validated['o_level_year'];
        $oLevelRecord->index_number = $validated['o_level_index'];
        $oLevelRecord->grades = $validated['o_level_grades']; // This should be parsed to JSON if it's a string of grades
        $oLevelRecord->save();

        $aLevelRecord = $applicantProfile->academicRecords()->where('qualification', 'A-Level')->first();
        if (!$aLevelRecord) {
            $aLevelRecord = new AcademicRecord();
        }
        $aLevelRecord->applicant_profile_id = $applicantProfile->id;
        $aLevelRecord->institution = $validated['a_level_institution'];
        $aLevelRecord->qualification = 'A-Level';
        $aLevelRecord->year_obtained = $validated['a_level_year'];
        $aLevelRecord->index_number = $validated['a_level_index'];
        $aLevelRecord->grades = $validated['a_level_grades'];
        $aLevelRecord->save();

        // Create the application
        $application = $applicantProfile->applications()->first();
        if (!$application) {
            $application = new Application();
        }
        $application->applicant_profile_id = $applicantProfile->id;
        $application->programme_id = $validated['programme_id'];
        $application->status = 'submitted'; // or 'draft' if saving as draft
        $application->save();

        return redirect()->route('applicant.dashboard')->with('success', 'Application submitted successfully!');
    }

    // Other methods for payment, status, etc.
}
