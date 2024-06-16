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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../font/font.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | School Year</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Archive School Year</h1>
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
                <h1 class="text-center">School Year <?php echo isset($_SESSION['start_year']) && isset($_SESSION['end_year']) ? $_SESSION['start_year'] . '-' . $_SESSION['end_year'] : ''; ?></h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Class</th>
                      <th>Semester</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($_SESSION['start_year']) && isset($_SESSION['end_year'])) {
                      $startYear = $_SESSION['start_year'];
                      $endYear = $_SESSION['end_year'];

                      $stmtEnroll = $conn->prepare("SELECT e.*, s.*, u.*, c.*, st.* FROM enroll_student e JOIN school_year s ON e.sy = s.sy_id JOIN users u ON e.student_id = u.id JOIN class c ON e.class = c.class_id JOIN strand st ON c.strand = st.strand_id WHERE s.start_year = ? AND s.end_year = ?");
                      $stmtEnroll->bind_param("ss", $startYear, $endYear);
                      $stmtEnroll->execute();
                      $stmtResultEnroll = $stmtEnroll->get_result();

                      while ($rowEnroll = $stmtResultEnroll->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $rowEnroll['lrn_number']; ?></td>
                          <td><?php echo $rowEnroll['lname'] . ", " . $rowEnroll['fname'] . " " . (!empty($rowEnroll['mname']) ? substr($rowEnroll['mname'], 0, 1) . "." : ""); ?></td>
                          <td><?php echo $rowEnroll['level'] . "-" . $rowEnroll['strand'] . "-" . $rowEnroll['section']; ?></td>
                          <td><?php echo $rowEnroll['semester']; ?></td>
                          <td>
                            <a href="admin_archive_view_grade.php?view=<?php echo $rowEnroll['enroll_id']; ?>" class="btn btn-primary btn-sm">View</a>
                            <a href="admin_archive_edit_grade.php?edit=<?php echo $rowEnroll['enroll_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="admin_archive_upload_grade.php?grade=<?php echo $rowEnroll['enroll_id']; ?>" class="btn btn-primary btn-sm">Upload</a>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="5" class="text-center">Select School Year</td>
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
        </div>
      </div>
    </div>
  </div>

  <!-- Insert School Year Modal -->
  <div class="modal fade" id="add-schoolyear">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Select School Year</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/select_schoolYear.php" method="post">
            <div class="form-group">
              <label for="sy">School Year</label>
              <select name="sy" id="sy" class="form-control">
                <option value=""></option>
                <?php
                $sqlSy = "SELECT DISTINCT start_year, end_year FROM school_year ORDER BY start_year ASC";
                $querySy = mysqli_query($conn, $sqlSy);

                while ($row = mysqli_fetch_assoc($querySy)) {
                  echo '<option value="' . $row['start_year'] . '-' .  $row['end_year'] . '">' . $row['start_year'] . '-' . $row['end_year'] . '</option>';
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="select-schoolyear">Select</button>
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
        "order": [
          [1, "asc"]
        ],
        "buttons": [{
          text: 'Select School Year',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-schoolyear').modal('show');
          }
        }, ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>


</body>

</html>