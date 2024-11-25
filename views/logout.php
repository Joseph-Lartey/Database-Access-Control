<?php


session_start();

unset($_SESSION['userID']);
unset($_SESSION['role']);


header("Location: ../views/login.php");
exit();

?>
