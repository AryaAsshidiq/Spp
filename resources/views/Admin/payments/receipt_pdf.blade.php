<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran SPP</title>
    <style>
        body {
            font-family: 'Courier', sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            border: 1px solid #000;
            padding: 20px;
        }

        .content p {
            margin: 0;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Kwitansi Pembayaran SPP</h1>
        </div>
        <div class="content">
            <p><strong>Nama Siswa:</strong> {{ $payment->student->name }}</p>
            <p><strong>Jumlah:</strong> {{ $payment->amount }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $payment->payment_date }}</p>
            <p><strong>Status:</strong> {{ $payment->confirmed ? 'Dikonfirmasi' : 'Belum Dikonfirmasi' }}</p>
        </div>
        <div class="footer">
            <p>Administrator.</p>
        </div>
    </div>
</body>

</html>
