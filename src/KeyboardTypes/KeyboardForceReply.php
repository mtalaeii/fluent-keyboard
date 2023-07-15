<?php

namespace EasyKeyboard\FluentKeyboard\Types;

use EasyKeyboard\FluentKeyboard\Docs\KeyboardDocs;
use EasyKeyboard\FluentKeyboard\Keyboard;

/**
 * @mixin KeyboardDocs
 */
final class KeyboardForceReply extends Keyboard
{
    public function __construct()
    {
        $this->data = ['_' => 'replyKeyboardForceReply'];
    }
}