<?php
include("../database/database.php");
include("../actions/session.php");
sessionTeacher();

$id = $_SESSION['teacher'];
$stmtTeacher = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtTeacher->bind_param("i", $id);
$stmtTeacher->execute();
$stmtResult = $stmtTeacher->get_result();
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
  <title>SJDC | Dashboard</title>
</head>

<body>
  <?php include("../components/teacher_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['login-teacher'])) {
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
          title: "<?php echo $_SESSION['login-teacher']; ?>"
        });
      </script>
    <?php
      unset($_SESSION['login-teacher']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Dashboard</h1>
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
                  $sy = $result['sy_id'];
                  $status = 0;
                  $stmtEnroll = $conn->prepare("SELECT e.*, c.*, u.status FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN users u ON e.student_id = u.id WHERE c.adviser = ? AND e.sy = ? AND u.status = ?");
                  $stmtEnroll->bind_param("iii", $id, $sy, $status);
                  $stmtEnroll->execute();
                  $stmtResultEnroll = $stmtEnroll->get_result();
                  echo '<h3>' . mysqli_num_rows($stmtResultEnroll) . '</h3>';
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>Total Students</p>
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
                  $sy = $result['sy_id'];
                  $status = 0;
                  $stmtGrade = $conn->prepare("SELECT g.student, ROUND(AVG(g.grade)) AS average, c.adviser FROM grade g JOIN class c ON g.class = c.class_id JOIN users u ON g.student = u.id WHERE g.sy = ? AND c.adviser = ? AND u.status = ? GROUP BY g.student HAVING average >= 75");
                  $stmtGrade->bind_param("iii", $sy, $id, $status);
                  $stmtGrade->execute();
                  $stmtResultGrade = $stmtGrade->get_result();
                  echo '<h3>' . mysqli_num_rows($stmtResultGrade) . '</h3>';
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>Total Passed</p>
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
                  $stmtGrade = $conn->prepare("SELECT g.student, ROUND(AVG(g.grade)) AS average, c.adviser FROM grade g JOIN class c ON g.class = c.class_id JOIN users u ON g.student = u.id WHERE g.sy = ? AND c.adviser = ? AND u.status = ? GROUP BY g.student HAVING average < 75");
                  $stmtGrade->bind_param("iii", $sy, $id, $status);
                  $stmtGrade->execute();
                  $stmtResultGrade = $stmtGrade->get_result();
                  echo '<h3>' . mysqli_num_rows($stmtResultGrade) . '</h3>';
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>


                <p>Total Failed</p>
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