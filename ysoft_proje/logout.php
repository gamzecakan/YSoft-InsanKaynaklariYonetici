<?php
session_start();
session_destroy(); // Oturumu sonlandır
header("Location: login.php");
exit();
?>
