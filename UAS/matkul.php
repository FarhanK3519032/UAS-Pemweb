<?php
session_start();
include 'dbconnect.php';
if (!isset($_SESSION['type'])) {
  header("Location:index.php");
} else {
  if ($_SESSION['type'] != 1) {
    header("Location:index.php");
  } elseif (!isset($_GET['mk'])) {
    header("Location:index.php");
  }
  $kode = $_SESSION['kode'];
  $nama = $_SESSION['nama'];
  $prodi = $_SESSION['prodi'];
  $fakultas = $_SESSION['fakultas'];
  $kode_matkul = $_GET['mk'];
  $getdatamatkul = mysqli_query($koneksi, "SELECT * FROM matkul WHERE kode_matkul='$kode_matkul'");
  $datamatkul = mysqli_fetch_assoc($getdatamatkul);
  $getdatadosen = mysqli_query($koneksi, "SELECT * FROM dosen WHERE kode_dosen='".$datamatkul['kode_dosen']."'");
  $datadosen = mysqli_fetch_assoc($getdatadosen);
  $namamk = $datamatkul['nama_matkul'];
  $namadosen = $datadosen['nama'];
  $sks = $datamatkul['sks'];

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


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
                        <h4 class="text-center font-weight-bold text-uppercase mb-0">RIWAYAT PRESENSI MATA KULIAH <?php echo "$namamk";?></h4>
                        <p class="text-center mb-0">Dosen Pengampu: <?php echo "$namadosen"; ?></p>
                        <p class="text-center mb-0">Kode MK: <?php echo "$kode_matkul"; ?></p>
                        <p class="text-center">SKS: <?php echo "$sks"; ?></p>
                        <hr>
                        <br>
                        <div class="row justify-content-evenly">
                          <?php
                          $getpresensi = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_matkul='$kode_matkul'");
                          $kodeabsen;
                          if($getpresensi){
                            while ($data = mysqli_fetch_array($getpresensi)) {
                              $kodeabsen = $data['kode_absen'];
                              $getcek = mysqli_query($koneksi, "SELECT * FROM presensi WHERE NIM='$kode' AND kode_absen='$kodeabsen'");
                              $cek = mysqli_fetch_assoc($getcek);
                              if (mysqli_num_rows($getcek) == 0) {
                                echo "
                                <div class='alert alert-danger col-sm-5'>
                                    <div class='answer'>
                                        <p>".$data['start']." s.d. ".$data['end']."</p>
                                        <a href='presensi.php?absen=".$kodeabsen."' class='btn btn-danger'>Presensi</a>
                                    </div>
                                </div>
                                ";
                              } elseif (mysqli_num_rows($getcek) != 0) {
                                echo "
                                <div class='alert alert-success col-sm-5'>
                                    <div class='answer'>
                                        <p>".$data['start']." s.d. ".$data['end']."</p>
                                        <p>Keterangan: ".$cek['ket']."</p>
                                    </div>
                                </div>
                                ";
                              }
                            }
                          }
                          mysqli_close($koneksi);
                          ?>
                        </div>
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
      <script type="text/javascript">
      $(document).ready(function() {
        $('#tabel-data').DataTable();
      } );
      </script>

    </body>
  </html>
