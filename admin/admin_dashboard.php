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

// $sql = "SELECT * FROM "

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

  <script src="../plugins/chart.js-4.4.3/package/dist/chart.umd.js"></script>
  <script src="../plugins/chartjs-datalabels/chartjs-plugin-datalabels.js"></script>

  <title>SJDC | Dashboard</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['login-admin'])) {
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
          title: "<?php echo $_SESSION['login-admin']; ?>"
        });
      </script>
    <?php
      unset($_SESSION['login-admin']);
    }
    ?>

    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Dashboard</h1>
      </div>
    </div>

    <!-- <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $statusStudent = 0;
                $role = "student";
                $countStudent = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                $countStudent->bind_param("is", $statusStudent, $role);
                $countStudent->execute();
                $totalStudent = $countStudent->get_result();

                if (mysqli_num_rows($totalStudent) > 0) {
                  echo '<h3>' . mysqli_num_rows($totalStudent) . '</h3>';
                } else {
                  echo '<h3>0</h3>';
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
                $countSubject = "SELECT * FROM subject";
                $totalSubject = mysqli_query($conn, $countSubject);

                if (mysqli_num_rows($totalSubject) > 0) {
                  echo '<h3>' . mysqli_num_rows($totalSubject) . '</h3>';
                } else {
                  echo '<h3>0</h3>';
                }
                ?>
                <p>Total Subjects</p>
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

                  $countClass = $conn->prepare("SELECT * FROM class WHERE sy = ?");
                  $countClass->bind_param("i", $sy);
                  $countClass->execute();
                  $totalClass = $countClass->get_result();

                  if (mysqli_num_rows($totalClass) > 0) {
                    echo '<h3>' . mysqli_num_rows($totalClass) . '</h3>';
                  } else {
                    echo '<h3>0</h3>';
                  }
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>Total Classes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $statusTeacher = 0;
                $role = "teacher";
                $countTeacher = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                $countTeacher->bind_param("is", $statusTeacher, $role);
                $countTeacher->execute();
                $totalTeacher = $countTeacher->get_result();

                if (mysqli_num_rows($totalTeacher) > 0) {
                  echo '<h3>' . mysqli_num_rows($totalTeacher) . '</h3>';
                } else {
                  echo '<h3>0</h3>';
                }
                ?>
                <p>Total Teachers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $statusStudent = 0;
                $role = "student";
                $countStudent = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                $countStudent->bind_param("is", $statusStudent, $role);
                $countStudent->execute();
                $totalStudent = $countStudent->get_result();

                if (mysqli_num_rows($totalStudent) > 0) {
                  echo '<h3>' . mysqli_num_rows($totalStudent) . '</h3>';
                } else {
                  echo '<h3>0</h3>';
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
                $countSubject = "SELECT * FROM subject";
                $totalSubject = mysqli_query($conn, $countSubject);

                if (mysqli_num_rows($totalSubject) > 0) {
                  echo '<h3>' . mysqli_num_rows($totalSubject) . '</h3>';
                } else {
                  echo '<h3>0</h3>';
                }
                ?>
                <p>Total Subjects</p>
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

                  $countClass = $conn->prepare("SELECT * FROM class WHERE sy = ?");
                  $countClass->bind_param("i", $sy);
                  $countClass->execute();
                  $totalClass = $countClass->get_result();

                  if (mysqli_num_rows($totalClass) > 0) {
                    echo '<h3>' . mysqli_num_rows($totalClass) . '</h3>';
                  } else {
                    echo '<h3>0</h3>';
                  }
                } else {
                  echo '<h3>No Active SY</h3>';
                }
                ?>
                <p>Total Classes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-12">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $statusTeacher = 0;
                $role = "teacher";
                $countTeacher = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                $countTeacher->bind_param("is", $statusTeacher, $role);
                $countTeacher->execute();
                $totalTeacher = $countTeacher->get_result();

                if (mysqli_num_rows($totalTeacher) > 0) {
                  echo '<h3>' . mysqli_num_rows($totalTeacher) . '</h3>';
                } else {
                  echo '<h3>0</h3>';
                }
                ?>
                <p>Total Teachers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="card">
              <div class="card-body">
                <?php
                $getStatus = "Active";
                $getSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $getSy->bind_param("s", $getStatus);
                $getSy->execute();
                $getResultSy = $getSy->get_result();
                if (mysqli_num_rows($getResultSy) > 0) {
                  $resultGetSy = $getResultSy->fetch_assoc();
                  $schoolyear = $resultGetSy['sy_id'];
                  $role = "student";

                  $stmtCheckEnroll = $conn->prepare("SELECT COUNT(*) AS total_enroll FROM enroll_student e WHERE e.sy = ?;");
                  $stmtCheckEnroll->bind_param("i", $schoolyear);
                  $stmtCheckEnroll->execute();
                  $stmtCheckEnrollResult = $stmtCheckEnroll->get_result();
                  $enrollResult = $stmtCheckEnrollResult->fetch_assoc();

                  $stmtCheckNotEnroll = $conn->prepare("SELECT (SELECT COUNT(*) FROM users u WHERE role = ?) - (SELECT COUNT(*) FROM enroll_student e WHERE e.sy = ?) AS total_not_enroll");
                  $stmtCheckNotEnroll->bind_param("si", $role, $schoolyear);
                  $stmtCheckNotEnroll->execute();
                  $stmtCheckNotEnrollResult = $stmtCheckNotEnroll->get_result();
                  $notEnrollResult = $stmtCheckNotEnrollResult->fetch_assoc();

                  $total_enroll = $enrollResult['total_enroll'];
                  $total_Not_Enroll = $notEnrollResult['total_not_enroll'];
                } else {
                  $total_enroll = 0;
                  $total_Not_Enroll = 0;
                }
                ?>
                <div>
                  <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>

                <script>
                  const ctx = document.getElementById('myChart');

                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                      labels: ['Enroll', 'Not Enroll'],
                      datasets: [{
                        label: 'Total',
                        data: ['<?php echo $total_enroll; ?>', '<?php echo $total_Not_Enroll; ?>'],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true,
                          ticks: {
                            display: false
                          }
                        }
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="card">
              <div class="card-body">
                <?php
                $fetchStatus = "Active";
                $fetchSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $fetchSy->bind_param("s", $fetchStatus);
                $fetchSy->execute();
                $fetchResultSy = $fetchSy->get_result();
                if (mysqli_num_rows($fetchResultSy) > 0) {
                  $resultFetchSy = $fetchResultSy->fetch_assoc();
                  $SY = $resultFetchSy['sy_id'];

                  $countStrand = $conn->prepare("SELECT s.strand, (SELECT COUNT(*) FROM enroll_student e LEFT JOIN class c ON e.class = c.class_id WHERE c.strand = s.strand_id AND e.sy = ?) AS total FROM strand s");
                  $countStrand->bind_param("i", $SY);
                  $countStrand->execute();
                  $countStrandResult = $countStrand->get_result();

                  while ($rowStrand = $countStrandResult->fetch_assoc()) {
                    $strandName[] = $rowStrand['strand'];
                    $totalCount[] = $rowStrand['total'];
                  }
                } else {
                  $strandName[] = "No Active School Year";
                  $totalCount[] = 0;
                }
                ?>
                <div>
                  <canvas id="myChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>

                <script>
                  const ctx2 = document.getElementById('myChart2');
                  new Chart(ctx2, {
                    type: 'pie',
                    data: {
                      labels: <?php echo json_encode($strandName); ?>,
                      datasets: [{
                        label: 'Total',
                        data: <?php echo json_encode($totalCount); ?>,
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true,
                          ticks: {
                            display: false
                          }
                        }
                      }
                    },
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>

</body>

</html>