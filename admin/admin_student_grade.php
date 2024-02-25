<?php
include("../database/database.php");
if (isset($_POST['grade'])) {
  $id = mysqli_escape_string($conn, $_POST['enroll-id']);
  $sql = "SELECT e.*, sy.*, c.strand, c.level, st.* FROM enroll_student e JOIN class c ON e.class = c.class_id JOIN school_year sy ON e.sy = sy.sy_id JOIN student st ON e.student_id = st.student_id WHERE enroll_id = '$id'";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);
  $semester = $result['semester'];
  $strand = $result['strand'];
  $level = $result['level'];

  $sqlSubject = "SELECT * FROM subject WHERE level = '$level' AND strand = '$strand' AND semester = '$semester'";
  $querySubject = mysqli_query($conn, $sqlSubject);
} else {
  echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_grade.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
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
                <p><strong>LRN Number: </strong><?php echo $result['lrn_number']; ?></p>
                <p><strong>Name: </strong><?php echo $result['lname'] . ', ' . $result['fname']; ?></p>
                <p><strong>School Year: </strong><?php echo $result['start_year'] . '-' . $result['end_year'] . ' ' . $result['semester']; ?></p>
                <form action="../actions/admin_insert_grade.php" method="post">
                  <input type="hidden" name="student-id" value="<?php echo $id; ?>">
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
                          <td class="text-center align-middle"><?php echo $row['subject_id']; ?></td>
                          <td class="text-center align-middle"><?php echo $row['name']; ?></td>
                          <td class="text-center align-middle">
                            <select class="form-control" name="grade[<?php echo $row['subject_id']; ?>]" id="">
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
                  <button type="submit" class="btn btn-primary btn-sm" name="grade-student">Grade</button>
                </form>

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

</body>

</html>