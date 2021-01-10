<?php 

	require_once './dbcon.php';
	session_start();

	if (isset($_SESSION['user_login'])) {
	header('location: index.php');
}

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT * FROM `admins` WHERE `username`= '$username'";

		$username_check = mysqli_query($link, $query);

		if (mysqli_num_rows($username_check) > 0) {
			$password_check = mysqli_fetch_assoc($username_check);

			if ($password_check['password'] == md5($password)) {
				$_SESSION['user_login'] = $username;
				header('location: index.php');
			} else {
				$wrong_password = "Wrong Password";
			}
		} else {
			$username_not_found = "This Username is not found.";
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MySchool Admin | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body class="hold-transition login-page">
<?php if (isset($username_not_found)) {
	echo '<div class="alert alert-danger animate__animated animate__backInDown">'.$username_not_found.'</div>';
} ?>
<?php if (isset($wrong_password)) {
	echo '<div class="alert alert-danger animate__animated animate__backInDown">'.$wrong_password.'</div>';
} ?>



<div class="login-box animate__animated animate__zoomIn">
  <div class="login-logo">
    <a href="login.php"><b>Admin</b>LOGIN</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required="" value="<?php if(isset($username)){ echo $username; } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required="" value="<?php if(isset($password)){ echo $password; } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4 ml-auto">
            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

     
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
