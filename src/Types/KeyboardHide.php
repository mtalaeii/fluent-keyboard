<?php

namespace MTProto\FluentKeyboard\Types;
use MTProto\FluentKeyboard\Keyboard;
use MTProto\FluentKeyboard\Exception;

class KeyboardHide extends Keyboard
{
    public function __construct()
    {
        $this->data = [ '_' => 'replyKeyboardHide' ];
    }

    final public function singleUse(): self
    {
        throw new Exception('INVALID_KEYOBARD_OPTION');  
    }

    final public function resize(): self
    {
        throw new Exception('INVALID_KEYOBARD_OPTION'); 
    }

    final public function inputPlaceHolder(string $text): self
    {
        throw new Exception('INVALID_KEYOBARD_OPTION'); 
    }
}