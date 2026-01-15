<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Sineas Baru</title>
</head>
<body style="
  margin:0;
  padding:0;
  background:#f6f7f9;
  font-family: Inter, Arial, sans-serif;
">

<!-- OUTER -->
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="padding:48px 16px;">

<!-- GLASS CARD -->
<table width="100%" cellpadding="0" cellspacing="0" style="
  max-width:640px;
  background:rgba(255,255,255,.92);
  border-radius:26px;
  border:1px solid rgba(255,255,255,.6);
  box-shadow:0 40px 90px rgba(237,34,88,.18);
  overflow:hidden;
">

<!-- HEADER -->
<tr>
<td style="
  padding:36px 40px 28px;
  background:
    linear-gradient(
      135deg,
      rgba(237,34,88,.40),
      rgba(237,34,88,.20)
    );
">

<p style="
  margin:0 0 6px;
  font-size:12px;
  letter-spacing:2px;
  font-weight:600;
  color:#ed2258;
">
  JOIN SINEAS
</p>

<h1 style="
  margin:0;
  font-size:24px;
  font-weight:800;
  letter-spacing:-0.02em;
  color:#111;
">
  Pendaftaran Sineas Baru
</h1>

<p style="
  margin:14px 0 0;
  font-size:15px;
  line-height:1.8;
  color:#444;
  max-width:520px;
">
  Ada pendaftaran sineas baru melalui platform
  <strong>Miniseri.id</strong>.
</p>

</td>
</tr>

<!-- CONTENT -->
<tr>
<td style="padding:32px 40px 40px;">

<!-- INFO GLASS -->
<table width="100%" cellpadding="0" cellspacing="0" style="
  background:rgba(255,255,255,.75);
  border-radius:20px;
  border:1px solid rgba(255,255,255,.5);
  box-shadow:0 20px 50px rgba(0,0,0,.08);
">
<tr>
<td style="padding:26px 28px;">

<!-- ITEM -->
<p style="margin:0 0 16px;font-size:14px;color:#333;">
<span style="font-size:12px;color:#777;letter-spacing:1px;">NAMA</span><br>
<strong style="font-size:15px;">{{ $sineas->name }}</strong>
</p>

<p style="margin:0 0 16px;font-size:14px;color:#333;">
<span style="font-size:12px;color:#777;letter-spacing:1px;">EMAIL</span><br>
<strong style="font-size:15px;">{{ $sineas->email }}</strong>
</p>

<p style="margin:0 0 16px;font-size:14px;color:#333;">
<span style="font-size:12px;color:#777;letter-spacing:1px;">NO HP</span><br>
<strong style="font-size:15px;">{{ $sineas->phone }}</strong>
</p>

<p style="margin:0;font-size:14px;color:#333;">
<span style="font-size:12px;color:#777;letter-spacing:1px;">
EDIT FORMAT MINISERI
</span><br>

<span style="
  display:inline-block;
  margin-top:6px;
  padding:6px 14px;
  border-radius:999px;
  background:rgba(237,34,88,.14);
  color:#ed2258;
  font-size:13px;
  font-weight:600;
">
  {{ $sineas->can_edit }}
</span>
</p>

</td>
</tr>
</table>

</td>
</tr>

<!-- FOOTER -->
<tr>
<td style="
  padding:26px 40px;
  background:linear-gradient(
    180deg,
    #f6f7f9,
    #ffffff
  );
  font-size:12px;
  color:#777;
  text-align:center;
">
  Email ini dikirim otomatis oleh sistem Miniseri.id<br>
  © {{ date('Y') }} Miniseri
</td>
</tr>

</table>
</td>
</tr>
</table>

</body>
</html>
