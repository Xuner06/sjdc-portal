<?php

function sessionTeacher() {
  if(!isset($_SESSION['teacher']) || empty($_SESSION['teacher'])) {
    echo '<script>window.location.href="http://localhost/portal/login.php"</script>';
  }
}

?>