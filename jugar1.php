<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Jugar - GET_NUMBER</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<?php session_start(); ?>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center ">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                <h1 class="text-light"><a href="index.php"><span>GET_NUMBER</span></a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a class="active" href="jugar.php">Jugar</a></li>
                    <li><a href="clasificacion.php">Clasificación</a></li>
                    <li><a href="mensajes.php">Mensaje</a></li>
                    <li><a href="foro.php">Foro</a></li>
                    <li><a href="iniciar_sesion.php">Iniciar sesión</a></li>
                    <li><a href="registrarse.php">Registrarse</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= SUB BARRA ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Jugar</h2>
                </div>

            </div>
        </section><!-- FIN SUB BARRA -->

        <?php
            require_once('conexion_bd.php');

            $id_jugador = $_SESSION['id'];
            $username_jugador = $_SESSION['username'];

            $suma = 0;

            // if(isset($_POST['numDados']) && isset($_POST['numCaras']) && isset($_POST['numGanador']) && isset($_SESSION['id']) && isset($_SESSION['username'])){
                $numDados = $_POST['numDados'];
                $numCaras = $_POST['numCaras'];
                $numGanador = $_POST['numGanador'];
               
            for ($i=0; $i < $numDados ; $i++) { 
               $tirada = rand(1, $numCaras);
               $suma += $tirada;
            }
        
            if($suma == $numGanador) {
                    $victorias = 1;
                    $derrotas = 0;
            
            $sql = 'INSERT INTO partida (id_jugador, username_jugador, numDados, numCaras, numGanador, victorias, derrotas) values(?,?,?,?,?,?,?)';
            $sth1 = $dbh->prepare($sql);
            $resultado1 = $sth1->execute(array($id_jugador,$username_jugador,$numDados, $numCaras, $numGanador,$victorias,$derrotas));

        ?>
        <!-- ======= CONTENIDO INICIO SESIÓN ======= -->
        <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container align-items-center">
                <h4 class="text-left">Resultados de tu tirada: </h4>
                <div class="specialrow">
                    <div class="container mt-4">
                        <div class="alert alert-success" role="alert">
                            <p><b>¡Felicidades, has ganado!</b></p>
                        </div>
                    </div>
                    <div class="php-email-form">
                        <p>Tu número ganador: <?=$numGanador?></p>
                        <p>Número resultante de la tirada: <?=$suma?></p>
                        <p>Número de dados: <?=$numDados?></p>
                        <p>Número de caras de los dados: <?=$numCaras?></p>
                    </div>
                </div>
                <a href="./jugar.php" class="btn btn-outline-secondary">Volver a jugar</a>
            </div>
        </section>

        <?php } else { 
             $victorias = 0;
             $derrotas = 1;
            
             $sql = 'INSERT INTO partida (id_jugador, username_jugador, numDados, numCaras, numGanador, victorias, derrotas) values(?,?,?,?,?,?,?)';
             $sth2 = $dbh->prepare($sql);
             $resultado2 = $sth2->execute(array($id_jugador,$username_jugador,$numDados,$numCaras,$numGanador,$victorias,$derrotas));
            
            ?>

        <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container align-items-center">
                <h4 class="text-left">Resultados de la jugada: </h4>
                <div class="specialrow">
                    <div class="container mt-4">
                        <div class="alert alert-danger" role="alert">
                            <p><b>Lo siento, has perdido.</b></p>
                        </div>
                    </div>
                    <div class="php-email-form">
                        <p>Tu número ganador: <?=$numGanador?></p>
                        <p>Número resultante de la tirada: <?=$suma?></p>
                        <p>Número de dados: <?=$numDados?></p>
                        <p>Número de caras de los dados: <?=$numCaras?></p>
                    </div>
                </div>
                <a href="./jugar.php" class="btn btn-outline-secondary">Volver a jugar</a>
            </div>
        </section>
        <?php } ?>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Marco Martínez Arenas</span></strong>. All Rights Reserved
                <div class="social-links mt-3">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>