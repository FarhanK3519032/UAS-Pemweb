<?php
session_start();
$unregistered = 0;
if (isset($_POST["submit"])) {
	include 'dbconnect.php';
	$username = $_POST['email'];
	$password = $_POST['password'];
	$login = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username' AND password='$password'");
	if (!mysqli_num_rows($login) == 0){
		while($logindata = mysqli_fetch_array($login)) {
			$type = $logindata['type'];
			echo $type;
			#print_r($logindata);
	  }
		if ($type == 0) {
			$dosen = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username='$username'");
			$sessiondata = mysqli_fetch_assoc($dosen);
		  $_SESSION['type'] = 0;
			$_SESSION['kode'] = $sessiondata['kode_dosen'];
			$_SESSION['nama'] = $sessiondata['nama'];
			mysqli_close($koneksi);
			header("Location:dosen.php");
		 } elseif ($type == 1) {
			 $mahasiswa = mysqli_query($koneksi, "SELECT * FROM mhs WHERE username='$username'");
			 $sessiondata = mysqli_fetch_assoc($mahasiswa);
		   $_SESSION['type'] = 1;
			 $_SESSION['kode'] = $sessiondata['NIM'];
			 $_SESSION['nama'] = $sessiondata['nama'];
			 $_SESSION['prodi'] = $sessiondata['prodi'];
			 $_SESSION['fakultas'] = $sessiondata['fakultas'];
			 mysqli_close($koneksi);
			 header("Location:presensi.php");
		 }
	 } elseif (mysqli_num_rows($login) == 0){
			$unregistered = 1;
			mysqli_close($koneksi);
		}
	} elseif (isset($_SESSION['type'])){
			if ($_SESSION['type'] == 0) {
				header("Location:dosen.php");
			} elseif ($_SESSION['type'] == 1) {
				header("Location:presensi.php");
			}
		}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/login.css">
	</head>
	<body>
		<!--Main Section Start-->
		<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
		    <div class="container">
		      <div class="card login-card">
		        <div class="row no-gutters">
		          <div class="col-md-5">
		            <img src="assets/img/wall1.jpg" alt="login" class="login-card-img">
		          </div>
		          <div class="col-md-7">
		          	<div class="card-body">
		              <div class="brand-wrapper">
		                <img src="assets/img/PC-LOGO.png" alt="logo" class="logo">
		              </div>
		              <center><p class="login-card-description">Pabelan Campus - Attendance</p></center>

									<?php
					        if ($unregistered == 1) {
					          echo "
					          <div class='alert alert-danger alert-dismissible fade show font-monospace' role='alert'>
					            Email/password is not registered.
					            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					          </div>
					          ";
					        }
					        ?>

										<form action="index.php" method="POST">
		                  <div class="form-group">
		                    <label for="email" class="sr-only">Email</label>
		                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
		                  </div>
		                  <div class="form-group mb-4">
		                    <label for="password" class="sr-only">Password</label>
		                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
		                  </div>
		                  <button class="btn btn-lg btn-primary btn-block" name="submit" id="submit" type="submit">Sign in</button>
		            	</form>
		            	<hr>
		                <nav class="login-card-footer-nav">
		                  <center><p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p></center>
		                </nav>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		</main>
		<!--Main Section Finish-->
	  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</body>
</html>
