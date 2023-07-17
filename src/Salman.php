<?php

namespace WebTech\WhatsAppApi\Salman;

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
}
