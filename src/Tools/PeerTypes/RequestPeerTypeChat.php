<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

/**
 * Pressing the button will open a list of suitable chats. Tapping on a chat will send its identifier to the bot
 */
class RequestPeerTypeChat extends RequestPeerType
{
    public static function new(
        ?bool $creator = null,
        ?bool $hasUsername = null,
        ?bool $forum = null,
        ?ChatAdminRights $userAdminRights = null,
        ?ChatAdminRights $botAdminRights  = null
    ): self {
        $data = [
            '_' => 'requestPeerTypeChat',
            'creator' => $creator,
            'forum'   => $forum,
            'has_username' => $hasUsername,
            'user_admin_rights' => \is_callable($userAdminRights) ? $userAdminRights() : ChatAdminRights::new()(),
            'bot_admin_rights'  => \is_callable($botAdminRights)  ? $botAdminRights()  : ChatAdminRights::new()()
        ];
        return new static($data);
    }
}
