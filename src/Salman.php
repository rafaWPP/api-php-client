<?php

namespace WebTech\WhatsAppApi;

use WebTech\WhatsAppApi\Config\Config;
use WebTech\WhatsAppApi\Util\HttpClient;
use Exception;

class Salman
{
    protected $httpClient;
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;

        $baseUrl = Config::get('sBaseUrl');
        $bearerToken = Config::get('sBearerToken');

        if (!$baseUrl || !$bearerToken) {
            throw new Exception("As configurações devem ser fornecidas para usar o Salman.");
        }

        $this->httpClient = new HttpClient($baseUrl, $bearerToken);
    }

    public function create()
    {
        return $this->httpClient->get('/instance/init?key=' . $this->key);
    }

    public function connect()
    {
        return $this->httpClient->get('/instance/qrbase64?key=' . $this->key);
    }

    public function status()
    {
        return $this->httpClient->get('/instance/info?key=' . $this->key);
    }

    public function restoreAll()
    {
        return $this->httpClient->get('/instance/restore');
    }

    public function delete()
    {
        return $this->httpClient->delete('/instance/delete?key=' . $this->key);
    }

    public function logout()
    {
        return $this->httpClient->delete('/instance/logout?key=' . $this->key);
    }

    public function fetchAll()
    {
        return $this->httpClient->get('/instance/list');
    }

    public function sendText($number, $message)
    {
        $data = [
            'id' => $number,
            'message' => $message
        ];

        return $this->httpClient->post('/message/text?key=' . $this->key, $data);
    }

    public function sendMedia($number, $caption, $media)
    {
        $mediaMessage = $this->getMediaMessage($caption, $media);
        $data = [
            'id' => $number,
            'url' => $mediaMessage['media'],
            'type' => $mediaMessage['mediatype'],
            'mimetype' => $mediaMessage['mimetype'],
            'caption' => $mediaMessage['caption']
        ];

        return $this->httpClient->post('/message/mediaurl?key=' . $this->key, $data);
    }

    public function sendButtons($number, $btndata)
    {
        return $this->httpClient->post('/message/button?key=' . $this->key, $btndata);
    }

    public function sendMediaButtons($number, $btndata)
    {
        return $this->httpClient->post('/message/MediaButton?key=' . $this->key, $btndata);
    }

    public function sendList($number, $msgdata)
    {
        return $this->httpClient->post('/message/list?key=' . $this->key, $msgdata);
    }

    private function getMediaMessage($caption, $media)
    {
        $extension = pathinfo($media, PATHINFO_EXTENSION);
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
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
            'fileName' => $media,
            'caption' => $caption,
            'media' => $media
        ];
    }
}
