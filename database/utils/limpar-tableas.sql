-- SEMPRE EXECUTAR TUDO --
use minhasvacinas;
SET SQL_SAFE_UPDATES = 0;
SET foreign_key_checks = 0;

TRUNCATE TABLE confirmar_cadastro;
TRUNCATE TABLE esqueceu_senha;
TRUNCATE TABLE excluir_conta;
TRUNCATE TABLE mudar_email;
TRUNCATE TABLE usuario;
TRUNCATE TABLE usuario_google;
TRUNCATE TABLE vacina;
TRUNCATE TABLE dispositivos;
TRUNCATE TABLE novidades;

SET SQL_SAFE_UPDATES = 1;
SET foreign_key_checks = 1;

-- SET time_zone = 'America/Sao_Paulo';

-- SEMPRE EXECUTAR TUDO --
