<?php
include('conexiondb.php');
session_start();

// Handle search
if (isset($_POST['bt_buscar_empleado'])) {
    $id = $_POST['emp_no'];
    $query = "SELECT * FROM employees WHERE emp_no = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);
        $first_name = $fila['first_name'];
        $last_name = $fila['last_name'];
        $gender = $fila['gender'];
        $birth_date = $fila['birth_date'];
        $hire_date = $fila['hire_date'];
    } else {
        echo "<p class='message'>No se encontró el empleado con ID: $id</p>";
    }
}

// Handle update
if (isset($_POST['bt_actualizar_empleado'])) {
    $id = $_POST['emp_no'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];

    $query = "UPDATE employees SET first_name = '$first_name', last_name = '$last_name', gender = '$gender' WHERE emp_no = $id";
    if (mysqli_query($conn, $query)) {
        echo "<p class='message success'>Empleado actualizado exitosamente.</p>";
    } else {
        echo "<p class='message error'>Error al actualizar el empleado: " . mysqli_error($conn) . "</p>";
    }
}

// Handle delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM employees WHERE emp_no = $id";
    if (mysqli_query($conn, $query)) {
        echo "<p class='message success'>Empleado eliminado exitosamente.</p>";
    } else {
        echo "<p class='message error'>Error al eliminar el empleado: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #545454;
        }
        .container {
            width: 90%;
            max-width: 700px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            color: #545454;
            margin-bottom: 15px;
        }
        form {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 8px;
        }
        label {
            font-weight: bold;
        }
        input[type="number"],
        input[type="text"],
        select {
            width: calc(100% - 22px);
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #545454;
            color: #ffffff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #333333;
        }
        .message {
            padding: 10px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }
        .message.success {
            color: #4CAF50;
        }
        .message.error {
            color: #FF0000;
        }
        .details {
            text-align: left;
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
            color: #545454;
        }
        .details strong {
            font-weight: bold;
        }
        .delete-button {
            display: inline-block;
            color: #ffffff;
            background-color: #FF0000;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        .delete-button:hover {
            background-color: #CC0000;
        }
        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 14px;
            color: #545454;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .logout img {
          
            height: 20px;
        }
        .logout:hover {
            color: #333333;
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout">
        Cerrar Sesión 
        <img src="logout.png" alt="Logout Icon">
    </a>
    <div class="container">
        <h2>Buscar Empleado</h2>
        <form action="editar_empleado.php" method="POST">
            <label for="emp_no">ID del Empleado:</label><br>
            <input type="number" id="emp_no" name="emp_no" required><br>
            <button type="submit" name="bt_buscar_empleado">Buscar</button>
        </form>

        <?php if (isset($fila)) { ?>
            <h2>Editar Empleado</h2>
            <form action="editar_empleado.php" method="POST">
                <input type="hidden" name="emp_no" value="<?php echo $id; ?>">
                <label for="first_name">Nombre:</label><br>
                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required><br>
                <label for="last_name">Apellido:</label><br>
                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required><br>
                <label for="gender">Género:</label><br>
                <select id="gender" name="gender">
                    <option value="M" <?php if ($gender == 'M') echo 'selected'; ?>>Masculino</option>
                    <option value="F" <?php if ($gender == 'F') echo 'selected'; ?>>Femenino</option>
                </select><br>
                <button type="submit" name="bt_actualizar_empleado">Actualizar Empleado</button>
            </form>

            <h2>Detalles del Empleado</h2>
            <div class="details">
                <p><strong>ID:</strong> <?php echo $id; ?></p>
                <p><strong>Nombre:</strong> <?php echo $first_name; ?></p>
                <p><strong>Apellido:</strong> <?php echo $last_name; ?></p>
                <p><strong>Género:</strong> <?php echo $gender; ?></p>
                <p><strong>Fecha de Nacimiento:</strong> <?php echo $birth_date; ?></p>
                <p><strong>Fecha de Contratación:</strong> <?php echo $hire_date; ?></p>
            </div>
            <a href="editar_empleado.php?delete_id=<?php echo $id; ?>" class="delete-button">Eliminar Empleado</a>
        <?php } ?>
    </div>
</body>
</html>
