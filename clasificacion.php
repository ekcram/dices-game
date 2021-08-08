<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clasificación - GET_NUMBER</title>
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

<?php
        require_once('conexion_bd.php');

        //Consulta para ver los resultados de las partidas del usuario
        $sql = 'SELECT * FROM partida WHERE id_jugador=?';
        $sth = $dbh->prepare($sql);
        $sth->execute(array($_SESSION['id']));
        $resultado = $sth->fetchAll();

        // //Consulta para sacar el % de victorias 
        $sql = 'SELECT username_jugador as "jugador", 
                COUNT(*) as "partidas_totales", 
                ROUND((AVG(CAST(victorias AS FLOAT ))*100),2) as "porcentaje_victorias",
                ROUND((AVG(CAST(derrotas AS FLOAT ))*100),2) as "porcentaje_derrotas"
                FROM partida where id_jugador=?';
        $sth1 = $dbh->prepare($sql);
        $sth1->execute(array($_SESSION['id']));
        $resultado1 = $sth1->fetchAll();

?>

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
                    <li><a href="jugar.php">Jugar</a></li>
                    <li><a class="active" href="clasificacion.php">Clasificación</a></li>
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
                    <h2>Clasificación</h2>
                </div>

            </div>
        </section><!-- FIN SUB BARRA -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <h3 class="h3 text-left" style="background-color: rgb(225,242,421);">Historial de tus partidas:
                        </h3>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID partida</th>
                                    <th scope="col">Jugador</th>
                                    <th scope="col">Tu número ganador</th>
                                    <th scope="col">Nº de dados</th>
                                    <th scope="col">Nº de caras de los dados</th>
                                    <th scope="col">Victorias</th>
                                    <th scope="col">Derrotas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultado as $fila) { ?>
                                <tr>
                                    <td><?= $fila['id_partida']?></td>
                                    <td><?= $fila['username_jugador']?></td>
                                    <td><?= $fila['numGanador']?></td>
                                    <td><?= $fila['numDados']?></td>
                                    <td><?= $fila['numCaras']?></td>
                                    <td><?=$fila['victorias']?></td>
                                    <td><?=$fila['derrotas']?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                    <br><br>
                    <div class="row">
                        <h3 class="h3 text-left" style="background-color: rgb(225,242,421);">Nº de partidas y % de
                            victorias:</h3>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Jugador</th>
                                    <th scope="col">Partidas totales</th>
                                    <th scope="col">% de victorias</th>
                                    <th scope="col">% de derrotas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultado1 as $fila) { ?>
                                <tr>
                                    <td><?= $fila['jugador']?></td>
                                    <td><?= $fila['partidas_totales']?></td>
                                    <td><?= $fila['porcentaje_victorias']?>%</td>
                                    <td><?= $fila['porcentaje_derrotas']?>%</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </section>
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