<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;
use EasyKeyboard\FluentKeyboard\Docs\KeyboardButtonDocs;
use EasyKeyboard\FluentKeyboard\Exception;

/**
 * @mixin KeyboardButtonDocs
 */
class KeyboardButton extends Button
{
    /**
     * @throws Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if(count($arguments) >= 1){
            switch ($name){
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
}