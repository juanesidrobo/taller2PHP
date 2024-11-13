<?php 

include('conexiondb.php'); 
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Departamentos</title>
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
            position: relative;
        }
        h2, h3 {
            color: #545454;
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
        input[type="text"] {
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .actions img {
            width: 20px;
            height: 20px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .actions img:hover {
            transform: scale(1.1);
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
            width: 20px;
            height: 20px;
        }
        .logout:hover {
            color: #333333;
        }
        .message {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout">
        Cerrar Sesión 
        <img src="logout.png" alt="Logout Icon">
    </a>
    
    <div class="container">
        <h2>Gestión de Departamentos</h2>

        <h3>Agregar Nuevo Departamento</h3>
        <form action="editar_departamento.php" method="POST">
            <label for="dept_no">ID del Departamento:</label><br>
            <input type="text" id="dept_no" name="dept_no" required><br>
            <label for="dept_name">Nombre del Departamento:</label><br>
            <input type="text" id="dept_name" name="dept_name" required><br>
            <button type="submit" name="bt_guardar_departamento">Guardar Departamento</button>
        </form>

        <h3>Lista de Departamentos</h3>
        <table>
            <thead>
                <tr>
                    <th>ID de Departamento</th>
                    <th>Nombre del Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT dept_no, dept_name FROM departments ORDER BY dept_no ASC";
                $resultado = mysqli_query($conn, $query);

                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['dept_no'] . "</td>";
                    echo "<td>" . $fila['dept_name'] . "</td>";
                    echo "<td class='actions'>
                            <a href='editar_departamento.php?edit_id=" . $fila['dept_no'] . "'>
                                <img src='editar.png' alt='Editar' title='Editar'>
                            </a>
                            <a href='editar_departamento.php?delete_id=" . $fila['dept_no'] . "'>
                                <img src='borrar.png' alt='Borrar' title='Eliminar'>
                            </a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Al guardar un nuevo departamento
if (isset($_POST['bt_guardar_departamento'])) {
    $dept_no = $_POST['dept_no'];
    $dept_name = $_POST['dept_name'];

    $query = "INSERT INTO departments (dept_no, dept_name) VALUES ('$dept_no', '$dept_name')";
    if (mysqli_query($conn, $query)) {
        header("Location: editar_departamento.php");
        exit(); // Agrega `exit` después de `header` para asegurarte de que el script se detenga
    } else {
        echo "<div class='message'>Error al guardar el departamento: " . mysqli_error($conn) . "</div>";
    }
}

        if (isset($_GET['delete_id'])) {
            $dept_no = $_GET['delete_id'];

            $query = "DELETE FROM departments WHERE dept_no = '$dept_no'";
            if (mysqli_query($conn, $query)) {
                header("Location: editar_departamento.php");
            } else {
                echo "<div class='message'>Error al eliminar el departamento: " . mysqli_error($conn) . "</div>";
            }
        }

        if (isset($_GET['edit_id'])) {
            $dept_no = $_GET['edit_id'];
            $query = "SELECT * FROM departments WHERE dept_no = '$dept_no'";
            $resultado = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultado) == 1) {
                $fila = mysqli_fetch_array($resultado);
                $dept_name = $fila['dept_name'];
                echo "<h3>Editar Departamento</h3>";
                echo "<form action='editar_departamento.php' method='POST'>";
                echo "<input type='hidden' name='dept_no' value='$dept_no'>";
                echo "<label for='dept_name'>Nombre del Departamento:</label><br>";
                echo "<input type='text' id='dept_name' name='dept_name' value='$dept_name' required><br>";
                echo "<button type='submit' name='bt_actualizar_departamento'>Actualizar Departamento</button>";
                echo "</form>";
            }
        }

        if (isset($_POST['bt_actualizar_departamento'])) {
            $dept_no = $_POST['dept_no'];
            $dept_name = $_POST['dept_name'];

            $query = "UPDATE departments SET dept_name = '$dept_name' WHERE dept_no = '$dept_no'";
            if (mysqli_query($conn, $query)) {
                header("Location: editar_departamento.php");
            } else {
                echo "<div class='message'>Error al actualizar el departamento: " . mysqli_error($conn) . "</div>";
            }
        }
        
        ?>
    </div>
</body>
</html>
