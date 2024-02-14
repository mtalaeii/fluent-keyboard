<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerType;

/**
 * Pressing the button will open a list of suitable users. Tapping on any user will send their identifier to the bot
 */
final class RequestUser extends RequestPeer
{
    /**
     * @param bool|null $bot     Whether request a bot
     * @param bool|null $premium Whether request a premium user,
     */
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
