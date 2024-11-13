<?php
$conn = mysqli_connect('localhost', 'root', '', 'employees');

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
