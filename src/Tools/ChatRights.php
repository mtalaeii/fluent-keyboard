<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools;

final class ChatRights
{
    private array $adminRights = [];

    private function __construct(array $data)
    {
        $this->adminRights +=  \array_filter($data, fn ($v) => !\is_null($v));
    }

    public function __invoke(): array
    {
        return $this->adminRights;
    }

    public static function new(
        ?bool $changeInfo     = null,
        ?bool $postMessages   = null,
        ?bool $editMessages   = null,
        ?bool $deleteMessages = null,
        ?bool $banUsers       = null,
        ?bool $inviteUsers    = null,
        ?bool $pinMessages    = null,
        ?bool $addAdmins      = null,
        ?bool $anonymous      = null,
        ?bool $manageCall     = null,
        ?bool $other          = null,
        ?bool $manageTopics   = null,
    ): self {
        $adminRights = [
            '_' => 'chatAdminRights',
            'change_info'     => $changeInfo,
            'post_messages'   => $postMessages,
            'edit_messages'   => $editMessages,
            'delete_messages' => $deleteMessages,
            'ban_users'       => $banUsers,
            'invite_users'    => $inviteUsers,
            'pin_messages'    => $pinMessages,
            'add_admins'      => $addAdmins,
            'anonymous'       => $anonymous,
            'manage_call'     => $manageCall,
            'other'           => $other,
            'manage_topics'   => $manageTopics
        ];
        return new static($adminRights);
    }
}
