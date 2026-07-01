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
            margin: 4mm;
            /* Diperkecil dari 5mm */
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            /* Diperkecil dari 13px */
            line-height: 1.3;
            /* Diperkecil dari 1.4 */
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }

        /* Kotak Utama Disesuaikan */
        .ticket-wrapper {
            width: 97.9%;
            height: 90mm;
            /* Diperkecil sedikit agar aman dari overflow */
            border: 2px solid #dad8d8;
            /* Diperkecil dari 2.5px */
            padding: 0.1mm;
            box-sizing: border-box;
        }

        .ticket-inner {
            border: 1px solid #000;
            padding: 8px 12px;
            /* Diperkecil dari 10px 14px */
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
            border-bottom: 2px solid #000;
            /* Diperkecil dari 2.5px */
            padding-bottom: 4px;
            /* Diperkecil dari 6px */
            margin-bottom: 6px;
            /* Diperkecil dari 10px */
        }

        .kop-left {
            text-align: left;
        }

        .kop-title {
            font-size: 12px;
            /* Diperkecil dari 14px */
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-subtitle {
            font-size: 9px;
            /* Diperkecil dari 10px */
            color: #333;
        }

        .doc-title {
            font-size: 11px;
            /* Diperkecil dari 13px */
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #000;
            /* Diperkecil dari 1.5px */
            padding: 2px 8px;
            /* Diperkecil */
            background-color: #f0f0f0;
        }

        /* Pembagian Layout Utama */
        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-grow: 1;
            margin-top: 3px;
        }

        /* Tabel Data Sisi Kiri */
        .data-table {
            width: 100%;
            /* Diubah ke 100% karena box tanda tangan opsional/dihapus jika space mepet */
            border-collapse: collapse;
        }

        .data-table td {
            padding: 3px 2px;
            /* Jarak baris dirapatkan dari 5px */
            vertical-align: top;
            font-size: 11px;
            /* Diperkecil dari 13px */
        }

        .label {
            width: 25%;
            /* Dioptimalkan */
            font-weight: bold;
            color: #000;
        }

        .separator {
            width: 3%;
            text-align: center;
            font-weight: bold;
        }

        .value {
            width: 72%;
            word-break: break-word;
        }

        /* Footer Sistem */
        .system-footer {
            border-top: 1px dashed #000;
            padding-top: 4px;
            font-size: 8px;
            /* Diperkecil dari 9px */
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
                        <td class="value" style="font-weight: bold; font-size: 12px; color: #000;">
                            "{{ $surat->perihal }}"</td>
                    </tr>
                </table>

            </div>

            <div class="system-footer">
                <span>Oleh: {{ auth()->user()->name }}</span>
                <span>Dicetak otomatis oleh Sistem: {{ now()->format('d/m/Y H:i') }} Wib</span>
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
