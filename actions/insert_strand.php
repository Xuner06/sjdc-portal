<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-strand'])) {
  $strand = mysqli_escape_string($conn, $_POST['strand']);
  $description = mysqli_escape_string($conn, $_POST['description']);

  $sql = "INSERT INTO strand VALUES('', '$strand', '$description', now())";
  $query = mysqli_query($conn, $sql);

  if($query) {
    $_SESSION['add-strand'] = "Successfully Added Strand";
    header("Location: ../admin/admin_strand.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_strand.php");
    exit();
  }
}

?>