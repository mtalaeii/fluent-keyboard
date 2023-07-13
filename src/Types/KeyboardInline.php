<?php

namespace MTProto\FluentKeyboard\Types;

use MTProto\FluentKeyboard\Exception;
use MTProto\FluentKeyboard\Keyboard;

class KeyboardInline extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyInlineMarkup';
    }

    public function __call($name, $arguments)
    {
        match ($name) {
            'singleUse',
            'resize',
            'selective',
            'inputPlaceHolder' => throw new Exception('INVALID_KEYOBARD_OPTION'),
            default => throw new Exception(
                sprintf('Call to undefined method %s::%s()',  get_class($this), $name)
            )
        };
    }
}