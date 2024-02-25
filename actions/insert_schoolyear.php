<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-schoolyear'])) {
  $start_year = mysqli_escape_string($conn, $_POST['start_year']);
  $end_year = mysqli_escape_string($conn, $_POST['end_year']);
  $semester = mysqli_escape_string($conn, $_POST['semester']);


  $checkActive = "SELECT * FROM school_year WHERE status = 'Active'";
  $checkActiveQuery = mysqli_query($conn, $checkActive);

  if(mysqli_num_rows($checkActiveQuery) >= 0)  {
    $sqlUpdateStatus = "UPDATE school_year SET status = 'Inactive'";
    $queryUpdateStatus = mysqli_query($conn, $sqlUpdateStatus);
    
    $sql = "INSERT INTO school_year (start_year, end_year, semester, created_at) VALUES('$start_year', '$end_year', '$semester', now())";
    $query = mysqli_query($conn, $sql);

    if($query) {
      $_SESSION['add-schoolyear'] = "Successfully Added School Year";
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_schoolyear.php"</script>';
    }
    else {
      echo '<script>window.location.href="http://localhost/sjdc-portal/admin/admin_schoolyear.php"</script>';
    }


  }
}
