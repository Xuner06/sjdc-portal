<?php
include("../database/database.php");
session_start();
$id = $_SESSION['teacher'];


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
                $sqlSy = "SELECT * FROM school_year WHERE status = 'Active'";
                $querySy = mysqli_query($conn, $sqlSy);
                if ($querySy && mysqli_num_rows($querySy) > 0) {
                  $result = mysqli_fetch_assoc($querySy);
                  $sy = $result['sy_id'];

                  $sql = "SELECT e.*, c.adviser, s.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN student s ON e.student_id = s.student_id WHERE c.adviser = '$id' AND e.sy = '$sy'";
                  $query = mysqli_query($conn, $sql);
                  
                  echo '<h3>'.mysqli_num_rows($query).'</h3>';
                } 
                else {
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
                <h3>0</h3>

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
                <h3>0</h3>

                <p>Total Classes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Total Teachers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

</body>

</html>