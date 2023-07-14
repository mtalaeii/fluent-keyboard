<?php

namespace MTProto\FluentKeyboard\Types;
use MTProto\FluentKeyboard\Keyboard;
use MTProto\FluentKeyboard\Exception;

class KeyboardForceReply extends Keyboard
{
    public function __construct()
    {
        $this->data = [ '_' => 'replyKeyboardForceReply' ];
    }

    final public function resize(): self
    {
        throw new Exception('INVALID_KEYOBARD_OPTION'); 
    }
    
    public function __call($name, $arguments)
    {
        match ($name) {
            'addKeyboard',
            'Row',
            'Stack' => throw new Exception('INVALID_KEYOBARD_METHOD'),
            default => throw new Exception(
                sprintf('Call to undefined method %s::%s()',  get_class($this), $name)
            )
        };
    }
}