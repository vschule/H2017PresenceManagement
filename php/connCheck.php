<?php

session_start();

if($_SESSION['adminUser'] != "valide")
{
    echo "<script>document.location='login.php' </script>";
}
?>