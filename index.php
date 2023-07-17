<?php
require_once('src/CodeChat.php');
require_once 'src/Config/Config.php';
require_once 'src/Util/HttpClient.php';
use WebTech\WhatsAppApi\CodeChat;

// Instanciando a classe CodeChat
$codeChat = new CodeChat("minha_instancia");

$response = $codeChat->create();
echo $response;

echo 'oi';