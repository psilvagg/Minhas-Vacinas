<?php
session_start();
if (isset($_SESSION['session_id'])) {
    header("Location: ../../painel/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../../../../public/assets/img/img-web.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <title>Minhas Vacinas - Cadastro</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/index.html">
                    <img src="../../../../public/assets/img/logo-head.png" alt="Logo Vacinas" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/index.html">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/index.html#nossa-missao">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../campaigns/index.html">Campanhas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../../../support/support.php" class="nav-link">
                                Suporte
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Baixe o App
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="">
                                        <img src="https://api.iconify.design/logos:apple-app-store.svg" alt="App Store"
                                            style="width: 20px; height: 20px;" class="me-2">
                                        App Store
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <img src="https://api.iconify.design/logos:google-play-icon.svg"
                                            alt="Google Play" style="width: 20px; height: 20px;" class="me-2">
                                        Google Play
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-light btn-login" href="https://auth.minhasvacinas.online/entrar">LOGIN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container d-flex justify-content-center align-items-center full-height" style="margin-top: 70px;">
            <div class="row w-100">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <form action="backend/cadastro.php" class="needs-validation bg-light p-5 rounded shadow-lg"
                        id="formcad" method="post" novalidate>
                        <h5 class="mb-4 text-center">Faça seu cadastro</h5><br>
                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome<span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" id="nome" name="nome" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail<span class="required-asterisk">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Crie sua senha<span class="required-asterisk">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="senha" name="senha" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Confirme sua senha<span class="required-asterisk">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confSenha" name="confSenha" required>
                                <button class="btn btn-outline-secondary" type="button" id="ConftogglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Selecione um estado<span class="required-asterisk">*</span></label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="">Selecione um estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                        <div class="cuteiner">
                            <div class="cf-turnstile" data-sitekey="0x4AAAAAAAzf0SlVhlpqfXSZ" data-callback="verificacaoConcluida"></div>
                        </div>
                        <button class="btn btn-success w-100" id="submitBtn" type="submit">CADASTRE-SE</button>
                    </form>
                    <hr class="custom-hr">
                    <div class="text-center mt-3">
                        <p class="mb-1">Já tem uma conta?</p>
                        <a href="https://auth.minhasvacinas.online/entrar" class="btn btn-primary">Entre na sua conta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">© 2024 Minhas Vacinas - Todos os direitos reservados</p>
            <a href="/public/assets/docs/Termos-de-Serviço.pdf" class="text-white">Termos de Serviço</a> |
            <a href="/public/assets\docs\Política-de-Privacidade.pdf" class="text-white">Política de Privacidade</a>
        </div>
    </footer>

    <!-- 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>