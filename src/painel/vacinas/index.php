<?php
require '../../scripts/conn.php';
require '../../scripts/auth.php';

session_start();
if (!isset($_SESSION['session_id'])) {
    header("Location: ../../auth/entrar/");
    exit();
} else {
    $id_usuario = $_SESSION['session_id'];
    $sql = $pdo->prepare("SELECT * FROM vacina WHERE id_usuario = :id_usuario");
    $sql->bindValue(':id_usuario', $id_usuario);
    $sql->execute();
    $vacinas = $sql->fetchAll(PDO::FETCH_ASSOC);

    if (count($vacinas) > 0) {
        $_SESSION['vacinas'] = $vacinas;
    } else {
        $_SESSION['vacinas'] = [];
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <title>Minhas Vacinas - Vacinas</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top"
            style="background-color: #007bff; z-index: 1081; width: 100%; left: 50%; transform: translateX(-50%);">
            <div class="container">
                <a class="navbar-brand" href="/index.html">
                    <img src="../../../assets/img/logo-head.png" alt="Logo Vacinas" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="sidebarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <section>
        <div class="wrapper">
            <aside class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
                <div class="d-flex align-items-center justify-content-center" style="height: 10vh;">
                </div>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="../" class="nav-link text-white" aria-current="page">
                            <i class="bi bi-house-door"></i>
                            Início
                        </a>
                    </li>
                    <li>
                        <a href="" onclick="Location.reload()" class="nav-link active" aria-current="page">
                            <i class="fas fa-syringe"></i>
                            Vacinas
                        </a>
                    </li>
                    <li>
                        <a href="" onclick="alert('Indisponível')" class="nav-link text-white">
                            <i class="fas fa-bullhorn"></i>
                            Campanhas
                        </a>
                    </li>
                    <li>
                        <a href="../perfil/" class="nav-link text-white">
                            <i class="bi bi-person"></i>
                            Conta
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
                        <img src="/assets/img/bx-user.svg" alt="Foto do Usuário" class="rounded-circle me-2"
                            width="40" height="40">
                        <span><?php echo isset($_SESSION['session_nome']) ? explode(' ', $_SESSION['session_nome'])[0] : 'Usuário'; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../perfil/"><i class="fas fa-user"></i> Minha conta</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../scripts/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    <div class="content">
        <section>
            <div class="esq mb-4">
                <h1>Vacinas</h1>
                <h3 class="fw-light">Registre e visualize as suas vacinas aplicadas.</h3>
                <p class="lead">Mantenha seu histórico de vacinação atualizado para garantir sua proteção e a de todos ao seu redor. Adicione as vacinas aplicadas e consulte facilmente todas as informações sobre cada dose.</p>
                <a type="button" class="btn btn-primary mt-3" href="cadastro-vacinas/">Registrar Doses</a>
                <button type="button" class="btn btn-success mt-3" title="Exportar todas as vacinas para um arquivo">
                    <i class="fas fa-file-export" style="font-size: 16px; padding-right: 0;"></i> Exportar Todas
                </button>
            </div>
            <div class="d-flex justify-content-start align-items-center mt-3">
                <span class="badge" style="background-color: #28a745; color: white; padding: 10px 15px; font-size: 16px; border-radius: 15px;">
                    <?= count($vacinas) ?> Vacinas Adicionadas
                </span>
            </div>
            <div class="vacinas-container d-flex flex-wrap gap-4 justify-content-center mt-4" id="vacinas-content">
                <?php if (count($vacinas) > 0): ?>
                    <?php foreach ($vacinas as $vacina): ?>
                        <div class="card shadow-lg" style="width: 350px; border-radius: 20px; background-color: rgba(255, 255, 255, 0.95); transition: all 0.3s ease; padding: 20px; display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                            <img src="../../../../assets/img/vac-card.jpg" class="card-img-top" alt="Vacina" style="object-fit: cover; height: 250px; width: 100%; border-radius: 20px 20px 0 0;">
                            <div class="card-body">
                                <h5 class="card-title text-center text-dark" style="font-weight: bold;"><?= htmlspecialchars($vacina['nome_vac'], ENT_QUOTES, 'UTF-8') ?></h5>
                                <div class="d-flex flex-column mt-3">
                                    <?php if (!empty($vacina['dose'])): ?>
                                        <p class="card-text"><i class="fas fa-syringe text-success"></i> <strong>Dose:</strong> <?= htmlspecialchars($vacina['dose'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($vacina['data_aplicacao'])): ?>
                                        <p class="card-text"><i class="fas fa-calendar-day text-info"></i> <strong>Data de Aplicação:</strong> <?= date('d/m/Y', strtotime($vacina['data_aplicacao'])) ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($vacina['local_aplicacao'])): ?>
                                        <p class="card-text"><i class="fas fa-map-marker-alt text-warning"></i> <strong>Local:</strong> <?= htmlspecialchars($vacina['local_aplicacao'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($vacina['lote'])): ?>
                                        <p class="card-text"><i class="fas fa-cogs text-secondary"></i> <strong>Lote:</strong> <?= htmlspecialchars($vacina['lote'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($vacina['obs'])): ?>
                                        <p class="card-text"><i class="fas fa-sticky-note text-dark"></i> <strong>Observações:</strong> <?= htmlspecialchars($vacina['obs'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <form action="../backend/excluir-vacina.php" method="POST" class="form-excluir-vacina mb-0">
                                    <input type="hidden" name="id_vac" value="<?= $vacina['id_vac'] ?>">
                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Excluir vacina" style="padding: 5px 10px;">
                                        <i class="fas fa-trash-alt" style="font-size: 16px; padding-right: 0;"></i>
                                    </button>
                                </form>
                                <a href="editar-vacina.php?id_vac=<?= $vacina['id_vac'] ?>" class="btn btn-secondary" data-toggle="tooltip" title="Editar vacina" style="border: none; background: #6c757d; padding: 5px 10px;">
                                    <i class="fas fa-edit" style="font-size: 16px; padding-right: 0;"></i>
                                </a>
                                <button type="button" class="btn btn-success" data-id="<?= $vacina['id_vac'] ?>" onclick="exportarVacina(this)">
                                    <i class="fas fa-share-alt" style="font-size: 16px; padding-right: 0;"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info w-100" role="alert">
                        <i class="fas fa-info-circle"></i> Nenhuma vacina registrada.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
</body>

</html>