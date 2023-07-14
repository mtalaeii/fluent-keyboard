<?php

namespace EasyKeyboard\FluentKeyboard\Types;
use EasyKeyboard\FluentKeyboard\Keyboard;
use EasyKeyboard\FluentKeyboard\Exception;
use EasyKeyboard\FluentKeyboard\Button;

final class KeyboardForceReply extends Keyboard
{
    public function __construct()
    {
        $this->data = [ '_' => 'replyKeyboardForceReply' ];
    }
}