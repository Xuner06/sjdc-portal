<?php
include("../database/database.php");
session_start();

if(isset($_POST['add-strand'])) {
  $strand = $_POST['strand'];
  $description = $_POST['description'];

  $stmtInsertStrand = $conn->prepare("INSERT INTO strand (strand, description, date_created) VALUES (?, ?, NOW())");
  $stmtInsertStrand->bind_param("ss", $strand, $description);

  if(mysqli_stmt_execute($stmtInsertStrand)) {
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