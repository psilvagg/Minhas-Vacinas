<?php
session_start();
require '../../scripts/conn.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nome = ucwords(trim($dados['nome']));
$cpf_formatado = isset($dados['cpf']) ? trim($dados['cpf']) : ($_SESSION['session_cpf'] ?? null);
$cpf = preg_replace('/[^0-9]/', '', $cpf_formatado);
$data_nascimento = trim($dados['data_nascimento']);
$telefone = trim($dados['telefone']);
$estado = isset($dados['estado']) ? trim($dados['estado']) : 'N/A';
$genero = ($dados['genero']);
// $cidade = trim($dados['cidade']);

$imagem = $_FILES['foto_perfil']['tmp_name'] ?? null; // Captura o arquivo de imagem enviado

if ($imagem && is_uploaded_file($imagem)) {
    $foto_perfil = file_get_contents($imagem); // Converte a imagem para binário
} else {
    $foto_perfil = null; // Se não for enviado um arquivo, o campo será nulo
}

if (!empty($cpf)) {
    if (!validaCPF($cpf)) {
        $retorna = ['status' => false, 'msg' => 'O CPF informado é inválido. Por favor, verifique e tente novamente.'];
        header('Content-Type: application/json');
        echo json_encode($retorna);
        exit();
    }
}

if (empty($nome) && empty($cpf) && empty($data_nascimento) && empty($telefone) && empty($estado) && empty($genero)) {
    $retorna = ['status' => false, 'msg' => 'Preencha todos os campos.'];
    header('Content-Type: application/json');
    echo json_encode($retorna);
    exit();
}

if (!empty($data_nascimento)) {
    if (!validarData($data_nascimento)) {
        $retorna = ['status' => false, 'msg' => "Data inválida ou no futuro. A data precisa estar no formato 'DIA-MÊS-ANO' e não pode ser posterior ao dia de hoje."];
        header('Content-Type: application/json');
        echo json_encode($retorna);
        exit();
    }
} else {
    // Se a data de nascimento estiver vazia, definimos ela como NULL para o banco de dados
    $data_nascimento = null;
}

if (!empty($cpf_formatado)) {
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE cpf = :cpf");
    $sql->bindValue(':cpf', $cpf_formatado);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $retorna = ['status' => false, 'msg' => 'CPF já cadastrado.'];
        header('Content-Type: application/json');
        echo json_encode($retorna);
        exit();
    }
}

try {
    // Atualizar os dados no banco
    $sql = $pdo->prepare("UPDATE usuario SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, telefone = :telefone, estado = :estado, genero = :genero, foto_perfil = :foto_perfil WHERE id_usuario = :id");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':cpf', $cpf_formatado);
    $sql->bindValue(':data_nascimento', $data_nascimento, PDO::PARAM_STR); // Enviar como NULL se vazio
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':estado', $estado);
    $sql->bindValue(':genero', $genero);
    $sql->bindValue(':foto_perfil', $foto_perfil, PDO::PARAM_LOB);
    $sql->bindValue(':id', $_SESSION['session_id']);
    $sql->execute();

    $_SESSION['session_nome'] = $nome;
    $_SESSION['session_data_nascimento'] = $data_nascimento;
    $_SESSION['session_telefone'] = $telefone;
    $_SESSION['session_estado'] = $estado;
    $_SESSION['session_genero'] = $genero;

    $retorna = ['status' => true, 'msg' => "Alteração realizada com sucesso. Suas informações estão atualizadas."];
    header('Content-Type: application/json');
    echo json_encode($retorna);
    exit();
} catch (PDOException $e) {
    $retorna = ['status' => false, 'msg' => "Erro: " . $e->getMessage()];
    header('Content-Type: application/json');
    echo json_encode($retorna);
    exit();
}

function validaCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) {
            return false;
        }
    }

    return true;
}


function validarData($data_nascimento)
{
    $dataFormatada = DateTime::createFromFormat('Y-m-d', $data_nascimento);

    // Verifica se a data é válida e no formato correto
    if (!$dataFormatada || $dataFormatada->format('Y-m-d') !== $data_nascimento) {
        return false;
    }

    // Verifica se a data de aplicação não é futura
    $dataHoje = new DateTime();
    if ($dataFormatada > $dataHoje) {
        return false;
    }

    // Verifica se a data de aplicação não é muito antiga (antes de 1900)
    $dataMinima = new DateTime('1900-01-01');
    if ($dataFormatada < $dataMinima) {
        return false;
    }

    return true;
}
