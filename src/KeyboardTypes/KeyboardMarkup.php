<?php

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;
use EasyKeyboard\FluentKeyboard\Tools\{KeyboardDocs, EasyMarkup};

/**
 * @mixin KeyboardDocs
 */
final class KeyboardMarkup extends Keyboard
{
    use EasyMarkup;
    public function __construct()
    {
        $this->data['_'] = 'replyKeyboardMarkup';
    }
}