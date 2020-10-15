<?php
session_start();

$_SESSION["username"] = "Nico";
$_SESSION["loggedin"] = true;
header("location: home.php");
