<?php

namespace WebTech\WhatsAppApi\Config;

class Config
{
    private static $config = [
        // code chat br
        'cBaseUrl' => null,
        'cApiKey' => null,
        // salman whatsapp api nodejs 
        'sBaseUrl' => null,
        'sBearerToken' => null,
        // wppconnect
        'wBaseUrl' => null,
        'wBearerToken' => null
    ];

    public function __construct(array $config = [])
    {
        self::$config = array_merge(self::$config, $config);
    }

    public static function get($key)
    {
        return self::$config[$key] ?? null;
    }
}
