<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-schoolyear'])) {
  $id = $_POST['edit-id'];
  $status = mysqli_escape_string($conn, $_POST['edit-status']);
  $startYear = mysqli_escape_string($conn, $_POST['edit-startYear']);
  $endYear = mysqli_escape_string($conn, $_POST['edit-endYear']);
  $semester = mysqli_escape_string($conn, $_POST['edit-semester']);

  $checkActive = "SELECT * FROM school_year WHERE status = 'Active'";
  $checkActiveQuery = mysqli_query($conn, $checkActive);

  if(mysqli_num_rows($checkActiveQuery) >= 0) {
    $sqlUpdateStatus = "UPDATE school_year SET status = 'Inactive' WHERE status = 'Active'";
    $queryUpdateStatus = mysqli_query($conn, $sqlUpdateStatus);

    $sql = "UPDATE school_year SET status = '$status', start_year = '$startYear', end_year = '$endYear', semester = '$semester' WHERE sy_id = '$id'";
    $query = mysqli_query($conn, $sql);

    if($query) {
      $_SESSION['update-schoolyear'] = "Successfully Updated School Year";
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_schoolyear.php"</script>';
  
    }
    else {
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_schoolyear.php"</script>';
    }

  }
  
}  


?>