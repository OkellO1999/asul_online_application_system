<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ApplicationsExport;
use App\Exports\ApplicationsSummaryExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrarController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_applications' => Application::count(),
            'pending_review' => Application::where('status', 'under_review')->count(),
            'admitted' => Application::where('status', 'admitted')->count(),
            'total_programmes' => Programme::count(),
        ];

        $recentApplications = Application::with(['applicant.user', 'programme'])
            ->latest()
            ->take(10)
            ->get();

        return view('registrar.dashboard', compact('stats', 'recentApplications'));
    }

    public function applications(Request $request)
    {
        $query = Application::with(['applicant.user', 'programme']);

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('programme') && $request->programme != 'all') {
            $query->where('programme_id', $request->programme);
        }

        $applications = $query->latest()->paginate(20);
        $programmes = Programme::where('is_active', true)->get();

        return view('registrar.applications', compact('applications', 'programmes'));
    }

    public function showApplication(Application $application)
    {
        $application->load(['applicant.user', 'programme', 'applicant.academicRecords']);
        return view('registrar.application-show', compact('application'));
    }

    public function updateApplicationStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:under_review,shortlisted,admitted,not_admitted',
            'notes' => 'nullable|string',
        ]);

        $application->update($validated);

        return back()->with('success', 'Application status updated successfully.');
    }

    public function reports()
    {
        $applicationsByProgramme = Application::join('programmes', 'applications.programme_id', '=', 'programmes.id')
            ->select('programmes.name', DB::raw('count(*) as count'))
            ->groupBy('programmes.name')
            ->get();

        $applicationsByStatus = Application::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        $programmes = Programme::where('is_active', true)->get();

        return view('registrar.reports', compact('applicationsByProgramme', 'applicationsByStatus', 'programmes'));
    }

    public function exportExcel(Request $request)
    {
        $filters = [
            'status' => $request->get('status', 'all'),
            'programme' => $request->get('programme', 'all'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
        ];

        $filename = 'applications_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new ApplicationsExport($filters), $filename);
    }

    public function exportExcelSummary(Request $request)
    {
        $filters = [
            'status' => $request->get('status', 'all'),
            'programme' => $request->get('programme', 'all'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
        ];

        $filename = 'applications_summary_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new ApplicationsSummaryExport($filters), $filename);
    }

    public function exportPdf(Request $request)
    {
        $filters = [
            'status' => $request->get('status', 'all'),
            'programme' => $request->get('programme', 'all'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
        ];

        // Get applications with filters
        $query = Application::with(['applicant.user', 'programme']);

        if ($filters['status'] != 'all') {
            $query->where('status', $filters['status']);
        }

        if ($filters['programme'] != 'all') {
            $query->where('programme_id', $filters['programme']);
        }

        if ($filters['start_date'] && $filters['end_date']) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        $applications = $query->latest()->get();
        $programmes = Programme::where('is_active', true)->get();

        // Get statistics
        $stats = [
            'total' => $applications->count(),
            'pending' => $applications->where('status', 'under_review')->count(),
            'admitted' => $applications->where('status', 'admitted')->count(),
            'rejected' => $applications->where('status', 'not_admitted')->count(),
        ];

        // Get by programme
        $byProgramme = Application::join('programmes', 'applications.programme_id', '=', 'programmes.id')
            ->select('programmes.name', DB::raw('count(*) as count'))
            ->groupBy('programmes.name')
            ->get();

        // Get by status
        $byStatus = Application::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        $pdf = Pdf::loadView('reports.applications-pdf', compact(
            'applications',
            'filters',
            'programmes',
            'stats',
            'byProgramme',
            'byStatus'
        ));

        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial'
        ]);

        return $pdf->download('applications_report_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
