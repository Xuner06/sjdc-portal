<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-strand'])) {
  $id = mysqli_escape_string($conn, $_POST['edit-id']);
  $strand = mysqli_escape_string($conn, $_POST['edit-strand']);
  $description = mysqli_escape_string($conn, $_POST['edit-description']);

  $sql = "UPDATE strand SET strand = '$strand', description = '$description' WHERE strand_id = '$id'";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['update-strand'] = "Successfully Updated Strand";
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_strand.php"</script>';
  }
  else {
    echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_strand.php"</script>';
  }
}  


?>