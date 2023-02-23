<?php

session_start();
unset($_SESSION['curr_user']);
session_destroy();
header("location: index.php");

?>