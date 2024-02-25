<?php
include("../database/database.php");
session_start();

if (isset($_POST['enroll'])) {
  $id = mysqli_escape_string($conn, $_POST['id']);
  $sql = "SELECT * FROM student WHERE student_id = '$id'";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
} 


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
    <!-- Content Header (Page header) -->

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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>School Year</th>
                      <th>Semester</th>
                      <th>Date Enroll</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlEnroll = "SELECT CONCAT(c.level, '-', s.strand,'-', c.section) AS class, sy.*, e.enroll_date, e.enroll_id FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN school_year sy ON sy.sy_id = e.sy JOIN strand s ON c.strand = s.strand_id WHERE student_id = '$id'";
                    $queryEnroll = mysqli_query($conn, $sqlEnroll);
                    while ($row = mysqli_fetch_assoc($queryEnroll)) {
                    ?>
                      <tr>
                        <td><?php echo $row['class']; ?></td>
                        <td><?php echo $row['start_year'] . '-' . $row['end_year']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['enroll_date']; ?></td>
                        <td>
                          <form action="../actions/delete_enroll.php" method="post">
                            <input type="hidden" name="delete-id" value="<?php echo $row['enroll_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="delete-enroll">Delete</button>
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
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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
          <form action="../actions/enroll_student.php" method="post">
            <input type="hidden" name="enroll-id" value="<?php echo $result['student_id']; ?>">
            <div class="form-group">
              <label class="form-label">LRN Number</label>
              <input type="number" class="form-control" value="<?php echo $result['lrn_number']; ?>" disabled>
            </div>
            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" value="<?php echo $result['lname'] . ', ' . $result['fname']; ?>" disabled>
            </div>
            <div class="form-group">
              <label for="class" class="form-label">Class</label>
              <select class="form-control" id="class" name="class" required>
                <option value=""></option>
                <?php
                $sqlSelectSy = "SELECT * FROM school_year WHERE status = 'Active'";
                $querySelectSy = mysqli_query($conn, $sqlSelectSy);
                if ($querySelectSy && mysqli_num_rows($querySelectSy) > 0) {
                  $result = mysqli_fetch_assoc($querySelectSy);
                  $sy = $result['sy_id'];

                  $sqlClass = "SELECT c.*, s.strand AS STRAND FROM class c JOIN strand s ON c.strand = s.strand_id WHERE sy = '$sy'";
                  $queryClass = mysqli_query($conn, $sqlClass);

                  while ($class = mysqli_fetch_assoc($queryClass)) {
                    echo '<option value="' . $class['class_id'] . '">' . $class['level'] . '-' . $class['STRAND'] . '-' . $class['section'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="schoolyear" class="form-label">School Year</label>
              <select class="form-control" id="schoolyear" name="schoolyear" required>
                <option value=""></option>
                <?php
                $sqlSchoolyear = "SELECT * FROM school_year WHERE status = 'Active'";
                $querySchoolyear = mysqli_query($conn, $sqlSchoolyear);
                if ($querySchoolyear && mysqli_num_rows($querySchoolyear) > 0) {
                  while ($schoolyear = mysqli_fetch_assoc($querySchoolyear)) {
                    echo '<option value="' . $schoolyear['sy_id'] . '">' . $schoolyear['start_year'] . '-' . $schoolyear['end_year'] . '-' . $schoolyear['semester'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="enroll-student">Enroll</button>
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
          text: 'Enroll Student',
          action: function() {
            // Open your modal or perform any action when the "Add Student" button is clicked
            $('#add-student').modal('show');
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