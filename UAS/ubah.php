<?php
include 'dbconnect.php';

if (isset($_POST['submit']) && isset($_POST['submit'])) {
  $tipe = $_POST['edittype'];
  if ($tipe == "edit") {
    $NIM = $_POST['NIM'];
    $kode_absen = $_POST['kode_absen'];
    $ket = $_POST['ket'];
    $update = mysqli_query($koneksi, "UPDATE presensi SET ket='$ket' WHERE NIM='$NIM'");
    mysqli_close($koneksi);
    echo "
    <!DOCTYPE html>
    <html lang='en' dir='ltr'>
      <head>
        <meta charset='utf-8'>
        <title></title>
      </head>
      <body>
        <form action='editpresensi.php?absen=$kode_absen' id='status' method='post'>
          <input type='text' name='status' value='success_edit' hidden>
        </form>
        <script type='text/javascript'>
          document.getElementById('status').submit();
        </script>
      </body>
    </html>
    ";
  } elseif ($tipe == "delete") {
    $NIM = $_POST['NIM'];
    $kode_absen = $_POST['kode_absen'];
    $delete = mysqli_query($koneksi, "DELETE FROM presensi WHERE NIM='$NIM'");
    mysqli_close($koneksi);
    echo "
    <!DOCTYPE html>
    <html lang='en' dir='ltr'>
      <head>
        <meta charset='utf-8'>
        <title></title>
      </head>
      <body>
        <form action='editpresensi.php?absen=$kode_absen' id='status' method='post'>
          <input type='text' name='status' value='success_delete' hidden>
        </form>
        <script type='text/javascript'>
          document.getElementById('status').submit();
        </script>
      </body>
    </html>
    ";
  }
}


?>
