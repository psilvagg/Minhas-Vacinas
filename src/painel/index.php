<?php
require '../backend/scripts/auth.php';
VefNoLogin();
CreateSessions($pdo);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../../assets/img/img-web.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Vacinas - Painel</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="../../index.html">
                    <img src="../../assets/img/logo-head.png" alt="Logo Vacinas" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="sidebarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <section>
        <div>
            <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
                <div class="d-flex align-items-center justify-content-center" style="height: 10vh;">
                </div>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link active" aria-current="page">
                            <i class="bi bi-house-door"></i>
                            Início
                        </a>
                    </li>
                    <li>
                        <a href="vaccines/index.html" class="nav-link text-white">
                            <i class="fas fa-syringe"></i>
                            Vacinas
                        </a>
                    </li>
                    <li>
                        <a href="/src/campaigns/index.html" class="nav-link text-white">
                            <i class="fas fa-bullhorn"></i>
                            Campanhas
                        </a>
                    </li>
                    <li>
                        <a href="profile/index.php" class="nav-link text-white">
                            <i class="bi bi-person"></i>
                            Perfil
                        </a>
                    </li>
                    <li>
                        <hr>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="Foto do Usuário" class="rounded-circle me-2"
                            width="40" height="40">
                        <span><?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : 'Usuário'; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <!-- <li><a class="dropdown-item" href="">Novo projeto...</a></li>
                        <li><a class="dropdown-item" href="">Configurações</a></li> -->
                        <li><a class="dropdown-item" href="profile/index.html">Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/src/backend/scripts/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
    </section>

    <section class="side-bar">
        <div class="content">
            <h1>Painel</h1>
        </div>
        </div>
    </section>

    <!-- 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>