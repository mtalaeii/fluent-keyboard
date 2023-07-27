<?php

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

class RequestPeerTypeUser extends RequestPeerType
{
    public static function new(bool $bot = false, bool $premium = false): self
    {
        $data = [
            '_'       => 'requestPeerTypeUser',
            'bot'     => $bot,
            'premium' => $premium
        ];
        return new static($data);
    }
}