
<!DOCTYPE html>
<html>
  <head>
    <title>Presensi Pabelan Campus</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/presensi.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

  </head>
  <body>
      <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
          <div class="container"><a class="navbar-brand logo text-weight-bold" href="index.php"><img src="assets/img/PC-LOGO.png" width="30" alt=""> Presensi UNPAB</a><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
              <div class="collapse navbar-collapse" id="navcol-1">
                  <ul class="nav navbar-nav ml-auto">
                      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                      <li class="nav-item"><a class="nav-link" href="MK_mhs.php">Mata Kuliah</a></li>
                      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>

                  </ul>
              </div>
          </div>
      </nav>
      <main class="page">
          <section class="clean-block dark">
              <div class="container">
                  <div class="block-heading">
                      <h2 class="text-info text-weight-bold">SELAMAT DATANG</h2>
                      <p>Muhamad Nur Azmi Wahyudi</p>
                      <p>S1 Pendidikan Teknik Informatika dan Komputer</p>
                      <p>Tahun Masuk 2020</p>
                  </div>
                  <div class="block-content">
                      <div class="">
                        <h4 class="text-center">PRESENSI AKTIF HARI INI</h4>
                        <hr>
                        <br>
                        <div class="presensi-item">
                            <h4 class="question">Lorem ipsum dolor sit amet</h4>
                            <div class="answer">
                                <p>Lorem ipsum dolor sit amet</p>
                                <a href="#" class="btn btn-outline-success">Presensi</a>
                            </div>
                        </div>
                        <hr>
                        <div class="presensi-item">
                            <h4 class="question">Lorem ipsum dolor sit amet</h4>
                            <div class="answer">
                                <p>Lorem ipsum dolor sit amet</p>
                                <a href="#" class="btn btn-outline-success">Presensi</a>
                            </div>
                        </div>
                        <hr>
                      </div>
                    </div>
                  </div>
          </section>
          <section class="clean-block dark">
              <div class="container">
                  <div class="block-content">
                      <div class="">
                          <h4 class="text-center">DAFTAR MATA KULIAH</h4>
                          <hr>
                          <br>
                      <div class="container mt-3">
                      <div class="row d-flex justify-content-center">
                        <div class="col-sm-9">
                          <div class="card">
                            <div class="card-body">
                              <table id="tabel-data" class="table text-center table-bordered">
                                <thead>
                                  <tr>
                                    <th>Kode Mata Kuliah</th>
                                    <th>Kode Dosen</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    include 'dbconnect.php';
                                    $matkul = mysqli_query($koneksi, "SELECT * FROM matkul");
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($matkul)) {
                                      if($i%2 == 1){
                                        echo "<tr style='background-color:#e1f5fe;'>";
                                      } else {
                                        echo "<tr>";
                                      }
                                      echo "
                                      <td>".$row['kode_matkul']."</td>
                                      <td>".$row['kode_dosen']."</td>
                                      <td>".$row['nama_matkul']."</td>
                                      <td>".$row['sks']."</td>
                                      <td><a href='matkul.php?kode=".$row['kode_matkul']."'class='btn btn-info text-light'>Detail</button></td>
                                      </tr>";
                                      $i++;
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
          </section>

          

      </main>
      <footer class="page-footer dark">
          <div class="footer-copyright">
              <p>© 2021 Copyright Text</p>
          </div>
      </footer>

      <script type="text/javascript">
      $(document).ready(function() {
        $('#tabel-data').DataTable();
      } );
      </script>

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
      <script src="assets/js/presensi.js"></script>
      <script src="assets/js/theme.js"></script>


    </body>
  </html>
