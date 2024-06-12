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

if (isset($_GET['class'])) {
  $classId = $_GET['class'];
  $stmtClass = $conn->prepare("SELECT * FROM class WHERE class_id = ?");
  $stmtClass->bind_param("i", $classId);
  $stmtClass->execute();
  $stmtResultClass = $stmtClass->get_result();

  if (mysqli_num_rows($stmtResultClass) == 0) {
    header("Location: ../admin/admin_class.php");
    exit();
  }
} else {
  header("Location: ../admin/admin_class.php");
  exit();
}
$class = $conn->prepare("SELECT * FROM class c LEFT JOIN strand s ON c.strand = s.strand_id LEFT JOIN users u ON c.adviser = u.id LEFT JOIN school_year sy ON c.sy = sy.sy_id WHERE c.class_id = ?");
$class->bind_param("i", $classId);
$class->execute();
$resultClass = $class->get_result();
$rowClass = $resultClass->fetch_assoc();
$finalClass = $rowClass['level'] . '-' . $rowClass['strand'] . '-' . $rowClass['section'];
$finalAdviser = $rowClass['fname'] . ' ' . substr($rowClass['mname'], 0, 1) . '.' . ' ' .$rowClass['lname'];
$finalSy = 'S.Y. ' . $rowClass['start_year'] . '-' . $rowClass['end_year'];
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
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | Class</title>
  <style>

  </style>
</head>

<body>
  <?php include("../components/admin_navbar.php");  ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Class List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="admin_class.php" class="btn btn-primary btn-sm">Back</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Class List</h1>
                <?php
                echo '<h1>' . $finalClass .'</h1>'
                ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="head">LRN Number</th>
                      <th>Name</th>
                      <th>Sex</th>
                      <th>Age</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = "Active";
                    $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                    $stmtSy->bind_param("s", $status);
                    $stmtSy->execute();
                    $stmtResultSy = $stmtSy->get_result();
                    $result = $stmtResultSy->fetch_assoc();
                    $sy = $result['sy_id'];

                    $stmtClass = $conn->prepare("SELECT e.*, u.* FROM enroll_student e JOIN users u ON e.student_id = u.id WHERE class = ?");
                    $stmtClass->bind_param("i", $classId);
                    $stmtClass->execute();
                    $stmtResultClass = $stmtClass->get_result();

                    if (mysqli_num_rows($stmtResultClass) > 0) {
                      while ($row = $stmtResultClass->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $row['lrn_number']; ?></td>
                          <td><?php echo $row['lname'] . ", " . $row['fname'] . " " . substr($row['mname'], 0, 1) . "."; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <?php
                          $currentDate = date('Y-m-d'); // Current date in 'Y-m-d' format
                          $bd = $row['birthday']; // Assuming 'birthday' is also in 'Y-m-d' format

                          // Calculate the age
                          $birthYear = date('Y', strtotime($bd)); // Extract the birth year from the birthday
                          $birthMonthDay = date('m-d', strtotime($bd)); // Extract the birth month and day

                          $currentYear = date('Y', strtotime($currentDate));
                          $currentMonthDay = date('m-d', strtotime($currentDate));

                          $age = $currentYear - $birthYear;

                          // If the birthday hasn't occurred yet this year, subtract one from the age
                          if ($currentMonthDay < $birthMonthDay) {
                            $age--;
                          }
                          ?>
                          <td><?php echo $age; ?></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="4" class="text-center">No Assign Student</td>
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

  <!-- Insert Class Modal -->
  <div class="modal fade" id="add-class">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Class</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/insert_class.php" method="post" id="insertForm">
            <div class="form-group">
              <label for="level" class="form-label">Grade Level</label>
              <select class="form-control" name="level" id="level" required>
                <option value=""></option>
                <option value="Grade 11">Grade 11</option>
                <option value="Grade 12">Grade 12</option>
              </select>
            </div>
            <div class="form-group">
              <label for="strand" class="form-label">Strand</label>
              <select class="form-control" name="strand" id="strand" required>
                <option value=""></option>
                <?php
                $sqlInsertStrand = "SELECT * FROM strand";
                $queryInsertStrand = mysqli_query($conn, $sqlInsertStrand);
                if (mysqli_num_rows($queryInsertStrand) > 0) {
                  while ($strand = mysqli_fetch_assoc($queryInsertStrand)) {
                    echo '<option value="' . $strand['strand_id'] . '">' . $strand['strand'] . '</option>';
                  }
                } else {
                  echo '<option value="" disabled>No Strand Available (Please Add Strand)</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="section" class="form-label">Section</label>
              <input type="number" class="form-control" name="section" id="section" required>
            </div>
            <div class="form-group">
              <label for="adviser" class="form-label">Adviser</label>
              <select class="form-control" name="adviser" id="adviser" required>
                <option value=""></option>
                <?php
                $status = "Active";
                $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $stmtSy->bind_param("s", $status);
                $stmtSy->execute();
                $stmtResultSy = $stmtSy->get_result();
                if (mysqli_num_rows($stmtResultSy) > 0) {
                  $result = $stmtResultSy->fetch_assoc();
                  $currentSy = $result['sy_id'];
                  $status = 0;
                  $role = "teacher";
                  $stmtInsertTeacher = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ? AND id NOT IN (SELECT adviser FROM class WHERE sy = ?)");
                  $stmtInsertTeacher->bind_param("isi", $status, $role, $currentSy);
                  $stmtInsertTeacher->execute();
                  $stmtResultInsertTeacher = $stmtInsertTeacher->get_result();
                  if (mysqli_num_rows($stmtResultInsertTeacher) > 0) {
                    while ($teacher = $stmtResultInsertTeacher->fetch_assoc()) {
                      echo '<option value="' . $teacher['id'] . '">' . $teacher['lname'] . ', ' . $teacher['fname'] . ' ' . substr($teacher['mname'], 0, 1) . '.' . '</option>';
                    }
                  } else {
                    echo '<option value="" disabled>No Teacher Available (Please Add Teacher)</option>';
                  }
                } else {
                  echo '<option value="" disabled>No Active School Year (Please Set School Year)</option>';
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="add-class">Add Class</button>
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
          extend: 'copy',
          className: 'mr-2 rounded rounded-2',
        }, {
          extend: 'csv',
          className: 'mr-2 rounded rounded-2',
        }, {
          extend: 'excel',
          className: 'mr-2 rounded rounded-2',
        }, {
          extend: 'pdf',
          className: 'mr-2 rounded rounded-2',
          title: '',
          customize: function(win) {
            $(win.document.body).prepend(
              '<img src="../assets/bg4.jpg">'
            )
          },
        }, {
          extend: 'print',
          className: 'mr-2 rounded rounded-2',
          title: '',
          messageTop: function() {
            return '<h1 class="text-center"><?php echo $finalClass; ?></h1>' + '<h1 class="text-center"><?php echo $finalSy; ?></h1>' + '<h1 class="text-center mb-4"><?php echo $finalAdviser; ?></h1>';
          }



        }]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>


</body>

</html>