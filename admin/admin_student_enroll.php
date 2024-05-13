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

if (isset($_GET['id'])) {
  $studentId = $_GET['id'];
  $role = "student";
  $stmtStudent = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = ?");
  $stmtStudent->bind_param("is", $studentId, $role);
  $stmtStudent->execute();
  $stmtResultStudent = $stmtStudent->get_result();
  $resultStudent = $stmtResultStudent->fetch_assoc();

  if (mysqli_num_rows($stmtResultStudent) == 0) {
    header("Location: ../admin/admin_student_list.php");
    exit();
  }
} else {
  header("Location: ../admin/admin_student_list.php");
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
  <title>SJDC | Student Enroll</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['success-enroll'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['success-enroll']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['success-enroll']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete-enroll'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['delete-enroll']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['delete-enroll']);
    }
    ?>
    <?php
    if (isset($_SESSION['error-enroll'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['error-enroll']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['error-enroll']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Enroll</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="admin_student_list.php" class="btn btn-primary btn-sm">Back</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Student Enroll</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>School Year</th>
                      <th>Semester</th>
                      <th>Date Enrolled</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stmtEnroll = $conn->prepare("SELECT e.*, c.*, s.*, sy.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN strand s ON c.strand = s.strand_id JOIN school_year sy ON e.sy = sy.sy_id WHERE e.student_id = ?");
                    $stmtEnroll->bind_param("i", $studentId);
                    $stmtEnroll->execute();
                    $stmtResultEnroll = $stmtEnroll->get_result();

                    if (mysqli_num_rows($stmtResultEnroll) > 0) {
                      while ($row = $stmtResultEnroll->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $row['level'] . '-', $row['strand'] . '-' . $row['section']; ?></td>
                          <td><?php echo $row['start_year'] . '-' . $row['end_year']; ?></td>
                          <td><?php echo $row['semester']; ?></td>
                          <td><?php echo $row['enroll_date']; ?></td>
                          <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteEnroll('<?php echo $row['enroll_id']; ?>')">Delete</button>
                            <form id="deleteForm-<?php echo $row['enroll_id']; ?>" action="../actions/delete_enroll.php" method="post">
                              <input type="hidden" name="delete-id" value="<?php echo $row['enroll_id']; ?>">
                              <input type="hidden" name="student-id" value="<?php echo $row['student_id']; ?>">
                            </form>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="5" class="text-center">Not Enrolled In Any School Year</td>
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

  <script>
    function deleteEnroll(enrollId) {
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
          document.getElementById("deleteForm-" + enrollId).submit();
        }
      });
    }
  </script>

  <!-- Insert Student Modal -->
  <div class="modal fade" id="add-student">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enroll Student</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/enroll_student.php" method="post" id="insertForm">
            <input type="hidden" name="student-id" value="<?php echo $resultStudent['id']; ?>">
            <div class="form-group">
              <label class="form-label">LRN Number</label>
              <input type="number" class="form-control" value="<?php echo $resultStudent['lrn_number']; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" value="<?php echo $resultStudent['lname'] . ', ' . $resultStudent['fname'] . " " . substr($resultStudent['mname'], 0, 1) . "."; ?>" disabled>
            </div>
            <div class="form-group">
              <label for="class" class="form-label">Class</label>
              <select class="form-control" id="class" name="class" required>
                <option value=""></option>
                <?php
                $statusSy = "Active";
                $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $stmtSy->bind_param("s", $statusSy);
                $stmtSy->execute();
                $stmtResultSy = $stmtSy->get_result();

                if (mysqli_num_rows($stmtResultSy) > 0) {
                  $result = $stmtResultSy->fetch_assoc();
                  $sy = $result['sy_id'];
                  $stmtClass = $conn->prepare("SELECT c.*, s.* FROM class c JOIN strand s ON c.strand = s.strand_id WHERE sy = ?");
                  $stmtClass->bind_param("i", $sy);
                  $stmtClass->execute();
                  $stmtResultClass = $stmtClass->get_result();

                  if (mysqli_num_rows($stmtResultClass) > 0) {
                    while ($class = $stmtResultClass->fetch_assoc()) {
                      echo '<option value="' . $class['class_id'] . '">' . $class['level'] . '-' . $class['strand'] . '-' . $class['section'] . '</option>';
                    }
                  } else {
                    echo '<option value="" disabled>No Class Available (Please Add Class)</option>';
                  }
                } else {
                  echo '<option value="" disabled>No Active School Year (Please Set School Year)</option>';
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="enroll-student">Enroll</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jquery-validation -->
  <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

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
        "buttons": [{
          text: 'Enroll Student',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-student').modal('show');
          }
        }, ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $('#insertForm').validate({
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  </script>
</body>

</html>