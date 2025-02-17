<?php
session_start();
require_once '../../scripts/User-Auth.php';
require_once '../../scripts/conn.php';

Auth($pdo);
Gerar_Session($pdo);

$sql = $pdo->prepare("SELECT * FROM dispositivos WHERE id_usuario = :id_usuario AND confirmado = 1");
$sql->bindValue(':id_usuario', $_SESSION['user_id']);
$sql->execute();

$dispositivos = $sql->fetchAll(PDO::FETCH_ASSOC);

if (count($dispositivos) > 0) {
    $_SESSION['dispositivos'] = $dispositivos;
} else {
    $_SESSION['dispositivos'] = [];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Minhas Vacinas - Seus Dados</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top"
            style="background-color: #007bff; z-index: 1100; width: 100%; left: 50%; transform: translateX(-50%);">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="../../../assets/img/logo-head.png" alt="Logo Vacinas" style="height: 50px;">
                </a>
                <button class="navbar-toggler" id="sidebarToggle" type="button" data-bs-toggle="sidebar" data-bs-target="#sidebar" aria-controls="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav" style="padding-left: 90%;">
                    <!-- <ul class="navbar-nav">
                        <li style="margin-left: 20px; margin-top: 2%;">
                            <div id="themeToggle" class="theme-toggle d-flex align-items-center" style="cursor: pointer;">
                                <i class="bi bi-sun" id="sunIcon" style="font-size: 1.2em;"></i>
                                <i class="bi bi-moon" id="moonIcon" style="font-size: 1.2em; display: none;"></i>
                            </div>
                        </li>
                    </ul> -->
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
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
                        <a class="nav-link active" aria-expanded="false">
                            <i class="bi bi-person"></i> Seus Dados
                        </a>
                    </li>
                    <hr>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="position-relative">
                            <img src="/assets/img/bx-user.svg" alt="Foto do Usuário" class="rounded-circle me-2" width="40" height="40">
                            <i class="fas fa-camera position-absolute bottom-0 end-0 text-white" style="font-size: 18px; opacity: 0; transition: opacity 0.3s;"></i>
                        </div>
                        <span>Olá, <?php echo isset($_SESSION['user_nome']) ? explode(' ', $_SESSION['user_nome'])[0] : 'Usuário'; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../../scripts/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item text-danger" href="" data-bs-toggle="modal" data-bs-target="#excluir-conta"><i class="fas fa-trash-alt"></i> Excluir conta</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Perfil -->
    <section class="profile-section py-5" id="perfil">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-gradient text-white text-center py-3" style="background-color: #343a40;">
                            <h4 class="mb-0">Dados do Usuário</h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="form_perfil" action="../../../backend/update_register.php" method="post" enctype="multipart/form-data">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" disabled
                                            value="<?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : ''; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">E-Mail</label>
                                        <input type="email" class="form-control" id="email" name="email" disabled
                                            value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'E-mail'; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../../assets/img/num-img-br.png" alt="BR" style="width: 20px; height: 15px;"> +55
                                            </span>
                                            <input type="text" class="form-control" id="telefone" name="telefone" disabled autocomplete="off" value="<?php echo isset($_SESSION['user_telefone']) ? $_SESSION['user_telefone'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" disabled
                                            value="<?php echo isset($_SESSION['user_cpf']) ? explode('.', $_SESSION['user_cpf'])[0] . '.***.***-**' : '***.***.***-**'; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" disabled
                                            value="<?php echo isset($_SESSION['user_nascimento']) ? $_SESSION['user_nascimento'] : ''; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="genero" class="form-label">Gênero</label>
                                        <select class="form-control" id="genero" name="genero" disabled>
                                            <option value="Não Informado" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Não Informado') ? 'selected' : ''; ?>>Não Informado</option>
                                            <option value="Masculino" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                            <option value="Feminino" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                                            <option value="Outro" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Outro') ? 'selected' : ''; ?>>Outro</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="estado" class="form-label">Estado</label>
                                        <input type="text" class="form-control" id="state" name="state" disabled
                                            value="<?php echo isset($_SESSION['user_estado']) ? $_SESSION['user_estado'] : ''; ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" id="capital" name="capital" disabled
                                            value="<?php echo isset($_SESSION['user_cidade']) ? $_SESSION['user_cidade'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-dark rounded w-35 py-2" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="bi bi-pencil-square"></i> EDITAR INFORMAÇÕES
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <!-- Dispositivos -->
    <section class="profile-section py-5" style="background-color: #f4f4f4;" id="dispositivos">
        <div class="container">
            <h2 class="text-center mb-5 text-dark">Dispositivos Conectados</h2>
            <div class="row justify-content-center g-4">
                <?php
                $user_ip = $_SESSION['user_ip'];
                if (count($dispositivos) > 0):
                    foreach ($dispositivos as $dispositivo):
                        $atual = $dispositivo['ip'] === $user_ip;
                        $icone = $dispositivo['tipo_dispositivo'] === 'Desktop' || $atual
                            ? 'bi bi-pc-display'
                            : ($dispositivo['tipo_dispositivo'] === 'Mobile'
                                ? 'bi bi-phone'
                                : ($dispositivo['tipo_dispositivo'] === 'Tablet'
                                    ? 'bi bi-tablet'
                                    : 'bi bi-device-hdd'));
                        $local = trim(implode(', ', array_filter([$dispositivo['cidade'], $dispositivo['estado'], $dispositivo['pais']]))); ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card border-0 shadow-sm" style="background-color: #ffffff;">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="<?php echo $icone; ?>" style="font-size: 2.5rem; color: #007bff;"></i>
                                    </div>
                                    <h5 class="card-title text-dark">
                                        <?php echo $dispositivo['nome_dispositivo']; ?>
                                        <?php if ($atual): ?>
                                            <span class="badge bg-success ms-2">Atual</span>
                                        <?php endif; ?>
                                    </h5>
                                    <p class="text-muted mb-2">
                                        <strong>Último login:</strong> <?php echo date("d/m/Y H:i", strtotime($dispositivo['data_cadastro'])); ?>
                                    </p>
                                    <p class="text-muted mb-2">
                                        <strong>IP:</strong> <?php echo $dispositivo['ip']; ?>
                                    </p>
                                    <?php if (!empty($local)): ?>
                                        <p class="text-muted mb-2">
                                            <strong>Local:</strong> <?php echo $local; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer bg-light text-center">
                                    <form action="../backend/remover-dispositivo.php" id="form-remover-dispositivo" method="POST">
                                        <input type="hidden" name="dispositivo_id" value="<?php echo $dispositivo['id']; ?>" />
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted fs-5">Nenhum dispositivo encontrado</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Modal de atualização do Perfil -->
    <section>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" style="z-index: 1200;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content shadow-lg rounded-4">
                    <div class="modal-header bg-white text-white">
                        <h5 class="modal-title" style="color: #212529;" id="updateModalLabel">Seus Dados</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="mb-4">Se deseja atualizar seu e-mail <a href="#" class="fw-bold text-primary" data-bs-toggle="modal" data-bs-target="#alterar-email">clique aqui</a> ou sua senha <a href="../../auth/esqueceu-senha/" class="fw-bold text-primary">clique aqui</a>.</p>
                        <form id="form-perfil" action="../backend/atualizar-dados.php" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" value="<?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" autocomplete="off" value="<?php echo !empty($_SESSION['user_nascimento']) ? $_SESSION['user_nascimento'] : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="../../../assets/img/num-img-br.png" alt="BR" style="width: 20px; height: 15px;"> +55
                                        </span>
                                        <input type="text" class="form-control" id="telefone" name="telefone" autocomplete="off" value="<?php echo isset($_SESSION['user_telefone']) ? $_SESSION['user_telefone'] : ''; ?>">
                                    </div>
                                </div>
                                <?php if (empty($_SESSION['user_cpf'])): ?>
                                    <div class="col-md-6">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" autocomplete="off">
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-6">
                                    <label for="genero" class="form-label">Gênero</label>
                                    <select class="form-select" id="genero" name="genero">
                                        <option value="Não Informado" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Não Informado') ? 'selected' : ''; ?>>Não Informado</option>
                                        <option value="Masculino" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                        <option value="Feminino" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                                        <option value="Outro" <?php echo (isset($_SESSION['user_genero']) && $_SESSION['user_genero'] === 'Outro') ? 'selected' : ''; ?>>Outro</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select" id="estado" name="estado">
                                        <option value="" disabled selected>Selecione um estado</option>
                                        <option value="AC" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'AC') ? 'selected' : ''; ?>>Acre</option>
                                        <option value="AL" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'AL') ? 'selected' : ''; ?>>Alagoas</option>
                                        <option value="AP" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'AP') ? 'selected' : ''; ?>>Amapá</option>
                                        <option value="AM" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'AM') ? 'selected' : ''; ?>>Amazonas</option>
                                        <option value="BA" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'BA') ? 'selected' : ''; ?>>Bahia</option>
                                        <option value="CE" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'CE') ? 'selected' : ''; ?>>Ceará</option>
                                        <option value="DF" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'DF') ? 'selected' : ''; ?>>Distrito Federal</option>
                                        <option value="ES" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'ES') ? 'selected' : ''; ?>>Espírito Santo</option>
                                        <option value="GO" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'GO') ? 'selected' : ''; ?>>Goiás</option>
                                        <option value="MA" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'MA') ? 'selected' : ''; ?>>Maranhão</option>
                                        <option value="MT" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'MT') ? 'selected' : ''; ?>>Mato Grosso</option>
                                        <option value="MS" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'MS') ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                                        <option value="MG" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
                                        <option value="PA" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'PA') ? 'selected' : ''; ?>>Pará</option>
                                        <option value="PB" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'PB') ? 'selected' : ''; ?>>Paraíba</option>
                                        <option value="PR" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'PR') ? 'selected' : ''; ?>>Paraná</option>
                                        <option value="PE" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'PE') ? 'selected' : ''; ?>>Pernambuco</option>
                                        <option value="PI" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'PI') ? 'selected' : ''; ?>>Piauí</option>
                                        <option value="RJ" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
                                        <option value="RN" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'RN') ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                                        <option value="RS" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'RS') ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                                        <option value="RO" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'RO') ? 'selected' : ''; ?>>Rondônia</option>
                                        <option value="RR" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'RR') ? 'selected' : ''; ?>>Roraima</option>
                                        <option value="SC" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'SC') ? 'selected' : ''; ?>>Santa Catarina</option>
                                        <option value="SP" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'SP') ? 'selected' : ''; ?>>São Paulo</option>
                                        <option value="SE" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'SE') ? 'selected' : ''; ?>>Sergipe</option>
                                        <option value="TO" <?php echo (isset($_SESSION['user_estado']) && $_SESSION['user_estado'] == 'TO') ? 'selected' : ''; ?>>Tocantins</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Cidade" class="form-label">Cidade</label>
                                    <div class="d-flex">
                                        <select class="form-select" id="cidade" name="cidade">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-dark">SALVAR INFORMAÇÕES</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de atualização do e-mail -->
    <section>
        <div class="modal fade" id="alterar-email" tabindex="-1" aria-labelledby="alterar-email" aria-hidden="true" style="z-index: 1200;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alterar-email">Alterar e-mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Um e-mail com um código será enviado para o e-mail abaixo. Verifique sua caixa de entrada para confirmar seu e-mail.
                        </p>
                        <form id="form-alterar-email" action="../backend/alterar-email.php" method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer custom-footer">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmar-codigo-alterar-email">Já tenho um código</button>
                                <button type="submit" class="btn btn-secondary">Enviar código</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmar-codigo-alterar-email" tabindex="-1" aria-labelledby="confirmar-codigo-alterar-email" aria-hidden="true" style="z-index: 1200;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmar-codigo-alterar-email">Confirmar Alteração de E-mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Verifique sua caixa de entrada e insira o código de confirmação que enviamos para o novo e-mail.</p>
                        <form id="form-confirmar-codigo-alterar-email" action="../backend/confirmar-email.php" method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="codigo" class="form-label">Código de Confirmação</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer custom-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#alterar-email">Voltar</button>
                                <button type="submit" class="btn btn-primary">Confirmar Alteração</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de exclusão de conta -->
    <section>
        <div class="modal fade" id="excluir-conta" tabindex="-1" aria-labelledby="excluir-conta" aria-hidden="true" style="z-index: 1200;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="excluir-conta">Confirmar exclusão de conta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Um e-mail com um código será enviado para o e-mail abaixo. Verifique sua caixa de entrada para continuar com a exclusão da sua conta.</p>
                        <p class="text-warning fw-bold">Aviso: A exclusão da sua conta é permanente e não poderá ser desfeita. Certifique-se de que deseja prosseguir.</p>
                        <form id="form-excluir-conta" action="../backend/excluir-conta.php" method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer custom-footer">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmar-exclusao">Já tenho um código</button>
                                <button type="submit" class="btn btn-secondary">Enviar código</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmar-exclusao" tabindex="-1" aria-labelledby="confirmar-exclusao" aria-hidden="true" style="z-index: 1200;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmar-exclusao">Código de confirmação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Informe o código enviado para o seu e-mail para concluir a exclusão da conta.</p>
                        <p class="text-warning">Antes de prosseguir, considere os seguintes pontos:</p>
                        <ul class="text-warning">
                            <li>Você perderá permanentemente todos os seus dados armazenados, incluindo informações valiosas como seu histórico de vacinação.</li>
                            <li>Não será possível recuperar sua conta após a exclusão.</li>
                            <li>Se você está enfrentando dificuldades ou preocupações, estamos aqui para ajudar. Entre em contato com nosso suporte antes de tomar essa decisão.</li>
                        </ul>
                        <form id="form-confirmar-exclusao" action="../backend/confirmar-exclusao.php" method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="codigo" class="form-label">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off">
                                </div>
                            </div>
                            <p class="text-danger fw-bold text-center mt-3">Ao excluir sua conta, todos os seus dados serão permanentemente apagados e não poderão ser recuperados. Esta ação é irreversível.</p>
                            <div class="modal-footer custom-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Excluir conta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Modal Dispositivos -->
    <section>
        <div class="modal fade" id="dispositivosModal" tabindex="-1" aria-labelledby="dispositivosModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content rounded-4 shadow-lg">
                    <div class="modal-header bg-gradient p-3">
                        <h5 class="modal-title text-white" id="dispositivosModalLabel">
                            <i class="bi bi-laptop"></i> Dispositivos Logados
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush">
                            <?php
                            $user_ip = $_SESSION['user_ip'];
                            $desktop_atual = null;
                            if (count($dispositivos) > 0):
                                foreach ($dispositivos as $dispositivo):
                                    if ($dispositivo['tipo_dispositivo'] === 'desktop' && $dispositivo['ip'] === $user_ip) {
                                        $desktop_atual = $dispositivo['nome_dispositivo'];
                                        $classe_atual = 'bg-warning text-dark'; // Destaque para o desktop atual
                                    } else {
                                        $classe_atual = '';
                                    }
                                    switch ($dispositivo['tipo_dispositivo']) {
                                        case 'celular':
                                            $icone = 'bi-phone';
                                            break;
                                        case 'tablet':
                                            $icone = 'bi-tablet';
                                            break;
                                        case 'desktop':
                                            $icone = 'bi-pc-display';
                                            break;
                                        default:
                                            $icone = 'bi-device-hdd';
                                    }

                                    $local = trim(implode(', ', array_filter([$dispositivo['cidade'], $dispositivo['estado'], $dispositivo['pais']])));
                            ?>
                                    <li class="list-group-item d-flex flex-column flex-md-row align-items-start py-3 mb-3 shadow-sm rounded-3 <?php echo $classe_atual; ?>">
                                        <i class="bi <?php echo $icone; ?> me-3 text-primary" style="font-size: 1.5rem;"></i>
                                        <div class="flex-grow-1">
                                            <strong class="d-block mb-2 fs-5"><?php echo $dispositivo['nome_dispositivo']; ?></strong>
                                            <small class="text-muted d-block mb-1 fs-7">Último login: <?php echo date("d/m/Y H:i", strtotime($dispositivo['data_cadastro'])); ?></small>
                                            <p class="text-muted mb-0 fs-7"><strong>IP:</strong> <?php echo $dispositivo['ip']; ?></p>
                                            <?php if (!empty($local)): ?>
                                                <p class="text-muted mb-0 fs-7"><strong>Local:</strong> <?php echo $local; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <form action="../backend/remover-dispositivo.php" method="POST" id="form-remover-dispositivo" class="d-inline">
                                            <input type="hidden" name="dispositivo_id" value="<?php echo $dispositivo['id']; ?>" />
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-2" aria-label="Sair">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center">
                                    <p class="text-muted fs-5">Nenhum dispositivo encontrado</p>
                                </div>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button class="btn btn-secondary btn-sm w-100 w-sm-auto" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer style="background-color: #212529; color: #f8f9fa; padding-top: 10px; margin-top: 7%;">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script src="mudar-email.js"></script>
    <script src="confirmar-email.js"></script>
    <script src="excluir-conta.js"></script>
    <script src="confirmar-exclusao.js"></script>
    <script src="remover-dispositivo.js"></script>
    <script src="api-ibge.js"></script>
</body>

</html>