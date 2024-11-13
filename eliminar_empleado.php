<?php
include('conexiondb.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM employees WHERE emp_no = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error al eliminar el empleado: " . mysqli_error($conn);
    }
}
?>
