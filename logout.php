<?php
require("config.php");
unset($_SESSION['user']);
header("Location: home.php");
die("Redirecting to: home.php");
?>