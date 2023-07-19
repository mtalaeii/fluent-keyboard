<?php

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Tools\KeyboardDocs;
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