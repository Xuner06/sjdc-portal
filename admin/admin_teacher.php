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
  <title>SJDC | Teacher</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['add-teacher'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['add-teacher']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['add-teacher']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-teacher'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-teacher']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-teacher']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete-teacher'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['delete-teacher']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['delete-teacher']);
    }
    ?>
    <?php
    if (isset($_SESSION['duplicate-email'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['duplicate-email']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['duplicate-email']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Teacher List</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Teacher List</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Teacher ID</th>
                      <th>Name</th>
                      <th>Sex</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = 0;
                    $role = "teacher";
                    $stmtTeacher = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                    $stmtTeacher->bind_param("is", $status, $role);
                    $stmtTeacher->execute();
                    $stmtResultTeacher = $stmtTeacher->get_result();

                    if (mysqli_num_rows($stmtResultTeacher) > 0) {
                      while ($row = $stmtResultTeacher->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['lname'] . ", " . $row['fname'] . " " . substr($row['mname'], 0, 1) . "."; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['contact']; ?></td>
                          <td>
                            <a href="admin_view_teacher.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View</a>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-teacher-<?php echo $row['id']; ?>">Edit</button>
                            <!-- Edit Teacher Modal -->
                            <div class="modal fade" id="edit-teacher-<?php echo $row['id']; ?>">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Teacher</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="../actions/update_teacher.php" method="post" id="editForm-<?php echo $row['id']; ?>">
                                      <input type="hidden" name="edit-id" value="<?php echo $row['id']; ?>">
                                      <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <label for="edit-fname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="edit-fname" name="edit-fname" value="<?php echo $row['fname']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <label for="edit-mname" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" id="edit-mname" name="edit-mname" value="<?php echo $row['mname']; ?>" required>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <label for="edit-lname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="edit-lname" name="edit-lname" value="<?php echo $row['lname']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
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
                                          <div class="form-group">
                                            <label for="edit_birthday" class="form-label">Birthday</label>
                                            <input type="date" class="form-control" id="edit_birthday" name="edit_birthday" value="<?php echo $row['birthday']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <label for="edit-contact" class="form-label">Contact</label>
                                            <input type="number" class="form-control" id="edit-contact" name="edit-contact" value="<?php echo $row['contact']; ?>" required>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <label for="edit_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="edit_email" name="edit_email" value="<?php echo $row['email']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                          <div class="form-group">
                                            <label for="edit-address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="edit-address" name="edit-address" value="<?php echo $row['address']; ?>" required>
                                          </div>
                                        </div>
                                      </div>
                                      <button type="submit" class="btn btn-success btn-sm w-100" name="update-teacher">Update Teacher</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteTeacher('<?php echo $row['id']; ?>')">Delete</button>
                            <form id="deleteForm-<?php echo $row['id']; ?>" action="../actions/delete_teacher.php" method="post">
                              <input type="hidden" name="delete-id" value="<?php echo $row['id']; ?>">
                            </form>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="8" class="text-center">No Teacher Please Add Teacher</td>
                        <td class="d-none"></td>
                        <td class="d-none"></td>
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
  <script>
    function deleteTeacher(teacherId) {
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
          document.getElementById("deleteForm-" + teacherId).submit();
        }
      });
    }
  </script>

  <!-- Insert Teacher Modal -->
  <div class="modal fade" id="add-teacher">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Teacher</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/insert_teacher.php" method="post" id="insertForm">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="fname" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="mname" class="form-label">Middle Name</label>
                  <input type="text" class="form-control" id="mname" name="mname" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="lname" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
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
                <div class="form-group">
                  <label for="birthday" class="form-label">Birthday</label>
                  <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="contact" class="form-label">Contact</label>
                  <input type="number" class="form-control" id="contact" name="contact" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" required>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100" name="add-teacher">Add Teacher</button>
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
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": [{
          text: 'Add Teacher',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-teacher').modal('show');
          }
        }, {
          extend: 'copy',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }, {
          extend: 'csv',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }, {
          extend: 'excel',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }, {
          extend: 'pdf',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }, {
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    const formattedCurrentDate = `${year}-${month}-${day}`;

    $('#birthday').attr('max', formattedCurrentDate);

    $('#insertForm').validate({
      rules: {
        birthday: {
          date: true,
          max: formattedCurrentDate
        }
      },
      messages: {
        email: {
          email: "Email Address Is Invalid"
        },
        birthday: {
          max: "Birthday Is Invalid"
        }
      },
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
        rules: {
          edit_birthday: {
            date: true,
            max: formattedCurrentDate
          }
        },
        messages: {
          edit_email: {
            email: "Email Address Is Invalid"
          },
          edit_birthday: {
            max: "Birthday Is Invalid"
          }
        },
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