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
  <title>SJDC | Account</title>
</head>

<body>
  <?php include("../components/admin_navbar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if (isset($_SESSION['wrong-pass'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['wrong-pass']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['wrong-pass']);
    }
    ?>
    <?php
    if (isset($_SESSION['success-changePass'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['success-changePass']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['success-changePass']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Account</h1>
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
                <h1 class="text-center">Admin Account Information</h1>
                <p><strong>First Name:</strong> <?php echo $row['fname']; ?></p>
                <p><strong>Middle Name:</strong> <?php echo $row['mname']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['lname']; ?></p>
                <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
                <?php
                $currentDate = date('Y-m-d'); // Current date in 'Y-m-d' format
                $bd = $row['birthday']; // Assuming 'birthday' is also in 'Y-m-d' format

                // Calculate the age
                $birthYear = date('Y', strtotime($bd)); // Extract the birth year from the birthday
                $birthMonthDay = date('m-d', strtotime($bd)); // Extract the birth month and day

                $currentYear = date('Y', strtotime($currentDate));
                $currentMonthDay = date('m-d', strtotime($currentDate));

                $age = $currentYear - $birthYear;

                // If the birthday hasn't occurred yet this year, subtract one from the age
                if ($currentMonthDay < $birthMonthDay) {
                  $age--;
                }
                ?>
                <p><strong>Age:</strong> <?php echo $age; ?></p>
                <p><strong>Birthday:</strong> <?php echo date("F d, Y", strtotime($row['birthday'])); ?></p>
                <p><strong>Contact:</strong> <?php echo $row['contact']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                <p><strong>Account Created:</strong> <?php echo date("F d, Y", strtotime($row['reg_date'])); ?></p>
                <a href="#change-pass" data-toggle="modal"><i class="fas fa-lock"></i> Change Password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="change-pass">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/change_password.php" method="post" id="changePassForm">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
              <label for="current-pass" class="form-label">Current Password</label>
              <input type="password" class="form-control" name="current-pass" id="current-pass" required>
            </div>
            <div class="form-group">
              <label for="new-pass" class="form-label">New Password</label>
              <input type="password" class="form-control" name="new-pass" id="new-pass" required>
            </div>
            <div class="form-group">
              <label for="confirm_pass" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" required>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="admin-change-password">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- jquery-validation -->
  <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
  <script>
    $('#changePassForm').validate({
      rules: {
        confirm_pass: {
          equalTo: "#new-pass"
        }
      },
      messages: {
        confirm_pass: {
          equalTo: "New Passwords Does Not Match"
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
  </script>
</body>

</html>