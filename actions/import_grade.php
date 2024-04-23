<?php
include("../database/database.php");
session_start();

if (isset($_POST['import-grade'])) {
  $subject = $_POST['subject'];
  $sy = $_POST['sy'];
  $class = $_POST['class'];

  // Allowed mime types
  $csvMimes = array('text/x-comma-separated-values', 'text/ comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain',);
  // Validate whether selected file is a CSV file
  if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

    // If the file is uploaded
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {

      // Open uploaded CSV file with read-only mode
      $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

      // Skip the first line
      fgetcsv($csvFile);

      // Parse data from CSV file line by line
      while (($line = fgetcsv($csvFile)) !== FALSE) {
        // Get row data
        $lrn = $line[0];
        $grade = $line[1];
        if (isset($line[0])) {
          $lrn = $line[0];
        } else {
          header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
          exit();
        }

        if (isset($line[1])) {
          $grade = $line[1];
        } else {
          header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
          exit();
        }

        // Check whether member already exists in the database with the same email
        $stmtSelect = $conn->prepare("SELECT * FROM users WHERE lrn_number = ?");
        $stmtSelect->bind_param("s", $lrn);
        $stmtSelect->execute();
        $stmtResultSelect = $stmtSelect->get_result();
        if (mysqli_num_rows($stmtResultSelect) > 0) {
          $result = $stmtResultSelect->fetch_assoc();
          $id = $result['id'];

          $stmtGrade = $conn->prepare("SELECT * FROM grade WHERE student = ? AND sy = ? AND subject = ?");
          $stmtGrade->bind_param("iii", $id, $sy, $subject);
          $stmtGrade->execute();
          $stmtResultGrade = $stmtGrade->get_result();

          if (mysqli_num_rows($stmtResultGrade) == 0) {
            $stmtInsertGrade = $conn->prepare("INSERT INTO grade (student, sy, subject, grade, class) VALUE (?, ?, ?, ?, ?)");
            $stmtInsertGrade->bind_param("iiiii", $id, $sy, $subject, $grade, $class);
            $stmtInsertGrade->execute();
          }
        }
      }
      // Close opened CSV file
      fclose($csvFile);

      $_SESSION['success-import'] = "Successfully Uploaded Grade";
      header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
      exit();
    } else {
      header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
      exit();
    }
  } else {
    $_SESSION['invalid-file'] = "Invalid File Type";
    header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
    exit();
  }
}
