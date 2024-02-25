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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <title>SJDC | Student</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['add-student'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['add-student']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['add-student']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-student'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-student']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-student']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-student'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-student']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-student']);
    }
    ?>

    <?php
    if (isset($_SESSION['delete-student'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['delete-student']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['delete-student']);
    }
    ?>
    <?php
    if (isset($_SESSION['no-schoolyear'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Error',
          text: '<?php echo $_SESSION['no-schoolyear']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['no-schoolyear']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Student List</h1>
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
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Age</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM student WHERE status = 0";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                      <!-- Edit Student Modal -->
                      <div class="modal fade" id="edit-student-<?php echo $row['student_id']; ?>">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit Student</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="../actions/admin_update_student.php" method="post">
                                <input type="hidden" name="edit-id" value="<?php echo $row['student_id']; ?>">
                                <div class="row">
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-lrn" class="form-label">LRN Number</label>
                                      <input type="number" class="form-control" id="edit-lrn" name="edit-lrn" value="<?php echo $row['lrn_number']; ?>" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-fname" class="form-label">First Name</label>
                                      <input type="text" class="form-control" id="edit-fname" name="edit-fname" value="<?php echo $row['fname']; ?>" required>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-lname" class="form-label">Last Name</label>
                                      <input type="text" class="form-control" id="edit-lname" name="edit-lname" value="<?php echo $row['lname']; ?>" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-gender" class="form-label">Gender</label>
                                      <select class="form-control" id="edit-gender" name="edit-gender" required>
                                        <option value=""></option>
                                        <option value="Male" <?= ($row['gender'] == "Male") ? "selected" : "" ?>>Male</option>
                                        <option value="Female" <?= ($row['gender'] == "Female") ? "selected" : "" ?>>Female</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-birthday" class="form-label">Birthday</label>
                                      <input type="date" class="form-control" id="edit-birthday" name="edit-birthday" value="<?php echo $row['birthday']; ?>" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-age" class="form-label">Age</label>
                                      <input type="number" class="form-control" id="edit-age" name="edit-age" value="<?php echo $row['age']; ?>" required>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-contact" class="form-label">Contact</label>
                                      <input type="number" class="form-control" id="edit-contact" name="edit-contact" value="<?php echo $row['contact']; ?>" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="edit-email" class="form-label">Email</label>
                                      <input type="email" class="form-control" id="edit-email" name="edit-email" value="<?php echo $row['email']; ?>" required>
                                    </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col">
                                    <div class="mb-3">
                                      <label for="edit-address" class="form-label">Address</label>
                                      <input type="text" class="form-control" id="edit-address" name="edit-address" value="<?php echo $row['address']; ?>" required>
                                    </div>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm w-100" name="update-student">Update Student</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <tr>
                        <td><?php echo $row['lrn_number']; ?></td>
                        <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td>
                          <form action="admin_view_student.php" method="post">
                            <input type="hidden" name="view-id" value="<?php echo $row['student_id']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm" name="view-student">View</button>
                          </form>
                        </td>
                        <td>
                          <!-- Edit Student Button Click -->
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-student-<?php echo $row['student_id']; ?>">Edit</button>

                        </td>
                        <td>
                          <button type="button" class="btn btn-danger btn-sm" onclick="deleteStudent('<?php echo $row['student_id']; ?>')">Delete</button>
                          <form id="deleteForm-<?php echo $row['student_id']; ?>" action="../actions/admin_delete_student.php" method="post">
                            <input type="hidden" name="delete-id" value="<?php echo $row['student_id']; ?>">
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

  <script>
    function deleteStudent(studentId) {
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
          document.getElementById("deleteForm-" + studentId).submit();
        }
      });
    }
  </script>

  <!-- Insert Student Modal -->
  <div class="modal fade" id="add-student">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Student</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/admin_insert_student.php" method="post">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="lrn-number" class="form-label">LRN Number</label>
                  <input type="number" class="form-control" id="lrn-number" name="lrn-number" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="fname" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="lname" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select id="gender" class="form-control" name="gender" required>
                    <option value=""></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="birthday" class="form-label">Birthday</label>
                  <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="age" class="form-label">Age</label>
                  <input type="number" class="form-control" id="age" name="age" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="contact" class="form-label">Contact</label>
                  <input type="number" class="form-control" id="contact" name="contact" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" required>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="add-student">Add Student</button>
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
          text: 'Add Student',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-student').modal('show');
          }
        }, "copy", "csv", "excel", "pdf", "print", "colvis"]
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