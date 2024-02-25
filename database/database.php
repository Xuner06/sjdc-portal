<?php

$conn = mysqli_connect('localhost', 'root', '', 'sjdc');

if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>