<?php
session_start();
if (isset($_SESSION['session_id'])) {
    header("Location: ../../painel/");
    exit();
}

$repoOwner = 'psilvagg';
$repoName = 'app-minhas-vacinas';
$token = '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';

$url = "https://api.github.com/repos/$repoOwner/$repoName/releases/latest";

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'User-Agent: MinhasVacinas-App',
    "Authorization: Bearer $token"
]);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($httpCode === 200 && $response) {
    $data = json_decode($response, true);
    $latestVersion = $data['tag_name'] ?? 'Versão não encontrada';
} elseif ($httpCode === 401) {
    $latestVersion = 'Erro: Não autorizado. Verifique o token.';
} elseif ($httpCode === 404) {
    $latestVersion = 'Erro: Repositório não encontrado.';
} else {
    $latestVersion = 'Erro ao buscar versão';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/assets/img/img-web.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Confirmação de Cadastro</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #007bff; z-index: 1081; width: 100%; left: 50%; transform: translateX(-50%);">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/assets/img/logo-head.png" alt="Logo Vacinas" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-download"></i> Baixe o App
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="https://github.com/psilvagg/app-minhas-vacinas/releases/latest" target="_blank">
                                        <i class="bi bi-github"></i> Release no GitHub
                                        <span class="badge bg-warning text-dark ms-2"><?php echo htmlspecialchars($latestVersion); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <?php if (isset($_SESSION['session_id'])): ?>
                            <li class="nav-item">
                                <a class="btn btn-primary rounded-pill px-4 py-2 text-white transition-transform transform-hover" href="../../painel/">
                                    <i class="bi bi-arrow-return-left"></i> Voltar à sua conta
                                </a>
                            </li>
                            <li class="nav-item" style="margin-left: 10px;">
                                <a class="btn btn-primary rounded-pill px-4 py-2 text-white transition-transform transform-hover" href="../../scripts/sair.php">
                                    <i class="bi bi-box-arrow-left"></i>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item me-3">
                                <a class="btn btn-light text-primary rounded-pill px-4 py-2 transition-transform transform-hover" href="../cadastro/">
                                    <i class="bi bi-person-plus"></i> CADASTRE-SE
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary rounded-pill px-4 py-2 text-white transition-transform transform-hover" href="../entrar/">
                                    <i class="bi bi-box-arrow-in-right"></i> ENTRAR
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="pt-5 pb-5">
        <div class="container mt-5">
            <h4 class="mb-4 text-center" style="margin-top: 10%;">Confirme seu cadastro</h4>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5" style="background-color: #f8f9fa;">
                            <form action="../backend/confirmar-cadastro.php" class="needs-validation" id="form-conf-cad" method="post" novalidate>
                                <p class="text-muted text-center mb-4">
                                    <i class="fas fa-envelope"></i> Um código de 6 dígitos foi enviado para o seu e-mail. Verifique sua caixa de entrada para confirmar seu cadastro.
                                </p>
                                <div class="mb-3">
                                    <label for="codigo" class="form-label text-dark">Código</label>
                                    <input type="text" class="form-control rounded-pill" id="codigo" name="codigo" required autocomplete="off">
                                </div>
                                <button class="btn btn-dark w-100 py-2 rounded-pill d-flex align-items-center justify-content-center" type="submit" id="submitBtn">
                                    <i class="bi bi-check-circle me-2"></i> CONFIRMAR CADASTRO
                                    <span class="spinner-border spinner-border-sm text-light" id="loadingSpinner" role="status" aria-hidden="true" style="display: none; margin-left: 10px; border-width: 3px;"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#emailModal" class="text-primary" style="text-decoration: none;">
                            <i class="bi bi-arrow-clockwise me-2"></i>Reenviar e-mail de confirmação
                        </a>
                    </div>
                    <hr class="custom-hr">
                    <div class="text-center mt-3">
                        <p class="mb-1 text-dark">Ainda não tem uma conta?</p>
                        <a href="../cadastro/" class="text-primary" style="text-decoration: none;">
                            <i class="bi bi-person-plus me-2"></i>Faça seu registro aqui
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true" style="z-index: 1900;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailModalLabel">Reenviar e-mail de confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Um novo código de 6 dígitos será enviado para o seu e-mail. Verifique sua caixa de entrada, a lixeira e o spam.</p>
                        <div id="alerta" class="alert" style="display: none;"></div>
                        <form action="../backend/reenviar-email.php" id="form-reenviar-email" method="post" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="off">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" id="reenviarBtn">
                                    <span id="reenviarText">Reenviar</span>
                                    <span class="spinner-border spinner-border-sm" id="loadingSpinner" style="display:none;" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
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
                        <a href="../../../docs/Politica-de-Privacidade.php"
                            style="text-decoration: none; color: #adb5bd;" class="text-reset">Política de
                            Privacidade</a>
                    </p>
                    <p>
                        <a href="../../../docs/Termos-de-Servico.php" style="text-decoration: none; color: #adb5bd;"
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="reenviar-emai.js"></script>
    <script src="../../../block.js"></script>
</body>

</html>