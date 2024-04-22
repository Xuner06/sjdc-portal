<?php
include("../database/database.php");
session_start();

if (isset($_POST['update-strand'])) {
  $id = $_POST['edit-id'];
  $strand = strtoupper($_POST['edit-strand']);
  $description = $_POST['edit-description'];

  $stmtOriginalStrand = $conn->prepare("SELECT strand FROM strand WHERE strand_id = ?");
  $stmtOriginalStrand->bind_param("i", $id);
  $stmtOriginalStrand->execute();
  $stmtResult = $stmtOriginalStrand->get_result();
  $result = $stmtResult->fetch_assoc();
  $originalStrand = $result['strand'];

  if($strand != $originalStrand) {
    $stmtCheckStrand = $conn->prepare("SELECT strand FROM strand WHERE strand = ?");
    $stmtCheckStrand->bind_param("s", $strand);
    $stmtCheckStrand->execute();
    $stmtResultStrand = $stmtCheckStrand->get_result();

    if(mysqli_num_rows($stmtResultStrand) > 0) {
      $_SESSION['duplicate-strand'] = "Strand Already Registered";
      header("Location: ../admin/admin_strand.php");
      exit();
    } 
    else {
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
  } 
  else {
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
}
?>
