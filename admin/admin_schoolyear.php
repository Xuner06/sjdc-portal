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

$systemDate = 2023;
$currentYear = date("Y");
$nextYear = $currentYear + 1;
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
    <?php
    if (isset($_SESSION['duplicate-sy'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['duplicate-sy']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['duplicate-sy']);
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
                      while ($rowSY = mysqli_fetch_assoc($querySchoolyear)) {
                    ?>

                        <tr>
                          <td><?php echo $rowSY['start_year'] . "-" . $rowSY['end_year']; ?></td>
                          <td><?php echo $rowSY['semester']; ?></td>
                          <td><?php echo $rowSY['status']; ?></td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-schoolyear-<?php echo $rowSY['sy_id']; ?>">Edit</button>
                            <div class="modal fade" id="edit-schoolyear-<?php echo $rowSY['sy_id']; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit School Year</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="../actions/update_schoolyear.php" method="post" id="editForm-<?php echo $rowSY['sy_id']; ?>">
                                      <input type="hidden" name="edit-id" value="<?php echo $rowSY['sy_id']; ?>">
                                      <div class="form-group">
                                        <label for="edit-status" class="form-label">Status</label>
                                        <select class="form-control" name="edit-status" id="edit-status" value="<?php echo $rowSY['status']; ?>" required>
                                          <option value=""></option>
                                          <option value="Active" <?php echo ($rowSY['status'] == "Active") ? "selected" : "" ?>>Active</option>
                                          <option value="Inactive" <?php echo ($rowSY['status'] == "Inactive") ? "selected" : "" ?>>Inactive</option>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="edit-startYear" class="form-label">Start Year</label>
                                        <select class="form-control" name="edit-startYear" id="edit-startYear" required>
                                          <?php
                                          for ($startYear = $systemDate; $startYear <= $currentYear; $startYear++) {
                                            echo '<option value="' . $startYear . '"' . ($startYear == $rowSY['start_year'] ? ' selected' : '') . '>' . $startYear . '</option>';
                                          }
                                          ?>
                                        </select>
                                        <div class="form-group">
                                          <label for="edit-endYear" class="form-label">End Year</label>
                                          <select class="form-control" name="edit-endYear" id="edit-endYear" required>
                                            <?php
                                            for ($endYear = $systemDate; $endYear <= $nextYear; $endYear++) {
                                              echo '<option value="' . $endYear . '"' . ($endYear == $rowSY['end_year'] ? ' selected' : '') . '>' . $endYear . '</option>';
                                            }
                                            ?>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="edit-semester" class="form-label">Semester</label>
                                          <select class="form-control" name="edit-semester" id="edit-semester" required>
                                            <option value=""></option>
                                            <option value="First Semester" <?php echo ($rowSY['semester'] == "First Semester") ? "selected" : "" ?>>First Semester</option>
                                            <option value="Second Semester" <?php echo ($rowSY['semester'] == "Second Semester") ? "selected" : "" ?>>Second Semester</option>
                                          </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success w-100" name="update-schoolyear">Update School Year</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
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
          <form action="../actions/insert_schoolyear.php" method="post" id="insertForm">
            <div class="form-group">
              <label for="start_year">Start Year</label>
              <select class="form-control" name="start_year" id="start_year" required>
                <option value=""></option>
                <?php
                for ($startYear = $systemDate; $startYear <= $currentYear; $startYear++) {
                  echo '<option value="' . $startYear . '">' . $startYear . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="end_year">End Year</label>
              <select class="form-control" name="end_year" id="end_year" required>
                <option value=""></option>
                <?php
                for ($endYear = $systemDate; $endYear <= $nextYear; $endYear++) {
                  echo '<option value="' . $endYear . '">' . $endYear . '</option>';
                }
                ?>
              </select>
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
    $(document).ready(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "columns": [
          null, // Ikalawang kolom
          null, // Ikatlong kolom
          null, // Atbp.
          {
            "searchable": false
          }, // Unang kolom (searchable property set to false)
        ],
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

  <script>
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

  <script>
    $('form[id^="editForm-"]').each(function() {
      $(this).validate({
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
    });
  </script>


</body>

</html>