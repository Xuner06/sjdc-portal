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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | Student</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['multiple-enroll'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['multiple-enroll']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['multiple-enroll']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Student List</h1>
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
                <h1 class="text-center">Student List</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th>LRN Number</th>
                      <th>Name</th>
                      <th>Sex</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = 0;
                    $role = "student";
                    $stmtStudent = $conn->prepare("SELECT * FROM users WHERE status = ? AND role = ?");
                    $stmtStudent->bind_param("is", $status, $role);
                    $stmtStudent->execute();
                    $stmtResultStudent = $stmtStudent->get_result();

                    if (mysqli_num_rows($stmtResultStudent) > 0) {
                      while ($row = $stmtResultStudent->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><input class="checkItem" type="checkbox" value="<?php echo $row['id']; ?>"></td>
                          <td><?php echo $row['lrn_number']; ?></td>
                          <td><?php echo $row['lname'] . ", " . $row['fname'] . " " . (!empty($row['mname']) ? substr($row['mname'], 0, 1) . "." : ""); ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['contact']; ?></td>
                          <td>
                            <a href="admin_student_enroll.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Assign</a>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="7" class="text-center">No Student Please Add Student</td>
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

  <!-- Insert Student Modal -->
  <div class="modal fade" id="add-student">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enroll Student</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/multiple_enroll_student.php" method="post" id="insertForm">
            <input type="hidden" name="id" id="hiddenId">
            <div class="form-group">
              <label for="class" class="form-label">Class</label>
              <select class="form-control" id="class" name="class" required>
                <option value=""></option>
                <?php
                $statusSy = "Active";
                $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                $stmtSy->bind_param("s", $statusSy);
                $stmtSy->execute();
                $stmtResultSy = $stmtSy->get_result();

                if (mysqli_num_rows($stmtResultSy) > 0) {
                  $result = $stmtResultSy->fetch_assoc();
                  $sy = $result['sy_id'];
                  $stmtClass = $conn->prepare("SELECT c.*, s.* FROM class c JOIN strand s ON c.strand = s.strand_id WHERE sy = ?");
                  $stmtClass->bind_param("i", $sy);
                  $stmtClass->execute();
                  $stmtResultClass = $stmtClass->get_result();

                  if (mysqli_num_rows($stmtResultClass) > 0) {
                    while ($class = $stmtResultClass->fetch_assoc()) {
                      echo '<option value="' . $class['class_id'] . '">' . $class['level'] . '-' . $class['strand'] . '-' . $class['section'] . '</option>';
                    }
                  } else {
                    echo '<option value="" disabled>No Class Available (Please Add Class)</option>';
                  }
                } else {
                  echo '<option value="" disabled>No Active School Year (Please Set School Year)</option>';
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="multiple-enroll-student">Enroll</button>
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
        "columnDefs": [{
          "orderable": false,
          "targets": [0]
        }],
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": true,
        "order": [
          [2, "asc"]
        ],
        "buttons": [{
          text: 'Multiple Assign',
          action: function() {
            var tables = $('#example1').DataTable();
            var checkedItems = tables.rows({
                search: 'applied'
              })
              .nodes()
              .to$()
              .find('.checkItem:checked');

            // Check if there are any checked checkboxes in the entire table
            if (checkedItems.length > 0) {
              $('#add-student').modal('show');
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Please select at least one checkbox.'
              });
            }
          }
        }]
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
  </script>

  <script>
    $(document).ready(function() {
      var table = $('#example1').DataTable();
      // Check/Uncheck all box
      $('#checkAll').change(function() {
        var isChecked = $(this).prop('checked');

        // Use DataTables API to check/uncheck all rows in all pages
        table.rows().nodes().to$().find('.checkItem').prop('checked', isChecked);
      });

      $('#add-student').on('show.bs.modal', function() {
        var checkedItems = table.rows({
            search: 'applied'
          }) // All rows filtered by search
          .nodes() // Get the nodes (DOM elements)
          .to$() // Convert nodes to jQuery object
          .find('.checkItem:checked') // Find checked checkboxes
          .map(function() {
            return $(this).val(); // Get the value of each checked checkbox
          }).get(); // Convert to array

        // Set the hidden input value to the comma-separated selected item IDs
        $('#hiddenId').val((checkedItems.join(', ')));
      });
    });
  </script>
</body>

</html>