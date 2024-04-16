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
  <title>SJDC | Archive</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['restore-student'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['restore-student']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['restore-student']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Student Archive</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Age</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Restore</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = 1;
                    $role = "student";
                    $stmtStudent = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                    $stmtStudent->bind_param("is", $status, $role);
                    $stmtStudent->execute();
                    $stmtResultStudent = $stmtStudent->get_result();
                    if (mysqli_num_rows($stmtResultStudent) > 0) {
                      while ($rowStudent = $stmtResultStudent->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $rowStudent['lrn_number']; ?></td>
                          <td><?php echo $rowStudent['fname'] . " " . $rowStudent['lname']; ?></td>
                          <td><?php echo $rowStudent['gender']; ?></td>
                          <?php
                          $currentDate = date('Y-m-d'); // Current date in 'Y-m-d' format
                          $bd = $rowStudent['birthday']; // Assuming 'birthday' is also in 'Y-m-d' format

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
                          <td><?php echo $age; ?></td>
                          <td><?php echo $rowStudent['email']; ?></td>
                          <td><?php echo $rowStudent['contact']; ?></td>
                          <td>
                            <form action="../actions/admin_restore_student.php" method="post">
                              <input type="hidden" name="restore-id" value="<?php echo $rowStudent['id']; ?>">
                              <button type="submit" class="btn btn-primary btn-sm" name="restore-student">Restore</button>
                            </form>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="7" class="text-center">Empty Student Archive</td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
                      </tr>
                    <?php
                    }
                    ?>

                  </tbody>
                </table>

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

  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>