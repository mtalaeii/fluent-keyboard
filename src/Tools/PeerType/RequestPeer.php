<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerType;

use EasyKeyboard\FluentKeyboard\ChatAdminRights;

abstract class RequestPeer
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
            'requestPeerTypeBroadcast' => RequestChannel::new(
                $peerType['creator'] ?? null,
                $peerType['has_username'] ?? null,
                ChatAdminRights::new(...$peerType['user_admin_rights']),
                ChatAdminRights::new(...$peerType['bot_admin_rights'])
            ),
            'requestPeerTypeChat' => RequestGroup::new(
                $peerType['creator'] ?? null,
                $peerType['has_username'] ?? null,
                $peerType['forum'] ?? null,
                ChatAdminRights::new(...$peerType['user_admin_rights']),
                ChatAdminRights::new(...$peerType['bot_admin_rights'])
            ),
            'requestPeerTypeUser' => RequestUser::new($peerType['bot'] ?? null, $peerType['premium'] ?? null)
        };
    }
}
