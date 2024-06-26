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
        $lrn = trim($line[0], "'");
        $grade = $line[2];
        if (isset($line[0]) && isset($line[2])) {
          $lrn = trim($line[0], "'");
          $grade = $line[2];

          // Check if grade is 'N/A', skip insertion
          if ($grade == 'N/A') {
            continue; // Skip current iteration and move to next line
          }

          // Check whether member already exists in the database with the same lrn_number
          $stmtSelect = $conn->prepare("SELECT * FROM users WHERE lrn_number = ?");
          $stmtSelect->bind_param("s", $lrn);
          $stmtSelect->execute();
          $stmtResultSelect = $stmtSelect->get_result();

          if (mysqli_num_rows($stmtResultSelect) > 0) {
            $result = $stmtResultSelect->fetch_assoc();
            $id = $result['id'];

            // Check if the grade entry already exists for this student, subject, and school year
            $stmtGrade = $conn->prepare("SELECT * FROM grade WHERE student = ? AND sy = ? AND subject = ?");
            $stmtGrade->bind_param("iii", $id, $sy, $subject);
            $stmtGrade->execute();
            $stmtResultGrade = $stmtGrade->get_result();

            if (mysqli_num_rows($stmtResultGrade) == 0) {
              // Insert the grade into the database
              $stmtInsertGrade = $conn->prepare("INSERT INTO grade (student, sy, subject, grade, class) VALUE (?, ?, ?, ?, ?)");
              $stmtInsertGrade->bind_param("iiiii", $id, $sy, $subject, $grade, $class);
              $stmtInsertGrade->execute();
            }
          }
        } else {
          // Handle missing data scenario (this should ideally never occur with properly formatted CSV)
          header("Location: ../teacher/teacher_encode_grade.php?subject=$subject");
          exit();
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
