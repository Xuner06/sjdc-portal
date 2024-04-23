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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <title>SJDC | Class</title>

  <style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0;
    }
  </style>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['add-class'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['add-class']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['add-class']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-class'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-class']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-class']);
    }
    ?>
    <?php
    if (isset($_SESSION['duplicate-class'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['duplicate-class']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['duplicate-class']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Class List</h1>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Grade Level</th>
                      <th>Strand</th>
                      <th>Section</th>
                      <th>School Year</th>
                      <th>Adviser</th>
                      <th>Edit</th>
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
                      $stmtClass = $conn->prepare("SELECT c.*, s.*, sy.*, u.* FROM class c JOIN school_year sy ON c.sy = sy.sy_id JOIN users u ON c.adviser = u.id JOIN strand s ON c.strand = s.strand_id WHERE c.sy = ?");
                      $stmtClass->bind_param("i", $sy);
                      $stmtClass->execute();
                      $stmtResultClass = $stmtClass->get_result();

                      if (mysqli_num_rows($stmtResultClass) > 0) {
                        while ($row = $stmtResultClass->fetch_assoc()) {
                    ?>
                          <tr>
                            <td><?php echo $row['level']; ?></td>
                            <td><?php echo $row['strand']; ?></td>
                            <td><?php echo $row['section']; ?></td>
                            <td><?php echo $row['start_year'] . '-' . $row['end_year'] . ' ' . $row['semester']; ?></td>
                            <td><?php echo $row['lname'] . ", " . $row['fname'] . " " . substr($row['mname'], 0, 1) . "."; ?></td>
                            <td>
                              <!-- Edit Class Button Click -->
                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-class-<?php echo $row['class_id']; ?>">Edit</button>
                              <!-- Edit Class Modal -->
                              <div class="modal fade" id="edit-class-<?php echo $row['class_id']; ?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Edit Class</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="../actions/update_class.php" method="post" id="editForm-<?php echo $row['class_id']; ?>">
                                        <input type="hidden" name="edit-id" value="<?php echo $row['class_id']; ?>">
                                        <div class="form-group">
                                          <label for="level" class="form-label">Grade Level</label>
                                          <select class="form-control" id="level" name="edit-level" required>
                                            <option value=""></option>
                                            <option value="Grade 11" <?= ($row['level'] == "Grade 11") ? "selected" : "" ?>>Grade 11</option>
                                            <option value="Grade 12" <?= ($row['level'] == "Grade 12") ? "selected" : "" ?>>Grade 12</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="edit-strand" class="form-label">Strand</label>
                                          <select class="form-control" name="edit-strand" id="edit-strand" required>
                                            <option value=""></option>
                                            <?php
                                            $sqlEditStrand = "SELECT * FROM strand";
                                            $queryEditStrand = mysqli_query($conn, $sqlEditStrand);
                                            while ($rowStrand = mysqli_fetch_assoc($queryEditStrand)) {
                                              $selected = ($rowStrand['strand_id'] == $row['strand_id']) ? "selected" : "";
                                              echo '<option value="' . $rowStrand['strand_id'] . '" ' . $selected . '>' . $rowStrand['strand'] . '</option>';
                                            }
                                            ?>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="section" class="form-label">Section</label>
                                          <input type="number" class="form-control" id="section" name="edit-section" value="<?php echo $row['section']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label for="edit-adviser" class="form-label">Adviser</label>
                                          <select class="form-control" name="edit-adviser" id="edit-adviser" required>
                                            <option value=""></option>
                                            <option value="<?php echo $row['id']; ?>" selected><?php echo $row['lname'] . ', ' . $row['fname'] . ' ' . substr($row['mname'], 0, 1) . '.'; ?></option>
                                            <?php
                                            $statustTeacher = 0;
                                            $role = "teacher";
                                            $stmtEditTeacher = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ? AND id NOT IN (SELECT adviser FROM class WHERE sy = ?)");
                                            $stmtEditTeacher->bind_param("isi", $statustTeacher, $role, $sy);
                                            $stmtEditTeacher->execute();
                                            $stmtResultEditTeacher = $stmtEditTeacher->get_result();

                                            if (mysqli_num_rows($stmtResultEditTeacher) > 0) {
                                              while ($rowTeacher = $stmtResultEditTeacher->fetch_assoc()) {
                                                echo '<option value="' . $rowTeacher['id'] . '">' . $rowTeacher['lname'] . ', ' . $rowTeacher['fname'] . ' ' . substr($rowTeacher['mname'], 0, 1) . '.' . '</option>';
                                              }
                                            } else {
                                              echo '<option value="" disabled>No Teacher Available (Please Add Teacher)</option>';
                                            }
                                            ?>
                                          </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success w-100" name="update-class">Update Class</button>
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
                          <td colspan="6" class="text-center">No Class Please Add Class</td>
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
                        <td colspan="6" class="text-center">No Active School Year</td>
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
          text: 'Add Class',
          action: function() {
            // Open your modal or perform any action when the "Add Class" button is clicked
            $('#add-class').modal('show');
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