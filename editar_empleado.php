<?php
include('conexiondb.php');

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
        echo "<p>No se encontró el empleado con ID: $id</p>";
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
        echo "<p>Empleado actualizado exitosamente.</p>";
    } else {
        echo "Error al actualizar el empleado: " . mysqli_error($conn);
    }
}

// Handle delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM employees WHERE emp_no = $id";
    if (mysqli_query($conn, $query)) {
        echo "<p>Empleado eliminado exitosamente.</p>";
    } else {
        echo "Error al eliminar el empleado: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
</head>
<body>
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
        <p><strong>ID:</strong> <?php echo $id; ?></p>
        <p><strong>Nombre:</strong> <?php echo $first_name; ?></p>
        <p><strong>Apellido:</strong> <?php echo $last_name; ?></p>
        <p><strong>Género:</strong> <?php echo $gender; ?></p>
        <p><strong>Fecha de Nacimiento:</strong> <?php echo $birth_date; ?></p>
        <p><strong>Fecha de Contratación:</strong> <?php echo $hire_date; ?></p>
        <a href="editar_empleado.php?delete_id=<?php echo $id; ?>">Eliminar Empleado</a>
    <?php } ?>
</body>
</html>
