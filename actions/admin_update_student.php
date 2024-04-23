<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-student'])) {
  $id = $_POST['edit-id'];
  $lrn = $_POST['edit_lrn'];
  $fname = ucfirst($_POST['edit-fname']);
  $mname = ucfirst($_POST['edit-mname']);
  $lname = ucfirst($_POST['edit-lname']);
  $gender = $_POST['edit-gender'];
  $contact = $_POST['edit-contact'];
  $email = $_POST['edit_email'];
  $birthday = $_POST['edit_birthday'];
  $address = $_POST['edit-address'];

  $stmtOriginalEmail = $conn->prepare("SELECT email, lrn_number FROM users WHERE id = ?");
  $stmtOriginalEmail->bind_param("i", $id);
  $stmtOriginalEmail->execute();
  $stmtResult = $stmtOriginalEmail->get_result();
  $result = $stmtResult->fetch_assoc();
  $originalEmail = $result['email'];
  $originalLrn = $result['lrn_number'];

  if ($lrn != $originalLrn) {
    $stmtDuplicateLrn = $conn->prepare("SELECT * FROM users WHERE lrn_number = ?");
    $stmtDuplicateLrn->bind_param("s", $lrn);
    $stmtDuplicateLrn->execute();
    $stmtResultDuplicateLrn = $stmtDuplicateLrn->get_result();

    if (mysqli_num_rows($stmtResultDuplicateLrn) > 0) {
      $_SESSION['duplicate-lrn'] = "This LRN Is Already Registered";
      header("Location: ../admin/admin_student.php");
      exit();
    } else {
      if ($email != $originalEmail) {
        $stmtDuplicateEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmtDuplicateEmail->bind_param("s", $email);
        $stmtDuplicateEmail->execute();
        $stmtResultDuplicateEmail = $stmtDuplicateEmail->get_result();

        if (mysqli_num_rows($stmtResultDuplicateEmail) > 0) {
          $_SESSION['duplicate-email'] = "This Email Is Already Registered";
          header("Location: ../admin/admin_student.php");
          exit();
        } else {
          $stmtUpdateStudent = $conn->prepare("UPDATE users SET lrn_number = ?, fname = ?, lname = ?, mname = ?, gender = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE id = ?");
          $stmtUpdateStudent->bind_param("sssssssssi", $lrn, $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $id);

          if (mysqli_stmt_execute($stmtUpdateStudent)) {
            $_SESSION['update-student'] = "Successfully Updated Student";
            header("Location: ../admin/admin_student.php");
            exit();
          }
        }
      } else {
        $stmtUpdateStudent = $conn->prepare("UPDATE users SET lrn_number = ?, fname = ?, lname = ?, mname = ?, gender = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE id = ?");
        $stmtUpdateStudent->bind_param("sssssssssi", $lrn, $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $id);

        if (mysqli_stmt_execute($stmtUpdateStudent)) {
          $_SESSION['update-student'] = "Successfully Updated Student";
          header("Location: ../admin/admin_student.php");
          exit();
        }
      }
    }
  } elseif ($email != $originalEmail) {
    $stmtDuplicateEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmtDuplicateEmail->bind_param("s", $email);
    $stmtDuplicateEmail->execute();
    $stmtResultDuplicateEmail = $stmtDuplicateEmail->get_result();

    if (mysqli_num_rows($stmtResultDuplicateEmail) > 0) {
      $_SESSION['duplicate-email'] = "This Email Is Already Registered";
      header("Location: ../admin/admin_student.php");
      exit();
    } else {
      $stmtUpdateStudent = $conn->prepare("UPDATE users SET lrn_number = ?, fname = ?, lname = ?, mname = ?, gender = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE id = ?");
      $stmtUpdateStudent->bind_param("sssssssssi", $lrn, $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $id);

      if (mysqli_stmt_execute($stmtUpdateStudent)) {
        $_SESSION['update-student'] = "Successfully Updated Student";
        header("Location: ../admin/admin_student.php");
        exit();
      }
    }
  } else {
    $stmtUpdateStudent = $conn->prepare("UPDATE users SET lrn_number = ?, fname = ?, lname = ?, mname = ?, gender = ?, birthday = ?, contact = ?, email = ?, address = ? WHERE id = ?");
    $stmtUpdateStudent->bind_param("sssssssssi", $lrn, $fname, $lname, $mname, $gender, $birthday, $contact, $email, $address, $id);

    if (mysqli_stmt_execute($stmtUpdateStudent)) {
      $_SESSION['update-student'] = "Successfully Updated Student";
      header("Location: ../admin/admin_student.php");
      exit();
    }
  }
}
