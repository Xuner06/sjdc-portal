<?php
include("../database/database.php");
include("../actions/session.php");
sessionTeacher();

$id = $_SESSION['teacher'];
$stmtTeacher = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtTeacher->bind_param("i", $id);
$stmtTeacher->execute();
$stmtResult = $stmtTeacher->get_result();
$row = $stmtResult->fetch_assoc();

if (isset($_GET['subject_view'])) {
  $subject = $_GET['subject_view'];

  $status = "Active";
  $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtSy->bind_param("s", $status);
  $stmtSy->execute();
  $stmtResultSy = $stmtSy->get_result();
  $resultSy = $stmtResultSy->fetch_assoc();
  $sy = $resultSy['sy_id'];

  $stmtClass = $conn->prepare("SELECT * FROM class c JOIN school_year sy ON c.sy = sy.sy_id WHERE adviser = ? AND sy = ?");
  $stmtClass->bind_param("ii", $id, $sy);
  $stmtClass->execute();
  $stmtResultClass = $stmtClass->get_result();
  $class = $stmtResultClass->fetch_assoc();

  $level = $class['level'];
  $strand = $class['strand'];
  $semester = $class['semester'];

  $stmtSubject = $conn->prepare("SELECT * FROM subject WHERE subject_id = ?");
  $stmtSubject->bind_param("i", $subject);
  $stmtSubject->execute();
  $stmtResultSubject = $stmtSubject->get_result();
  $resultSubject = $stmtResultSubject->fetch_assoc();

  $subjectLevel = $resultSubject['level'];
  $subjectStrand = $resultSubject['strand'];
  $subjectSemester = $resultSubject['semester'];

  if ($level != $subjectLevel || $strand != $subjectStrand || $semester != $subjectSemester) {
    header("Location: teacher_grade.php");
    exit();
  }
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
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
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
                <h1 class="text-center mb-4 mt-4"><?php echo $resultSubject['name']; ?></h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = "Active";
                    $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                    $stmtSy->bind_param("s", $status);
                    $stmtSy->execute();
                    $stmtResultSy = $stmtSy->get_result();
                    $resultSy = $stmtResultSy->fetch_assoc();
                    $sy = $resultSy['sy_id'];

                    $studentStatus = 0;
                    $stmtEnroll = $conn->prepare("SELECT e.*, c.*, u.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN users u ON e.student_id = u.id WHERE c.adviser = ? AND e.sy = ? AND u.status = ?");
                    $stmtEnroll->bind_param("iii", $id, $sy, $studentStatus);
                    $stmtEnroll->execute();
                    $stmtResultEnroll = $stmtEnroll->get_result();

                    if (mysqli_num_rows($stmtResultEnroll) > 0) {
                      while ($rowStudent = $stmtResultEnroll->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $rowStudent['lrn_number']; ?></td>
                          <td><?php echo $rowStudent['lname'] . ", " . $rowStudent['fname'] . " " . (!empty($rowStudent['mname']) ? substr($rowStudent['mname'], 0, 1) . "." : ""); ?></td>
                          <td>
                            <?php
                            $stmtGrade = $conn->prepare("SELECT * FROM grade WHERE student = ? AND subject = ? AND sy = ?");
                            $stmtGrade->bind_param("iii", $rowStudent['student_id'], $subject, $sy);
                            $stmtGrade->execute();
                            $stmtResultGrade = $stmtGrade->get_result();

                            if (mysqli_num_rows($stmtResultGrade) > 0) {
                              $grade = $stmtResultGrade->fetch_assoc();
                              $currentGrade = $grade['grade'];
                            } else {
                              $currentGrade = 'N/A';
                            }
                            ?>
                            <?php echo $currentGrade; ?>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr class="no-assign-student">
                        <td colspan="3" class="text-center">No Assign Student</td>
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
        "paging": true,
        "order": [
          [1, "asc"]
        ],
        "buttons": [{
          extend: 'copy',
          className: 'mr-2 rounded rounded-2',
        }, {
          extend: 'csv',
          className: 'mr-2 rounded rounded-2',
          exportOptions: {
            format: {
              body: function(data, row, column, node) {
                // Apply single quotation marks for columns 0 and 3
                return column === 0 ? "'" + data + "'" : data;
              }
            }
          }
        }, {
          extend: 'pdf',
          className: 'mr-2 rounded rounded-2',
        }, {
          extend: 'print',
          className: 'mr-2 rounded rounded-2',
          title: '',
          messageTop: function() {
            return '<h1 class="text-center mb-4"><?php echo $resultSubject['name']; ?></h1>';
          }
        }],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
  </script>
</body>

</html>