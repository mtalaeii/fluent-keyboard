<?php

namespace EasyKeyboard\FluentKeyboard;

final class ChatAdminRights
{
    private static array $adminRights = [];
    public function __invoke(): array
    {
        return self::$adminRights;
    }

    public function __construct(array $data)
    {
        self::$adminRights += $data;
    }

    public static function new(
        bool $change_info = true,
        bool $post_messages = true,
        bool $edit_messages = true,
        bool $delete_messages = true,
        bool $ban_users = true,
        bool $invite_users = true,
        bool $pin_messages = true,
        bool $add_admins = true,
        bool $anonymous = true,
        bool $manage_call = true,
        bool $other = true,
        bool $manage_topics = true,
    ): self
    {
        self::$adminRights = [
            '_' => 'chatAdminRights',
            'change_info' => $change_info,
            'post_messages' => $post_messages,
            'edit_messages' => $edit_messages,
            'delete_messages' => $delete_messages,
            'ban_users' => $ban_users,
            'invite_users' => $invite_users,
            'pin_messages' => $pin_messages,
            'add_admins' => $add_admins,
            'anonymous' => $anonymous,
            'manage_call' => $manage_call,
            'other' => $other,
            'manage_topics' => $manage_topics
        ];
        return new static(self::$adminRights);
    }
}