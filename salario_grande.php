<?php include('conexiondb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados con Salario Mayor a 150000</title>
</head>
<body>
    <h2>Empleados con Salario Mayor a 150,000</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Salario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to get employees with salary greater than 150000
            $query = "SELECT e.first_name, e.last_name, s.salary FROM employees e JOIN salaries s ON e.emp_no = s.emp_no WHERE s.salary > 150000";
            $resultado = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['first_name'] . "</td>";
                    echo "<td>" . $fila['last_name'] . "</td>";
                    echo "<td>" . $fila['salary'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron empleados con salario mayor a 150,000.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
