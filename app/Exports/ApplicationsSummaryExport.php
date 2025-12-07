<?php

namespace App\Exports;

use App\Models\Application;
use App\Models\Programme;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ApplicationsSummaryExport implements FromCollection, WithHeadings, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Applications by programme
        $byProgramme = Application::join('programmes', 'applications.programme_id', '=', 'programmes.id')
            ->select('programmes.name', DB::raw('count(*) as count'))
            ->groupBy('programmes.name')
            ->get();

        // Applications by status
        $byStatus = Application::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Applications by date (last 30 days)
        $byDate = Application::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        // Combine all data
        $data = collect([
            ['Section' => 'Applications by Programme', 'Detail' => ''],
            ...$byProgramme->map(function($item) {
                return ['Section' => $item->name, 'Detail' => $item->count];
            })->toArray(),
            ['Section' => '', 'Detail' => ''],
            ['Section' => 'Applications by Status', 'Detail' => ''],
            ...$byStatus->map(function($item) {
                return ['Section' => ucfirst(str_replace('_', ' ', $item->status)), 'Detail' => $item->count];
            })->toArray(),
            ['Section' => '', 'Detail' => ''],
            ['Section' => 'Daily Applications (Last 30 Days)', 'Detail' => ''],
            ...$byDate->map(function($item) {
                return ['Section' => $item->date, 'Detail' => $item->count];
            })->toArray()
        ]);

        return $data;
    }

    public function headings(): array
    {
        return [
            'Category',
            'Count'
        ];
    }

    public function title(): string
    {
        return 'Summary Report';
    }
}
