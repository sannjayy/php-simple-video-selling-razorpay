<?php
include("../inc/main_init.php");

session_start();
session_destroy();
header("location:./");
?>