<?php
// Almacenar el nombre del empleado en una cookie
if (isset($_POST['bt_guardar_nombre'])) {
    $employee_name = $_POST['employee_name'];
    setcookie("employee_name", $employee_name, time() + (86400 * 30), "/"); // Guardar nombre del empleado en una cookie por 30 días
    echo "<p class='success'>Nombre del empleado almacenado en una cookie: $employee_name</p>";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #0056b3;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 300px;
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004494;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        .stored-name {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Almacenar Nombre del Empleado en una Cookie</h2>
    <form action="" method="POST">
        <label for="employee_name">Nombre del Empleado:</label><br>
        <input type="text" id="employee_name" name="employee_name" required><br>
        <button type="submit" name="bt_guardar_nombre">Guardar Nombre</button>
    </form>

    <div class="stored-name">
        <h2>Nombre del Empleado Almacenado</h2>
        <p><?php echo $stored_name; ?></p>
    </div>
</body>
</html>