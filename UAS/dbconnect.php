<?php
$host = "presensi.masuk.id";
$username = "presens2_uas";
$password = "ptikfkipuns2019";
$db = "presens2_uas";
$koneksi = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_errno()) {
  echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
