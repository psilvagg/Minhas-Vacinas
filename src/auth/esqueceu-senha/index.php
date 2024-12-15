<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/assets/img/img-web.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Minhas Vacinas - Recuperação de Senha</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top"
            style="background-color: #007bff; z-index: 1081; width: 100%; left: 50%; transform: translateX(-50%);">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo-head.png" alt="Logo Vacinas" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#nossa-missao">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" onclick="Swal.fire({
                                title: '🚧 O site está passando por modificações importantes!',
                                text: 'Algumas funcionalidades podem não estar disponíveis. Por favor, tente novamente mais tarde.',
                                icon: 'warning'
                            }); return false;" class="nav-link">Campanhas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../../ajuda/" class="nav-link">Suporte</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-outline-light" href="../cadastro/">CADASTRE-SE</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary btn-login" href="../entrar/">ENTRAR</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="position: fixed; top: 0; left: 0; z-index: 1100;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#nossa-missao">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" onclick="Swal.fire({
                        title: '🚧 O site está passando por modificações importantes!',
                        text: 'Algumas funcionalidades podem não estar disponíveis. Por favor, tente novamente mais tarde.',
                        icon: 'warning'
                    }); return false;" class="nav-link">Campanhas</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../ajuda/" class="nav-link">Suporte</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary w-100 mb-2" href="../cadastro/">CADASTRE-SE</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary w-100" href="../entrar/">ENTRAR</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <section class="form-log">
        <div class="container d-flex justify-content-center align-items-center full-height" style="margin-top: 70px;">
            <div class="row w-100">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <form action="../backend/esqueceu_senha.php" class="needs-validation bg-light p-5 rounded shadow-lg"
                        id="form_recovery" method="post" novalidate>
                        <h4 class="mb-4 text-center">Redefina sua senha</h4>
                        <div id="passwordHelpBlock" class="form-text">
                            Após o envio do formulário você receberá um e-mail com instruções para redefinir sua senha.
                        </div><br>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required name="email" autocomplete="off">
                            <div class="mt-2 text-end">
                                <a href="../entrar/" class="text-muted">
                                    <i class="bi bi-question-circle me-1"></i> Voltar para login?
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Enviar e-mail</button>
                    </form>
                    <hr class="custom-hr">
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
                        <a href="/assets/docs/Política-de-Privacidade.pdf" style="text-decoration: none; color: #adb5bd;"
                            class="text-reset">Política de Privacidade</a>
                    </p>
                    <p>
                        <a href="/assets/docs/Termos-de-Serviço.pdf" style="text-decoration: none; color: #adb5bd;"
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
            © 2024 Minhas Vacinas. Todos os direitos reservados.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
</body>

</html>