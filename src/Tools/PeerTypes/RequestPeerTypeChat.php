<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

class RequestPeerTypeChat extends RequestPeerType
{
    public static function new(
        bool             $creator           = false,
        bool             $has_username      = false,
        bool             $forum             = false,
        ?ChatAdminRights $user_admin_rights = null,
        ?ChatAdminRights $bot_admin_rights  = null
    ): self {
        $data = [
            '_'                 => 'requestPeerTypeChat',
            'creator'           => $creator,
            'has_username'      => $has_username,
            'forum'             => $forum,
            'user_admin_rights' => \is_callable($user_admin_rights) ?  $user_admin_rights(): ChatAdminRights::new()(),
            'bot_admin_rights'  => \is_callable($bot_admin_rights)  ?  $bot_admin_rights() : ChatAdminRights::new()()
        ];
        return new static($data);
    }
}
