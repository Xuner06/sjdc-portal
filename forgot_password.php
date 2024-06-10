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
  <title>SJDC | Forgot Password</title>
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
            if (isset($_SESSION['email-send'])) {
            ?>
              <script>
                Swal.fire({
                  title: 'Success',
                  text: '<?php echo $_SESSION['email-send']; ?>',
                  icon: 'success',
                  position: 'top',
                })
              </script>
            <?php
              unset($_SESSION['email-send']);
            }
            ?>
            <img src="./assests/bg1.png" alt="">
            <form action="./actions/send_password.php" method="post" autocomplete="off">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
              <div class="mb-3">
                <a href="login.php" class="text-dark">Login</a>
              </div>
              <button type="submit" class="btn btn-success w-100" name="send">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>