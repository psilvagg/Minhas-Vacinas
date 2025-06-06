<?php
require_once '../../../vendor/autoload.php';
require_once '../../scripts/Conexao.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha = $dados['senha'];
$confsenha = $dados['confSenha'];
$token = $dados['token'];

if (empty($senha) || empty($confsenha) || empty($token)) {
    $retorna = ['status' => false, 'msg' => "Todos os campos devem ser preenchidos."];
    header('Content-Type: application/json');
    echo json_encode($retorna);
    exit();
} else {
    if ($senha === $confsenha) {
        try {
            $sql = $pdo->prepare("SELECT * FROM esqueceu_senha WHERE token = :token");
            $sql->bindValue(':token', $token);
            $sql->execute();

            if ($sql->rowCount() === 1) {
                $tokenData = $sql->fetch(PDO::FETCH_ASSOC);
                $email = $tokenData['email'];

                try {
                    $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
                    $sql->bindValue(':email', $email);
                    $sql->execute();

                    if ($sql->rowCount() === 1) {
                        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                        $sql = $pdo->prepare("UPDATE usuario SET senha = :senha WHERE email = :email");
                        $sql->bindValue(':senha', $senhaHash);
                        $sql->bindValue(':email', $email);
                        $sql->execute();

                        if ($sql->rowCount() === 1) {
                            try {
                                $sql = $pdo->prepare("DELETE FROM esqueceu_senha WHERE email = :email");
                                $sql->bindValue(':email', $email);
                                $sql->execute();

                                enviarEmail($email);
                                $retorna = ['status' => true, 'msg' => "Senha atualizada com sucesso."];
                                header('Content-Type: application/json');
                                echo json_encode($retorna);
                                exit();
                            } catch (PDOException $e) {
                                $retorna = ['status' => false, 'msg' => "Erro ao remover o token: " . $e->getMessage()];
                                header('Content-Type: application/json');
                                echo json_encode($retorna);
                                exit();
                            }
                        } else {
                            $retorna = ['status' => false, 'msg' => "Erro ao atualizar a senha."];
                            header('Content-Type: application/json');
                            echo json_encode($retorna);
                            exit();
                        }
                    } else {
                        $retorna = ['status' => false, 'msg' => "Usuário não encontrado."];
                        header('Content-Type: application/json');
                        echo json_encode($retorna);
                        exit();
                    }
                } catch (PDOException $e) {
                    $retorna = ['status' => false, 'msg' => "Erro ao buscar usuário: " . $e->getMessage()];
                    header('Content-Type: application/json');
                    echo json_encode($retorna);
                    exit();
                }
            } else {
                $retorna = ['status' => false, 'msg' => "Token inválido ou expirado."];
                header('Content-Type: application/json');
                echo json_encode($retorna);
                exit();
            }
        } catch (PDOException $e) {
            $retorna = ['status' => false, 'msg' => "Erro ao buscar o token: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($retorna);
            exit();
        }
    } else {
        $retorna = ['status' => false, 'msg' => "As senhas não coincidem."];
        header('Content-Type: application/json');
        echo json_encode($retorna);
        exit();
    }
}

function enviarEmail($email)
{
    $email_body = file_get_contents('../../../assets/email/nova-senha.html');
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['HOST_SMTP'];
        $mail->SMTPAuth = true;
        $mail->Username =  $_ENV['EMAIL'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom($_ENV['EMAIL'], 'Minhas Vacinas');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Senha Alterada com sucesso!';
        $mail->addEmbeddedImage('../../../assets/img/logo-img.png', 'logo-img');
        $email_body = str_replace('{{logo-img}}', 'cid:logo-img', $email_body);
        $mail->Body = $email_body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
