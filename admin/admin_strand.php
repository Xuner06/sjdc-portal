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
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
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
    <?php
    if (isset($_SESSION['duplicate-strand'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['duplicate-strand']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['duplicate-strand']);
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
                      <!-- <th>Track</th> -->
                      <th>Strand</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqlStrand = "SELECT * FROM strand";
                    $queryStrand = mysqli_query($conn, $sqlStrand);

                    if (mysqli_num_rows($queryStrand) > 0) {
                      while ($rowStrand = mysqli_fetch_assoc($queryStrand)) {

                    ?>
                        <tr>
                          <!-- <td><?php echo $rowStrand['track']; ?></td> -->
                          <td><?php echo ($rowStrand['track'] == "Technical-Vocational-Livelihood Track" ? "TVL-" : "") . $rowStrand['strand']; ?></td>
                          <td><?php echo $rowStrand['description']; ?></td>
                          <td>

                            <!-- Edit Strand Button Click -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-strand-<?php echo $rowStrand['strand_id']; ?>">Edit</button>
                            <!-- Edit Strand Modal -->
                            <div class="modal fade" id="edit-strand-<?php echo $rowStrand['strand_id']; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Strand</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="../actions/update_strand.php" method="post" id="editForm-<?php echo $rowStrand['strand_id']; ?>">
                                      <input type="hidden" name="edit-id" value="<?php echo $rowStrand['strand_id']; ?>">
                                      <div class="form-group">
                                        <label for="edit-track-<?php echo $rowStrand['strand_id']; ?>" class="form-label">Track</label>
                                        <select class="form-control" name="edit-track" id="edit-track-<?php echo $rowStrand['strand_id']; ?>" required>
                                          <option value=""></option>
                                          <option value="Academic Track" <?php echo ($rowStrand['track'] == "Academic Track" ? "selected" : "") ?>>Academic Track</option>
                                          <option value="Arts and Design Track" <?php echo ($rowStrand['track'] == "Arts and Design Track" ? "selected" : "") ?>>Arts and Design Track</option>
                                          <option value="Sports Track" <?php echo ($rowStrand['track'] == "Sports Track" ? "selected" : "") ?>>Sports Track</option>
                                          <option value="Technical-Vocational-Livelihood Track" <?php echo ($rowStrand['track'] == "Technical-Vocational-Livelihood Track" ? "selected" : "") ?>>Technical-Vocational-Livelihood Track</option>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="edit-strand-<?php echo $rowStrand['strand_id']; ?>" class="form-label">Strand</label>
                                        <input type="text" class="form-control" name="edit-strand" id="edit-strand-<?php echo $rowStrand['strand_id']; ?>" value="<?php echo $rowStrand['strand']; ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="edit-description-<?php echo $rowStrand['strand_id']; ?>" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="edit-description" id="edit-description-<?php echo $rowStrand['strand_id']; ?>" value="<?php echo $rowStrand['description']; ?>" required>
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
                    } else {
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
          <form action="../actions/insert_strand.php" method="post" id="insertForm">
            <div class="form-group">
              <label for="track" class="form-label">Track</label>
              <select class="form-control" name="track" id="track" required>
                <option value=""></option>
                <option value="Academic Track">Academic Track</option>
                <option value="Arts and Design Track">Arts and Design Track</option>
                <option value="Sports Track">Sports Track</option>
                <option value="Technical-Vocational-Livelihood Track">Technical-Vocational-Livelihood Track</option>
              </select>
            </div>
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
    $(document).ready(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "search": true,
        "columns": [
          null, // Ikatlong kolom
          null, // Atbp.
          {
            "searchable": false
          }, // Unang kolom (searchable property set to false)
        ],
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

  <script>
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