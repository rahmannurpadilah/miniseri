<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Sineas Baru</title>
</head>
<body style="
    margin:0;
    padding:0;
    background:#f6f7fb;
    font-family: Inter, Arial, sans-serif;
">

<!-- WRAPPER -->
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="padding:40px 16px;">

<!-- CARD -->
<table width="100%" cellpadding="0" cellspacing="0" style="
    max-width:600px;
    background:linear-gradient(135deg,#ffffff,#f9f9fb);
    border-radius:22px;
    box-shadow:0 30px 60px rgba(0,0,0,.08);
    overflow:hidden;
">

<!-- HEADER -->
<tr>
<td style="
    padding:28px 32px;
    background:linear-gradient(135deg,#ed2258,#c81d4a);
    color:#fff;
">
    <h2 style="
        margin:0;
        font-size:22px;
        font-weight:700;
        letter-spacing:.3px;
    ">
        Pendaftaran Sineas Baru
    </h2>
    <p style="
        margin:6px 0 0;
        font-size:14px;
        opacity:.9;
    ">
        miniseri.id
    </p>
</td>
</tr>

<!-- BODY -->
<tr>
<td style="padding:32px;">

<p style="
    margin:0 0 18px;
    font-size:15px;
    color:#333;
    line-height:1.7;
">
    Ada pendaftaran sineas baru melalui website <strong>miniseri.id</strong>
</p>

<!-- INFO BOX -->
<table width="100%" cellpadding="0" cellspacing="0" style="
    background:#ffffff;
    border-radius:16px;
    border:1px solid #eee;
">
<tr>
<td style="padding:18px 20px;">

<p style="margin:0 0 10px;font-size:14px;">
<strong>Nama:</strong><br>
{{ $sineas->name }}
</p>

<p style="margin:0 0 10px;font-size:14px;">
<strong>Email:</strong><br>
{{ $sineas->email }}
</p>

<p style="margin:0 0 10px;font-size:14px;">
<strong>No HP:</strong><br>
{{ $sineas->phone }}
</p>

<p style="margin:0;font-size:14px;">
<strong>Bersedia edit format Miniseri:</strong><br>
{{ $sineas->can_edit }}
</p>

</td>
</tr>
</table>

</td>
</tr>

<!-- FOOTER -->
<tr>
<td style="
    padding:22px 32px;
    background:#f1f2f6;
    font-size:12px;
    color:#777;
    text-align:center;
">
    Email ini dikirim otomatis dari sistem Miniseri.id<br>
    © {{ date('Y') }} Miniseri
</td>
</tr>

</table>
</td>
</tr>
</table>

</body>
</html>
