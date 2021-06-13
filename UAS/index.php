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
		            <img src="assets/wall1.jpg" alt="login" class="login-card-img">
		          </div>
		          <div class="col-md-7">
		          	<div class="card-body">
		              <div class="brand-wrapper">
		                <img src="assets/PC-LOGO.png" alt="logo" class="logo">
		              </div>
		              <center><p class="login-card-description">Pabelan Campus - Attendance</p></center>
		              	<form action="#!">
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
		                <center><p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p></center>
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
