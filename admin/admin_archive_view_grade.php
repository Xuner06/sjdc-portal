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

if (isset($_GET['view'])) {
  $enrollId = $_GET['view'];

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
  <title>SJDC | Grade</title>

</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Grade</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="admin_archive_sy.php" class="btn btn-primary btn-sm">Back</a>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Student Grade</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Subject Name</th>
                      <th>Grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $studentId = $result['student_id'];
                    $sy = $result['sy'];

                    $stmtGrade = $conn->prepare("SELECT * FROM grade g JOIN subject s ON g.subject = s.subject_id WHERE g.student = ? AND g.sy = ?");
                    $stmtGrade->bind_param("ii", $studentId, $sy);
                    $stmtGrade->execute();
                    $stmtResultGrade = $stmtGrade->get_result();

                    if (mysqli_num_rows($stmtResultGrade) > 0) {
                      while ($grade = $stmtResultGrade->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $grade['name']; ?></td>
                          <td><?php echo $grade['grade']; ?></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="2" class="text-center">Not Graded Yet</td>
                        <td class="d-none"></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                  <?php
                  $stmtAverage = $conn->prepare("SELECT ROUND(AVG(g.grade)) AS average FROM grade g WHERE g.student = ? AND g.sy = ?");
                  $stmtAverage->bind_param("ii", $studentId, $sy);
                  $stmtAverage->execute();
                  $stmtResultAverage = $stmtAverage->get_result();

                  if (mysqli_num_rows($stmtResultAverage) > 0) {
                    $average = $stmtResultAverage->fetch_assoc();
                    $total = $average['average'];
                    if ($total !== null) {
                  ?>
                      <tfoot>
                        <tr>
                          <td><strong>GWA</strong></td>
                          <td><strong><?php echo $total; ?></strong></td>
                        </tr>
                      </tfoot>
                  <?php
                    }
                  }
                  ?>
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
      var enrollId = <?php echo json_encode($enrollId); ?>;
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "info": false,
        "paging": false,
        "buttons": [{
            extend: 'copy',
            className: 'mr-2 rounded rounded-2',
          },
          {
            extend: 'csv',
            className: 'mr-2 rounded rounded-2',
          },
          {
            extend: 'excel',
            className: 'mr-2 rounded rounded-2',
          },
          {
            extend: 'pdf',
            className: 'mr-2 rounded rounded-2',
          },
          {
            className: 'mr-2 rounded rounded-2',
            text: 'Print',
            action: function() {
              window.open('admin_print_grade.php?view=' + enrollId, '_blank');
            }
          }
        ],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
  </script>
</body>

</html>