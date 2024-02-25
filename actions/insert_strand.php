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
    echo '<script>window.location.href="http://localhost/sjdc/admin/admin_strand.php"</script>';
  }
  else {
    echo '<script>window.location.href="http://localhost/sjdc/admin/admin_strand.php"</script>';
  }
}

?>