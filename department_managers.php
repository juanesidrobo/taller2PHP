<?php include('conexiondb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerentes de Departamentos</title>
</head>
<body>
    <h2>Gerentes de Departamentos</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to get department managers and their departments
            $query = "SELECT e.first_name, e.last_name, d.dept_name FROM employees e JOIN dept_manager dm ON e.emp_no = dm.emp_no JOIN departments d ON dm.dept_no = d.dept_no";
            $resultado = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['first_name'] . "</td>";
                    echo "<td>" . $fila['last_name'] . "</td>";
                    echo "<td>" . $fila['dept_name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron gerentes de departamentos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
