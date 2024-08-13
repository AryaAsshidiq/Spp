<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pembayaran SPP {{ $month_year }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Rekap Pembayaran SPP {{ $month_year }}</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Tagihan</th>
                <th>Jumlah Tagihan</th>
                <th>Status Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Sisa Pembayaran</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->student_name }}</td>
                <td>{{ $payment->class }}</td>
                <td>{{ $payment->billing->billing_name }}</td>
                <td>Rp {{ number_format($payment->billing->billing_amount, 0) }}</td>
                <td>{{ $payment->status }}</td>
                <td>Rp {{ number_format($payment->amount, 0) }}</td>
                <td>Rp {{ number_format($payment->remaining_amount, 0) }}</td>
                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
