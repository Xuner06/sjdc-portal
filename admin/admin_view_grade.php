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
  $status = "Active";
  $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtSy->bind_param("s", $status);
  $stmtSy->execute();
  $stmtResultSy = $stmtSy->get_result();
  $result = $stmtResultSy->fetch_assoc();
  $sy = $result['sy_id'];

  $stmtEnroll = $conn->prepare("SELECT e.*, sy.*, c.* FROM enroll_student e JOIN school_year sy ON e.sy = sy.sy_id JOIN class c ON e.class = c.class_id WHERE e.enroll_id = ? AND e.sy = ?");
  $stmtEnroll->bind_param("ii", $enrollId, $sy);
  $stmtEnroll->execute();
  $stmtResultEnroll = $stmtEnroll->get_result();
  $result = $stmtResultEnroll->fetch_assoc();

  if (mysqli_num_rows($stmtResultEnroll) == 0) {
    header("Location: admin_grade.php");
    exit();
  }
} else {
  header("Location: admin_grade.php");
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
              <a href="admin_grade.php" class="btn btn-primary btn-sm">Back</a>
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
                      <th>Subject Code</th>
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

                    $stmtAverage = $conn->prepare("SELECT ROUND(AVG(g.grade)) AS average FROM grade g WHERE g.student = ? AND g.sy = ?");
                    $stmtAverage->bind_param("ii", $studentId, $sy);
                    $stmtAverage->execute();
                    $stmtResultAverage = $stmtAverage->get_result();
                    $average = $stmtResultAverage->fetch_assoc();
                    $total = $average['average'];

                    if (mysqli_num_rows($stmtResultGrade) > 0) {
                      while ($grade = $stmtResultGrade->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $grade['subject']; ?></td>
                          <td><?php echo $grade['name']; ?></td>
                          <td><?php echo $grade['grade']; ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                      <tr>
                        <td colspan="2">Total</td>
                        <td class="d-none"></td>
                        <td><?php echo $total; ?></td>
                      </tr>
                    <?php
                    } else {
                    ?>
                      <tr>
                        <td colspan="3" class="text-center">Not Graded Yet</td>
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
        "info": false,
        "paging": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
  </script>
</body>

</html>