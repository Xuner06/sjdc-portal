<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-id'])) {
  $id = mysqli_escape_string($conn, $_POST['delete-id']);
  $sql = "UPDATE class SET status = 1 WHERE class_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['delete-class'] = "Successfully Deleted Class";
    echo '<script>window.location.href="http://localhost/sjdc/admin/admin_class.php"</script>';
  }
}
else {
  echo '<script>window.location.href="http://localhost/sjdc/admin/admin_class.php"</script>';
}


?>