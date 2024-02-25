<?php
include("../database/database.php");
session_start();


if (isset($_POST['view-student'])) {
  $id = mysqli_escape_string($conn, $_POST['view-id']);
  $sql = "SELECT * FROM student WHERE student_id = '$id'";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($query);
} else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_student.php"</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <title>SJDC | Student</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="admin_student.php" class="btn btn-primary btn-sm">Back</a>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Student Account Information</h1>
                <p><strong>LRN Number:</strong> <?php echo $row['lrn_number']; ?></p>
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