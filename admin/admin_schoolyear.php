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
  <title>SJDC | School Year</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['add-schoolyear'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['add-schoolyear']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['add-schoolyear']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-schoolyear'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-schoolyear']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-schoolyear']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">School Year</h1>
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
                <h1 class="text-center">School Year List</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>School Year ID</th>
                      <th>School Year</th>
                      <th>Semester</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlSchoolyear = "SELECT * FROM school_year";
                    $querySchoolyear = mysqli_query($conn, $sqlSchoolyear);

                    if (mysqli_num_rows($querySchoolyear) > 0) {
                      while ($row = mysqli_fetch_assoc($querySchoolyear)) {
                    ?>
                        <!-- Edit School Year Modal -->
                        <div class="modal fade" id="edit-schoolyear-<?php echo $row['sy_id']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit School Year</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="../actions/update_schoolyear.php" method="post">
                                  <input type="hidden" name="edit-id" value="<?php echo $row['sy_id']; ?>">
                                  <div class="form-group">
                                    <label for="edit-status" class="form-label">Status</label>
                                    <select class="form-control" name="edit-status" id="edit-status" value="<?php echo $row['status']; ?>" required>
                                      <option value=""></option>
                                      <option value="Active" <?php echo ($row['status'] == "Active") ? "selected" : "" ?>>Active</option>
                                      <option value="Inactive" <?php echo ($row['status'] == "Inactive") ? "selected" : "" ?>>Inactive</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="edit-startYear" class="form-label">Start Year</label>
                                    <input type="number" class="form-control" name="edit-startYear" id="edit-startYear" value="<?php echo $row['start_year']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="edit-endYear" class="form-label">End Year</label>
                                    <input type="number" class="form-control" name="edit-endYear" id="edit-endYear" value="<?php echo $row['end_year']; ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="edit-semester" class="form-label">Semester</label>
                                    <select class="form-control" name="edit-semester" id="edit-semester" required>
                                      <option value=""></option>
                                      <option value="First Semester" <?php echo ($row['semester'] == "First Semester") ? "selected" : "" ?>>First Semester</option>
                                      <option value="Second Semester" <?php echo ($row['semester'] == "Second Semester") ? "selected" : "" ?>>Second Semester</option>
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-sm btn-success w-100" name="update-schoolyear">Update School Year</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <tr>
                          <td><?php echo $row['sy_id']; ?></td>
                          <td><?php echo $row['start_year'] . "-" . $row['end_year']; ?></td>
                          <td><?php echo $row['semester']; ?></td>
                          <td><?php echo $row['status']; ?></td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-schoolyear-<?php echo $row['sy_id']; ?>">Edit</button>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="5" class="text-center">No School Year Please Add School Year</td>
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
          <h4 class="modal-title">Add School Year</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/insert_schoolyear.php" method="post">
            <div class="form-group">
              <label for="start_year">Start Year</label>
              <input type="number" class="form-control" name="start_year" id="start_year" required>
            </div>
            <div class="form-group">
              <label for="end_year">End Year</label>
              <input type="number" class="form-control" name="end_year" id="end_year" required>
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <select class="form-control" name="semester" id="semester" required>
                <option value=""></option>
                <option value="First Semester">First Semester</option>
                <option value="Second Semester">Second Semester</option>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="add-schoolyear">Add School Year</button>
          </form>
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
        "buttons": [{
          text: 'Add School Year',
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