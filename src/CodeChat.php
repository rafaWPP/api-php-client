<?php

namespace WebTech\WhatsAppApi;

use WebTech\WhatsAppApi\Config\Config;
use WebTech\WhatsAppApi\Util\HttpClient;
use Exception;

class CodeChat
{
    protected $httpClient;
    protected $instanceName;
    protected $apiKey;
    protected $baseUrl;

    public function __construct($instanceName)
    {
        $baseUrl = Config::get('cBaseUrl');
        $apiKey = Config::get('cApiKey');
    
        $this->httpClient = new HttpClient($baseUrl, $apiKey);
        $this->instanceName = $instanceName;
    }

    public function create()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->post('/instance/create', ['instanceName' => $this->instanceName]);
    }

    public function connect()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->get('/instance/connect/' . $this->instanceName);
    }

    public function delete()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->delete('/instance/delete/' . $this->instanceName);
    }
    
    public function logout()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->delete('/instance/logout/' . $this->instanceName);
    }
    
    public function fetch()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->get('/instance/fetchInstances?instanceName=' . $this->instanceName);
    }
    
    public function fetchAll()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->get('/instance/fetchInstances');
    }
    
    public function status()
    {
        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->get('/instance/connectionState/' . $this->instanceName);
    }

    public function sendText($number, $text, $delay = 0)
    {
        $data = [
            'number' => $number,
            'options' => ['delay' => $delay],
            'textMessage' => ['text' => $text]
        ];

        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->post('/message/sendText/' . $this->instanceName, $data);
    }

    public function sendMedia($number, $caption, $media, $delay = 0)
    {
        $data = [
            'number' => $number,
            'options' => ['delay' => $delay],
            'mediaMessage' => $this->getMediaMessage($caption, $media)
        ];

        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->post('/message/sendMedia/' . $this->instanceName, $data);
    }

    public function sendButtons($number, $title, $description, $footerText, $buttons, $media, $delay = 0)
    {
        $data = [
            'number' => $number,
            'options' => ['delay' => $delay],
            'buttonMessage' => [
                'title' => $title,
                'description' => $description,
                'footerText' => $footerText,
                'buttons' => $buttons,
                'mediaMessage' => $this->getMediaMessage('', $media)
            ]
        ];

        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->post('/message/sendButtons/' . $this->instanceName, $data);
    }

    public function sendList($number, $title, $description, $buttonText, $footerText, $sections, $delay = 0)
    {
        $data = [
            'number' => $number,
            'listMessage' => [
                'title' => $title,
                'description' => $description,
                'buttonText' => $buttonText,
                'footerText' => $footerText,
                'sections' => $sections
            ],
            'options' => ['delay' => $delay]
        ];

        return $this->httpClient->headers([
            'Content-Type: application/json',
            'apikey:' . $this->apiKey
        ])->post('/message/sendList/' . $this->instanceName, $data);
    }

    private function getMediaMessage($caption, $media)
    {
        $extension = pathinfo($media, PATHINFO_EXTENSION);
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif','webp'];
        $documentExtensions = ['pdf', 'doc', 'docx'];
        $videoExtensions = ['mp4', 'avi', 'mov'];
        $audioExtensions = ['mp3', 'wav'];
        $mediatype = '';

        if (in_array($extension, $imageExtensions)) {
            $mediatype = 'image';
        } elseif (in_array($extension, $documentExtensions)) {
            $mediatype = 'document';
        } elseif (in_array($extension, $videoExtensions)) {
            $mediatype = 'video';
        } elseif (in_array($extension, $audioExtensions)) {
            $mediatype = 'audio';
        } else {
            throw new Exception("Tipo de arquivo inválido");
        }

        return [
            'mediatype' => $mediatype,
            'fileName' => $mediatype,
            'caption' => $caption,
            'media' => $media
        ];
    }
}
