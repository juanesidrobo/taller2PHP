<?php
// Almacenar el nombre del empleado en una cookie
if (isset($_POST['bt_guardar_nombre'])) {
    $employee_name = $_POST['employee_name'];
    setcookie("employee_name", $employee_name, time() + (86400 * 30), "/"); // Guardar nombre del empleado en una cookie por 30 días
    echo "<p>Nombre del empleado almacenado en una cookie: $employee_name</p>";
}

// Recuperar el nombre del empleado de la cookie si existe
$stored_name = isset($_COOKIE['employee_name']) ? $_COOKIE['employee_name'] : "No se ha almacenado ningún nombre";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Demo</title>
</head>
<body>
    <h2>Almacenar Nombre del Empleado en una Cookie</h2>
    <form action="cookie_demo.php" method="POST">
        <label for="employee_name">Nombre del Empleado:</label><br>
        <input type="text" id="employee_name" name="employee_name" required><br>
        <button type="submit" name="bt_guardar_nombre">Guardar Nombre</button>
    </form>

    <h2>Nombre del Empleado Almacenado</h2>
    <p><?php echo $stored_name; ?></p>
</body>
</html>
