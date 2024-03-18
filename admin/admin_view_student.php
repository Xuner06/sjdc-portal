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
  $studentId = $_GET['id'];
  $stmtStudent = $conn->prepare("SELECT * FROM student WHERE student_id = ?");
  $stmtStudent->bind_param("i", $studentId);
  $stmtStudent->execute();
  $stmtResultStudent = $stmtStudent->get_result();
  $rowStudent = $stmtResultStudent->fetch_assoc();

  if(mysqli_num_rows($stmtResultStudent) == 0) {
    header("Location: ../admin/admin_student.php");
    exit();
  }
} 
else {
  header("Location: ../admin/admin_student.php");
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
                <p><strong>LRN Number:</strong> <?php echo $rowStudent['lrn_number']; ?></p>
                <p><strong>First Name:</strong> <?php echo $rowStudent['fname']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $rowStudent['lname']; ?></p>
                <p><strong>Gender:</strong> <?php echo $rowStudent['gender']; ?></p>
                <p><strong>Age:</strong> <?php echo $rowStudent['age']; ?></p>
                <p><strong>Birthday:</strong> <?php echo date("F d, Y", strtotime($rowStudent['birthday'])); ?></p>
                <p><strong>Contact:</strong> <?php echo $rowStudent['contact']; ?></p>
                <p><strong>Email:</strong> <?php echo $rowStudent['email']; ?></p>
                <p><strong>Address:</strong> <?php echo $rowStudent['address']; ?></p>
                <p><strong>Account Created:</strong> <?php echo date("F d, Y", strtotime($rowStudent['reg_date'])); ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>