<?php
namespace WebTech\WhatsAppApi\Util;

class HttpClient
{
    private $baseUrl;
    private $apiKey;
    private $nextRequestHeaders;

    public function __construct($baseUrl, $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->nextRequestHeaders = [];
    }

    public function headers($headers)
    {
        $this->nextRequestHeaders = $headers;
        return $this;
    }

    private function executeCurl($url, $method = 'GET', $body = null)
    {
        $ch = curl_init();

        $defaultHeaders = [
            'Content-Type: application/json',
            'apikey: ' . $this->apiKey,
        ];

        $headers = array_merge($defaultHeaders, $this->nextRequestHeaders);
        // Limpa os cabeçalhos para a próxima requisição.
        $this->nextRequestHeaders = [];

        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            throw new \Exception("Erro na requisição cURL: " . $error);
        }

        curl_close($ch);

        return $response;
    }

    public function post($url, $body = [])
    {
        return $this->executeCurl($url, 'POST', $body);
    }

    public function get($url)
    {
        return $this->executeCurl($url, 'GET');
    }

    public function delete($url)
    {
        return $this->executeCurl($url, 'DELETE');
    }
}
