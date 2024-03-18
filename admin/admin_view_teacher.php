<?php
include("../database/database.php");
include("../actions/session.php");
sessionAdmin();

$id = $_SESSION['admin'];
$stmtTeacher = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");
$stmtTeacher->bind_param("i", $id);
$stmtTeacher->execute();
$stmtResult = $stmtTeacher->get_result();
$row = $stmtResult->fetch_assoc();

if (isset($_GET['id'])) {
  $teacherId = $_GET['id'];
  $stmtTeacher = $conn->prepare("SELECT * FROM teacher WHERE teacher_id = ?");
  $stmtTeacher->bind_param("i", $teacherId);
  $stmtTeacher->execute();
  $stmtResultTeacher = $stmtTeacher->get_result();
  $rowTeacher = $stmtResultTeacher->fetch_assoc();

  if(mysqli_num_rows($stmtResultTeacher) == 0) {
    header("Location: admin_teacher.php");
    exit();
  }
} 
else {
  header("Location: admin_teacher.php");
  exit();
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
  <title>SJDC | Teacher</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Teacher Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="admin_teacher.php" class="btn btn-primary btn-sm">Back</a>
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
                <h1 class="text-center">Teacher Account Information</h1>
                <p><strong>First Name:</strong> <?php echo $rowTeacher['fname']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $rowTeacher['lname']; ?></p>
                <p><strong>Gender:</strong> <?php echo $rowTeacher['gender']; ?></p>
                <p><strong>Age:</strong> <?php echo $rowTeacher['age']; ?></p>
                <p><strong>Birthday:</strong> <?php echo date("F d, Y", strtotime($rowTeacher['birthday'])); ?></p>
                <p><strong>Contact:</strong> <?php echo $rowTeacher['contact']; ?></p>
                <p><strong>Email:</strong> <?php echo $rowTeacher['email']; ?></p>
                <p><strong>Address:</strong> <?php echo $rowTeacher['address']; ?></p>
                <p><strong>Account Created:</strong> <?php echo date("F d, Y", strtotime($rowTeacher['reg_date'])); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>