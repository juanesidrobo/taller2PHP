<?php include('conexiondb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Departamentos</title>
</head>
<body>
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
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID de Departamento</th>
                <th>Nombre del Departamento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to get departments
            $query = "SELECT dept_no, dept_name FROM departments ORDER BY dept_no ASC";
            $resultado = mysqli_query($conn, $query);

            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['dept_no'] . "</td>";
                echo "<td>" . $fila['dept_name'] . "</td>";
                echo "<td>
                        <a href='editar_departamento.php?edit_id=" . $fila['dept_no'] . "'>Editar</a>
                        <a href='editar_departamento.php?delete_id=" . $fila['dept_no'] . "'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Handle insert
    if (isset($_POST['bt_guardar_departamento'])) {
        $dept_no = $_POST['dept_no'];
        $dept_name = $_POST['dept_name'];

        $query = "INSERT INTO departments (dept_no, dept_name) VALUES ('$dept_no', '$dept_name')";
        if (mysqli_query($conn, $query)) {
            header("Location: editar_departamento.php");
        } else {
            echo "Error al guardar el departamento: " . mysqli_error($conn);
        }
    }

    // Handle delete
    if (isset($_GET['delete_id'])) {
        $dept_no = $_GET['delete_id'];

        $query = "DELETE FROM departments WHERE dept_no = '$dept_no'";
        if (mysqli_query($conn, $query)) {
            header("Location: editar_departamento.php");
        } else {
            echo "Error al eliminar el departamento: " . mysqli_error($conn);
        }
    }

    // Handle edit
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

    // Handle update
    if (isset($_POST['bt_actualizar_departamento'])) {
        $dept_no = $_POST['dept_no'];
        $dept_name = $_POST['dept_name'];

        $query = "UPDATE departments SET dept_name = '$dept_name' WHERE dept_no = '$dept_no'";
        if (mysqli_query($conn, $query)) {
            header("Location: editar_departamento.php");
        } else {
            echo "Error al actualizar el departamento: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
