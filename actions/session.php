<?php
session_start();

function sessionStudent() {
  if(!isset($_SESSION['student']) || empty($_SESSION['student'])) {
    header("Location: ../login.php");
    exit();
  }
}

function sessionTeacher() {
  if(!isset($_SESSION['teacher']) || empty($_SESSION['teacher'])) {
    header("Location: ../login.php");
    exit();
  }
}

function sessionAdmin() {
  if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
  }
}