<?php

namespace WebTech\WhatsAppApi;

use WebTech\WhatsAppApi\Config\Config;
use WebTech\WhatsAppApi\Util\HttpClient;
use Exception;

class Wpp
{
    protected $httpClient;
    protected $instanceName;
    protected $baseUrl;
    protected $secureToken;

    public function __construct($instanceName)
    {
        $this->baseUrl = Config::get('wBaseUrl');
        $this->secureToken = Config::get('wBearerToken');
        $this->httpClient = new HttpClient($this->baseUrl, $this->secureToken);
        $this->instanceName = $instanceName;
    }

    public function newToken()
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $this->secureToken
        ]);
    
        $response = $this->httpClient->post('/api/' . $this->instanceName . '/'. $this->secureToken. '/generate-token');
    
        return $response;
    }
    
    public function connect($token)
    {
        $data = [
            'webhook' => null,
            'waitQrCode' => false
        ];
    
        $response = $this->httpClient->headers([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ])->post('/api/' . $this->instanceName . '/start-session', $data);
    
        return $response;
    }
    
    public function qrcodeUpdate($token)
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $token
        ]);

        $response = $this->httpClient->get('/api/' . $this->instanceName . '/status-session');

        return $response;
    }

    public function qrcodeSession($token)
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $token
        ]);

        $response = $this->httpClient->get('/api/' . $this->instanceName . '/qrcode-session');

        return $response;
    }

    public function status($token)
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $token
        ]);
    
        $response = $this->httpClient->get('/api/' . $this->instanceName . '/check-connection-session');
    
        return $response;
    }
    
    public function delete($token)
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $token
        ]);

        $response = $this->httpClient->post('/api/' . $this->instanceName . '/close-session');

        return $response;
    }

    public function logout($token)
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $token
        ]);

        $response = $this->httpClient->post('/api/' . $this->instanceName . '/logout-session');

        return $response;
    }

    public function chatwootWebhook($token)
    {
        $this->httpClient->headers([
            'Authorization: Bearer ' . $token
        ]);

        $response = $this->httpClient->post('/api/' . $this->instanceName . '/chatwoot');

        return $response;
    }

    public function sendText($token,$phone, $message, $isGroup = false)
    {
        $data = [
            'phone' => $phone,
            'message' => $message,
            'isGroup' => $isGroup
        ];
    
        $response = $this->httpClient->headers([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ])->post('/api/' . $this->instanceName . '/send-message', $data);
    
        return $response;
    }

    public function sendMedia($token, $phone, $link, $caption = '', $isGroup = false)
{
    // Obtém a extensão do arquivo
    $extension = pathinfo($link, PATHINFO_EXTENSION);
    
    // Verifica o tipo de arquivo com base na extensão
    $fileType = '';
    if (in_array(strtolower($extension), ['doc', 'docx', 'txt'])) {
        $fileType = 'document';
    } elseif (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
        $fileType = 'image';
    } elseif (in_array(strtolower($extension), ['mp4', 'mov', 'avi'])) {
        $fileType = 'video';
    } elseif (strtolower($extension) === 'pdf') {
        $fileType = 'pdf';
    } else {
        // Caso a extensão não corresponda a nenhum tipo conhecido, trate o erro
        return "Tipo de arquivo não suportado.";
    }

    // Obtém o conteúdo do arquivo
    $fileContent = file_get_contents($link);
    
    if ($fileContent === false) {
        // Trate o erro caso não seja possível obter o conteúdo do arquivo
        return "Erro ao obter o conteúdo do arquivo.";
    }

    // Codifica o conteúdo do arquivo em base64
    $base64Data = base64_encode($fileContent);

    // Define o tipo MIME de acordo com o tipo de arquivo
    $mimeType = '';
    if ($fileType === 'image') {
        $mimeType = 'image/' . $extension;
    } elseif ($fileType === 'video') {
        $mimeType = 'video/' . $extension;
    } elseif ($fileType === 'pdf') {
        $mimeType = 'application/pdf';
    } else {
        // Caso o tipo de arquivo não seja suportado, trate o erro
        return "Tipo de arquivo não suportado.";
    }

    $base64Data = 'data:' . $mimeType . ';base64,' . $base64Data;
    
    // Monta os dados para a requisição
    $data = [
        'phone' => $phone,
        'base64' => $base64Data,
        'isGroup' => $isGroup
    ];

    // Realiza a chamada para a API
    $response = $this->httpClient->headers([
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ])->post('/api/' . $this->instanceName . '/send-file-base64', $data);

    if (!empty($caption)) {
        $this->sendText($token, $phone, $caption, $isGroup);
    }
    return $response;
}


    public function sendLinkPreview($token,$phone, $url, $caption = "")
    {
        $data = [
            'phone' => $phone,
            'url' => $url,
            'caption' => $caption
        ];

        $response = $this->httpClient->headers([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ])->post('/api/' . $this->instanceName . '/send-link-preview', $data);
    
        return $response;
    }

    public function numberCheck($token,$phone)
    {
        $response = $this->httpClient->headers([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ])->get('/api/' . $this->instanceName . '/check-number-status/' . $phone);

        return $response;
    }
}


