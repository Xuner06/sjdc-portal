<?php
include("../database/database.php");
include("../actions/session.php");
sessionTeacher();

$id = $_SESSION['teacher'];
$stmtTeacher = $conn->prepare("SELECT * FROM teacher WHERE teacher_id = ?");
$stmtTeacher->bind_param("i", $id);
$stmtTeacher->execute();
$stmtResult = $stmtTeacher->get_result();
$row = $stmtResult->fetch_assoc();

if (isset($_GET['id'])) {
  $studentId = $_GET['id'];
  $stmtEnroll = $conn->prepare("SELECT e.*, c.adviser, s.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN student s ON e.student_id = s.student_id WHERE e.student_id = ? AND c.adviser = ?");
  $stmtEnroll->bind_param("ii", $studentId, $id);
  $stmtEnroll->execute();
  $stmtResult = $stmtEnroll->get_result();
  $rowStudent = $stmtResult->fetch_assoc();

  if(mysqli_num_rows($stmtResult) == 0) {
    header("Location: teacher_student.php");
    exit();
  }

}
else {
  header("Location: teacher_student.php");
  exit();
}
  
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
  <title>SJDC | Student Details</title>
</head>

<body>
  <?php include("../components/teacher_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="teacher_student.php" class="btn btn-primary btn-sm">Back</a>
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