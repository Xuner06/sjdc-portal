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
  <title>SJDC | Teacher</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['restore-teacher'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['restore-teacher']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['restore-teacher']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Teacher Archive</h1>
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
                      <th>Teacher ID</th>
                      <th>Name</th>
                      <th>Sex</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = 1;
                    $role = "teacher";
                    $stmtTeacher = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                    $stmtTeacher->bind_param("is", $status, $role);
                    $stmtTeacher->execute();
                    $stmtResultTeacher = $stmtTeacher->get_result();

                    if (mysqli_num_rows($stmtResultTeacher) > 0) {
                      while ($rowTeacher = $stmtResultTeacher->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $rowTeacher['id']; ?></td>
                          <td><?php echo $rowTeacher['lname'] . ", " . $rowTeacher['fname'] . " " . substr($rowTeacher['mname'], 0, 1) . "."; ?></td>
                          <td><?php echo $rowTeacher['gender']; ?></td>
                          <td><?php echo $rowTeacher['email']; ?></td>
                          <td><?php echo $rowTeacher['contact']; ?></td>
                          <td>
                            <form action="../actions/admin_restore_teacher.php" method="post">
                              <input type="hidden" name="restore-id" value="<?php echo $rowTeacher['id']; ?>">
                              <button type="submit" class="btn btn-primary btn-sm" name="restore-teacher">Restore</button>
                            </form>
                          </td>
                        </tr>
                      <?php
                      }
                    } 
                    else {
                    ?>
                      <tr>
                        <td colspan="6" class="text-center">Empty Teacher Archive</td>
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
        </div>
      </div>
    </div>
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
    });
  </script>
</body>

</html>