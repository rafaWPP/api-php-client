CodeChatBR

```<?php
use WebTech\WhatsAppApi\CodeChat;
use WebTech\WhatsAppApi\Config\Config;

$config = new Config([
    'cBaseUrl' => 'http:api:por',
    'cApiKey' => 'sua-chave-api-aqui',
    // Restante das configurações
]);

// Instanciando a classe CodeChat
$codeChat = new CodeChat("minha_instancia");

$response = $codeChat->create();
echo $response;

$response = $codeChat->connect();
echo $response;

$response = $codeChat->status();
echo $response;

// Enviar mensagem sem delei
$response = $codeChat->sendText('1234567890', 'Olá, este é um teste');

// Enviar mensagem com delei
$response = $codeChat->sendText('1234567890', 'Olá, este é um teste',120);

echo $response;

// Enviar midia sem delei
$response = $codeChat->sendMedia('1234567890', 'Este é um arquivo de teste', '/caminho/para/arquivo.jpg');

// Enviar midia sem delei
$response = $codeChat->sendMedia('1234567890', 'Este é um arquivo de teste', '/caminho/para/arquivo.jpg',120);

echo $response;
?>

Salman

```<?php
use WebTech\WhatsAppApi\CodeChat;
use WebTech\WhatsAppApi\Config\Config;

$config = new Config([
    'cBaseUrl' => 'http:api:por',
    'cApiKey' => 'sua-chave-api-aqui',
    // Restante das configurações
]);

// Instanciando a classe CodeChat
$codeChat = new CodeChat("minha_instancia");

$response = $codeChat->create();
echo $response;

$response = $codeChat->connect();
echo $response;

$response = $codeChat->status();
echo $response;

// Enviar mensagem sem delei
$response = $codeChat->sendText('1234567890', 'Olá, este é um teste');

// Enviar mensagem com delei
$response = $codeChat->sendText('1234567890', 'Olá, este é um teste',120);

echo $response;

// Enviar midia sem delei
$response = $codeChat->sendMedia('1234567890', 'Este é um arquivo de teste', '/caminho/para/arquivo.jpg');

// Enviar midia sem delei
$response = $codeChat->sendMedia('1234567890', 'Este é um arquivo de teste', '/caminho/para/arquivo.jpg',120);

echo $response;
?>

