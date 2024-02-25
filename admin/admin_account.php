<?php
include("../database/database.php");
session_start();
$sql = "SELECT * FROM class WHERE status = 1";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../font/font.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <title>SJDC | Account</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['restore-class'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['restore-class']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['restore-class']);
    }
    ?>

    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Account</h1>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="text-center">Account Profile Information</h3>
                <p><strong>First Name:</strong> Test</p>
                <p><strong>First Name:</strong> Test</p>
                <p><strong>First Name:</strong> Test</p>
                <p><strong>First Name:</strong> Test</p>
                <p><strong>First Name:</strong> Test</p>
                <p><strong>First Name:</strong> Test</p>
                <p><strong>First Name:</strong> Test</p>

              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>


</body>

</html>