<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Bukti Agenda Surat Masuk</title>
    <style>
        @page {
            /* Kertas disetel ke A4 Portrait */
            size: A4 portrait;
            /* WAJIB: hilangkan margin agar konten bisa melebar penuh 21cm tanpa kegencet */
            margin: 0;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
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
            width: 100%;
            height: 14.85cm;
            /* Pas setengah dari tinggi A4 (29.7cm) */
            position: relative;
            box-sizing: border-box;
            /* Beri padding agar isi form tidak terlalu rapat dengan pinggiran potongan kertas */
            padding: 0.6cm 0.8cm 0 0.8cm;
            overflow: hidden;
        }

        /* BORDER UTAMA FORM */
        .form-container {
            width: 100%;
            height: 13.2cm;
            /* Dikunci agar pas menyisakan ruang untuk teks sistem di bawah */
            box-sizing: border-box;
            position: relative;
            border: 1px solid #000;
            /* Kotak hitam yang membungkus form */
        }

        /* Reset margin elemen internal agar spasi efisien */
        .form-container * {
            margin-top: 0;
            margin-bottom: 5px;
        }

        /* Header area */
        .header-box {
            border: 2px solid #000;
            background-color: #f2f2f2;
            padding: 6px 10px;
        }

        .header-box h2 {
            font-size: 15px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .header-box p {
            font-size: 12px;
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
            margin-bottom: 8px;
        }

        .perihal-title {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .perihal-box {
            border: 1px solid #000;
            background-color: #f2f2f2;
            padding: 6px;
            font-weight: bold;
            font-size: 13px;
        }

        /* === TABEL DISPOSISI BAWAH === */
        .tabel-disposisi {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            margin-bottom: 0;
        }

        .tabel-disposisi td {
            padding: 5px 8px;
            vertical-align: middle;
        }

        .bold {
            font-weight: bold;
        }

        .bg-dark {
            background-color: #333;
            color: #fff;
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
            height: 3.4cm !important;
            /* Membuat area kosong catatan melar ke bawah */
            border-bottom: none !important;
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
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="page-half-a4">

        <div class="form-container">

            <div class="header-box">
                <h2>Sistem Informasi Kearsipan 2</h2>
                <p>Lembar Bukti Agenda Surat Masuk</p>
            </div>

            <div class="status-bar">
                <div>( ) SANGAT SEGERA</div>
                <div>( ) SEGERA</div>
            </div>

            <table class="meta-table">
                <tr>
                    <td width="12%">Asal Surat</td>
                    <td width="2%">:</td>
                    <td width="45%" class="bg-gray">DISTANDALITU KEMENTERIAN PERDAGANGAN</td>
                    <td width="12%" style="padding-left: 15px;">No. Agenda</td>
                    <td width="2%">:</td>
                    <td width="27%" class="bg-gray">Exp 113/PST/VI/2026</td>
                </tr>
                <tr>
                    <td>Nomor Surat</td>
                    <td>:</td>
                    <td class="bg-gray">PC.00.00/159/PEN.4/SD/06/2026</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Tgl Terima</td>
                    <td>:</td>
                    <td class="bg-gray">02-07-2026</td>
                    <td colspan="3"></td>
                </tr>
            </table>

            <div class="perihal-section">
                <div class="perihal-title">Perihal Surat / Undangan</div>
                <div class="perihal-box">
                    UNDANGAN MENGHADIRI BUSINESS MATCHING PRODUSEN PRODUK KARET
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
                    <td width="33%">ASISTEN DIREKTUR <span class="checkbox">( )</span></td>
                    <td width="33%">DISELESAIKAN <span class="checkbox">( )</span></td>
                    <td width="34%">MEWAKILI SAYA <span class="checkbox">( )</span></td>
                </tr>
                <tr class="b-bottom">
                    <td>ASISTEN DIREKTUR 2 <span class="checkbox">( )</span></td>
                    <td>DI PELAJARI <span class="checkbox">( )</span></td>
                    <td>UNTUK DIKETAHUI <span class="checkbox">( )</span></td>
                </tr>
                <tr class="row-catatan">
                    <td colspan="3"></td>
                </tr>
            </table>

        </div>

        <div class="footer-sistem">
            <div>Oleh: administrator</div>
            <div>Dicetak otomatis oleh Sistem 02/07/2026</div>
        </div>

    </div>

</body>

</html>