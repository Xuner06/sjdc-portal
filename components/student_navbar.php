<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../font/font.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-green navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <?php
          $navStatus = "Active";
          $navSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
          $navSy->bind_param("s", $navStatus);
          $navSy->execute();
          $navResultSy = $navSy->get_result();
          if (mysqli_num_rows($navResultSy) > 0) {
            $resultschoolyear = $navResultSy->fetch_assoc();
            $navschoolyear = $resultschoolyear['start_year'] . "-" . $resultschoolyear['end_year'] . " " .  (($resultschoolyear['semester'] == "First Semester") ? "1st Sem" : "2nd Sem");
          } else {
            $navschoolyear = "No School Year";
          }
          ?>
          <span class="nav-link text-white disabled"><?php echo $navschoolyear; ?></span>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span class="nav-link text-white disabled"><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
        </li>
        <li class="nav-item d-flex align-items-center">
          <a href="../actions/process_logout.php" class="btn btn-sm btn-warning text-light"><i class="fas fa-power-off"></i> Logout</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-green elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="../assests/bg1.png" alt="SJDC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SJDC</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="../student/student_home.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'student_home.php') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../student/student_grade.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'student_grade.php' || basename($_SERVER['PHP_SELF']) == 'student_view_grade.php') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-award"></i>
                <p>
                  Grade
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../student/student_account.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'student_account.php') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                  Account
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

</body>

</html>