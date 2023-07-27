<?php

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
        bool $change_info     = false,
        bool $post_messages   = false,
        bool $edit_messages   = false,
        bool $delete_messages = false,
        bool $ban_users       = false,
        bool $invite_users    = false,
        bool $pin_messages    = false,
        bool $add_admins      = false,
        bool $anonymous       = false,
        bool $manage_call     = false,
        bool $other           = false,
        bool $manage_topics   = false,
    ): self
    {
        $adminRights = [
            '_'               => 'chatAdminRights',
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