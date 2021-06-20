<?php
session_start();
include 'dbconnect.php';
if (!isset($_SESSION['type'])) {
  header("Location:index.php");
} elseif(isset($_GET['kodemk'])) {
  if ($_SESSION['type'] != 0) {
    header("Location:index.php");
  }
  $kodedosen = $_SESSION['kode'];
  $kodemk = $_GET['kodemk'];
  $matakuliah = mysqli_query($koneksi, "SELECT * FROM matkul WHERE kode_matkul='$kodemk'");
  $datamk = mysqli_fetch_assoc($matakuliah);
  $namamk = $datamk['nama_matkul'];
  $sks = $datamk['sks'];
  if ($kodedosen != $datamk['kode_dosen']) {
    header("Location:index.php");
  }
} elseif(!isset($_GET['kodemk'])){
  header("Location:index.php");
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
          <section class="clean-block dark">
              <div class="container">
                <div class="block-heading"></div>
                  <div class="block-content">
                      <div class="">
                          <h4 class="text-center text-uppercase">DAFTAR PRESENSI <?php echo "$namamk"; ?></h4>
                          <p class="text-center">Jumlah SKS: <?php echo "$sks"; ?></p>
                          <hr>
                          <br>
                      <div class="container mt-3">
                      <div class="row d-flex justify-content-center">
                        <div class="col-sm-9">
                          <?php
                          if (isset($_POST['status'])) {
                            echo "
                            <div class='alert alert-success alert-dismissible fade show font-monospace' role='alert'>
                              Berhasil menghapus presensi!
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                          }

                           ?>
                          <div class="container text-center"><a href='create.php?kodemk=<?php echo "$kodemk" ?>' class='btn btn-outline-info'>Buat Presensi</a></div>
                          <br>
                          <div class="card">
                            <div class="card-body">
                              <table id="tabel-data" class="table text-center table-bordered">
                                <thead>
                                  <tr>
                                    <th>Kode Presensi</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $getpresensi = mysqli_query($koneksi, "SELECT kode_absen,start,end FROM jadwal WHERE kode_matkul='$kodemk'");
                                  $i=1;
                                  while ($row = mysqli_fetch_array($getpresensi)) {
                                      if($i%2 == 1){
                                        echo "<tr style='background-color:#e1f5fe;'>";
                                      } else {
                                        echo "<tr>";
                                      }
                                      echo "
                                      <td>".$row['kode_absen']."</td>
                                      <td>".$row['start']."</td>
                                      <td>".$row['end']."</td>
                                      <td><a href='editpresensi.php?absen=".$row['kode_absen']."'class='btn btn-info text-light'>Edit</a></td>
                                      </tr>";
                                      $i++;
                                    }
                                    mysqli_close($koneksi);
                                  ?>
                                </tbody>
                              </table>
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
