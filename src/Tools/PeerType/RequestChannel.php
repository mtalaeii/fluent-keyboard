<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerType;

use EasyKeyboard\FluentKeyboard\Tools\ChatRights;

/**
 * Pressing the button will open a list of suitable channels. Tapping on a chat will send its identifier to the bot
 */
final class RequestChannel extends RequestPeer
{
    /**
     * @param bool|null       $creator         Whether request a channel owned by the user
     * @param bool|null       $hasUsername     Whether request a supergroup or a channel with a username
     * @param ChatRights|null $userAdminRights Required administrator rights of the user in the channel
     * @param ChatRights|null $botAdminRights  Required administrator rights of the bot in the channel
     */
    public static function new(
        ?bool $creator = null,
        ?bool $hasUsername = null,
        ?ChatRights $userAdminRights = null,
        ?ChatRights $botAdminRights = null
    ): self {
        $data = [
            '_' => 'requestPeerTypeBroadcast',
            'creator' => $creator,
            'has_username' => $hasUsername,
            'user_admin_rights' => $userAdminRights instanceof ChatRights ? $userAdminRights() : null,
            'bot_admin_rights'  => $botAdminRights  instanceof ChatRights ? $botAdminRights() : null
        ];
        return new static($data);
    }
}
