<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerType;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

/**
 * Pressing the button will open a list of suitable chats. Tapping on a chat will send its identifier to the bot
 */
class RequestGroup extends RequestPeer
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
            'user_admin_rights' => $userAdminRights instanceof ChatAdminRights ? $userAdminRights() : null,
            'bot_admin_rights'  => $botAdminRights  instanceof ChatAdminRights ? $botAdminRights() : null,
        ];
        return new static($data);
    }
}
