CodeChat
```<?php
<?php

// Inclua o arquivo da classe CodeChat
use WebTech\WhatsAppApi\CodeChat;

//Configuração
use WebTech\WhatsAppApi\Config\Config;

$config = new Config([
    // codechat
    'cBaseUrl' => 'url',
    'cApiKey' => 'key',
    //salman
    'sBaseUrl' => 'url',
    'sBearerToken' => 'token',
    //wppconnect
    'wBaseUrl' => 'url',
    'wBearerToken' => 'token',
]);

// Crie uma instância do CodeChat
$instanceName = 'minha_instancia';
$codeChat = new CodeChat($instanceName);

try {
    // Crie uma nova instância
    $response = $codeChat->create();
    echo "Instância criada com sucesso.\n";

    // Conecte-se à instância
    $response = $codeChat->connect();
    echo "Conexão estabelecida com sucesso.\n";

    // Envie uma mensagem de texto
    $number = '551234567890';
    $text = 'Olá, mundo!';
    $response = $codeChat->sendText($number, $text);
    echo "Mensagem de texto enviada com sucesso.\n";

    // Envie uma mídia
    $caption = 'Imagem legal';
    $media = '/caminho/para/imagem.jpg';
    $response = $codeChat->sendMedia($number, $caption, $media);
    echo "Mídia enviada com sucesso.\n";

    // Obtenha o estado da conexão
    $response = $codeChat->status();
    echo "Estado da conexão: " . $response . "\n";

    // Exclua a instância
    $response = $codeChat->delete();
    echo "Instância excluída com sucesso.\n";
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage() . "\n";
}

//Salman
<?php

// Inclua o arquivo da classe Salman
require_once 'Salman.php';

use WebTech\WhatsAppApi\Salman;

// Crie uma instância do Salman
$key = 'chave_de_acesso_aqui';
$salman = new Salman($key);

try {
    // Crie uma nova instância
    $response = $salman->create();
    echo "Instância criada com sucesso.\n";

    // Conecte-se à instância
    $response = $salman->connect();
    echo "Conexão estabelecida com sucesso.\n";

    // Envie uma mensagem de texto
    $number = '551234567890';
    $message = 'Olá, mundo!';
    $response = $salman->sendText($number, $message);
    echo "Mensagem de texto enviada com sucesso.\n";

    // Envie uma mídia
    $caption = 'Imagem legal';
    $media = '/caminho/para/imagem.jpg';
    $response = $salman->sendMedia($number, $caption, $media);
    echo "Mídia enviada com sucesso.\n";

    // Obtenha o estado da conexão
    $response = $salman->status();
    echo "Estado da conexão: " . $response . "\n";

    // Restaure todas as instâncias
    $response = $salman->restoreAll();
    echo "Todas as instâncias restauradas.\n";

    // Exclua a instância
    $response = $salman->delete();
    echo "Instância excluída com sucesso.\n";
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage() . "\n";
}

//WPPconnect
<?php

// Inclua o arquivo da classe Wpp
require_once 'Wpp.php';

use WebTech\WhatsAppApi\Wpp;

// Crie uma instância do Wpp
$instanceName = 'nome_da_instancia';
$wpp = new Wpp($instanceName);

try {
    // Obtenha um novo token
    $tokenResponse = $wpp->newToken();
    $token = $tokenResponse['data']['token'];

    // Conecte-se à instância com o token
    $connectResponse = $wpp->connect($token);
    echo "Conexão estabelecida com sucesso.\n";

    // Obtenha o código QR e a URL de sessão
    $qrcodeResponse = $wpp->qrcodeSession($token);
    $qrcode = $qrcodeResponse['data']['qrCode'];
    $sessionUrl = $qrcodeResponse['data']['sessionUrl'];
    echo "Código QR: " . $qrcode . "\n";
    echo "URL da sessão: " . $sessionUrl . "\n";

    // Verifique se o código QR foi atualizado
    $qrcodeUpdateResponse = $wpp->qrcodeUpdate($token);
    $isQrcodeUpdated = $qrcodeUpdateResponse['data']['isQrcodeUpdated'];
    echo "O código QR foi atualizado? " . ($isQrcodeUpdated ? "Sim" : "Não") . "\n";

    // Obtenha o status da conexão
    $statusResponse = $wpp->status($token);
    $connectionStatus = $statusResponse['data']['connectionStatus'];
    echo "Status da conexão: " . $connectionStatus . "\n";

    // Envie uma mensagem de texto
    $phone = '551234567890';
    $message = 'Olá, mundo!';
    $sendTextResponse = $wpp->sendText($token, $phone, $message);
    echo "Mensagem de texto enviada com sucesso.\n";

    // Envie um arquivo
    $fileLink = '/caminho/para/arquivo.pdf';
    $caption = 'Arquivo PDF';
    $sendFileResponse = $wpp->sendMedia($token, $phone, $fileLink, $caption);
    echo "Arquivo enviado com sucesso.\n";

    // Envie um link com visualização
    $link = 'https://www.example.com';
    $linkCaption = 'Link para o site';
    $sendLinkPreviewResponse = $wpp->sendLinkPreview($token, $phone, $link, $linkCaption);
    echo "Link com visualização enviado com sucesso.\n";

    // Verifique o status de um número
    $number = '551234567890';
    $numberCheckResponse = $wpp->numberCheck($token, $number);
    $numberStatus = $numberCheckResponse['data']['status'];
    echo "Status do número " . $number . ": " . $numberStatus . "\n";

    // Encerre a sessão
    $logoutResponse = $wpp->logout($token);
    echo "Sessão encerrada com sucesso.\n";
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage() . "\n";
}



