<?php
require_once '../user/Session.php';

Session::start();
Session::destroy(); // Destroy the session

header("Location: login.php"); // Redirect to login page
exit();
?>