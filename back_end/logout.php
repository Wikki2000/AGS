<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
header("Location: ../front_end/login_page.html");

exit;
?>