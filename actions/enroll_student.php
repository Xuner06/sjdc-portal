<?php
include("../database/database.php");
session_start();

if (isset($_POST['enroll-student'])) {
  $studentId = $_POST['student-id'];
  $class = $_POST['class'];
  
  $statusSy = "Active";
  $stmtSy = $conn->prepare("SELECT * FROM school_year WHERE status = ?");
  $stmtSy->bind_param("s", $statusSy);
  $stmtSy->execute();
  $stmtResultSy = $stmtSy->get_result();
  $result = $stmtResultSy->fetch_assoc();
  $schoolyear = $result['sy_id'];

  $stmtEnroll = $conn->prepare("SELECT * FROM enroll_student WHERE student_id = ? AND sy = ?");
  $stmtEnroll->bind_param("ii", $studentId, $schoolyear);
  $stmtEnroll->execute();
  $stmtResultEnroll = $stmtEnroll->get_result();

  if (mysqli_num_rows($stmtResultEnroll) > 0) {
    $_SESSION['error-enroll'] = "Student Already Enrolled In This School Year";
    header("Location: ../admin/admin_student_enroll.php?id=$studentId");
    exit();
  } 
  else {
    $stmtInsertEnroll = $conn->prepare("INSERT INTO enroll_student (student_id, class, sy, enroll_date) VALUES (?, ?, ?, NOW())");
    $stmtInsertEnroll->bind_param("iii", $studentId, $class, $schoolyear);

    if (mysqli_stmt_execute($stmtInsertEnroll)) {
      $_SESSION['success-enroll'] = "Successfully Enroll Student";
      header("Location: ../admin/admin_student_enroll.php?id=$studentId");
      exit();
    } 
    else {
      header("Location: ../admin/admin_student_enroll.php?id=$studentId");
      exit();
    }
  }
}
?>
