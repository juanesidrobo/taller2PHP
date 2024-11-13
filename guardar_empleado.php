<?php
include('conexiondb.php');

if (isset($_POST['bt_guardar_empleado'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];
    $hire_date = $_POST['hire_date'];

    // NOTA: No se debe incluir el campo `emp_no` en la consulta INSERT
    $query = "INSERT INTO employees (birth_date, first_name, last_name, gender, hire_date) 
              VALUES ('$birth_date', '$first_name', '$last_name', '$gender', '$hire_date')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error al guardar el empleado: " . mysqli_error($conn);
    }
}
?>
