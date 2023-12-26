<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard;

final class ChatAdminRights
{
    private array $adminRights = [];

    public function __invoke(): array
    {
        return $this->adminRights;
    }

    public function __construct(array $data)
    {
        $this->adminRights += $data;
    }

    public static function new(
        ?bool $change_info     = null,
        ?bool $post_messages   = null,
        ?bool $edit_messages   = null,
        ?bool $delete_messages = null,
        ?bool $ban_users       = null,
        ?bool $invite_users    = null,
        ?bool $pin_messages    = null,
        ?bool $add_admins      = null,
        ?bool $anonymous       = null,
        ?bool $manage_call     = null,
        ?bool $other           = null,
        ?bool $manage_topics   = null,
    ): self {
        $adminRights = [
            '_' => 'chatAdminRights',
            'change_info'     => $change_info,
            'post_messages'   => $post_messages,
            'edit_messages'   => $edit_messages,
            'delete_messages' => $delete_messages,
            'ban_users'       => $ban_users,
            'invite_users'    => $invite_users,
            'pin_messages'    => $pin_messages,
            'add_admins'      => $add_admins,
            'anonymous'       => $anonymous,
            'manage_call'     => $manage_call,
            'other'           => $other,
            'manage_topics'   => $manage_topics
        ];
        return new static($adminRights);
    }
}
