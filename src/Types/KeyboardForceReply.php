<?php

namespace MTProto\FluentKeyboard\Types;
use MTProto\FluentKeyboard\Keyboard;
use MTProto\FluentKeyboard\Exception;

class KeyboardForceReply extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyKeyboardForceReply';
    }

    final public function resize(): self
    {
        throw new Exception('INVALID_KEYOBARD_OPTION'); 
    }
}