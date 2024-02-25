<?php
include("../database/database.php");
session_start();

if (isset($_POST['grade'])) {
  $id = mysqli_escape_string($conn, $_POST['id']);
}
else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/teacher/teacher_grade.php"</script>';
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
  <?php include("../components/teacher_navbar.php"); ?>
  <div class="content-wrapper">

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
                <?php
                $sql = "SELECT e.*, sy.*, c.* FROM enroll_student e JOIN school_year sy ON e.sy = sy.sy_id JOIN class c ON e.class = c.class_id WHERE e.enroll_id = '$id'";
                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($query);
                $semester = $result['semester'];
                $level = $result['level'];
                $strand = $result['strand'];

                $sqlSubject = "SELECT * FROM subject WHERE level = '$level' AND strand = '$strand' AND semester = '$semester'";
                $querySubject = mysqli_query($conn, $sqlSubject);
                ?>
                <form action="../actions/teacher_insert_grade.php" method="post">
                  <input type="hidden" value="<?php echo $result['student_id']; ?>" name="student-id">
                  <input type="hidden" value="<?php echo $result['sy']; ?>" name="sy">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($row = mysqli_fetch_assoc($querySubject)) {
                      ?>
                        <tr>
                          <td><?php echo $row['subject_id']; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td>
                            <select class="form-control" name="grade[<?php echo $row['subject_id']; ?>]" required>
                              <option class="text-center " value=""></option>
                              <?php
                              for ($i = 70; $i <= 100; $i++) {
                                echo '<option value="' . $i . '" class="text-center">' . $i . '</option>';
                              }
                              ?>
                            </select>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" name="upload-grade">Upload Grade</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


</body>

</html>