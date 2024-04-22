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

if (isset($_GET['subject_edit'])) {
  $subject = $_GET['subject_edit'];

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
  <title>SJDC | Student</title>
</head>

<body>
  <?php include("../components/teacher_navbar.php"); ?>
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
              <a href="teacher_grade.php" class="btn btn-primary btn-sm">Back</a>
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
                <form action="../actions/teacher_update_grade.php" method="post" id="editGrade">
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
                      $studentStatus = 0;
                      $stmtEnroll = $conn->prepare("SELECT e.*, c.*, u.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN users u ON e.student_id = u.id WHERE c.adviser = ? AND e.sy = ? AND u.status = ?");
                      $stmtEnroll->bind_param("iii", $id, $sy, $studentStatus);
                      $stmtEnroll->execute();
                      $stmtResultEnroll = $stmtEnroll->get_result();

                      if (mysqli_num_rows($stmtResultEnroll) > 0) {
                        while ($rowStudent = $stmtResultEnroll->fetch_assoc()) {
                      ?>
                          <tr class="wew">
                            <td><?php echo $rowStudent['lrn_number']; ?></td>
                            <td><?php echo $rowStudent['lname'] . ', ' . $rowStudent['fname']; ?></td>
                            <td>
                              <input type="hidden" name="subject" value="<?php echo $subject; ?>">
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
                              <select class="form-control" name="grade[<?php echo $rowStudent['student_id']; ?>]" required>
                                <option class="text-center" value="N/A" <?php echo ($currentGrade == 'N/A') ? 'selected' : ''; ?>>N/A</option>
                                <?php
                                for ($i = 50; $i <= 100; $i++) {
                                  $selected = ($currenGrade != 'N/A' && $i == $currentGrade) ? 'selected' : '';
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
    $(document).ready(function() {
      $("#example1").DataTable({
        "paging": false,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": [{
          text: 'Edit Grades',
          className: 'upload-button', // Add a class to the button for easy targeting
          action: function() {
            // Check again if there are rows with assigned students before submitting
            var tableRows = $('#example1 tbody tr:not(.no-assign-student)').length;
            if (tableRows > 0) {
              // If there are assigned students, submit the form
              Swal.fire({
                title: "Update Grades?",
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
                text: "No Assign Student",
              });
            }
          }
        }, ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>


</body>

</html>