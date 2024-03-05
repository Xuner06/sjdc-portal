<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-strand'])) {
  $strand = mysqli_escape_string($conn, $_POST['strand']);
  $description = mysqli_escape_string($conn, $_POST['description']);
  $date_created = date("Y-m-d");

  //prepare and bind
  $stmtStrand = $conn->prepare("INSERT INTO strand (strand, description, date_created) VALUES (?, ?, ?)");
  $stmtStrand->bind_param("sss", $strand, $description, $date_created);

  if(mysqli_stmt_execute($stmtStrand)) {
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