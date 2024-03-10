<?php
include("../database/database.php");
session_start();

if(isset($_POST['update-strand'])) {
  $id = $_POST['edit-id'];
  $strand = $_POST['edit-strand'];
  $description = $_POST['edit-description'];

  $stmtUpdateStrand = $conn->prepare("UPDATE strand SET strand = ?, description = ? WHERE strand_id = ?");
  $stmtUpdateStrand->bind_param("ssi", $strand, $description, $id);

  if(mysqli_stmt_execute($stmtUpdateStrand)) {
    $_SESSION['update-strand'] = "Successfully Updated Strand";
    header("Location: ../admin/admin_strand.php");
    exit();
  }
  else {
    header("Location: ../admin/admin_strand.php");
    exit();
  }
}  
?>