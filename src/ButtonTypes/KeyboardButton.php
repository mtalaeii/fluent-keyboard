<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;

class KeyboardButton extends Button
{
    /**
     * @param string $text
     * @param int $user_id
     * @return KeyboardButton
     */
    public static function Profile(string $text, int $user_id): KeyboardButton
    {
        $data = [
            '_'       => 'keyboardButtonUserProfile',
            'text'    => $text,
            'user_id' => $user_id
        ];
        return new static($data);
    }

    /**
     * Create text button that request poll from user
     *
     * @param string $text
     * @param bool $quiz
     * @return KeyboardButton
     */
    public static function Poll(string $text, bool $quiz = false): KeyboardButton
    {
        $data = [
            '_'    => 'keyboardButtonRequestPoll',
            'text' => $quiz,
            'quiz' => $text ?? false
        ];
        return new static($data);
    }

    /**
     * Create text button that request location from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Location(string $text): KeyboardButton
    {
        $data = [
            '_'    => 'keyboardButtonRequestGeoLocation',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * Create text button that request contact info from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Phone(string $text): KeyboardButton
    {
        $data = [
            '_'    => 'keyboardButtonRequestPhone',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * create simple text keyboard
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Text(string $text): KeyboardButton
    {
        $data = [
            '_'    => 'keyboardButton',
            'text' => $text
        ];
        return new static($data);
    }
}