<?php
include("../database/database.php");
session_start();
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
    if (isset($_SESSION['delete-class'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['delete-class']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['delete-class']);
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Grade Level</th>
                      <th>Strand</th>
                      <th>Section</th>
                      <th>Schoolyear</th>
                      <th>Adviser</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlSy = "SELECT * FROM school_year WHERE status = 'Active'";
                    $querySy = mysqli_query($conn, $sqlSy);
                    if ($querySy && mysqli_num_rows($querySy) > 0) {
                      $result = mysqli_fetch_assoc($querySy);
                      $sy = $result['sy_id'];
                      $sql = "SELECT c.*, s.strand as STRAND, CONCAT(sy.start_year, '-', sy.end_year, ' ', sy.semester) AS SY, CONCAT(t.lname, ', ', t.fname) AS ADVISER FROM class c JOIN strand s ON c.strand = s.strand_id JOIN school_year sy ON c.sy = sy.sy_id JOIN Teacher t ON c.adviser = t.teacher_id WHERE sy = '$sy'";
                      $query = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                          <td><?php echo $row['level']; ?></td>
                          <td><?php echo $row['STRAND']; ?></td>
                          <td><?php echo $row['section']; ?></td>
                          <td><?php echo $row['SY']; ?></td>
                          <td><?php echo $row['ADVISER']; ?></td>
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
                                    <form action="../actions/update_class.php" method="post">
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
                                          $editSqlStrand = "SELECT * FROM strand";
                                          $editQueryStrand = mysqli_query($conn, $editSqlStrand);
                                          while ($rowStrand = mysqli_fetch_assoc($editQueryStrand)) {
                                            $selected = ($rowStrand['strand_id'] == $row['strand']) ? "selected" : "";
                                            echo '<option value="' . $rowStrand['strand_id'] . '" ' . $selected . '>' . $rowStrand['strand'] . '</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="section" class="form-label">Section</label>
                                        <input type="text" class="form-control" id="section" name="edit-section" value="<?php echo $row['section']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="edit-sy" class="form-label">Schoolyear</label>
                                        <select class="form-control" name="edit-sy" id="edit-sy" required>
                                          <option value=""></option>
                                          <?php
                                          $editSqlSy = "SELECT * FROM school_year";
                                          $editQuerySy = mysqli_query($conn, $editSqlSy);
                                          while ($rowSy = mysqli_fetch_assoc($editQuerySy)) {
                                            $selected = ($rowSy['sy_id'] == $row['sy']) ? "selected" : "";
                                            echo '<option value="' . $rowSy['sy_id'] . '" ' . $selected . '>' . $rowSy['start_year'] . '-' . $rowSy['end_year'] . ' ' . $rowSy['semester'] . '</option>';
                                          }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="edit-adviser" class="form-label">Adviser</label>
                                        <select class="form-control" name="edit-adviser" id="edit-adviser" required>
                                          <option value=""></option>
                                          <?php
                                          $editSqlTeacher = "SELECT * FROM teacher ";
                                          $editQueryTeacher = mysqli_query($conn, $editSqlTeacher);
                                          while ($rowTeacher = mysqli_fetch_assoc($editQueryTeacher)) {
                                            $selected = ($rowTeacher['teacher_id'] == $row['adviser']) ? "selected" : "";
                                            echo '<option value="' . $rowTeacher['teacher_id'] . '" ' . $selected . '>' . $rowTeacher['lname'] . ', ' . $rowTeacher['fname'] . '</option>';
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
                          <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteClass('<?php echo $row['class_id']; ?>')">Delete</button>
                            <form id="deleteForm-<?php echo $row['class_id']; ?>" action="../actions/delete_class.php" method="post">
                              <input type="hidden" name="delete-id" value="<?php echo $row['class_id']; ?>">
                            </form>
                          </td>
                        </tr>
                    <?php
                      }
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
          <form action="../actions/insert_class.php" method="post">
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
              <input type="text" class="form-control" name="section" id="section" required>
            </div>
            <div class="form-group">
              <label for="sy" class="form-label">Schoolyear</label>
              <select class="form-control" name="sy" id="sy" required>
                <option value=""></option>
                <?php
                $sqlSy = "SELECT * FROM school_year WHERE status = 'Active'";
                $querySy = mysqli_query($conn, $sqlSy);
                if (mysqli_num_rows($querySy) > 0) {
                  while ($sy = mysqli_fetch_assoc($querySy)) {
                    echo '<option value="' . $sy['sy_id'] . '">' . $sy['start_year'] . '-' . $sy['end_year'] . ' ' . $sy['semester'] . '</option>';
                  }
                } else {
                  echo '<option value="" disabled>No Active School Year (Please Set School Year)</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="adviser" class="form-label">Adviser</label>
              <select class="form-control" name="adviser" id="adviser" required>
                <option value=""></option>
                <?php
                $sqlGetSy = "SELECT * FROM school_year WHERE status = 'Active'";
                $queryGetSy = mysqli_query($conn, $sqlGetSy);
                $result = mysqli_fetch_assoc($queryGetSy);
                $currentSy = $result['sy_id'];
                $sqlInsertTeacher = "SELECT * FROM teacher WHERE status = 0 AND teacher_id NOT IN (SELECT adviser FROM class WHERE sy = '$currentSy')";
                $queryInsertTeacher = mysqli_query($conn, $sqlInsertTeacher);
                while ($teacher = mysqli_fetch_assoc($queryInsertTeacher)) {
                  echo '<option value="' . $teacher['teacher_id'] . '">' . $teacher['lname'] . ', ' . $teacher['fname'] . '</option>';
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
  <script>
    function deleteClass(classId) {
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
          document.getElementById("deleteForm-" + classId).submit();
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
        "buttons": [{
          text: 'Add Class',
          action: function() {
            // Open your modal or perform any action when the "Add Class" button is clicked
            $('#add-class').modal('show');
          }
        }, ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>


</body>

</html>