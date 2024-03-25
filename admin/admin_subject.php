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
  <title>SJDC | Subject</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['add-subject'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['add-subject']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['add-subject']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-subject'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-subject']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-subject']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Subject List</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Subject List</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Subject ID</th>
                      <th>Subject Name</th>
                      <th>Grade Level</th>
                      <th>Strand</th>
                      <th>Semester</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlSubject = "SELECT su.*, st.strand AS strands FROM subject su JOIN strand st ON su.strand = st.strand_id";
                    $querySubject = mysqli_query($conn, $sqlSubject);
                    if (mysqli_num_rows($querySubject) > 0) {
                      while ($row = mysqli_fetch_assoc($querySubject)) {
                    ?>
                        <tr>
                          <td><?php echo $row['subject_id']; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['level']; ?></td>
                          <td><?php echo $row['strands']; ?></td>
                          <td><?php echo $row['semester']; ?></td>
                          <td>
                            <!-- Edit Subject Button Click -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-subject-<?php echo $row['subject_id']; ?>">Edit</button>
                            <!-- Edit Subject Modal -->
                            <div class="modal fade" id="edit-subject-<?php echo $row['subject_id']; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Subject</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="../actions/update_subject.php" method="post">
                                      <input type="hidden" name="edit-id" value="<?php echo $row['subject_id']; ?>">
                                      <div class="form-group">
                                        <label for="edit-name" class="form-label">Subject Name</label>
                                        <input type="text" class="form-control" name="edit-name" id="edit-name" value="<?php echo $row['name']; ?>" required>
                                      </div>
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
                                        <label for="level" class="form-label">Semester</label>
                                        <select class="form-control" id="level" name="edit-semester" required>
                                          <option value=""></option>
                                          <option value="First Semester" <?= ($row['semester'] == "First Semester") ? "selected" : "" ?>>First Semester</option>
                                          <option value="Second Semester" <?= ($row['semester'] == "Second Semester") ? "selected" : "" ?>>Second Semester</option>
                                        </select>
                                      </div>
                                      <button type="submit" class="btn btn-sm btn-success w-100" name="update-subject">Update Subject</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php
                      }
                    } 
                    else {
                    ?>
                      <tr>
                        <td colspan="6" class="text-center">No Subject Please Add Subject</td>
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

  <!-- Insert Subject Modal -->
  <div class="modal fade" id="add-subject">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Subject</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/insert_subject.php" method="post">
            <div class="form-group">
              <label for="name" class="form-label">Subject Name</label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
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
              <label for="semester" class="form-label">Semester</label>
              <select class="form-control" name="semester" id="semester" required>
                <option value=""></option>
                <option value="First Semester">First Semester</option>
                <option value="Second Semester">Second Semester</option>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="add-subject">Add Subject</button>
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
          text: 'Add Subject',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-subject').modal('show');
          }
        }, ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>


</body>

</html>