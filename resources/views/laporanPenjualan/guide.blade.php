<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Panduan Upload Laporan Bulanan Cabang</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #233746; font-size: 11pt; line-height: 1.5; }
        h1 { color: #174e67; font-size: 20pt; margin-bottom: 4px; }
        h2 { color: #174e67; font-size: 13pt; margin: 20px 0 6px; }
        .subtitle { color: #667780; margin-top: 0; }
        .notice { background: #edf6fa; border-left: 4px solid #2283a5; padding: 10px 14px; }
        li { margin-bottom: 5px; }
        table { border-collapse: collapse; width: 100%; margin-top: 8px; }
        th, td { border: 1px solid #ccd8de; padding: 7px; text-align: left; }
        th { background: #eaf2f5; }
    </style>
</head>
<body>
    <h1>Panduan Upload Laporan Bulanan Cabang</h1>
    <p class="subtitle">Panduan mengunduh template, mengisi, dan mengirim laporan melalui aplikasi.</p>

    <div class="notice">
        Gunakan template Excel yang diunduh dari halaman Rekapitulasi. Jangan memakai atau mengubah header dari file lain karena header template menjadi acuan pembacaan otomatis.
    </div>

    <h2>Langkah upload</h2>
    <ol>
        <li>Tekan <strong>Download Template Excel</strong> pada halaman Laporan Bulanan Cabang.</li>
        <li>Buka file dan isi data pada sheet <strong>Laporan Bulanan</strong>, mulai baris 7. Sheet <strong>Petunjuk</strong> memuat ringkasan aturan pengisian.</li>
        <li>Pertahankan urutan dan nama header. Jangan menghapus, memindahkan, atau menggabungkan ulang kolom header.</li>
        <li>Pilih bulan dan tahun laporan pada halaman upload, kemudian pilih file Excel yang sudah diisi.</li>
        <li>Tekan <strong>Baca dan Preview Excel</strong>. Periksa jumlah perusahaan, nilai rekap, dan semua peringatan.</li>
        <li>Jika sudah benar, tekan <strong>Kirim Laporan</strong>. Laporan akan masuk status Menunggu Review.</li>
    </ol>

    <h2>Kolom yang diisi</h2>
    <table>
        <thead><tr><th>Kolom</th><th>Aturan</th></tr></thead>
        <tbody>
            <tr><td>No.</td><td>Nomor sumber; nomor berulang tidak menghilangkan baris perusahaan.</td></tr>
            <tr><td>Nama Perusahaan</td><td>Wajib diisi; pertahankan nama persis seperti sumber.</td></tr>
            <tr><td>Kapasitas Terpasang</td><td>Nilai numerik dalam TON/THN.</td></tr>
            <tr><td>Kode TPP</td><td>Pertahankan kode sumber; jangan diubah otomatis.</td></tr>
            <tr><td>Jenis Karet</td><td>Pertahankan isi sumber, termasuk daftar jenis jika ada.</td></tr>
            <tr><td>Oper. Fact.</td><td>Nilai numerik dalam UNIT.</td></tr>
            <tr><td>Produksi, Lokal, Ekspor, Penjualan</td><td>Nilai dalam KG. Sistem menampilkan rekap dan membandingkannya dengan TOTAL sumber jika ditemukan.</td></tr>
        </tbody>
    </table>

    <h2>Ketentuan penting</h2>
    <ul>
        <li>File harus berformat <strong>.xlsx</strong> atau <strong>.xls</strong>, maksimal <strong>10 MB</strong>.</li>
        <li>Angka boleh menggunakan pemisah ribuan. Tanda <strong>-</strong> diperlakukan sebagai nol untuk perhitungan; file asli tidak diubah.</li>
        <li>Jangan menambahkan baris TOTAL ke template. Aplikasi menghitung ulang total; perbedaan dengan total sumber akan diberi peringatan untuk diperiksa.</li>
        <li>Baris data tidak dibatasi jumlahnya. Setiap baris perusahaan dibaca tersendiri meskipun nomor urut berulang.</li>
        <li>Cabang hanya dapat mengunggah ulang periode yang berstatus <strong>Perlu Revisi</strong>. Periode Menunggu Review atau Disetujui tidak dapat diganti.</li>
        <li>Jika diminta revisi, baca catatan admin, perbaiki file, lalu unggah kembali untuk periode yang sama.</li>
    </ul>
</body>
</html>
