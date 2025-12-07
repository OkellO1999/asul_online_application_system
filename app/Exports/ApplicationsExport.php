<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Application::with(['applicant.user', 'programme']);

        if (isset($this->filters['status']) && $this->filters['status'] != 'all') {
            $query->where('status', $this->filters['status']);
        }

        if (isset($this->filters['programme']) && $this->filters['programme'] != 'all') {
            $query->where('programme_id', $this->filters['programme']);
        }

        if (isset($this->filters['start_date']) && isset($this->filters['end_date'])) {
            $query->whereBetween('created_at', [
                $this->filters['start_date'],
                $this->filters['end_date']
            ]);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Application No.',
            'Applicant Name',
            'Email',
            'Phone',
            'Programme',
            'Application Fee',
            'Status',
            'Date Applied',
            'Date of Birth',
            'Gender',
            'Nationality',
            'District'
        ];
    }

    public function map($application): array
    {
        return [
            $application->application_number,
            $application->applicant->user->name,
            $application->applicant->user->email,
            $application->applicant->user->phone ?? 'N/A',
            $application->programme->name,
            number_format($application->programme->application_fee),
            ucfirst(str_replace('_', ' ', $application->status)),
            $application->created_at->format('Y-m-d H:i:s'),
            $application->applicant->date_of_birth ? \Carbon\Carbon::parse($application->applicant->date_of_birth)->format('Y-m-d') : 'N/A',
            ucfirst($application->applicant->gender),
            $application->applicant->nationality,
            $application->applicant->district
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true]],

            // Set column widths
            'A' => ['width' => 15],
            'B' => ['width' => 25],
            'C' => ['width' => 25],
            'D' => ['width' => 15],
            'E' => ['width' => 25],
            'F' => ['width' => 15],
            'G' => ['width' => 15],
            'H' => ['width' => 20],
            'I' => ['width' => 15],
            'J' => ['width' => 10],
            'K' => ['width' => 15],
            'L' => ['width' => 15],
        ];
    }
}
