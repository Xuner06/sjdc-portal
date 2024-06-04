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
  <script src="../plugins/chart.js/Chart.js"></script>
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
                <div>
                  <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                  const ctx = document.getElementById('myChart');

                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                      datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
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
                <div>
                  <canvas id="myChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <script>
                  const ctx2 = document.getElementById('myChart2');

                  new Chart(ctx2, {
                    type: 'bar',
                    data: {
                      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                      datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
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