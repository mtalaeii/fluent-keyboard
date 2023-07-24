<?php

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

class RequestPeerTypeChat extends RequestPeerType
{
    protected static array $data = [];

    protected function setPredict()
    {
        self::$data['_'] = ['requestPeerTypeChat'];
    }

    public static function new(
        bool             $creator = false,
        bool             $has_username = false,
        bool             $forum = false,
        ?ChatAdminRights $user_admin_rights = null,
        ?ChatAdminRights $bot_admin_rights = null
    ): self
    {
        self::$data += [
            'creator' => $creator,
            'has_username' => $has_username,
            'forum' => $forum,
            'user_admin_rights' => is_callable($user_admin_rights) ?  $user_admin_rights(): [],
            'bot_admin_rights' => is_callable($bot_admin_rights) ?  $bot_admin_rights(): []
        ];
        return new static(self::$data);
    }
}