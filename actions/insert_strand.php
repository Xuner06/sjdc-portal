<?php
include("../database/database.php");
session_start();

if (isset($_POST['add-strand'])) {
  $strand = strtoupper($_POST['strand']);
  $description = $_POST['description'];

  $stmtCheckStrand = $conn->prepare("SELECT strand FROM strand WHERE strand = ?");
  $stmtCheckStrand->bind_param("s", $strand);
  $stmtCheckStrand->execute();
  $stmtResultStrand = $stmtCheckStrand->get_result();

  if (mysqli_num_rows($stmtResultStrand) > 0) {
    $_SESSION['duplicate-strand'] = "Strand Already Exists";
    header("Location: ../admin/admin_strand.php");
    exit();
  } 
  else {
    $stmtInsertStrand = $conn->prepare("INSERT INTO strand (strand, description, date_created) VALUES (?, ?, NOW())");
    $stmtInsertStrand->bind_param("ss", $strand, $description);

    if (mysqli_stmt_execute($stmtInsertStrand)) {
      $_SESSION['add-strand'] = "Successfully Added Strand";
      header("Location: ../admin/admin_strand.php");
      exit();
    } else {
      header("Location: ../admin/admin_strand.php");
      exit();
    }
  }
}
?>
