<?php

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

class RequestPeerTypeUser extends RequestPeerType
{
    protected static array $data = [];

    protected function setPredict()
    {
        self::$data['_'] = 'requestPeerTypeUser';
    }

    public static function new(bool $bot = false, bool $premium = false): self
    {
        self::$data += [
            'bot' => $bot,
            'premium' => $premium
        ];
        return new static(self::$data);
    }
}