<?php
include("../database/database.php");
include("../actions/session.php");
sessionAdmin();

$id = $_SESSION['admin'];
$stmtAdmin = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtAdmin->bind_param("i", $id);
$stmtAdmin->execute();
$stmtResult = $stmtAdmin->get_result();
$row = $stmtResult->fetch_assoc();

if (isset($_GET['id'])) {
  $teacherId = $_GET['id'];
  $role = "teacher";
  $stmtTeacher = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = ?");
  $stmtTeacher->bind_param("is", $teacherId, $role);
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
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
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
                <p><strong>Middle Name:</strong> <?php echo $rowTeacher['mname']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $rowTeacher['lname']; ?></p>
                <p><strong>Sex:</strong> <?php echo $rowTeacher['gender']; ?></p>
                <?php
                $currentDate = date('Y-m-d'); // Current date in 'Y-m-d' format
                $bd = $rowTeacher['birthday']; // Assuming 'birthday' is also in 'Y-m-d' format

                // Calculate the age
                $birthYear = date('Y', strtotime($bd)); // Extract the birth year from the birthday
                $birthMonthDay = date('m-d', strtotime($bd)); // Extract the birth month and day

                $currentYear = date('Y', strtotime($currentDate));
                $currentMonthDay = date('m-d', strtotime($currentDate));

                $age = $currentYear - $birthYear;

                // If the birthday hasn't occurred yet this year, subtract one from the age
                if ($currentMonthDay < $birthMonthDay) {
                  $age--;
                }
                ?>
                <p><strong>Age:</strong> <?php echo $age; ?></p>
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