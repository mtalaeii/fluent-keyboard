<?php

namespace EasyKeyboard\FluentKeyboard\Docs;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;

interface KeyboardButtonDocs
{
    /**
     * @param string $text
     * @param int $user_id
     * @return KeyboardButton
     */
    public static function Profile(string $text, int $user_id): KeyboardButton;

    /**
     * Create text button that request poll from user
     *
     * @param string $text
     * @param bool $quiz
     * @return KeyboardButton
     */
    public static function Poll(string $text, bool $quiz = false): KeyboardButton;

    /**
     * Create text button that request location from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Location(string $text): KeyboardButton;

    /**
     * Create text button that request contact info from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Phone(string $text): KeyboardButton;

}