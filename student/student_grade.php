<?php
include("../database/database.php");
include("../actions/session.php");
sessionStudent();

$id = $_SESSION['student'];
$sql = "SELECT * FROM student WHERE student_id = '$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

$sql = "SELECT e.sy, sy.* FROM enroll_student e JOIN school_year sy ON e.sy = sy.sy_id WHERE e.student_id = '$id'";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../font/font.css">
  <title>SJDC | Grade</title>
</head>

<body>
  <?php include("../components/student_navbar.php"); ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Grade</h1>
      </div>
    </div>
  
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1 class="text-center">Student Grade</h1>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>School Year</th>
                      <th>Semester</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($rowStudent = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?php echo $rowStudent['start_year'] . "-" . $rowStudent['end_year']; ?></td>
                        <td><?php echo $rowStudent['semester']; ?></td>
                        <td>
                          <form action="student_view_grade.php" method="post">
                            <input type="hidden" value="<?php echo $rowStudent['sy']; ?>" name="sy">
                            <button type="submit" class="btn btn-primary btn-sm" name="view-grade">View</button>
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
        </div>
      </div>
    </div>
  </div>
</body>

</html>