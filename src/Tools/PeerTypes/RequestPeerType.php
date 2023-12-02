<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

abstract class RequestPeerType
{
    protected array $types = [];
    public function __invoke(): array
    {
        return $this->types;
    }

    public function __construct(array $data)
    {
        $this->types = $data + $this->types;
    }

    public static function fromRawPeerType(array $peerType): self
    {
        unset($peerType['user_admin_rights']['_'],$peerType['bot_admin_rights']['_']);
        return match ($peerType['_']) {
            'requestPeerTypeBroadcast' => RequestPeerTypeBroadcast::new(
                $peerType['creator'] ?? false,
                $peerType['has_username'] ?? false,
                ChatAdminRights::new(...$peerType['user_admin_rights']),
                ChatAdminRights::new(...$peerType['bot_admin_rights'])
            ),
            'requestPeerTypeChat' => RequestPeerTypeChat::new(
                $peerType['creator'] ?? false,
                $peerType['has_username'] ?? false,
                $peerType['forum'] ?? false,
                ChatAdminRights::new(...$peerType['user_admin_rights']),
                ChatAdminRights::new(...$peerType['bot_admin_rights'])
            ),
            'requestPeerTypeUser' => RequestPeerTypeUser::new($peerType['bot'] ?? false, $peerType['premium'] ?? false)
        };
    }
}
