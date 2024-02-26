<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-class'])) {
  $level = mysqli_escape_string($conn, $_POST['level']);
  $strand = mysqli_escape_string($conn, $_POST['strand']);
  $section = mysqli_escape_string($conn, $_POST['section']);
  $sy = mysqli_escape_string($conn, $_POST['sy']);
  $adviser = mysqli_escape_string($conn, $_POST['adviser']);

  $sql = "INSERT INTO class VALUES('', '$level', '$strand', '$section', '$sy', '$adviser', now())";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['add-class'] = "Successfully Added Class";
    header("Location: ../admin/admin_class.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_class.php");
    exit();
  }
}

?>