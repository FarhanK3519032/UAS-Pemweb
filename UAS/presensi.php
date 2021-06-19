<?php
session_start();
include 'dbconnect.php';
if (!isset($_SESSION['type'])) {
  header("Location:index.php");
} else {
  if ($_SESSION['type'] != 1) {
    header("Location:index.php");
  }
  $kode = $_SESSION['kode'];
  //Presensinya
  date_default_timezone_set('Asia/Jakarta');
  $kodeabsen = $_GET['absen'];
  $now =  date("Y-m-d H:i:s");
  $getdata = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_absen='$kodeabsen'");
  $data = mysqli_fetch_assoc($getdata);
  $getcek = mysqli_query($koneksi, "SELECT * FROM presensi WHERE NIM='$kode' AND kode_absen='$kodeabsen'");
  $cek = mysqli_fetch_assoc($getcek);
  $getdatamatkul = mysqli_query($koneksi, "SELECT nama_matkul FROM matkul WHERE kode_matkul='".$data['kode_matkul']."'");
  $datamatkul = mysqli_fetch_assoc($getdatamatkul);
  mysqli_close($koneksi);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Presensi Pabelan Campus</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/presensi.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" href="assets/img/pc-icon.ico">

  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src="assets/img/PC-LOGO.png" width="30" alt=""> Presensi Pabelan Campus</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <main class="page">
          <section class="clean-block dark pb-4">
              <div class="container">
                  <div class="block-heading "></div>
                  <div class="block-content">
                      <div class="">
                        <h4 class="text-center font-weight-bold text-uppercase">PRESENSI MATA KULIAH <?php echo $datamatkul['nama_matkul']; ?></h4>
                        <p class="text-center"><?php echo "SKS: ".$data['sks'].""; ?></p>
                        <hr>
                        <br>
                        <?php
                        if (mysqli_num_rows($getcek) != 0) {
                          if (isset($_POST['success'])) {
                            echo "
        					          <div class='alert alert-success fade show font-monospace' role='alert'>
        					            Berhasil presensi!<br>
        					            <a href='index.php' class='btn btn-outline-info'>Kembali ke Home</a>
        					          </div>
        					          ";
                          } elseif (!isset($_POST['success'])) {
                            echo "
        					          <div class='alert alert-danger fade show font-monospace' role='alert'>
        					            Anda sudah presensi!
        					          </div>
        					          ";
                          }
                        } elseif ($now > $data['end'] || $now < $data['start']) {
                          echo "
                          <div class='alert alert-danger fade show font-monospace' role='alert'>
                            Waktu presensi tidak sesuai!
                          </div>
                          ";
                        } elseif (mysqli_num_rows($getcek) == 0) {
                          echo "
                          <form method='POST' action='process.php'>
                            <input type='text' id='NIM' name='NIM' value='$kode' hidden>
                            <input type='text' id='kode_absen' name='kode_absen' value='$kodeabsen' hidden>
                            <label for='ket' class='form-label'>Keterangan</label>
                            <select class='form-select' id='ket' name='ket' required>
                              <option selected value='HADIR'>Hadir</option>
                              <option value='SAKIT'>Sakit</option>
                            </select>
                            <br>
                            <button type='submit' id='submit' name='submit' class='btn btn-outline-info' value='submit'>Presensi</button>
                          </form>
                          ";
                        }
                        ?>

                      </div>
                    </div>
                  </div>
          </section>


      </main>
      <footer class="page-footer dark">
          <div class="footer-copyright">
            <p>Presensi UNPAB v0.0.0.1</p>
            <p>© 2021 - K3519001 | K3519032 | K3519053 | K3519063</p>
          </div>
      </footer>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
      <script src="assets/js/presensi.js"></script>
      <script src="assets/js/theme.js"></script>

    </body>
  </html>
