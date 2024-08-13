<!DOCTYPE html>
<html>
<head>
    <title>Rekap Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #f1f1f1;
            border-bottom: 1px solid #ddd;
        }
        .footer {
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .footer .page-number:after {
            content: counter(page);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .summary {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rekap Keuangan - {{ $monthYear ?? 'All' }}</h1>
    </div>
    
    <div class="container">
        <div class="summary">
            <p>Total Income: {{ number_format($total_income, 0) }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Income</th>
                </tr>
            </thead>
            <tbody>
                @forelse($financialSummaries as $summary)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($summary->summary_date)->translatedFormat('F Y') }}</td>
                    <td>{{ number_format($summary->total_income, 0) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">No data available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Page <span class="page-number"></span></p>
    </div>
</body>
</html>
