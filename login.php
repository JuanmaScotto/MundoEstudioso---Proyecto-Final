<?php
// Include database connection
$servername = "localhost";
$dbname = "registration";  // Your database name
$username = "root";   // Default XAMPP username
$password = "";       // Default XAMPP password (empty)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = '';  // Variable para el mensaje de error

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are not empty
    if (empty($username) || empty($password)) {
        $error_message = "Por favor complete todos los campos.";
    } else {
        // Prepare SQL query to fetch user
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Start a session and set user details (successful login)
                session_start();
                $_SESSION['username'] = $user['username'];
                header("Location: index.html"); // Redirect to a welcome or dashboard page
                exit();
            } else {
                $error_message = "Usuario y/o contraseña incorrectos.";
            }
        } else {
            $error_message = "Usuario y/o contraseña incorrectos.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>Estudiantil Sanducero</title>
</head>
<div class="contenedor-header">
        <header>
            <h1><span class="txtAmarillo">Mundo</span><span class="txtRojo">Estudioso</span></h1>
            <nav id="nav">
                <a href="index.html" onclick="seleccionar()" data-translate="inicio">Inicio</a>
                <a href="nosotros.html" onclick="seleccionar()" data-translate="nosotros">Nosotros</a>
                <a href="servicios.html" onclick="seleccionar()" data-translate="historia">Historia</a>
                <a href="comodidades.html" onclick="seleccionar()" data-translate="juveniles">Juveniles</a>
                <a href="galeria.html" onclick="seleccionar()" data-translate="galeria">Galería</a>
                <div class="dropdown">
                    <a href="equipo.html" onclick="seleccionar()" data-translate="planteles">Planteles</a>
                    <div class="dropdown-content">
                        <a href="equipo.html#primera" data-translate="primera">Primera</a>
                        <a href="equipo.html#sub18" data-translate="sub18">Sub-18</a>
                        <a href="equipo.html#sub16" data-translate="sub16">Sub-16</a>
                    </div>
                </div>
            </nav>

            <button id="btnIdioma" onclick="cambiarIdioma()">
                <i class="fa-solid fa-globe"></i>
            </button>

            <div class="redes">
                <a href="https://www.facebook.com/estudiantilsfc/?locale=es_LA" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://x.com/estudiantilsfc" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.instagram.com/estudiantilsanducerofc/" target="_blank"><i class="fa-brands fa-square-instagram"></i></a>
            </div>

            <div id="icono-nav" class="nav-responsive" onclick="mostrarOcultarMenu()">
                <i class="fa-solid fa-bars" id="icono-menu"></i>
            </div>
            <img src="img/logo-pagina web-Estudiantil.png" width="80px" height="80px">
            <nav>
                <div class="dropdown">
                    <a href="#" class="login-link">
                        <img class="login-img" src="img/login-removebg-preview.png" width="60" height="60" alt="Login">
                    </a>
                    <div class="dropdown-content">
                        <a href="login.html" data-translate="login">Login</a>
                        <a href="signup.html" data-translate="signup">Signup</a>
                    </div>
                </div>
            </nav>
        </header>
    </div>
<body>
    <section id="inicio" class="inicio">
        <div class="contenido-seccion">
            <div class="login-container">
                <h1>Iniciar Sesión</h1>
                <form id="formValidation" action="login.php" method="POST">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Entrar</button>
                </form>

                <!-- Mostrar mensaje de error -->
                <?php if (!empty($error_message)): ?>
                    <p class="error-message" style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <a href="signup.html">No tienes una cuenta? Registrate</a>
            </div>
        </div>
    </section>
</body>
</html>