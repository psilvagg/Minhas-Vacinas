<?php
session_start();
require '../../scripts/Conexao.php';
require '../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../../');
$dotenv->load();

use Google\Client as GoogleClient;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (empty($_POST['credential']) || empty($_POST['g_csrf_token'])) {
    $_SESSION['erro_email'] = "Dados de login inválidos.";
    header('Location: ../entrar/');
    exit();
}

$cookie = $_COOKIE['g_csrf_token'];

if ($_POST['g_csrf_token'] != $cookie) {
    $_SESSION['erro_email'] = "Token CSRF inválido.";
    header('Location: ../entrar/');
    exit();
}

$client = new GoogleClient(['client_id' => '14152276280-9pbtedkdibk5rsktetmnh32rap49a8jm.apps.googleusercontent.com']);
$payload = $client->verifyIdToken($_POST['credential']);

if (isset($payload['email'])) {
    $email = $payload['email'];
    $googleId = $payload['sub'];

    $sql = $pdo->prepare("SELECT * FROM usuario_google WHERE google_id = :google_id");
    $sql->bindValue(':google_id', $googleId);
    $sql->execute();

    if ($sql->rowCount() === 1) {
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $usuario['id_usuario'];
        $ip = ObterIP();

        $sql = $pdo->prepare("SELECT * FROM usuario WHERE ip_cadastro = :ip_cadastro AND id_usuario = :id_usuario");
        $sql->bindValue(':ip_cadastro', $ip);
        $sql->bindValue(':id_usuario', $id_usuario);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            $_SESSION['user_id'] = $usuario['id_usuario'];
            $_SESSION['user_nome'] = $usuario['nome'];
            $_SESSION['user_email'] = $usuario['email'];
            $_SESSION['user_ip'] = $ip;
            header('Location: ../../painel/');
            exit();
        } else {
            $sql = $pdo->prepare("SELECT * FROM dispositivos WHERE ip = :ip AND id_usuario = :id_usuario");
            $sql->bindValue(':ip', $ip);
            $sql->bindValue(':id_usuario', $id_usuario);
            $sql->execute();

            if ($sql->rowCount() == 1) {
                $dispostivo = $sql->fetch(PDO::FETCH_BOTH);
                $dispositivo_confirmado = $dispostivo['confirmado'];

                if ($dispositivo_confirmado != 1) {
                    $id_usuario = $dispostivo['id_usuario'];
                    $ip = $dispostivo['ip'];
                    $cidade = $dispostivo['cidade'];
                    $estado = $dispostivo['estado'];
                    $pais = $dispostivo['pais'];

                    EnviarEmail($id_usuario, $email, $ip, $cidade, $estado, $pais);
                    $_SESSION['sucesso-email'] = "Para concluir o login, verifique seu e-mail e clique no link de confirmação. Um e-mail foi enviado com as instruções.";
                    header('Location: ../entrar/');
                    exit();
                } else {
                    header('Location: ../../painel/');
                    $_SESSION['user_id'] = $usuario['id_usuario'];
                    $_SESSION['user_nome'] = $usuario['nome'];
                    $_SESSION['user_email'] = $usuario['email'];
                    $_SESSION['user_ip'] = $ip;
                    exit();
                }
            } else {
                RegistrarDispositivos($pdo, $id_usuario);
                $token = $_ENV['IPINFO_TOKEN'];
                $response = file_get_contents("https://ipinfo.io/{$ip}/json?token={$token}");
                $data = json_decode($response, true);

                $cidade = $data['city'];
                $estado = $data['region'];
                $pais = $data['country'];
                $email = $usuario['email'];

                EnviarEmail($id_usuario, $email, $ip, $cidade, $estado, $pais);
                $_SESSION['sucesso-email'] = "Para concluir o login, verifique seu e-mail e clique no link de confirmação. Um e-mail foi enviado com as instruções.";
                header('Location: ../entrar/');
                exit();
            }
        }
    } else {
        $_SESSION['erro_email'] = "Usuário não cadastrado ou não conectado com google.";
        header('Location: ../entrar/');
        exit();
    }
} else {
    $_SESSION['erro_email'] = "Erro ao verificar o login com o Google.";
    header('Location: ../entrar/');
    exit();
}


