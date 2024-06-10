<?php
include("../database/database.php");
include("../actions/session.php");
sessionStudent();

$id = $_SESSION['student'];
$stmtStudent = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtStudent->bind_param("i", $id);
$stmtStudent->execute();
$stmtResult = $stmtStudent->get_result();
$row = $stmtResult->fetch_assoc();

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
  <title>SJDC | Home</title>
</head>

<body>
  <?php include("../components/student_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['login-student'])) {
    ?>
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 1000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
        Toast.fire({
          icon: "success",
          title: "<?php echo $_SESSION['login-student']; ?>"
        });
      </script>
    <?php
      unset($_SESSION['login-student']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Home</h1>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $status = "Active";
                $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $stmtSy->bind_param("s", $status);
                $stmtSy->execute();
                $stmtResultSy = $stmtSy->get_result();

                if (mysqli_num_rows($stmtResultSy) > 0) {
                  $result = $stmtResultSy->fetch_assoc();
                  $start_year = $result['start_year'];
                  $end_year = $result['end_year'];

                  echo '<h3>' . $start_year . '-' . $end_year . '</h3>';
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>School Year</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $status = "Active";
                $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $stmtSy->bind_param("s", $status);
                $stmtSy->execute();
                $stmtResultSy = $stmtSy->get_result();
                if (mysqli_num_rows($stmtResultSy) > 0) {
                  $result = $stmtResultSy->fetch_assoc();
                  $sem = $result['semester'];

                  echo '<h3>' . (($sem == "First Semester") ? "1st Semester" : "2nd Semester") . '</h3>';
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>Semester</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                $status = "Active";
                $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $stmtSy->bind_param("s", $status);
                $stmtSy->execute();
                $stmtResultSy = $stmtSy->get_result();
                if (mysqli_num_rows($stmtResultSy) > 0) {
                  $result = $stmtResultSy->fetch_assoc();
                  $sy = $result['sy_id'];
                  $status = 0;
                  $stmtEnroll = $conn->prepare("SELECT * FROM users u LEFT JOIN enroll_student e ON u.id = e.student_id WHERE u.id = ? AND e.sy = ?");
                  $stmtEnroll->bind_param("ii", $id, $sy);
                  $stmtEnroll->execute();
                  $stmtResultEnroll = $stmtEnroll->get_result();

                  if (mysqli_num_rows($stmtResultEnroll) > 0) {
                    $status = "Enrolled";
                  } else {
                    $status = "Not Enrolled";
                  }
                  echo '<h3>' . $status . '</h3>';
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>Status</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

</body>

</html>