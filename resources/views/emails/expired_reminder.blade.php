<!DOCTYPE html>
<html>

<head>
    <title>Peringatan</title>
</head>

<body>

    <p>Yth. {{ $company->name }},</p>

    <p>
        Surat perusahaan Anda akan segera expired pada tanggal:
        <strong>{{ $company->expired_at->format('d M Y') }}</strong>
    </p>

    <p>Mohon segera melakukan perpanjangan.</p>

    <p>Terima kasih.</p>

</body>

</html>
