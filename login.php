<?php
session_start();

if (isset($_SESSION['teacher'])) {
  header("Location: ./teacher/teacher_dashboard.php");
  exit();
} elseif (isset($_SESSION['student'])) {
  header("Location: ./student/student_account.php");
  exit();
} elseif (isset($_SESSION['admin'])) {
  header("Location: ./admin/admin_dashboard.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SJDC | Login</title>
  <link rel="stylesheet" href="./font/font.css">
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="./plugins/sweetalert2/sweetalert2.min.css">
  <script src="./plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <link rel="icon" href="./assests/bg1.png" type="image/x-icon">

  <style>
    body {
      background-image: url('./assests/sjdc.jpg');
      background-size: cover;
      background-position: center;
    }

    img {
      height: 100px;
      width: 100px;
      display: block;
      /* Ensures the image is treated as a block element */
      margin: auto;
      /* Centers the image horizontally */
    }

    .transparent-card {
      background-color: rgba(255, 255, 255, 0.7);
      /* Adjust the alpha value for transparency */
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="text-center mt-5 text-white text-bold">St. Jude College Of Dasmarinas Cavite Student Portal</h1>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card mt-5 transparent-card">
          <div class="card-body">
            <?php
            if (isset($_SESSION['login-failed'])) {
            ?>
              <script>
                Swal.fire({
                  title: 'Login Failed',
                  text: '<?php echo $_SESSION['login-failed']; ?>',
                  icon: 'error',
                  position: 'top',
                })
              </script>
            <?php
              unset($_SESSION['login-failed']);
            }
            ?>
            <img src="./assests/bg1.png" alt="">
            <form action="./actions/process_login.php" method="post" autocomplete="off">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="cpassword" onclick="showPassword()">
                <label class="form-check-label" for="cpassword">Show Password</label>
              </div>
              <button type="submit" class="btn btn-success w-100" name="login">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showPassword() {
      var passwordInput = document.getElementById("password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
  </script>
</body>

</html>