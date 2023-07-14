<?php

namespace EasyKeyboard\FluentKeyboard\Types;

use EasyKeyboard\FluentKeyboard\Exception;
use EasyKeyboard\FluentKeyboard\Keyboard;

class KeyboardInline extends Keyboard
{
    public function __construct()
    {
        $this->data['_'] = 'replyInlineMarkup';
    }
}