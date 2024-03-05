<?php
include("../database/database.php");
include("../actions/session.php");
sessionTeacher();

$idTeacher = $_SESSION['teacher'];
$sql = "SELECT * FROM teacher WHERE teacher_id = '$idTeacher'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

if (isset($_GET['view'])) {
  $id = mysqli_escape_string($conn, $_GET['view']);

  $sql = "SELECT e.*, sy.*, c.* FROM enroll_student e JOIN school_year sy ON e.sy = sy.sy_id JOIN class c ON e.class = c.class_id WHERE e.enroll_id = '$id' AND c.adviser = '$idTeacher'";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);

  if (!$result) {
    header("Location: ../unauthorize.php");
    exit();
  }
  $studentId = $result['student_id'];
  $sy = $result['sy'];

  $sqlGrade = "SELECT * FROM grade g JOIN subject s ON g.subject = s.subject_id WHERE g.student = '$studentId' AND g.sy = '$sy'";
  $queryGrade = mysqli_query($conn, $sqlGrade);
} else {
  header("Location: teacher_grade.php");
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
  <?php include("../components/teacher_navbar.php"); ?>
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Grade</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="teacher_grade.php" class="btn btn-primary btn-sm">Back</a>
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
                    $sqlSum = "SELECT ROUND((SUM(g.grade) / COUNT(g.grade))) AS total FROM grade g WHERE g.student = '$studentId' AND g.sy = '$sy'";
                    $querySum = mysqli_query($conn, $sqlSum);
                    $result = mysqli_fetch_assoc($querySum);
                    $total = $result['total'];

                    while ($row = mysqli_fetch_assoc($queryGrade)) {
                    ?>
                      <tr>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                    <tr>
                      <td colspan="2">Total</td>
                      <td class="d-none"></td>
                      <td><?php echo $total; ?></td>
                    </tr>
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
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>