<?php
include("../database/database.php");
include("../actions/session.php");
sessionStudent();

$id = $_SESSION['student'];
$stmtStudent = $conn->prepare("SELECT * FROM student WHERE student_id = ?");
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
                    $stmtEnroll = $conn->prepare("SELECT e.sy, sy.* FROM enroll_student e JOIN school_year sy ON e.sy = sy.sy_id WHERE e.student_id = ?");
                    $stmtEnroll->bind_param("i", $id);
                    $stmtEnroll->execute();
                    $stmtResult = $stmtEnroll->get_result();
                    if (mysqli_num_rows($stmtResult) > 0) {           
                      while ($resultSy = $stmtResult->fetch_assoc()) {
                      ?>
                        <tr>
                          <td><?php echo $resultSy['start_year'] . "-" . $resultSy['end_year']; ?></td>
                          <td><?php echo $resultSy['semester']; ?></td>
                          <td>
                            <a href="student_view_grade.php?view=<?php echo $resultSy['sy']; ?>" class="btn btn-primary btn-sm">View</a>
                          </td>
                        </tr>
                      <?php
                      }
                    } 
                    else {
                    ?>
                      <tr>
                        <td colspan="3" class="text-center">Not Enrolled In Any School Year</td>
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
</body>

</html>