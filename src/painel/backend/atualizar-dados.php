<?php
session_start();
require '../../scripts/conn.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nome = ucwords(trim($dados['nome']));
$cpf_formatado = isset($dados['cpf']) ? trim($dados['cpf']) : ($_SESSION['session_cpf'] ?? null);
$cpf = preg_replace('/[^0-9]/', '', $cpf_formatado);
$data_nascimento = trim($dados['data_nascimento']);
$telefone = trim($dados['telefone']);
$estado = trim($dados['estado']);
$genero = ($dados['genero']);
// $cidade = trim($dados['cidade']);

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
        $retorna = ['status' => false, 'msg' => "Data inválida ou data no futuro. A data precisa estar no formato 'DIA-MÊS-ANO' e não pode ser posterior ao dia de hoje."];
        header('Content-Type: application/json');
        echo json_encode($retorna);
        exit();
    }
}

try {
    $sql = $pdo->prepare("UPDATE usuario SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, telefone = :telefone, estado = :estado, genero = :genero WHERE email = :email");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':data_nascimento', $data_nascimento);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':estado', $estado);
    $sql->bindValue(':genero', $genero);
    // $sql->bindValue(':cidade', $cidade);
    $sql->bindValue(':email', $_SESSION['session_email']);
    $sql->execute();


    $_SESSION['session_nome'] = $nome;
    $_SESSION['session_data_nascimento'] = $data_nascimento;
    $_SESSION['session_telefone'] = $telefone;
    $_SESSION['session_estado'] = $estado;
    $_SESSION['session_genero'] = $genero;
    // $_SESSION['session_cidade'] = $cidade;
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
