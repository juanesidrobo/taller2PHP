<?php include('conexiondb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerentes de Departamentos</title>
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
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card-department {
            font-size: 16px;
            color: #333333;
            font-weight: bold;
        }
        .no-results {
            text-align: center;
            font-weight: bold;
            color: #ff0000;
            padding: 20px;
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
    </style>
</head>
<body>
<a href="logout.php" class="logout">
        Cerrar Sesión 
        <img src="logout.png" alt="Logout Icon">
    </a>
    <div class="container">
        <h2>Gerentes de Departamentos</h2>
        <div class="card-grid">
            <?php
            // Query to get department managers and their departments
            $query = "SELECT e.first_name, e.last_name, d.dept_name FROM employees e JOIN dept_manager dm ON e.emp_no = dm.emp_no JOIN departments d ON dm.dept_no = d.dept_no";
            $resultado = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<div class='card'>";
                    echo "<div class='card-title'>" . $fila['first_name'] . " " . $fila['last_name'] . "</div>";
                    echo "<div class='card-department'>" . $fila['dept_name'] . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='no-results'>No se encontraron gerentes de departamentos.</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
