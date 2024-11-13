<?php 
include('conexiondb.php');
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #545454;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            
            max-width: 800px;
            width: 90% ;
        }
        .header {
            font-weight: 800;
            font-size: 24px;
            color: #545454;
            margin-bottom: 10px;
        }
        .welcome-message {
            font-size: 18px;
            font-weight: bold;
            color: #545454;
            margin-top: 10px;
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
            
            height: 20px;
        }
        .logout:hover {
            color: #333333;
        }
        .option-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            gap: 15px;
        }
        .option {
            text-align: center;
            color: #ffffff;
            background-color: #545454;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            width: 140px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;

        }
        .option:hover {
            background-color: #333333;
        }
        .option img {
            
            height: 60px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout">
        Cerrar Sesión 
        <img src="logout.png" alt="Logout Icon">
    </a>
    
    <div class="container">
        <h2 class="header">BD EMPLOYEES</h2>
        <div class="welcome-message">
            BIENVENIDO <?php echo strtoupper($_SESSION['nombre_usuario']); ?> <br>¿QUÉ TE GUSTARÍA GESTIONAR?
        </div>
        
        <div class="option-container">
            <a href="editar_departamento.php" class="option">
                <img src="departamentos.png" alt="Departamentos">
                DEPARTAMENTOS
            </a>
            <a href="editar_empleado.php" class="option">
                <img src="empleados.png" alt="Empleados">
                EMPLEADOS
            </a>
	    <a href="salario_grande.php" class="option">
                <img src="empleados.png" alt="salarios">
                VER SALARIOS MAYORES A 150000
            </a>
            <a href="department_managers.php" class="option">
                <img src="empleados.png" alt="Gerentes">
                PERSONAS GERENTES
            </a>
            <a href="employee_salaries_departments.php" class="option">
                <img src="empleados.png" alt="SALARIOS Y DEPTOS">
                Salarios y departamentos de los empleados
            </a>
        </div>
    </div>
</body>
</html>
