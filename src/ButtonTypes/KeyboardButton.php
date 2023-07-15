<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;
use EasyKeyboard\FluentKeyboard\Exception;

class KeyboardButton extends Button
{
    /**
     * @throws Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (count($arguments) >= 1) {
            switch ($name) {
                case 'Profile':
                    $data = self::createButton(
                        'keyboardButtonUserProfile',
                        ['text' => $arguments[0], 'user_id' => $arguments[1]]
                    );
                    return new static($data);
                case 'Poll':
                    $data = self::createButton(
                        'keyboardButtonRequestPoll',
                        ['quiz' => $arguments[0] ?? false, 'text' => $arguments[1]]
                    );
                    return new static($data);
                case 'Location':
                    $data = self::createButton(
                        'keyboardButtonRequestGeoLocation',
                        ['text' => $arguments[0]]
                    );
                    return new static($data);
                case 'Phone':
                    $data = self::createButton(
                        'keyboardButtonRequestPhone',
                        ['text' => $arguments[0]]
                    );
                    return new static($data);
                case 'Text':
                    $data = self::createButton(
                        'keyboardButton',
                        ['text' => $arguments[0]]
                    );
                    return new static($data);
                default:
                    throw new Exception(
                        sprintf('Call to undefined method %s()', $name)
                    );
            }
        }
        throw new Exception(
            sprintf('Call to undefined method %s()', $name)
        );
    }

    /**
     * @param string $text
     * @param int $user_id
     * @return KeyboardButton
     */
    public static function Profile(string $text, int $user_id): KeyboardButton
    {
        $data = self::createButton(
            'keyboardButtonUserProfile',
            ['text' => $text, 'user_id' => $user_id]
        );
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
        $data = self::createButton(
            'keyboardButtonRequestPoll',
            ['quiz' => $text ?? false, 'text' => $quiz]
        );
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
        $data = self::createButton(
            'keyboardButtonRequestGeoLocation',
            ['text' => $text]
        );
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
        $data = self::createButton(
            'keyboardButtonRequestPhone',
            ['text' => $text]
        );
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
        $data = self::createButton(
            'keyboardButton',
            ['text' => $text]
        );
        return new static($data);
    }
}