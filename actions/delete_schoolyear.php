<?php
include("../database/database.php");
session_start();

if(isset($_POST['delete-schoolyear'])) {
  $id = mysqli_escape_string($conn, $_POST['delete-id']);
  $sql = "DELETE FROM school_year WHERE sy_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['delete-schoolyear'] = "Successfully Deleted School Year";
    echo '<script>window.location.href="http://localhost/portal/admin/admin_schoolyear.php"</script>';
  }
}
else {
  echo '<script>window.location.href="http://localhost/portal/admin/admin_schoolyear.php"</script>';
}


?>