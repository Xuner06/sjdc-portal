<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-subject'])) {
  $id = $_POST['edit-id'];
  $name = mysqli_escape_string($conn, $_POST['edit-name']);
  $level = mysqli_escape_string($conn, $_POST['edit-level']);
  $strand = mysqli_escape_string($conn, $_POST['edit-strand']);
  $semester = mysqli_escape_string($conn, $_POST['edit-semester']);

  $sql = "UPDATE subject SET name = '$name', level = '$level', strand = '$strand', semester = '$semester' WHERE subject_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['update-subject'] = "Successfully Updated Subject";
    header("Location: ../admin/admin_subject.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_subject.php");
    exit();
  }
}  


?>