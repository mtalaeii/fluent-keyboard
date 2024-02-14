<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools\PeerType;

use EasyKeyboard\FluentKeyboard\Tools\ChatRights;

abstract class RequestPeer
{
    protected array $types = [];

    protected function __construct(array $data)
    {
        $this->types = $data + $this->types;
    }

    public function __invoke(): array
    {
        return $this->types;
    }

    public static function fromRawPeerType(array $peerType): self
    {
        unset($peerType['user_admin_rights']['_'],$peerType['bot_admin_rights']['_']);
        return match ($peerType['_']) {
            'requestPeerTypeBroadcast' => RequestChannel::new(
                $peerType['creator'] ?? null,
                $peerType['has_username'] ?? null,
                ChatRights::new(...$peerType['user_admin_rights']),
                ChatRights::new(...$peerType['bot_admin_rights'])
            ),
            'requestPeerTypeChat' => RequestGroup::new(
                $peerType['creator'] ?? null,
                $peerType['has_username'] ?? null,
                $peerType['forum'] ?? null,
                ChatRights::new(...$peerType['user_admin_rights']),
                ChatRights::new(...$peerType['bot_admin_rights'])
            ),
            'requestPeerTypeUser' => RequestUser::new($peerType['bot'] ?? null, $peerType['premium'] ?? null)
        };
    }
}
