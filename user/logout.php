<?php
include_once 'control.php';
controlLoged();
session_destroy();
echo "<p id='message'>Thanks for trusting us! Redirecting...<p>";
?>
