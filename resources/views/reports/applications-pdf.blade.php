<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ASUL Applications Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #1e6b52;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #1e6b52;
            margin: 0;
            font-size: 20px;
        }
        .header h2 {
            color: #4b286d;
            margin: 5px 0;
            font-size: 16px;
        }
        .report-info {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            height: 60px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background-color: #1e6b52;
            color: white;
            text-align: left;
            padding: 8px;
            font-weight: bold;
        }
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .summary-box {
            margin: 15px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .summary-box h3 {
            color: #4b286d;
            margin-top: 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 15px 0;
        }
        .stat-item {
            text-align: center;
            padding: 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #1e6b52;
        }
        .stat-label {
            font-size: 10px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1 style="color: #1e6b52;">ALL SAINTS UNIVERSITY - LANGO</h1>
        </div>
        <h2>APPLICATIONS REPORT</h2>
        <p>Generated on: {{ now()->format('F d, Y h:i A') }}</p>
    </div>

    <div class="report-info">
        <p><strong>Report Period:</strong> {{ $filters['start_date'] ?? 'All time' }} to {{ $filters['end_date'] ?? 'Present' }}</p>
        <p><strong>Programme:</strong> {{ $filters['programme'] == 'all' ? 'All Programmes' : ($programmes->find($filters['programme'])->name ?? 'All Programmes') }}</p>
        <p><strong>Status:</strong> {{ $filters['status'] == 'all' ? 'All Statuses' : ucfirst(str_replace('_', ' ', $filters['status'])) }}</p>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-box">
        <h3>SUMMARY STATISTICS</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Applications</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending Review</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ $stats['admitted'] }}</div>
                <div class="stat-label">Admitted</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ $stats['rejected'] }}</div>
                <div class="stat-label">Not Admitted</div>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    <h3>APPLICATIONS LIST</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Application No.</th>
                <th>Applicant Name</th>
                <th>Programme</th>
                <th>Status</th>
                <th>Date Applied</th>
                <th>Application Fee</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $index => $application)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $application->application_number }}</td>
                <td>{{ $application->applicant->user->name }}</td>
                <td>{{ $application->programme->name }}</td>
                <td>
                    <span style="color:
                        {{ $application->status == 'admitted' ? '#28a745' :
                           ($application->status == 'under_review' ? '#ffc107' :
                           ($application->status == 'submitted' ? '#007bff' :
                           ($application->status == 'shortlisted' ? '#6f42c1' :
                           ($application->status == 'not_admitted' ? '#dc3545' :
                           '#6c757d')))) }}">
                        {{ str_replace('_', ' ', ucfirst($application->status)) }}
                    </span>
                </td>
                <td>{{ $application->created_at->format('Y-m-d') }}</td>
                <td>UGX {{ number_format($application->programme->application_fee) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Charts/Graphs Section -->
    <div class="page-break"></div>
    <h3>ANALYTICS</h3>

    <!-- By Programme -->
    <div style="margin: 20px 0;">
        <h4>Applications by Programme</h4>
        <table>
            <thead>
                <tr>
                    <th>Programme</th>
                    <th>Count</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($byProgramme as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->count }}</td>
                    <td>{{ number_format(($item->count / $stats['total']) * 100, 1) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- By Status -->
    <div style="margin: 20px 0;">
        <h4>Applications by Status</h4>
        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Count</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($byStatus as $item)
                <tr>
                    <td>{{ str_replace('_', ' ', ucfirst($item->status)) }}</td>
                    <td>{{ $item->count }}</td>
                    <td>{{ number_format(($item->count / $stats['total']) * 100, 1) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>This report was generated by the ASUL Application Portal</p>
        <p>All Saints University - Lango | Lira, Northern Uganda</p>
        <p>Generated by: {{ auth()->user()->name }} | {{ auth()->user()->email }}</p>
    </div>
</body>
</html>
