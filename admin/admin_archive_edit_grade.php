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

if (isset($_GET['edit'])) {
  $enrollId = $_GET['edit'];

  $stmtEnroll = $conn->prepare("SELECT e.* FROM enroll_student e WHERE e.enroll_id = ?");
  $stmtEnroll->bind_param("i", $enrollId);
  $stmtEnroll->execute();
  $stmtResultEnroll = $stmtEnroll->get_result();
  $result = $stmtResultEnroll->fetch_assoc();

  if (mysqli_num_rows($stmtResultEnroll) == 0) {
    header("Location: admin_archive_sy.php");
    exit();
  }
} else {
  header("Location: admin_archive_sy.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | Student</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['success-update'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['success-update']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['success-update']);
    }
    ?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Grade</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="admin_archive_sy.php" class="btn btn-primary btn-sm">Back</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Student Edit Grade</h1>
                <form action="../actions/admin_update_archive_grade.php" method="post" id="editGrade">
                  <input type="hidden" value="<?php echo $result['student_id']; ?>" name="student-id">
                  <input type="hidden" value="<?php echo $result['enroll_id']; ?>" name="enroll-id">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $studentId = $result['student_id'];
                      $sy = $result['sy'];
                      $stmtGrade = $conn->prepare("SELECT g.*, s.* FROM grade g JOIN subject s ON g.subject = s.subject_id WHERE g.student = ? AND g.sy = ?");
                      $stmtGrade->bind_param("ii", $studentId, $sy);
                      $stmtGrade->execute();
                      $stmtResultGrade = $stmtGrade->get_result();

                      if (mysqli_num_rows($stmtResultGrade) > 0) {
                        while ($row = $stmtResultGrade->fetch_assoc()) {
                      ?>
                          <tr>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                              <select class="form-control" name="grade[<?php echo $row['subject_id']; ?>]" required>
                                <?php
                                for ($i = 50; $i <= 100; $i++) {
                                  $selected = ($i == $row['grade']) ? 'selected' : '';
                                  echo '<option value="' . $i . '" class="text-center"' . $selected . '>' . $i . '</option>';
                                }
                                ?>
                              </select>
                            </td>
                          </tr>
                        <?php
                        }
                      } else {
                        ?>
                        <tr class="no-grade">
                          <td colspan="3" class="text-center">No Grade Yet</td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </form>
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
        "searching": false,
        "info": false,
        "paging": false,
        "buttons": [{
          text: 'Edit Grades',
          action: function() {
            // Check again if there are rows with assigned students before submitting
            var tableRows = $('#example1 tbody tr:not(.no-grade)').length;
            if (tableRows > 0) {
              // If there are assigned students, submit the form
              Swal.fire({
                title: "Edit Grades?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
              }).then((result) => {
                if (result.isConfirmed) {
                  $('#editGrade').submit();
                }
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Failed",
                text: "No Grade Yet",
              });
            }
          }
        }],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>


</body>

</html>