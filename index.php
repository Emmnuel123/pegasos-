<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Colores personalizados */
        .custom-bg-green {
            background-color: #52904c; /* #52904c (verde) */
        }

        .custom-bg-yellow {
            background-color: #f7ee3b; /* #f7ee3b (amarillo) */
        }

        .custom-bg-dark {
            background-color: #16333d; /* #16333d (oscuro) */
        }

        .btn-custom-yellow {
            background-color: #f7ee3b;
            color: #16333d;
            border: none;
        }

        .btn-custom-green {
            background-color: #52904c;
            color: white;
            border: none;
        }

        .section-title {
            color: #16333d;
        }

        .highlight-text {
            color: #f7ee3b;
        }

        .img-thumbnail {
            max-height: 300px;
            object-fit: cover;
        }

        .about-section {
            background-color: #f7ee3b;
            padding: 60px 0;
        }

        .about-image {
            max-height: 400px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Navbar (Header) -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-bg-green">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="pega.png" alt="Logo" class="me-2 rounded-circle" width="60" height="60">
                Mi Página
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Sesión iniciada: <?php echo $_SESSION['email']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">Cerrar sesión</a>
                    </li>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="admin.php">Panel de Administración</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="usuario.php">Perfil de Usuario</a>
                        </li>
                    <?php endif; ?>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="login.php">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="registro.php">Registrar</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección de bienvenida -->
    <section id="inicio" class="custom  text-white py-5">
        <div class="container text-center">
            <h1 class="mb-4 section-title">Bienvenido a Nuestra Página</h1>
            <p class="lead">Explora nuestros contenidos exclusivos según tu rol.</p>
            <a href="https://www.transportes-pegaso.com/" class="btn btn-custom-yellow">Descubrir más</a>

        </div>
    </section>

    <!-- Sección de Acerca de Nosotros -->
    <section class="">
        <div class="container text-center">
            <h2 class="section-title mb-4">Acerca de Nosotros</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="HELI.jpg" alt="Imagen de la empresa" class="img-fluid about-image rounded-3 shadow-lg">
                </div>
                <div class="col-md-6">
                    <h4 class="-text mb-3">Nuestra Historia</h4>
                    <p>

                    Más de 40 años de experiencia nos respaldan

Transportes Pegaso, una historia de éxito en el mundo de la aviación. Desde nuestros inicios, nos hemos destacado como líderes en servicios de vuelos costa afuera a plataformas petroleras, transporte ejecutivo, vuelos chárter de carga y ambulancia aérea.

Nuestra empresa nació con el objetivo de ofrecer soluciones de viaje de negocios y vuelos privados de calidad. A lo largo de los años, hemos invertido en una flota de aeronaves de última generación, equipadas con la más alta tecnología, para garantizar a nuestros clientes una experiencia de vuelo segura y eficiente.

En Transportes Pegaso, nos enorgullece haber sido la elección preferida de numerosas empresas para sus viajes de negocios. Nuestra dedicación a la excelencia en los vuelos chárter y la satisfacción del cliente nos ha posicionado como líderes indiscutibles en la industria de la aviación.

Confía en nosotros para tus necesidades de transporte aéreo, ya sea un viaje de negocios o un vuelo privado. Nuestra historia es una de innovación, calidad y compromiso inquebrantable con la seguridad. Descubre por qué somos la opción número uno en el mundo de la aviación.
.
                    </p>
                    <p>
                        Nuestro equipo de trabajo está altamente capacitado y enfocado en ofrecer soluciones innovadoras para satisfacer todas tus necesidades. ¡Únete a nosotros y descubre la diferencia!
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <br>

    <!-- Footer -->
    <footer class="custom-bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2024 Mi Página. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
