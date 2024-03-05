<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-subject'])) {
  $name = mysqli_escape_string($conn, $_POST['name']);
  $level = mysqli_escape_string($conn, $_POST['level']);
  $strand = mysqli_escape_string($conn, $_POST['strand']);
  $semester = mysqli_escape_string($conn, $_POST['semester']);

  $sql = "INSERT INTO subject VALUES('', '$name', '$level', '$strand', '$semester', now())";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['add-subject'] = "Successfully Added Subject";
    header("Location: ../admin/admin_subject.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_subject.php");
    exit();
  }
}

?>