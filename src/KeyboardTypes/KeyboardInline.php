<?php

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;

final class KeyboardInline extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyInlineMarkup';
    }
}