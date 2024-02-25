<?php
include("../database/database.php");
session_start();
$id = $_SESSION['teacher'];
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
  <title>SJDC | Grade</title>
</head>

<body>
  <?php include("../components/teacher_navbar.php"); ?>
  <div class="content-wrapper">
    <?php
    if (isset($_SESSION['success-upload'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['success-upload']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['success-upload']);
    }
    ?>

    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Student Grade</h1>
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
                      <th>Final Average</th>
                      <th>Remarks</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlSy = "SELECT * FROM school_year WHERE status = 'Active'";
                    $querySy = mysqli_query($conn, $sqlSy);
                    if ($querySy && mysqli_num_rows($querySy) > 0) {
                      $result = mysqli_fetch_assoc($querySy);
                      $sy = $result['sy_id'];

                      $sql = "SELECT e.*, c.adviser, s.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN student s ON e.student_id = s.student_id WHERE c.adviser = '$id' AND e.sy = '$sy'";
                      $query = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                          <td><?php echo $row['lrn_number']; ?></td>
                          <td><?php echo $row['lname'] . ", " . $row['fname']; ?></td>
                          <td>test</td>
                          <td>test</td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm">View</button>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm">Edit</button>
                          </td>
                          <td>
                            <form action="teacher_encode_grade.php" method="post">
                              <input type="hidden" value="<?php echo $row['enroll_id']; ?>" name="id">
                              <button type="submit" class="btn btn-primary btn-sm" name="grade">Upload</button>
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
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  </div>
  <script>
    function deleteStudent(studenId) {
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
          document.getElementById("deleteForm-" + studenId).submit();
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
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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