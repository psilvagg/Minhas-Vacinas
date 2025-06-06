<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/assets/img/img-web.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Minhas Vacinas - Ajuda</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-secondary fixed-top" style="z-index: 1081; width: 100%; left: 50%; transform: translateX(-50%);">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo-head.png" alt="Logo Vacinas" style="height: 50px;">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#nossa-missao">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link">Suporte</a></li>
                        <li class="nav-item"><a href="FAQ/" class="nav-link">FAQ</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle btn btn-primary rounded-pill px-4 py-2 text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person text-dark"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="../painel/"><i class="bi bi-house-door text-dark me-2"></i>Painel</a></li>
                                    <li><a class="dropdown-item" href="../painel/vacinas/"><i class="bi bi-heart-pulse-fill text-dark me-2"></i>Vacinas</a></li>
                                    <li><a class="dropdown-item" href="../painel/perfil/"><i class="bi bi-person-circle text-dark me-2"></i>Perfil</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item me-3">
                                <a class="btn btn-light text-primary rounded-pill px-4 py-2" href="../auth/cadastro/">
                                    <i class="bi bi-person-plus"></i> CADASTRE-SE
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary rounded-pill px-4 py-2 text-white" href="../auth/entrar/">
                                    <i class="bi bi-box-arrow-in-right"></i> ENTRAR
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 75%; background: rgba(255, 255, 255, 0.95);">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between" style="height: 100%;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/" style="font-weight: 500;">
                            <i class="bi bi-house-door text-dark me-2"></i>Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#nossa-missao" style="font-weight: 500;">
                            <i class="bi bi-info-circle text-dark me-2"></i>Sobre
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-dark" style="font-weight: 500;">
                            <i class="bi bi-question-circle text-dark me-2"></i>Suporte
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../FAQ/" class="nav-link text-dark" style="font-weight: 500;">
                            <i class="bi bi-file-earmark-text text-dark me-2"></i>FAQ
                        </a>
                    </li>
                </ul>
                <div class="d-flex flex-column align-items-center gap-3 mt-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a class="nav-link dropdown-toggle btn btn-outline-primary rounded-pill px-4 py-2 w-100 text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person text-dark"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../painel/"><i class="bi bi-house-door text-dark me-2"></i>Painel</a></li>
                            <li><a class="dropdown-item" href="../painel/vacinas/"><i class="bi bi-heart-pulse-fill text-dark me-2"></i>Vacinas</a></li>
                            <li><a class="dropdown-item" href="../painel/perfil/"><i class="bi bi-person-circle text-dark me-2"></i>Perfil</a></li>
                        </ul>
                    <?php else: ?>
                        <a class="btn btn-secondary text-white rounded-pill px-4 py-2 w-100 text-center" href="../auth/cadastro/">
                            <i class="bi bi-person-plus"></i> CADASTRE-SE
                        </a>
                        <a class="btn btn-primary rounded-pill px-4 py-2 text-white w-100 text-center" href="../auth/entrar/">
                            <i class="bi bi-box-arrow-in-right"></i> ENTRAR
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <section class="pt-5 pb-5">
        <div class="container mt-5">
            <h4 class="mb-4 text-center">
                Entre em contato <i class="bi bi-chat-dots me-2"></i>
            </h4>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5" style="background-color: #f8f9fa;">
                            <form id="form_suporte" class="needs-validation" novalidate action="backend/suporte.php" method="post">
                                <div class="mb-4">
                                    <label for="suporte_nome" class="form-label">Nome<span class="required-asterisk">*</span></label>
                                    <input type="text" class="form-control" id="suporte_nome" autocomplete="off" name="suporte_nome" required>
                                </div>
                                <div class="mb-4">
                                    <label for="suporte_email" class="form-label">E-mail<span class="required-asterisk">*</span></label>
                                    <input type="email" class="form-control" id="suporte_email" autocomplete="off" name="suporte_email" required>
                                </div>
                                <div class="mb-4">
                                    <label for="motivo_contato" class="form-label">Motivo do Contato<span class="required-asterisk">*</span></label>
                                    <select class="form-select" name="motivo_contato" multiple aria-label="Multiple select example">
                                        <option value="Problema Técnico">Problema técnico</option>
                                        <option value="Dúvida">Dúvida</option>
                                        <option value="Sugestão">Sugestão</option>
                                        <option value="Reclamação">Reclamação</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="mensagem" class="form-label">Mensagem<span class="required-asterisk">*</span></label>
                                    <textarea class="form-control rounded" id="mensagem" name="mensagem" rows="4" placeholder="Escreva sua mensagem aqui..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <i class="bi bi-send"></i> ENVIAR
                                </button>
                            </form>
                            <div id="resposta-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer style="background-color: #212529; color: #f8f9fa; padding-top: 10px;">
        <div class="me-5 d-none d-lg-block"></div>
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="bi bi-gem me-2"></i>Minhas Vacinas
                    </h6>
                    <p>
                        <i class="bi bi-info-circle me-1"></i> Protegendo você e sua família com informações e
                        controle digital de vacinas.
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Serviços</h6>
                    <p>
                        <a href="/src/auth/cadastro/" style="text-decoration: none; color: #adb5bd;" class="text-reset">Cadastro</a>
                    </p>
                    <p>
                        <a href="/src/ajuda/" style="text-decoration: none; color: #adb5bd;" class="text-reset">Suporte</a>
                    </p>
                    <p>
                        <a href="/src/painel/" style="text-decoration: none; color: #adb5bd;" class="text-reset">Histórico</a>
                    </p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Links Úteis</h6>
                    <p>
                        <a href="../../docs/Politica-de-Privacidade.php"
                            style="text-decoration: none; color: #adb5bd;" class="text-reset">Política de
                            Privacidade</a>
                    </p>
                    <p>
                        <a href="../../docs/Termos-de-Servico.php" style="text-decoration: none; color: #adb5bd;"
                            class="text-reset">Termos de Serviço</a>
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Contato</h6>
                    <p><i class="bi bi-envelope me-2"></i>contato@minhasvacinas.online</p>
                </div>
            </div>
        </div>

        <div class="text-center p-4" style="background-color: #181a1b; color: #adb5bd;">
            © 2025 Minhas Vacinas. Todos os direitos reservados.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    <script src="../../../block.js"></script>
</body>

</html>