<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // Redirige al inicio de sesión
?>
