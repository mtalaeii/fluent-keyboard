<?php

namespace MTProto\FluentKeyboard\Types;
use MTProto\FluentKeyboard\Keyboard;

class KeyboardMarkup extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyKeyboardMarkup';
    }

    public function persistent(): self
    {
        $this->data['persistent'] = true;
        return $this;
    }
}