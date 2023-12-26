<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

/**
 * Pressing the button will open a list of suitable users. Tapping on any user will send their identifier to the bot
 */
class RequestPeerTypeUser extends RequestPeerType
{
    public static function new(?bool $bot = null, ?bool $premium = null): self
    {
        $data = [
            '_' => 'requestPeerTypeUser',
            'bot' => $bot,
            'premium' => $premium
        ];
        return new static($data);
    }
}
