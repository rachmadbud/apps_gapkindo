<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Bukti Agenda Surat Masuk</title>
    <style>
        @page {
            /* Kertas disetel ke A4 Portrait */
            size: A4 landscape;
            /* WAJIB: hilangkan margin agar konten bisa melebar penuh 21cm tanpa kegencet */
            margin: 0;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* AREA SETENGAH KERTAS A4 (A5 LANDSCAPE ATAS) */
        .page-half-a4 {
            width: 50%;
            height: 18.85cm;
            /* Pas setengah dari tinggi A4 (29.7cm) */
            position: relative;
            box-sizing: border-box;
            /* Beri padding agar isi form tidak terlalu rapat dengan pinggiran potongan kertas */
            padding: 0.6cm 0.8cm 0 0.8cm;
            overflow: hidden;

            margin-left: auto;
        }

        /* BORDER UTAMA FORM */
        .form-container {
            width: 100%;
            height: auto;
            /* Dikunci agar pas menyisakan ruang untuk teks sistem di bawah */
            box-sizing: border-box;
            position: relative;
            border: 3px solid #000;
            /* Kotak hitam yang membungkus form */
        }

        /* Reset margin elemen internal agar spasi efisien */
        .form-container * {
            margin-top: 0;
            margin-bottom: 5px;
        }

        /* Header area */
        .header-box {
            border: 1px solid #000;
            background-color: #f2f2f2;
            padding: 3px 5px;
        }

        .header-box h2 {
            font-size: 13px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .header-box p {
            font-size: 11px;
            margin: 2px 0 0 0;
        }

        /* Status Kecepatan */
        .status-bar {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            padding: 2px 5px;
            margin-bottom: 6px;
        }

        /* Tabel Data Surat (Atas) */
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .meta-table td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .bg-gray {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 3px 8px !important;
        }

        /* Bagian Perihal */
        .perihal-section {
            text-align: center;
            margin-bottom: 0;
        }

        .perihal-title {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .perihal-box {
            border: 1px solid;
            background-color: #f2f2f2;
            padding: 9px;
            font-weight: bold;
            font-size: 13px;
            height: 2.5cm;
        }

        /* === TABEL DISPOSISI BAWAH === */
        .tabel-disposisi {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 0;
        }

        .tabel-disposisi td {
            padding: 15px 8px;
            vertical-align: middle;
        }

        .bold {
            font-weight: bold;
        }

        .bg-dark {
            background-color: #e7e4e4;
            color: #161616;
            font-weight: bold;
            text-align: center;
        }

        .checkbox {
            float: right;
            margin-right: 15px;
            font-weight: normal;
        }

        .b-bottom td {
            border-bottom: 1px solid #000 !important;
        }

        /* KOTAK CATATAN DISET LUAS DAN LEGA */
        .row-catatan td {
            padding: 0 !important;
            vertical-align: top;
            border: 1px solid #000 !important;
        }

        /* Kita tembak langsung tag div di dalam selnya */
        .row-catatan .space-catatan {
            height: 13.5cm !important;
            /* Paksa div ini melar setinggi 3.5cm */
            width: 100%;
            display: block;
        }

        /* TEKS FOOTER SISTEM (Menempel pas di bawah kotak border form) */
        .footer-sistem {
            position: absolute;
            bottom: 0.2cm;
            left: 0.8cm;
            right: 0.8cm;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #000;
            margin: 1%;
        }
    </style>
</head>

<body>

    <div class="page-half-a4">

        <div class="form-container">

            <div class="header-box">
                <h2>Sistem Informasi Kearsipan</h2>
                <p>Lembar Bukti Agenda Surat Masuk</p>
            </div>

            {{-- <div class="status-bar" style="display: flex; flex-direction: column; gap: 5px;">
                <div>( ) SANGAT SEGERA</div>
                <div>( ) SEGERA</div>
            </div> --}}
            <table class="meta-table" style="width: 100%;">
                <tr>
                    <td colspan="3" style="font-weight: bold; padding-bottom: 10px;">( ) SANGAT SEGERA</td>

                    <td colspan="3" style="padding-left: 15px; font-weight: bold; padding-bottom: 10px;">( ) SEGERA
                    </td>
                </tr>

                <tr>
                    <td width="17%">Asal Surat</td>
                    <td width="2%">:</td>
                    <td width="46%" class="bg-gray">{{ $surat->pengirim }}</td>

                    <td width="17%" style="padding-left: 15px;">No. Agenda</td>
                    <td width="2%">:</td>
                    <td width="27%" class="bg-gray">{{ $surat->nomor_agenda }}</td>
                </tr>
                <tr>
                    <td>Nomor Surat</td>
                    <td>:</td>
                    <td class="bg-gray">{{ $surat->nomor_surat }}</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Tgl Surat</td>
                    <td>:</td>
                    <td class="bg-gray">{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Tgl Terima</td>
                    <td>:</td>
                    <td class="bg-gray">{{ \Carbon\Carbon::parse($surat->created_at)->format('d-m-Y') }}</td>
                    <td colspan="3"></td>
                </tr>
            </table>

            <div class="perihal-section">
                <div class="perihal-title">Perihal Surat / Undangan</div>
                <div class="perihal-box">
                    {{ $surat->perihal }}
                </div>
            </div>
            <table class="tabel-disposisi">
                <tr>
                    <td colspan="3" class="bg-dark">DITERUSKAN DIREKTUR EKSEKUTIF</td>
                </tr>
                <tr>
                    <td colspan="3" class="bold">KEPADA :</td>
                </tr>
                <tr>
                    <td width="39%">ASISTEN DIREKTUR <span class="checkbox">( )</span></td>
                    <td width="28%">DISELESAIKAN <span class="checkbox">( )</span></td>
                    <td width="34%">MEWAKILI SAYA <span class="checkbox">( )</span></td>
                </tr>
            </table>
            <table class="tabel-disposisi">
                <tr>
                    <td width="39%">ASISTEN DIREKTUR 2<span class="checkbox">( )</span></td>
                    <td width="28%">DIPELAJARI <span class="checkbox">( )</span></td>
                    <td width="34%">UNTUK DIKETAHUI<span class="checkbox">( )</span></td>
                </tr>
            </table>
            <table class="tabel-disposisi">
                <tr class="row-catatan">
                    <td colspan="3"
                        style="height: 2.5cm !important; min-height: 3.5cm !important; vertical-align: top !important; padding: 10px !important;">

                    </td>
                </tr>
            </table>

        </div>

        <div class="footer-sistem">
            <div>Oleh: {{ auth()->user()->name }}</div>
            <div>Dicetak otomatis oleh Sistem 02/07/2026</div>
        </div>

    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>

</html>
