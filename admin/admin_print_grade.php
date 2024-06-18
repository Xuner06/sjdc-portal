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

if (isset($_GET['view'])) {
  $enrollId = $_GET['view'];

  $stmtEnroll = $conn->prepare("SELECT * FROM enroll_student e LEFT JOIN school_year sy ON e.sy = sy.sy_id LEFT JOIN class c ON e.class = c.class_id LEFT JOIN strand s ON c.strand = s.strand_id LEFT JOIN users u ON e.student_id = u.id WHERE e.enroll_id = ?");
  $stmtEnroll->bind_param("i", $enrollId);
  $stmtEnroll->execute();
  $stmtResultEnroll = $stmtEnroll->get_result();
  $result = $stmtResultEnroll->fetch_assoc();

  if (mysqli_num_rows($stmtResultEnroll) == 0) {
    header("Location: admin_grade.php");
    exit();
  }
} else {
  header("Location: admin_grade.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../font/font.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" href="../assests/bg1.png" type="image/x-icon">
  <title>SJDC | Print Grade</title>
</head>

<body>
  <div class="container">
    <div class="d-flex justify-content-center">
      <img src="../assests/header.png" alt="">
    </div>
    <h1 class="text-center mb-5">REPORT OF GRADES</h1>
    <div class="row">
      <div class="col d-flex justify-content-start">
        <p>Lrn Number: <?php echo $result['lrn_number']; ?></p>
      </div>
      <div class="col d-flex justify-content-end">
        <p>S.Y: <?php echo $result['start_year'] . '-' . $result['end_year'] . ' ' . ($result['semester'] == "First Semester" ? "1st Sem" : "2nd Sem"); ?></p>

      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-start">
        <p>Name: <?php echo $result['fname'] . ' ' . $result['mname'] . ' ' . $result['lname']; ?></p>
      </div>
      <div class="col d-flex justify-content-end">
        <p>Class: <?php echo $result['level'] . '-' . $result['strand'] . '-' . $result['section']; ?></p>
      </div>
    </div>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="bg-secondary">Subject Name</th>
          <th class="bg-secondary">Grade</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $studentId = $result['student_id'];
        $level = $result['level'];
        $strand = $result['strand_id'];
        $semester = $result['semester'];
        $sy = $result['sy'];


        $stmtSubject = $conn->prepare("SELECT * FROM subject WHERE level = ? AND FIND_IN_SET(?, strand) > 0 AND semester = ? ORDER BY name");
        $stmtSubject->bind_param("sss", $level, $strand, $semester);
        $stmtSubject->execute();
        $stmtResultSubject = $stmtSubject->get_result();
        if (mysqli_num_rows($stmtResultSubject) > 0) {
          while ($rowSubject = mysqli_fetch_assoc($stmtResultSubject)) {
        ?>
            <tr>
              <td><?php echo $rowSubject['name']; ?></td>
              <td>
                <?php
                $stmtCheckGrade = $conn->prepare("SELECT * FROM grade WHERE student = ? AND subject = ?");
                $stmtCheckGrade->bind_param("ii", $studentId, $rowSubject['subject_id']);
                $stmtCheckGrade->execute();
                $stmtResultGrade = $stmtCheckGrade->get_result();

                if (mysqli_num_rows($stmtResultGrade) > 0) {
                  $resultGrade = $stmtResultGrade->fetch_assoc();
                  $grade = $resultGrade['grade'];
                  echo $grade;
                } else {
                  echo "N/A";
                }
                ?>
              </td>
            </tr>
          <?php
          }
        } else {
          ?>
          <tr class="no-subject">
            <td colspan="2" class="text-center">No Subject Available</td>
            <td class="d-none"></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
      <?php
      $stmtCheckSubject = $conn->prepare("SELECT * FROM subject WHERE level = ? AND FIND_IN_SET(?, strand) > 0 AND semester = ?");
      $stmtCheckSubject->bind_param("sss", $level, $strand, $semester);
      $stmtCheckSubject->execute();
      $stmtResultCheckSubject = $stmtCheckSubject->get_result();
      if (mysqli_num_rows($stmtResultCheckSubject) > 0) {
        $stmtAverage = $conn->prepare("SELECT ROUND(AVG(g.grade)) AS average FROM grade g WHERE g.student = ? AND g.sy = ?");
        $stmtAverage->bind_param("ii", $studentId, $sy);
        $stmtAverage->execute();
        $stmtResultAverage = $stmtAverage->get_result();

        if (mysqli_num_rows($stmtResultAverage) > 0) {
          $average = $stmtResultAverage->fetch_assoc();
          $total = $average['average'];
          if ($total !== null) {
      ?>
            <tfoot>
              <tr>
                <td><strong>GWA</strong></td>
                <td><strong><?php echo $total; ?></strong></td>
              </tr>
            </tfoot>
          <?php
          } else {
          ?>
            <tfoot>
              <tr>
                <td><strong>GWA</strong></td>
                <td><strong><?php echo "N/A"; ?></strong></td>
              </tr>
            </tfoot>
      <?php
          }
        }
      }
      ?>
    </table>
  </div>
  <script>
    window.addEventListener("load", window.print());
  </script>
</body>

</html>