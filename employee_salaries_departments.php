<?php include('conexiondb.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados, Salarios y Departamentos</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #545454;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            color: #545454;
            margin-bottom: 20px;
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
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a, .pagination strong {
            color: #545454;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .pagination strong {
            background-color: #00aaff;
            color: #ffffff;
            border: 1px solid #00aaff;
        }
        .pagination .disabled {
            color: #ccc;
            border-color: #ddd;
            pointer-events: none;
        }
        .pagination .prev-next {
            font-weight: bold;
            color: #545454;
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
        <h2>Empleados, Salarios y Departamentos</h2>
        <table>
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
                // Peticion SQL para obtener los empleados, salarios y departamentos
                $query = "SELECT e.first_name, e.last_name, s.salary, d.dept_name 
                          FROM employees e 
                          JOIN salaries s ON e.emp_no = s.emp_no 
                          JOIN dept_emp de ON e.emp_no = de.emp_no 
                          JOIN departments d ON de.dept_no = d.dept_no 
                          LIMIT $limit OFFSET $offset";
                $resultado = mysqli_query($conn, $query);
                // Mostrar los resultados en la tabla
                if (mysqli_num_rows($resultado) > 0) {
                    while ($fila = mysqli_fetch_array($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $fila['first_name'] . "</td>";
                        echo "<td>" . $fila['last_name'] . "</td>";
                        echo "<td>$" . number_format($fila['salary'], 2) . "</td>";
                        echo "<td>" . $fila['dept_name'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Mensaje si no se encuentran empleados
                    echo "<tr><td colspan='4' class='no-results'>No se encontraron empleados.</td></tr>";
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
        // Enlace a la página anterior
        if ($page > 1) {
            echo "<a href='employee_salaries_departments.php?page=" . ($page - 1) . "' class='prev-next'>&laquo;</a>";
        } else {
            echo "<span class='prev-next disabled'>&laquo;</span>";
        }
        // Enlaces a las páginas
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<strong>$i</strong>";
            } else {
                echo "<a href='employee_salaries_departments.php?page=$i'>$i</a>";
            }
        }
        // Enlace a la página siguiente
        if ($page < $total_pages) {
            echo "<a href='employee_salaries_departments.php?page=" . ($page + 1) . "' class='prev-next'>&raquo;</a>";
        } else {
            echo "<span class='prev-next disabled'>&raquo;</span>";
        }

        echo "</div>";
        ?>
    </div>
</body>
</html>
