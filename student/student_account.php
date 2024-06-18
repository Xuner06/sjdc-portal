<?php
include("../database/database.php");
include("../actions/session.php");
sessionStudent();

$id = $_SESSION['student'];
$stmtStudent = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtStudent->bind_param("i", $id);
$stmtStudent->execute();
$stmtResult = $stmtStudent->get_result();
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
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | Account</title>
</head>

<body>
  <?php include("../components/student_navbar.php"); ?>

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

    if (isset($_SESSION['upload-picture-success'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Success',
          text: '<?php echo $_SESSION['upload-picture-success']; ?>',
          icon: 'success',
        })
      </script>
    <?php
      unset($_SESSION['upload-picture-success']);
    }
    if (isset($_SESSION['invalid-file-type'])) {
    ?>
      <script>
        Swal.fire({
          title: 'Failed',
          text: '<?php echo $_SESSION['invalid-file-type']; ?>',
          icon: 'error',
        })
      </script>
    <?php
      unset($_SESSION['invalid-file-type']);
    }
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Account</h1>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center mb-3">Student Account Information</h1>
                <div class="row">
                  <div class="col-lg-4 d-flex justify-content-center">
                    <a href="#upload-profile" data-toggle="modal"><img src="<?php echo $row['picture']; ?>" alt="" width="200" height="200"></a>
                  </div>
                  <div class="col-lg-4">
                    <p><strong>LRN Number:</strong> <?php echo $row['lrn_number']; ?></p>
                    <p><strong>First Name:</strong> <?php echo $row['fname']; ?></p>
                    <p><strong>Middle Name:</strong> <?php echo (!empty($row['mname']) ? $row['mname'] : "N/A"); ?></p>
                    <p><strong>Last Name:</strong> <?php echo $row['lname']; ?></p>
                    <p><strong>Sex:</strong> <?php echo $row['gender']; ?></p>
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
                  </div>
                  <div class="col-lg-4">
                    <p><strong>Contact:</strong> <?php echo $row['contact']; ?></p>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                    <p><strong>Account Created:</strong> <?php echo date("F d, Y", strtotime($row['reg_date'])); ?></p>
                    <?php
                    $getStatus = "Active";
                    $getSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
                    $getSy->bind_param("s", $getStatus);
                    $getSy->execute();
                    $getResultSy = $getSy->get_result();

                    if (mysqli_num_rows($getResultSy) > 0) {
                      $resultSy = $getResultSy->fetch_assoc();
                      $schoolYear = $resultSy['sy_id'];

                      $class = $conn->prepare("SELECT * FROM enroll_student e JOIN class c ON e.class = c.class_id LEFT JOIN strand s ON c.strand = s.strand_id WHERE e.student_id = ? AND e.sy = ?");
                      $class->bind_param("ii", $id, $schoolYear);
                      $class->execute();
                      $stmtResultClass = $class->get_result();
                      if (mysqli_num_rows($stmtResultClass) > 0) {
                        $resultClass = $stmtResultClass->fetch_assoc();
                        $finalCLass = $resultClass['level'] . '-' . $resultClass['strand'] . '-' . $resultClass['section'];
                      } else {
                        $finalCLass = "N/A";
                      }
                    } else {
                      $finalCLass = "No Active School Year";
                    }

                    ?>
                    <p><strong>Class:</strong> <?php echo $finalCLass; ?></p>
                    <a href="#change-pass" data-toggle="modal"><i class="fas fa-lock"></i> Change Password</a>
                  </div>
                </div>
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
            <button type="submit" class="btn btn-sm btn-primary w-100" name="student-change-password">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="upload-profile">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Profile</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../actions/upload_picture.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="profile_pic" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary w-100" name="upload-picture">Upload</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- bs-custom-file-input -->
  <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

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
  <script>
    $(document).ready(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>