<?php include('conexiondb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados con Salario Mayor a 150,000</title>
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
        .card-salary {
            font-size: 16px;
            color: #4CAF50;
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
        <h2>Empleados con Salario Mayor a 150,000</h2>
        <div class="card-grid">
            <?php
            //Peticion para obtener los empleados con salario mayor a 150,000
            $query = "SELECT e.first_name, e.last_name, s.salary FROM employees e JOIN salaries s ON e.emp_no = s.emp_no WHERE s.salary > 150000";
            $resultado = mysqli_query($conn, $query);
            //Si se encuentran empleados con salario mayor a 150,000, se muestran en tarjetas
            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<div class='card'>";
                    echo "<div class='card-title'>" . $fila['first_name'] . " " . $fila['last_name'] . "</div>";
                    echo "<div class='card-salary'>$" . number_format($fila['salary'], 2) . "</div>";
                    echo "</div>";
                }
            } else {
                //Mensaje si no se encuentran empleados con salario mayor a 150,000
                echo "<div class='no-results'>No se encontraron empleados con salario mayor a 150,000.</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
