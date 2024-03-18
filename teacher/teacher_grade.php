<?php
include("../database/database.php");
include("../actions/session.php");
sessionTeacher();

$id = $_SESSION['teacher'];
$stmtTeacher = $conn->prepare("SELECT * FROM teacher WHERE teacher_id = ?");
$stmtTeacher->bind_param("i", $id);
$stmtTeacher->execute();
$stmtResult = $stmtTeacher->get_result();
$row = $stmtResult->fetch_assoc();

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
        <h1 class="m-0">Student Grade</h1>
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
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Final Average</th>
                      <th>Remarks</th>
                      <th>View</th>
                      <th>Edit</th>
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

                    if (mysqli_num_rows($stmtResultSy) > 0) {
                      $result = $stmtResultSy->fetch_assoc();
                      $sy = $result['sy_id'];

                      $stmtEnroll = $conn->prepare("SELECT e.*, c.adviser, s.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN student s ON e.student_id = s.student_id WHERE c.adviser = ? AND e.sy = ?");
                      $stmtEnroll->bind_param("ii", $id, $sy);
                      $stmtEnroll->execute();
                      $stmtResultEnroll = $stmtEnroll->get_result();
                      if (mysqli_num_rows($stmtResultEnroll) > 0) {
                        while ($rowStudent = $stmtResultEnroll->fetch_assoc()) {
                          $stmtGrade = $conn->prepare("SELECT * FROM grade g JOIN subject s ON g.subject = s.subject_id WHERE g.student = ? AND g.sy = ?");
                          $stmtGrade->bind_param("ii", $rowStudent['student_id'], $rowStudent['sy']);
                          $stmtGrade->execute();
                          $stmtResultGrade = $stmtGrade->get_result();
                    ?>
                          <tr>
                            <td><?php echo $rowStudent['lrn_number']; ?></td>
                            <td><?php echo $rowStudent['lname'] . ", " . $rowStudent['fname']; ?></td>
                            <td>
                              <?php
                              if (mysqli_num_rows($stmtResultGrade) > 0) {
                                $stmtAverage = $conn->prepare("SELECT ROUND(AVG(g.grade)) AS average FROM grade g WHERE g.student = ? AND g.sy = ?");
                                $stmtAverage->bind_param("ii", $rowStudent['student_id'], $rowStudent['sy']);
                                $stmtAverage->execute();
                                $stmtResultAverage = $stmtAverage->get_result();
                                $average = $stmtResultAverage->fetch_assoc();
                                $total = $average['average'];
                                echo $total;
                              } else {
                                echo "N/A";
                              }

                              ?>
                            </td>
                            <td>
                              <?php
                              if (mysqli_num_rows($stmtResultGrade) > 0) {
                                if ($total >= 75) {
                                  echo "Passed";
                                } else {
                                  echo "Failed";
                                }
                              }
                              else {
                                echo "N/A";
                              }
                              ?>
                            </td>
                            <td>
                              <a href="teacher_view_grade.php?view=<?php echo $rowStudent['enroll_id']; ?>" class="btn btn-primary btn-sm">View</a>
                            </td>
                            <td>
                              <a href="teacher_edit_grade.php?edit=<?php echo $rowStudent['enroll_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            </td>
                            <td>
                              <a href="teacher_encode_grade.php?grade=<?php echo $rowStudent['enroll_id']; ?>" class="btn btn-primary btn-sm">Upload</a>
                            </td>
                          </tr>
                        <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="7" class="text-center">No Assign Student</td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                          <td class="d-none"></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="7" class="text-center">No Active School Year</td>
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
  </div>
  <script>
    function deleteStudent(studenId) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById("deleteForm-" + studenId).submit();
        }
      });
    }
  </script>

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
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>