function EnviarEmail($id_usuario, $email, $ip, $cidade, $estado, $pais)
{
    date_default_timezone_set('America/Sao_Paulo');
    $data_local = date('d/m/Y H:i:s');
    $email_body = file_get_contents('../../../assets/email/alerta-login.html');
    $email_body = str_replace('{{ip}}', $ip, $email_body);
    $email_body = str_replace('{{cidade}}', $cidade, $email_body);
    $email_body = str_replace('{{estado}}', $estado, $email_body);
    $email_body = str_replace('{{pais}}', $pais, $email_body);
    $email_body = str_replace('{{horario}}', $data_local, $email_body);
    $email_body = str_replace('{{id}}', $id_usuario, $email_body);
    $email_body = str_replace('{{ip}}', $ip, $email_body);
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['HOST_SMTP'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom($_ENV['EMAIL'], 'Minhas Vacinas');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Sua conta Minhas Vacinas foi acessada a partir de um novo endereço IP';
        $mail->addEmbeddedImage('../../../assets/img/logo-img.png', 'logo-img');
        $email_body = str_replace('{{logo-img}}', 'cid:logo-img', $email_body);
        $mail->Body = $email_body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function RegistrarDispositivos($pdo, $id_usuario)
{
    $ip = ObterIP();
    $token = 'c4444d8bf12e24';
    $response = file_get_contents("https://ipinfo.io/{$ip}/json?token={$token}");
    $data = json_decode($response, true);

    $cidade = isset($data['city']) ? $data['city'] : 'Desconhecida';
    $estado = isset($data['region']) ? $data['region'] : 'Desconhecido';
    $pais = isset($data['country']) ? $data['country'] : 'Desconhecido';

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser_info = NavegadorInfo($user_agent);
    $navegador = $browser_info['browser'];
    $sistema_operacional = $browser_info['os'];
    $tipo_dispositivo = (strpos($user_agent, 'Mobile') !== false) ? 'Mobile' : 'Desktop';
    $tipo_dispositivo = strtoupper($tipo_dispositivo);
    $nome_dispositivo = $tipo_dispositivo . " - " . $sistema_operacional . " | " . $navegador;

    $sql = $pdo->prepare("INSERT INTO dispositivos (id_usuario, nome_dispositivo, tipo_dispositivo, ip, navegador, cidade, estado, pais)
    VALUES
    (:id_usuario, :nome_dispositivo, :tipo_dispositivo, :ip, :navegador, :cidade, :estado, :pais)");

    $sql->bindValue(':id_usuario', $id_usuario);
    $sql->bindValue(':nome_dispositivo', $nome_dispositivo);
    $sql->bindValue(':tipo_dispositivo', $tipo_dispositivo);
    $sql->bindValue(':ip', $ip);
    $sql->bindValue(':navegador', $navegador);
    $sql->bindValue(':cidade', $cidade);
    $sql->bindValue(':estado', $estado);
    $sql->bindValue(':pais', $pais);
    $sql->execute();


    return $ip;
}

function ObterIP()
{
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = '192.168.1';
    }

    return $ip;
}

function NavegadorInfo($user_agent)
{
    if (strpos($user_agent, 'Windows NT') !== false) {
        $os = 'Windows';
    } elseif (strpos($user_agent, 'Macintosh') !== false) {
        $os = 'Mac OS';
    } elseif (strpos($user_agent, 'Linux') !== false) {
        $os = 'Linux';
    } elseif (strpos($user_agent, 'Android') !== false) {
        $os = 'Android';
    } elseif (strpos($user_agent, 'iPhone') !== false) {
        $os = 'iOS';
    } else {
        $os = 'Desconhecido';
    }

    if (strpos($user_agent, 'Chrome') !== false) {
        $browser = 'Chrome';
    } elseif (strpos($user_agent, 'Firefox') !== false) {
        $browser = 'Firefox';
    } elseif (strpos($user_agent, 'Safari') !== false) {
        $browser = 'Safari';
    } elseif (strpos($user_agent, 'Edge') !== false) {
        $browser = 'Edge';
    } elseif (strpos($user_agent, 'MSIE') !== false || strpos($user_agent, 'Trident') !== false) {
        $browser = 'Internet Explorer';
    } else {
        $browser = 'Desconhecido';
    }

    return [
        'os' => $os,
        'browser' => $browser
    ];
}
