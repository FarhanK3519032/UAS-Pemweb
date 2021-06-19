<?php
include 'dbconnect.php';
$NIM = $_POST['NIM'];
$kode_absen = $_POST['kode_absen'];
$ket = $_POST['ket'];
$insert = mysqli_query($koneksi, "INSERT INTO presensi (NIM,kode_absen,ket) VALUES ('$NIM','$kode_absen','$ket')");
mysqli_close($koneksi);
echo "
<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title></title>
  </head>
  <body>
    <form action='presensi.php?absen=$kode_absen' id='status' method='post'>
      <input type='text' name='success' value='success' hidden>
    </form>
    <script type='text/javascript'>
      document.getElementById('status').submit();
    </script>
  </body>
</html>
";
?>
