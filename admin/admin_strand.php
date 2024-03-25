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
  <title>SJDC | Strand</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['add-strand'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['add-strand']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['add-strand']);
    }
    ?>
    <?php
    if (isset($_SESSION['update-strand'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['update-strand']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['update-strand']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Strand List</h1>
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
                <h1 class="text-center">Strand List</h1>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Strand ID</th>
                      <th>Strand</th>
                      <th>Description</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlStrand = "SELECT * FROM strand";
                    $queryStrand = mysqli_query($conn, $sqlStrand);

                    if (mysqli_num_rows($queryStrand) > 0) {
                      while ($row = mysqli_fetch_assoc($queryStrand)) {
                    ?>
                        <tr>
                          <td><?php echo $row['strand_id']; ?></td>
                          <td><?php echo $row['strand']; ?></td>
                          <td><?php echo $row['description']; ?></td>
                          <td>
                            <!-- Edit Strand Button Click -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-strand-<?php echo $row['strand_id']; ?>">Edit</button>
                            <!-- Edit Strand Modal -->
                            <div class="modal fade" id="edit-strand-<?php echo $row['strand_id']; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Strand</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="../actions/update_strand.php" method="post">
                                      <input type="hidden" name="edit-id" value="<?php echo $row['strand_id']; ?>">
                                      <div class="form-group">
                                        <label for="edit-strand" class="form-label">Strand</label>
                                        <input type="text" class="form-control" name="edit-strand" id="edit-strand" value="<?php echo $row['strand']; ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="edit-description" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="edit-description" id="edit-description" value="<?php echo $row['description']; ?>" required>
                                      </div>
                                      <button type="submit" class="btn btn-sm btn-success w-100" name="update-strand">Update Strand</button>
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
                        <td colspan="4" class="text-center">No Strand Please Add Strand</td>
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

  <!-- Insert Strand Modal -->
  <div class="modal fade" id="add-strand">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Strand</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/insert_strand.php" method="post">
            <div class="form-group">
              <label for="strand" class="form-label">Strand</label>
              <input type="text" class="form-control" name="strand" id="strand" required>
            </div>
            <div class="form-group">
              <label for="description" class="form-label">Description</label>
              <input type="text" class="form-control" name="description" id="description" required>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="add-strand">Add Strand</button>
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
          text: 'Add Strand',
          action: function() {
            // Open your modal or perform any action when the "Add Class" button is clicked
            $('#add-strand').modal('show');
          }
        }, ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>


</body>

</html>