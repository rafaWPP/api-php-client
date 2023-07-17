<?php
namespace WebTech\WhatsAppApi\Config;

class Config
{
    private static $config = [
        // code chat br
        'cBaseUrl' => 'https://api.codechat.dev',
        'cApiKey' => 'sua-chave-api-aqui',
        // salman whatsapp api nodejs 
        'sBaseUrl' => 'https://api.codechat.dev',
        'sBearerToken' => 'seu-token-bearer-aqui',
        // wppconnnect
        'wBaseUrl' => 'https://api.codechat.dev',
        'wBearerToken' => 'seu-token-bearer-aqui'
    ];

    public static function get($key)
    {
        return self::$config[$key] ?? null;
    }
}
