<?php
session_start();
session_destroy();
echo '<script>alert("Successfully Logout")</script>';
echo '<script>window.location.href="http://localhost/portal/login.php"</script>';
?>
