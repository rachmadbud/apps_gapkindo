<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tanda Terima Surat Masuk</title>
    <style>
        /* Mengubah orientasi menjadi LANDSCAPE (A4 dibagi 4 kotak sama besar) */
        @page {
            size: A6 landscape;
            margin: 5mm;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            /* Ukuran dasar teks diperbesar dari 11px */
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }

        /* Kotak Utama Tetap Terjaga */
        .ticket-wrapper {
            width: 100%;
            height: 94mm;
            /* Batas tinggi pas untuk 1/4 A4 landscape */
            border: 2.5px solid #000;
            /* Garis tepi sedikit dipertebal agar makin tegas */
            padding: 2px;
            box-sizing: border-box;
        }

        .ticket-inner {
            border: 1px solid #000;
            padding: 10px 14px;
            box-sizing: border-box;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Kop Surat */
        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2.5px solid #000;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .kop-left {
            text-align: left;
        }

        .kop-title {
            font-size: 14px;
            /* Diperbesar */
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-subtitle {
            font-size: 10px;
            /* Diperbesar */
            color: #333;
        }

        .doc-title {
            font-size: 13px;
            /* Diperbesar */
            font-weight: bold;
            text-transform: uppercase;
            border: 1.5px solid #000;
            padding: 3px 10px;
            background-color: #f0f0f0;
        }

        /* Pembagian Layout Utama */
        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-grow: 1;
            margin-top: 5px;
        }

        /* Tabel Data Sisi Kiri (Teks Diperbesar) */
        .data-table {
            width: 65%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 5px 2px;
            /* Jarak baris sedikit dilonggarkan agar rapi */
            vertical-align: top;
            font-size: 13px;
            /* Diperbesar dari 11px */
        }

        .label {
            width: 30%;
            font-weight: bold;
            color: #000;
        }

        .separator {
            width: 5%;
            text-align: center;
            font-weight: bold;
        }

        .value {
            width: 65%;
            word-break: break-word;
        }

        /* Area Tanda Tangan Sisi Kanan */
        .signature-box {
            width: 30%;
            text-align: center;
            font-size: 12px;
            /* Diperbesar dari 10px */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 52mm;
        }

        .signature-space {
            height: 45px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            font-size: 12px;
        }

        /* Footer Sistem */
        .system-footer {
            border-top: 1px dashed #000;
            padding-top: 5px;
            font-size: 9px;
            /* Diperbesar */
            color: #444;
            font-style: italic;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="ticket-wrapper">
        <div class="ticket-inner">

            <div class="kop-surat">
                <div class="kop-left">
                    <div class="kop-title">Sistem Informasi Kearsipan</div>
                    <div class="kop-subtitle">Lembar Bukti Agenda Surat Masuk</div>
                </div>
                <div class="doc-title">
                    Tanda Terima
                </div>
            </div>

            <div class="main-content">

                <table class="data-table">
                    <tr>
                        <td class="label">No. Agenda</td>
                        <td class="separator">:</td>
                        <td class="value" style="font-weight: bold; font-size: 15px; color: #000;">
                            {{ $surat->nomor_agenda }}</td>
                    </tr>
                    <tr>
                        <td class="label">Asal Surat</td>
                        <td class="separator">:</td>
                        <td class="value" style="font-weight: bold;">{{ $surat->pengirim }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nomor Surat</td>
                        <td class="separator">:</td>
                        <td class="value">{{ $surat->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tgl Terima</td>
                        <td class="separator">:</td>
                        <td class="value">{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Perihal</td>
                        <td class="separator">:</td>
                        <td class="value" style="font-style: italic;">"{{ $surat->perihal }}"</td>
                    </tr>
                </table>

                <div class="signature-box">
                    <div>Penerima,</div>
                    <div class="signature-space"></div>
                    <div class="signature-name">{{ auth()->user()->name }}</div>
                </div>

            </div>

            <div class="system-footer">
                <span>Petugas: {{ auth()->user()->name }}</span>
                <span>Waktu Cetak: {{ now()->format('d/m/Y H:i') }} Wib</span>
            </div>

        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
