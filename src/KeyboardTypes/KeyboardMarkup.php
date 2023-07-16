<?php

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Docs\KeyboardDocs;
use EasyKeyboard\FluentKeyboard\Keyboard;

/**
 * @mixin KeyboardDocs
 */
final class KeyboardMarkup extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyKeyboardMarkup';
    }
}