<?php
session_start();
if (isset($_SESSION["type"])){
	if ($_SESSION["type"] == 0) {
		header("Location:dosen.php");
	} elseif ($_SESSION["type"] == 1) {
		header("Location:presensi.php");
	}
} elseif (!isset($_SESSION["username"]) && isset($_POST['submit'])) {
	include 'dbconnect.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login = mysqli_query($koneksi, "SELECT * FROM login WHERE username=$username,password=$password");
	if (mysqli_num_rows($login) > 0) {
		while($logindata = mysqli_fetch_assoc($login)) {
    	$type = $logindata['type'];
  	}
		if ($type == 0) {
			$data = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username=$username");
			if (mysqli_num_rows($data) > 0) {
				while($sessiondata = mysqli_fetch_assoc($data)) {
		    	$_SESSION['type'] = $type;
					$_SESSION['kode'] = $sessiondata['kode_dosen'];
					$_SESSION['nama'] = $sessiondata['nama'];
		  	}
			}
			header("Location:dosen.php");
		} elseif ($type == 1) {
			$data = mysqli_query($koneksi, "SELECT * FROM mhs WHERE username=$username");
			if (mysqli_num_rows($data) > 0) {
				while($sessiondata = mysqli_fetch_assoc($data)) {
		    	$_SESSION['type'] = $type;
					$_SESSION['kode'] = $sessiondata['NIM'];
					$_SESSION['nama'] = $sessiondata['nama'];
					$_SESSION['prodi'] = $sessiondata['prodi'];
					$_SESSION['fakultas'] = $sessiondata['fakultas'];
		  	}
			}
			header("Location:presensi.php");
		}



	} else {

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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
		              	<form action="index.php" method="POST">
		                  <div class="form-group">
		                    <label for="email" class="sr-only">Email</label>
		                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
		                  </div>
		                  <div class="form-group mb-4">
		                    <label for="password" class="sr-only">Password</label>
		                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
		                  </div>
		                  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	</body>
</html>
