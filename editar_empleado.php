<?php
include('conexiondb.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM employees WHERE emp_no = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);
        $first_name = $fila['first_name'];
        $last_name = $fila['last_name'];
        $gender = $fila['gender'];
        $birth_date = $fila['birth_date'];
        $hire_date = $fila['hire_date'];
    }
}

if (isset($_POST['bt_actualizar_empleado'])) {
    $id = $_GET['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];
    $hire_date = $_POST['hire_date'];

    $query = "UPDATE employees SET first_name = '$first_name', last_name = '$last_name', gender = '$gender', birth_date = '$birth_date', hire_date = '$hire_date' WHERE emp_no = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error al actualizar el empleado: " . mysqli_error($conn);
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
    <h2>Editar Empleado</h2>
    <form action="editar_empleado.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <label for="first_name">Nombre:</label><br>
        <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required><br>
        <label for="last_name">Apellido:</label><br>
        <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required><br>
        <label for="gender">Género:</label><br>
        <select id="gender" name="gender">
            <option value="M" <?php if ($gender == 'M') echo 'selected'; ?>>Masculino</option>
            <option value="F" <?php if ($gender == 'F') echo 'selected'; ?>>Femenino</option>
        </select><br>
        <label for="birth_date">Fecha de Nacimiento:</label><br>
        <input type="date" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>" required><br>
        <label for="hire_date">Fecha de Contratación:</label><br>
        <input type="date" id="hire_date" name="hire_date" value="<?php echo $hire_date; ?>" required><br>
        <button type="submit" name="bt_actualizar_empleado">Actualizar Empleado</button>
    </form>
</body>
</html>
