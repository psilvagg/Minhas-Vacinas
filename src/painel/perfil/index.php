<?php
session_start();
require '../../scripts/conn.php';
require '../../scripts/auth.php';

if (!isset($_SESSION['session_id'])) {
    header("Location: ../../auth/entrar/");
    exit();
} else {
    info_user($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../../../../assets/img/img-web.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Vacinas - Perfil</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top rounded-pill shadow"
            style="background-color: #007bff; z-index: 1100; width: 85%; left: 50%; transform: translateX(-50%); margin-top: 10px;">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="../../../assets/img/logo-head.png" alt="Logo Vacinas" style="height: 40px;">
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
                <div class="d-flex align-items-center justify-content-center" style="height: 10vh;"></div>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="../" class="nav-link text-white" aria-current="page">
                            <i class="bi bi-house-door"></i> Início
                        </a>
                    </li>
                    <li>
                        <a href="../vacinas/" class="nav-link text-white">
                            <i class="fas fa-syringe"></i> Vacinas
                        </a>
                    </li>
                    <li>
                        <a href="" onclick="alert('Indisponível')" class="nav-link text-white">
                            <i class="fas fa-bullhorn"></i> Campanhas
                        </a>
                    </li>
                    <li>
                        <a href="" onclick="Location.reload()" class="nav-link active" aria-current="page">
                            <i class="bi bi-person"></i> Conta
                        </a>
                    </li>
                    <li>
                        <hr>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/assets/img/bx-user.svg" alt="sua foto aqui" class="rounded-circle me-2"
                            width="40" height="40">
                        <span><?php echo isset($_SESSION['session_nome']) ? explode(' ', $_SESSION['session_nome'])[0] : 'Usuário'; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a href="" onclick="Location.reload()" class="nav-link active" aria-current="page"></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../scripts/sair.php">Sair</a></li>
                        <li><a class="dropdown-item" href="../../auth/excluir-conta/">Excluir Conta</a></li>
                    </ul>
                </div>
            </div>
            <div class="content flex-grow-1">
                <div class="container d-flex justify-content-start align-items-start mt-4" style="margin-left: -15px;">
                    <div class="card mb-4" style="width: 35rem;">
                        <div class="d-flex align-items-center p-3">
                            <img src="/assets/img/bx-user.svg" class="rounded-circle" alt="Foto do Usuário" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                            <div>
                                <h5 class="card-title" style="font-size: 1.25rem;"><?php echo isset($_SESSION['session_nome']) ? $_SESSION['session_nome'] : 'Nome do Usuário'; ?></h5>
                                <p class="card-text" style="font-size: 0.875rem;"><?php echo isset($_SESSION['session_email']) ? $_SESSION['session_email'] : 'email@exemplo.com'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section>
        <div class="content">
            <form id="form_perfil" class="form_perfil" action="../../../backend/update_register.php" method="post">
                <div class="col mb-3">
                    <div class="col">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" disabled
                            value="<?php echo isset($_SESSION['session_nome']) ? $_SESSION['session_nome'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control" id="email" name="email" disabled
                            value="<?php echo isset($_SESSION['session_email']) ? $_SESSION['session_email'] : ''; ?>">
                        <p style="color: #198754; font-size: 14px; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 5px; font-size: 12px;"></i> E-mail confirmado com sucesso!
                        </p>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="col">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" disabled
                            value="<?php echo isset($_SESSION['session_data_nascimento']) ? $_SESSION['session_data_nascimento'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="telefone" class="form-label">Telefone</label>
                        <div class="input-group">
                            <span class="input-group-text" id="telefone-addon">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg" alt="Brasil" style="width: 20px; height: 15px; margin-right: 5px;">
                                +55
                            </span>
                            <input type="text" class="form-control" id="telefone" name="telefone" disabled
                                aria-describedby="telefone-addon"
                                value="<?php echo isset($_SESSION['session_telefone']) ? $_SESSION['session_telefone'] : ''; ?>">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" disabled
                            value="<?php echo isset($_SESSION['session_cpf']) ? $_SESSION['session_cpf'] : ''; ?>"
                            <?php echo isset($_SESSION['session_cpf']) && !empty($_SESSION['session_cpf']) ? 'disabled' : ''; ?>>
                        <?php if (!empty($_SESSION['session_cpf'])): ?>
                            <p style="color: #198754; font-size: 14px; display: flex; align-items: center;">
                                <i class="fas fa-check-circle" style="margin-right: 5px; font-size: 12px;"></i> CPF válido!
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" disabled>
                            <option value="">Selecione um estado</option>
                            <option value="AC" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AC') ? 'selected' : ''; ?>>Acre</option>
                            <option value="AL" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AL') ? 'selected' : ''; ?>>Alagoas</option>
                            <option value="AP" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AP') ? 'selected' : ''; ?>>Amapá</option>
                            <option value="AM" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AM') ? 'selected' : ''; ?>>Amazonas</option>
                            <option value="BA" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'BA') ? 'selected' : ''; ?>>Bahia</option>
                            <option value="CE" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'CE') ? 'selected' : ''; ?>>Ceará</option>
                            <option value="DF" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'DF') ? 'selected' : ''; ?>>Distrito Federal</option>
                            <option value="ES" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'ES') ? 'selected' : ''; ?>>Espírito Santo</option>
                            <option value="GO" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'GO') ? 'selected' : ''; ?>>Goiás</option>
                            <option value="MA" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MA') ? 'selected' : ''; ?>>Maranhão</option>
                            <option value="MT" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MT') ? 'selected' : ''; ?>>Mato Grosso</option>
                            <option value="MS" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MS') ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
                            <option value="PA" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PA') ? 'selected' : ''; ?>>Pará</option>
                            <option value="PB" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PB') ? 'selected' : ''; ?>>Paraíba</option>
                            <option value="PR" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PR') ? 'selected' : ''; ?>>Paraná</option>
                            <option value="PE" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PE') ? 'selected' : ''; ?>>Pernambuco</option>
                            <option value="PI" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PI') ? 'selected' : ''; ?>>Piauí</option>
                            <option value="RJ" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
                            <option value="RN" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RN') ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                            <option value="RS" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RS') ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                            <option value="RO" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RO') ? 'selected' : ''; ?>>Rondônia</option>
                            <option value="RR" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RR') ? 'selected' : ''; ?>>Roraima</option>
                            <option value="SC" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'SC') ? 'selected' : ''; ?>>Santa Catarina</option>
                            <option value="SP" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'SP') ? 'selected' : ''; ?>>São Paulo</option>
                            <option value="SE" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'SE') ? 'selected' : ''; ?>>Sergipe</option>
                            <option value="TO" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'TO') ? 'selected' : ''; ?>>Tocantins</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="genero" class="form-label">Gênero</label>
                        <select class="form-select" id="genero" name="genero" disabled>
                            <option value="" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == '') ? 'selected' : ''; ?>>Não definido</option>
                            <option value="M" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                            <option value="F" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                            <option value="O" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" disabled
                            value="<?php echo isset($_SESSION['session_cidade']) ? $_SESSION['session_cidade'] : ''; ?>">
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                Atualizar Cadastro
            </button>
        </div>
    </section>

    <section>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" style="z-index: 1200;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Atualizar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-perfil" action="../backend/atualizar-dados.php" method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" autocomplete="off"
                                        value="<?php echo isset($_SESSION['session_nome']) ? $_SESSION['session_nome'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="col">
                                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" autocomplete="off"
                                        value="<?php echo isset($_SESSION['session_data_nascimento']) ? $_SESSION['session_data_nascimento'] : ''; ?>">
                                </div>
                                <div class="col">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="telefone-addon">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg" alt="Brasil" style="width: 20px; height: 15px; margin-right: 5px;">
                                            +55
                                        </span>
                                        <input type="text" class="form-control" id="telefone" name="telefone" autocomplete="off"
                                            aria-describedby="telefone-addon"
                                            value="<?php echo isset($_SESSION['session_telefone']) ? $_SESSION['session_telefone'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <?php if (empty($_SESSION['session_cpf'])): ?>
                                <div class="mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" autocomplete="off">
                                    <small class="form-text text-muted" style="color: red;">O CPF pode ser preenchido uma única vez e não poderá ser alterado.</small>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <div class="col">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" id="estado" name="estado">
                                        <option value="">Selecione um estado</option>
                                        <option value="AC" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AC') ? 'selected' : ''; ?>>Acre</option>
                                        <option value="AL" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AL') ? 'selected' : ''; ?>>Alagoas</option>
                                        <option value="AP" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AP') ? 'selected' : ''; ?>>Amapá</option>
                                        <option value="AM" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'AM') ? 'selected' : ''; ?>>Amazonas</option>
                                        <option value="BA" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'BA') ? 'selected' : ''; ?>>Bahia</option>
                                        <option value="CE" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'CE') ? 'selected' : ''; ?>>Ceará</option>
                                        <option value="DF" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'DF') ? 'selected' : ''; ?>>Distrito Federal</option>
                                        <option value="ES" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'ES') ? 'selected' : ''; ?>>Espírito Santo</option>
                                        <option value="GO" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'GO') ? 'selected' : ''; ?>>Goiás</option>
                                        <option value="MA" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MA') ? 'selected' : ''; ?>>Maranhão</option>
                                        <option value="MT" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MT') ? 'selected' : ''; ?>>Mato Grosso</option>
                                        <option value="MS" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MS') ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                                        <option value="MG" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
                                        <option value="PA" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PA') ? 'selected' : ''; ?>>Pará</option>
                                        <option value="PB" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PB') ? 'selected' : ''; ?>>Paraíba</option>
                                        <option value="PR" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PR') ? 'selected' : ''; ?>>Paraná</option>
                                        <option value="PE" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PE') ? 'selected' : ''; ?>>Pernambuco</option>
                                        <option value="PI" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'PI') ? 'selected' : ''; ?>>Piauí</option>
                                        <option value="RJ" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
                                        <option value="RN" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RN') ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                                        <option value="RS" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RS') ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                                        <option value="RO" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RO') ? 'selected' : ''; ?>>Rondônia</option>
                                        <option value="RR" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'RR') ? 'selected' : ''; ?>>Roraima</option>
                                        <option value="SC" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'SC') ? 'selected' : ''; ?>>Santa Catarina</option>
                                        <option value="SP" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'SP') ? 'selected' : ''; ?>>São Paulo</option>
                                        <option value="SE" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'SE') ? 'selected' : ''; ?>>Sergipe</option>
                                        <option value="TO" <?php echo (isset($_SESSION['session_estado']) && $_SESSION['session_estado'] == 'TO') ? 'selected' : ''; ?>>Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="genero" class="form-label">Gênero</label>
                                    <select class="form-select" id="genero" name="genero">
                                        <option value="<?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == '') ? 'selected' : ''; ?>">Selecione um gênero</option>
                                        <option value="M" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                                        <option value="F" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                                        <option value="O" <?php echo (isset($_SESSION['session_genero']) && $_SESSION['session_genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" autocomplete="off"
                                        value="<?php echo isset($_SESSION['session_cidade']) ? $_SESSION['session_cidade'] : ''; ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Atualizar perfil</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="script.js"></script>
    <script>

    </script>
</body>

</html>