<?php
session_start();

$_SESSION['adminUser'] = "None";

echo "<script>document.location='../login.html' </script>";

?>