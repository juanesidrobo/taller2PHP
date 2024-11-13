<?php include('conexiondb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados, Salarios y Departamentos</title>
</head>
<body>
    <h2>Empleados, Salarios y Departamentos</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Salario</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Pagination logic
            $limit = 30;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Query to get employees with their salaries and departments with limit and offset
            $query = "SELECT e.first_name, e.last_name, s.salary, d.dept_name 
                      FROM employees e 
                      JOIN salaries s ON e.emp_no = s.emp_no 
                      JOIN dept_emp de ON e.emp_no = de.emp_no 
                      JOIN departments d ON de.dept_no = d.dept_no 
                      LIMIT $limit OFFSET $offset";
            $resultado = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['first_name'] . "</td>";
                    echo "<td>" . $fila['last_name'] . "</td>";
                    echo "<td>" . $fila['salary'] . "</td>";
                    echo "<td>" . $fila['dept_name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron empleados.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Pagination links
    $total_query = "SELECT COUNT(*) as total FROM employees e 
                    JOIN salaries s ON e.emp_no = s.emp_no 
                    JOIN dept_emp de ON e.emp_no = de.emp_no 
                    JOIN departments d ON de.dept_no = d.dept_no";
    $total_result = mysqli_query($conn, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_employees = $total_row['total'];
    $total_pages = ceil($total_employees / $limit);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo "<strong>$i</strong> ";
        } else {
            echo "<a href='employee_salaries_departments.php?page=$i'>$i</a> ";
        }
    }
    echo "</div>";
    ?>
</body>
</html>
