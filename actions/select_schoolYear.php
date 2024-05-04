<?php
include("../database/database.php");
session_start();

if (isset($_POST['select-schoolyear'])) {
  $sy = $_POST['sy'];
  list($startYear, $endYear) = explode('-', $sy);

  $_SESSION['start_year'] = $startYear;
  $_SESSION['end_year'] = $endYear;

  header("Location: ../admin/admin_archive_sy.php");
  exit();
}
?>
