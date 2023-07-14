<?php

namespace MTProto\FluentKeyboard\Types;
use MTProto\FluentKeyboard\Keyboard;
use MTProto\FluentKeyboard\Exception;
use MTProto\FluentKeyboard\Button;

final class KeyboardHide extends Keyboard
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

    final public function addKeyboard(Button ... $buttons): self
    {
        throw new Exception('INVALID_KEYOBARD_METHOD');
    }

    final public function Row(?Button ... $button): self
    {
        throw new Exception('INVALID_KEYOBARD_METHOD');
    }

    final public function Stack(Button ... $button): self
    {
        throw new Exception('INVALID_KEYOBARD_METHOD');

    }
}