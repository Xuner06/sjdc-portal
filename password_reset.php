<?php
session_start();
include("./database/database.php");

if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $token_hash = hash("sha256", $token);
  
  $checkToken = $conn->prepare("SELECT * FROM users u WHERE token = ?");
  $checkToken->bind_param("s", $token_hash);
  $checkToken->execute();
  $result = $checkToken->get_result();
  $fetchToken = $result->fetch_assoc();

  if(mysqli_num_rows($result) > 0) {
    $token_expiry = $fetchToken['token_expiration'];

    if(strtotime($token_expiry) <= time()) {
      header("Location: forgot_password.php");
      exit();
    }
  }
  else {
    header("Location: forgot_password.php");
    exit();
  }
}
else {
  header("Location: forgot_password.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SJDC | Password Reset</title>
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
            if (isset($_SESSION['pass-not-match'])) {
            ?>
              <script>
                Swal.fire({
                  title: 'Failed',
                  text: '<?php echo $_SESSION['pass-not-match']; ?>',
                  icon: 'error',
                  position: 'top',
                })
              </script>
            <?php
              unset($_SESSION['pass-not-match']);
            }
            ?>
            <img src="./assests/bg1.png" alt="">
            <form action="./actions/recover_password.php" method="post" autocomplete="off">
              <input type="hidden" name="token" value="<?php echo $token; ?>">
              <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password" required>
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
              </div>
              <button type="submit" class="btn btn-success w-100" name="change-password">Change Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>