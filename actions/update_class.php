<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-class'])) {
  $id = mysqli_escape_string($conn, $_POST['edit-id']);
  $level = mysqli_escape_string($conn, $_POST['edit-level']);
  $strand = mysqli_escape_string($conn, $_POST['edit-strand']);
  $section = mysqli_escape_string($conn, $_POST['edit-section']);
  $adviser = mysqli_escape_string($conn, $_POST['edit-adviser']);
  $sy = mysqli_escape_string($conn, $_POST['edit-sy']);

  $sql = "UPDATE class SET level = '$level', strand = '$strand', section = '$section', adviser = '$adviser', sy = '$sy' WHERE class_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['update-class'] = "Successfully Updated Class";
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_class.php"</script>';

  }
  else {
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_class.php"</script>';
  }
}  


?>