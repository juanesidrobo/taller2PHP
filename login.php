<?php
include('conexiondb.php');
session_start();

$success = '';
$error = '';

if (isset($_POST['login'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];

    // Verificar si el usuario existe
    $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // El usuario existe, verificar la contraseña
        $user = mysqli_fetch_assoc($result);

        if ($user['password'] === $password) { // Cambia aquí si usas hashing con password_verify()
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $success = "Inicio de sesión exitoso.";
            header("Location: index.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            color: #545454;
        }
        h2 {
            font-weight: 800;
            font-size: 24px;
            color: #545454;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #545454;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #e6e6e6;
            font-size: 16px;
            color: #545454;
        }
        .button {
            background-color: #545454;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .button:hover {
            background-color: #333333;
        }
        .error, .success {
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .error { background-color: #e74c3c; }
        .success { background-color: #2ecc71; }
    </style>
    <script>
        function validateForm() {
            const usuario = document.getElementById("nombre_usuario").value.trim();
            const password = document.getElementById("password").value.trim();
            if (!usuario || !password) {
                alert("Por favor complete todos los campos.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>BIENVENIDO A BASE DE DATOS EMPLOYEES!</h2>
        <img src="usericon.png" alt="User Icon" style="width:200px; margin:20px auto; display:block;">

        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php elseif ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" onsubmit="return validateForm();">
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario">

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">

            <button type="submit" name="login" class="button">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
