<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerType;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

/**
 * Pressing the button will open a list of suitable channels. Tapping on a chat will send its identifier to the bot
 */
class RequestChannel extends RequestPeer
{
    public static function new(
        ?bool $creator = null,
        ?bool $hasUsername = null,
        ?ChatAdminRights $userAdminRights = null,
        ?ChatAdminRights $botAdminRights = null
    ): self {
        $data = [
            '_' => 'requestPeerTypeBroadcast',
            'creator' => $creator,
            'has_username' => $hasUsername,
            'user_admin_rights' => $userAdminRights instanceof ChatAdminRights ? $userAdminRights() : null,
            'bot_admin_rights'  => $botAdminRights  instanceof ChatAdminRights ? $botAdminRights() : null
        ];
        return new static($data);
    }
}
