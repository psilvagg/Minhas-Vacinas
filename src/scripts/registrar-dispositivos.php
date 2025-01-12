<?php
require 'conn.php';


function registrar_dispositivo($pdo)
{

    $id_usuario = 2;
    // Obter IP
    $ip = $_SERVER['REMOTE_ADDR'];

    // Obter informações de geolocalização usando o serviço de IP (ipinfo.io)
    $token = 'c4444d8bf12e24'; // Coloque seu token do ipinfo.io aqui
    $response = file_get_contents("https://ipinfo.io/{$ip}/json?token={$token}");
    $data = json_decode($response, true);

    $cidade = isset($data['city']) ? $data['city'] : 'Desconhecida';
    $estado = isset($data['region']) ? $data['region'] : 'Desconhecido';
    $pais = isset($data['country']) ? $data['country'] : 'Desconhecido';

    // Obter informações do User-Agent (Navegador e SO)
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser_info = get_browser_info($user_agent);
    $navegador = $browser_info['browser'];
    $sistema_operacional = $browser_info['os'];

    // Nome do dispositivo (pode ser personalizado se disponível no cabeçalho do dispositivo)
    $nome_dispositivo = gethostname(); // Ou use uma variável de entrada se disponível

    // Tipo do dispositivo (pode ser baseado no User-Agent ou outras informações)
    $tipo_dispositivo = (strpos($user_agent, 'Mobile') !== false) ? 'Mobile' : 'Desktop';

    // Inserir na tabela de dispositivos
    $sql = $pdo->prepare("INSERT INTO dispositivos
(id_usuario, nome_dispositivo, tipo_dispositivo, ip, navegador, cidade, estado, pais)
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

    // Executar a query
    $sql->execute();
}

// Função auxiliar para detectar o navegador e o sistema operacional
function get_browser_info($user_agent)
{
    // Detectando o sistema operacional
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

    // Detectando o navegador
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
