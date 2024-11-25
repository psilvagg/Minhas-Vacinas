<?php
session_start();
require '../../scripts/conn.php';

$cpf = $_SESSION['session_cpf'];
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nome = strtolower(trim($dados['nome']));
$cpf = isset($dados['cpf']) ? trim($dados['cpf']) : ($_SESSION['session_cpf'] ?? null);
$data_nascimento = trim($dados['data_nascimento']);
$telefone = trim($dados['telefone']);
$estado = trim($dados['estado']);
$genero = trim($dados['genero']);
$cidade = trim($dados['cidade']);


if (validarCPF($cpf)) {
    if (empty($nome) && empty($cpf) && empty($data_nascimento) && empty($telefone) && empty($estado) && empty($genero) && empty($cidade)) {
        $retorna = ['status' => false, 'msg' => 'Preencha todos os campos.'];
        header('Content-Type: application/json');
        echo json_encode($retorna);
        exit();
    } else {
        try {
            $sql = $pdo->prepare("UPDATE usuario SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, telefone = :telefone, estado = :estado, genero = :genero, cidade = :cidade WHERE id_user = :id_user");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':cpf', $cpf);
            $sql->bindValue(':data_nascimento', $data_nascimento);
            $sql->bindValue(':telefone', $telefone);
            $sql->bindValue(':estado', $estado);
            $sql->bindValue(':genero', $genero);
            $sql->bindValue(':cidade', $cidade);
            $sql->bindValue(':id_user', $_SESSION['session_id']);
            $sql->execute();

            if ($sql->rowCount() === 1) {
                $_SESSION['session_nome'] = $nome;
                $_SESSION['session_data_nascimento'] = $data_nascimento;
                $_SESSION['session_telefone'] = $telefone;
                $_SESSION['session_estado'] = $estado;
                $_SESSION['session_genero'] = $genero;
                $_SESSION['session_cidade'] = $cidade;
                $retorna = ['status' => true, 'msg' => "Alteração realizada com sucesso. Suas informações estão atualizadas."];
                header('Content-Type: application/json');
                echo json_encode($retorna);
                exit();
            } else {
                $retorna = ['status' => false, 'msg' => 'Você não alterou nenhum dado. Tente novamente.'];
                header('Content-Type: application/json');
                echo json_encode($retorna);
                exit();
            }
        } catch (PDOException $e) {
            $retorna = ['status' => false, 'msg' => 'Não foi possível salvar as alterações. Tente novamente em alguns minutos.'];
            header('Content-Type: application/json');
            echo json_encode($retorna);
            exit();
        }
    }
} else {
    $retorna = ['status' => false, 'msg' => 'O CPF informado é inválido. Por favor, verifique e tente novamente.'];
    header('Content-Type: application/json');
    echo json_encode($retorna);
    exit();
}


function validarCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}
