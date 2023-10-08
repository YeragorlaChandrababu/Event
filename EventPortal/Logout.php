<?php
session_start();
   unset($_SESSION['loggedin']);
   unset($_SESSION['uid']);
   unset($_SESSION['usn']);
   session_destroy();
   echo "<script>window.location.replace('Login.php')</script>";
   exit;
?>