<?php
session_start();

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
</head>

<body>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card mt-5">
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
            <h1 class="text-center">LOGO</h1>
            <form action="./actions/process_login.php" method="post" autocomplete="off">
              <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select class="form-control" name="user" id="user" required>
                  <option value=""></option>
                  <option value="student">Student</option>
                  <option value="teacher">Teacher</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
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
                <label class="form-check-label" for="cpassword">Check Password</label>
              </div>
              <button type="submit" class="btn btn-primary" name="login">Login</button>
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