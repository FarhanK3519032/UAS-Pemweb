<?php
session_start();
include 'dbconnect.php';
if (!isset($_SESSION['type'])) {
  header("Location:index.php");
} elseif(isset($_GET['absen'])) {
  if ($_SESSION['type'] != 0) {
    header("Location:index.php");
  }
  $kodedosen = $_SESSION['kode'];
  $kode_absen = $_GET['absen'];
  $absen = mysqli_query($koneksi, "SELECT * FROM presensi WHERE kode_absen='$kode_absen'");
  $jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_absen='$kode_absen'");
  $datajadwal = mysqli_fetch_assoc($jadwal);
  $matkul = mysqli_query($koneksi, "SELECT * FROM matkul WHERE kode_matkul='".$datajadwal['kode_matkul']."'");
  $datamk = mysqli_fetch_assoc($matkul);
  $namamk = $datamk['nama_matkul'];
  $sks = $datamk['sks'];
  if ($kodedosen != $datamk['kode_dosen']) {
    header("Location:index.php");
  }
} elseif(!isset($_GET['absen'])){
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
      <?php
      //Buat edit kehadiran
      if (isset($_GET['absen']) && isset($_GET['nim']) && isset($_GET['action'])) {
        $NIM = $_GET['nim'];
        $action = $_GET['action'];
        $getmhs = mysqli_query($koneksi, "SELECT nama FROM mhs WHERE NIM='$NIM'");
        $mhs = mysqli_fetch_assoc($getmhs);
        $namamhs = $mhs['nama'];
        if ($action == "delete") {?>
          <main class="page">
              <section class="clean-block dark">
                  <div class="container">
                    <div class="block-heading"></div>
                      <div class="block-content">
                          <div class="">
                              <h4 class="text-center text-uppercase">UBAH PRESENSI <?php echo "$namamk"; ?></h4>
                              <p class="text-center mb-0">Kode Presensi: <?php echo "$kode_absen"; ?></p>
                              <p class="text-center mb-0">SKS: <?php echo "$sks"; ?></p>
                              <hr>
                              <br>
                          <div class="container mt-3">
                          <div class="row d-flex justify-content-center">
                            <div class="col-sm-9">
                              <br>
                              <div class="card">
                                <div class="card-body">
                                  <div class="alert alert-danger alert-dismissible fade show font-monospace" role="alert">
                                   Anda yakin akan menghapus presensi a.n. <?php echo "$namamhs ($NIM)"; ?> ?<br>
                                   <form class="" action="ubah.php" method="post">
                                     <input type="text" name="NIM" value="<?php echo $NIM ?>" hidden>
                                     <input type="text" name="kode_absen" value="<?php echo $kode_absen ?>" hidden>
                                     <input type="text" name="edittype" value="delete" hidden>
                                     <div class='btn-group' role='group'>
                                       <button type="submit" name="submit" id="submit" class="btn btn-danger">Ya</button>
                                       <a href='editpresensi.php?absen=<?php echo $kode_absen ?>' type='button' class='btn btn-info'>Tidak</a>
                                     </div>
                                   </form>
                                 </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
              </section>
        <?php } elseif ($action == "edit") { ?>
          <main class="page">
              <section class="clean-block dark">
                  <div class="container">
                    <div class="block-heading"></div>
                      <div class="block-content">
                          <div class="">
                              <h4 class="text-center text-uppercase">UBAH PRESENSI <?php echo "$namamk"; ?></h4>
                              <p class="text-center mb-0">Kode Presensi: <?php echo "$kode_absen"; ?></p>
                              <p class="text-center mb-0">SKS: <?php echo "$sks"; ?></p>
                              <hr>
                              <br>
                          <div class="container mt-3">
                          <div class="row d-flex justify-content-center">
                            <div class="col-sm-9">
                              <br>
                              <div class="card">
                                <div class="card-body">
                                  <p>Ubah presensi a.n. <?php echo "$namamhs ($NIM)"; ?></p>
                                  <form method='POST' action='ubah.php'>
                                   <input type='text' id='NIM' name='NIM' value='<?php echo "$NIM"; ?>' hidden>
                                   <input type="text" name="edittype" value="edit" hidden>
                                   <input type='text' id='kode_absen' name='kode_absen' value='<?php echo $kode_absen ?>' hidden>
                                   <label for='ket' class='form-label'>Keterangan</label>
                                   <select class='form-select' id='ket' name='ket' required>
                                     <option selected value='HADIR'>Hadir</option>
                                     <option value='SAKIT'>Sakit</option>
                                   </select>
                                   <br>
                                   <button type='submit' id='submit' name='submit' class='btn btn-outline-info' value='submit'>Ubah Presensi</button>
                                 </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
              </section>
        <?php } else {
          header("Location: editpresensi.php?absen=$kode_absen");
        }
      } elseif (!isset($_GET['absen']) || !isset($_GET['nim']) || !isset($_GET['action'])) {
        if (isset($_GET['absen']) && isset($_GET['action'])) {
          if ($_GET['action'] == "ubahwaktu") {
            $start = $datajadwal['start'];
            $end = $datajadwal['end']; ?>
            <main class="page">
                <section class="clean-block dark">
                    <div class="container">
                      <div class="block-heading"></div>
                        <div class="block-content">
                            <div class="">
                                <h4 class="text-center text-uppercase">UBAH PRESENSI <?php echo "$namamk"; ?></h4>
                                <p class="text-center mb-0">Kode Presensi: <?php echo "$kode_absen"; ?></p>
                                <p class="text-center mb-0">SKS: <?php echo "$sks"; ?></p>
                                <hr>
                                <br>
                            <div class="container mt-3">
                            <div class="row d-flex justify-content-center">
                              <div class="col-sm-9">
                                <br>
                                <div class="card">
                                  <div class="card-body">
                                    <p>Ubah presensi dengan kode <?php echo "$kode_absen"; ?></p>
                                    <form method="POST" action="ubah.php">
                                      <input type="text" class="form-control" id="kode_absen" name="kode_absen" aria-describedby="kodeabsendesc" value="<?php echo "$kode_absen" ?>" hidden>
                                      <input type="text" name="edittype" value="ubahwaktu" hidden>
                                      <div class="mb-3">
                                        <label for="start" class="form-label">Mulai</label>
                                        <input type="datetime-local" class="form-control" id="start" name="start">
                                      </div>
                                      <div class="mb-3">
                                        <label for="end" class="form-label">Akhir</label>
                                        <input type="datetime-local" class="form-control" id="end" name="end">
                                      </div>
                                      <button type="submit" id="submit" name="submit" class="btn btn-outline-info" value="submit">Ubah</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </section>
          <?php } elseif ($_GET['action'] == "hapuspresensi") { ?>
            <main class="page">
                <section class="clean-block dark">
                    <div class="container">
                      <div class="block-heading"></div>
                        <div class="block-content">
                            <div class="">
                                <h4 class="text-center text-uppercase">UBAH PRESENSI <?php echo "$namamk"; ?></h4>
                                <p class="text-center mb-0">Kode Presensi: <?php echo "$kode_absen"; ?></p>
                                <p class="text-center mb-0">SKS: <?php echo "$sks"; ?></p>
                                <hr>
                                <br>
                            <div class="container mt-3">
                            <div class="row d-flex justify-content-center">
                              <div class="col-sm-9">
                                <br>
                                <div class="card">
                                  <div class="card-body">
                                    <div class="alert alert-danger alert-dismissible fade show font-monospace" role="alert">
                                     Anda yakin akan menghapus presensi dengan kode <?php echo "$kode_absen"; ?> ?<br>
                                     <form class="" action="ubah.php" method="post">
                                       <input type="text" name="kode_absen" value="<?php echo $kode_absen ?>" hidden>
                                       <input type="text" name="edittype" value="hapus" hidden>
                                       <div class='btn-group' role='group'>
                                         <button type="submit" name="submit" id="submit" class="btn btn-danger">Ya</button>
                                         <a href='editpresensi.php?absen=<?php echo $kode_absen ?>' type='button' class='btn btn-info'>Tidak</a>
                                       </div>
                                     </form>
                                   </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </section>
          <?php } else {
            header("Location: editpresensi.php?absen=$kode_absen");
          }?>

      <?php  } else {?>
        <main class="page">
            <section class="clean-block dark">
                <div class="container">
                  <div class="block-heading"></div>
                    <div class="block-content">
                        <div class="">
                            <h4 class="text-center text-uppercase">DAFTAR PRESENSI <?php echo "$namamk"; ?></h4>
                            <p class="text-center mb-0">Kode Presensi: <?php echo "$kode_absen"; ?></p>
                            <p class="text-center mb-0">SKS: <?php echo "$sks"; ?></p>
                            <p class="text-center mb-0">Waktu: <?php echo "".$datajadwal['start']." - ".$datajadwal['end'].""; ?></p>
                            <hr>
                            <br>
                        <div class="container mt-3">
                        <div class="row d-flex justify-content-center">
                          <div class="col-sm-9">
                            <br>
                            <center>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="editpresensi.php?absen=<?php echo $kode_absen ?>&action=ubahwaktu" name="ubahwaktu" type="button" class="btn btn-info">Ubah Waktu Presensi</a>
                                <a href="editpresensi.php?absen=<?php echo $kode_absen ?>&action=hapuspresensi" name="hapuspresensi" type="button" class="btn btn-danger">Hapus Presensi</a>
                              </div>
                            </center>
                            <br>
                            <div class="card">
                              <div class="card-body">
                                <?php
                                if (isset($_POST['status'])) {
                                  $status = $_POST['status'];
                                  if ($status == "success_edit") {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show font-monospace' role='alert'>
                					            Berhasil mengubah kehadiran mahasiswa!
                					            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                					          </div>
                                    ";
                                  } elseif ($status == "success_delete") {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show font-monospace' role='alert'>
                					            Berhasil menghapus kehadiran mahasiswa!
                					            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                					          </div>
                                    ";
                                  } elseif ($status == "success_ubah") {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show font-monospace' role='alert'>
                					            Berhasil mengubah waktu presensi!
                					            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                					          </div>
                                    ";
                                  } elseif ($status == "success_hapus") {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show font-monospace' role='alert'>
                					            Berhasil menghapus presensi!
                					            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                					          </div>
                                    ";
                                  }
                                }
                                ?>

                                <h5 class="text-center">Kehadiran Mahasiswa</h5>
                                <table id="tabel-data" class="table text-center table-bordered">
                                  <thead>
                                    <tr>
                                      <th>NIM</th>
                                      <th>Nama</th>
                                      <th>Keterangan</th>
                                      <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $i=1;
                                    while ($dataabsen = mysqli_fetch_array($absen)) {
                                      $getmhs = mysqli_query($koneksi, "SELECT nama FROM mhs WHERE NIM='".$dataabsen['NIM']."'");
                                      $mhs = mysqli_fetch_assoc($getmhs);
                                      $namamhs = $mhs['nama'];
                                      if($i%2 == 1){
                                        echo "<tr style='background-color:#e1f5fe;'>";
                                      } else {
                                        echo "<tr>";
                                      }
                                      echo "
                                      <td>".$dataabsen['NIM']."</td>
                                      <td>".$namamhs."</td>
                                      <td>".$dataabsen['ket']."</td>
                                      <td>
                                        <div class='btn-group' role='group'>
                                          <a href='editpresensi.php?absen=$kode_absen&nim=".$dataabsen['NIM']."&action=edit' type='button' class='btn btn-info'>Ubah</a>
                                          <a href='editpresensi.php?absen=$kode_absen&nim=".$dataabsen['NIM']."&action=delete' type='button' class='btn btn-danger'>Hapus</a>
                                        </div>
                                      </td>
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
      <?php }
    }?>
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
