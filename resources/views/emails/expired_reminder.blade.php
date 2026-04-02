<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
</head>

<body style="
      margin: 0;
      padding: 0;
      background: #f4f6f8;
      font-family: Arial, sans-serif;
    ">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background: #ffffff; border-radius: 8px; overflow: hidden">
                    <!-- HEADER -->
                    <tr>
                        <td style="background: #2e7d32; padding: 20px; color: #fff">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <!-- LOGO KIRI -->
                                    <td width="80" style="vertical-align: middle">
                                        <img src="http://apps-gapkindo.gapkindo.org/logo-gapkindo.gif" alt="GAPKINDO"
                                            style="max-width: 60px" />
                                    </td>

                                    <!-- TEXT KANAN -->
                                    <td style="vertical-align: middle">
                                        <h2 style="margin: 0">REMINDER MASA BERLAKU</h2>
                                        <p style="margin: 5px 0 0; font-size: 14px">
                                            Sertifikat Akan Segera Berakhir
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- CONTENT -->
                    <tr>
                        <td style="padding: 30px; color: #333">
                            <p>Yth. <strong>{{ $data['name'] }}</strong>,</p>

                            <p>
                                Kami menginformasikan bahwa sertifikat berikut akan segera
                                berakhir:
                            </p>

                            <!-- TABLE DATA -->
                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="
                    border-collapse: collapse;
                    margin: 20px 0;
                    border: 1px solid #eee;
                  ">
                                <tr style="background: #f1f1f1">
                                    <td width="40%"><strong>Jenis</strong></td>
                                    <td>{{ $data['jenis'] }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Nomor</strong></td>
                                    <td>{{ $data['nomor'] }}</td>
                                </tr>

                                <tr style="background: #f1f1f1">
                                    <td><strong>Tanggal Berakhir</strong></td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($data['expired_at'])->format('d M
                                                              Y') }}
                                    </td>
                                </tr>
                            </table>

                            <p>
                                Mohon segera melakukan perpanjangan sebelum tanggal tersebut.
                            </p>

                            <hr
                                style="
                    border: none;
                    border-top: 1px solid #eee;
                    margin: 25px 0;
                  " />

                            <p>
                                Terima kasih,<br />
                                <strong>{{ $data['sender'] }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td
                            style="
                  background: #f4f6f8;
                  padding: 15px;
                  text-align: center;
                  font-size: 12px;
                  color: #888;
                ">
                            Email ini dikirim otomatis oleh GAPKINDO.<br />
                            Mohon tidak membalas email ini.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
