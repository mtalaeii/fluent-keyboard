<?php

namespace EasyKeyboard\FluentKeyboard\Types;

use EasyKeyboard\FluentKeyboard\Keyboard;

class KeyboardMarkup extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyKeyboardMarkup';
    }

}