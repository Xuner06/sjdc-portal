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

  if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];

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

    $classId = $class['class_id'];
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

    $subjectStrandArray = explode(',', $subjectStrand);
 
    if ($level != $subjectLevel || !in_array($strand, $subjectStrandArray) || $semester != $subjectSemester) {
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
    <title>SJDC | Student</title>
  </head>

  <body>
    <?php include("../components/teacher_navbar.php"); ?>
    <div class="content-wrapper">
      <?php
      if (isset($_SESSION['success-upload'])) {
      ?>
        <script>
          Swal.fire({
            title: 'Success',
            text: '<?php echo $_SESSION['success-upload']; ?>',
            icon: 'success',
          })
        </script>
      <?php
        unset($_SESSION['success-upload']);
      }
      ?>
      <?php
      if (isset($_SESSION['invalid-file'])) {
      ?>
        <script>
          Swal.fire({
            title: 'Failed',
            text: '<?php echo $_SESSION['invalid-file']; ?>',
            icon: 'error',
          })
        </script>
      <?php
        unset($_SESSION['invalid-file']);
      }
      ?>
      <?php
      if (isset($_SESSION['success-import'])) {
      ?>
        <script>
          Swal.fire({
            title: 'Success',
            text: '<?php echo $_SESSION['success-import']; ?>',
            icon: 'success',
          })
        </script>
      <?php
        unset($_SESSION['success-import']);
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
                  <h1 class="text-center mb-4 mt-4"><?php echo $resultSubject['name']; ?></h1>
                  <form action="../actions/teacher_insert_grade.php" method="post" id="insertGrade">
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
                            <tr>
                              <td><?php echo $rowStudent['lrn_number']; ?></td>
                              <td><?php echo $rowStudent['lname'] . ", " . $rowStudent['fname'] . " " . (!empty($rowStudent['mname']) ? substr($rowStudent['mname'], 0, 1) . "." : ""); ?></td>
                              <td>
                                <input type="hidden" name="class" value="<?php echo $rowStudent['class']; ?>">
                                <input type="hidden" name="sy" value="<?php echo $sy; ?>">
                                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                                <?php
                                $stmtCheckGrade = $conn->prepare("SELECT * FROM grade WHERE student = ? AND subject = ? AND sy = ?");
                                $stmtCheckGrade->bind_param("iii", $rowStudent['student_id'], $subject, $sy);
                                $stmtCheckGrade->execute();
                                $stmtResultGrade = $stmtCheckGrade->get_result();

                                if (mysqli_num_rows($stmtResultGrade) > 0) {
                                  $resultGrade = $stmtResultGrade->fetch_assoc();
                                  $grade = $resultGrade['grade'];
                                ?>
                                  <select class="form-control" disabled>
                                    <option value="" class="text-center" selected><?php echo $grade; ?></option>
                                  </select>
                                <?php
                                } else {
                                ?>
                                  <select class="form-control" name="grade[<?php echo $rowStudent['student_id']; ?>]" required>
                                    <option class="text-center" value="N/A">N/A</option>
                                    <?php
                                    for ($i = 50; $i <= 100; $i++) {
                                      echo '<option value="' . $i . '" class="text-center">' . $i . '</option>';
                                    }
                                    ?>
                                  </select>
                                <?php
                                }
                                ?>
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
                  </form>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Import Grade Modal -->
    <div class="modal fade" id="importGrade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Import Grade</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="../actions/import_grade.php" method="post" id="insertForm" enctype="multipart/form-data">
              <input type="hidden" name="class" value="<?php echo $classId; ?>">
              <input type="hidden" name="sy" value="<?php echo $sy; ?>">
              <input type="hidden" name="subject" value="<?php echo $subject; ?>">
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div>
              <button type="submit" class="btn btn-sm btn-primary w-100" name="import-grade">Import Grade</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

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
        bsCustomFileInput.init();
        $("#example1").DataTable({
          "paging": false,
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "order": [
            [1, "asc"]
          ],
          "buttons": [{
            className: 'mr-2 rounded rounded-2',
            text: 'Upload Grades',
            action: function() {
              // Check again if there are rows with assigned students before submitting
              var tableRows = $('#example1 tbody tr:not(.no-assign-student)').length;
              if (tableRows > 0) {
                // If there are assigned students, submit the form
                Swal.fire({
                  title: "Upload Grades?",
                  text: "You won't be able to revert this!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Yes"
                }).then((result) => {
                  if (result.isConfirmed) {
                    $('#insertGrade').submit();
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
          }, {
            className: 'mr-2 rounded rounded-2',
            text: 'Import Grades',
            action: function() {
              // Open your modal or perform any action when the "Add Class" button is clicked
              var tableRows = $('#example1 tbody tr:not(.no-assign-student)').length;
              if (tableRows > 0) {
                $('#importGrade').modal('show');
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Failed",
                  text: "No Assign Student",
                });
              }
            }

          }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
    </script>


  </body>

  </html>