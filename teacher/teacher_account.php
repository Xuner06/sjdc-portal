<?php
include("../database/database.php");
session_start();

$id = $_SESSION['teacher'];
$sql = "SELECT * FROM teacher WHERE teacher_id = '$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../font/font.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <title>SJDC | Account</title>
</head>

<body>
  <?php include("../components/teacher_navbar.php"); ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Account</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Teacher Account Information</h1>
                <p><strong>First Name:</strong> <?php echo $row['fname']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['lname']; ?></p>
                <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
                <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
                <p><strong>Birthday:</strong> <?php echo date("F d, Y", strtotime($row['birthday'])); ?></p>
                <p><strong>Contact:</strong> <?php echo $row['contact']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                <p><strong>Account Created:</strong> <?php echo date("F d, Y", strtotime($row['reg_date'])); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>