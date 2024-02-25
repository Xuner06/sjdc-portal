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
    <?php
    if (isset($_SESSION['delete-subject'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['delete-subject']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['delete-subject']);
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Subject ID</th>
                      <th>Subject Name</th>
                      <th>Grade Level</th>
                      <th>Strand</th>
                      <th>Semester</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT sub.*, s.strand as strandName FROM subject sub JOIN strand s ON sub.strand = s.strand_id";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?php echo $row['subject_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['level']; ?></td>
                        <td><?php echo $row['strandName']; ?></td>
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
                        <td>
                          <button type="button" class="btn btn-danger btn-sm" onclick="deleteSubject('<?php echo $row['subject_id']; ?>')">Delete</button>
                          <form id="deleteForm-<?php echo $row['subject_id']; ?>" action="../actions/delete_subject.php" method="post">
                            <input type="hidden" name="delete-id" value="<?php echo $row['subject_id']; ?>">
                          </form>
                        </td>
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
                $sqlStrand = "SELECT * FROM strand";
                $queryStrand = mysqli_query($conn, $sqlStrand);
                while ($row = mysqli_fetch_assoc($queryStrand)) {
                  echo '<option value="' . $row['strand_id'] . '">' . $row['strand'] . '</option>';
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
  <script>
    function deleteSubject(subjectId) {
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
          document.getElementById("deleteForm-" + subjectId).submit();
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
          text: 'Add Subject',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-subject').modal('show');
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