<?php

namespace EasyKeyboard\FluentKeyboard\Types;

use EasyKeyboard\FluentKeyboard\Keyboard;

final class KeyboardHide extends Keyboard
{
    public function __construct()
    {
        $this->data = ['_' => 'replyKeyboardHide'];
    }
}