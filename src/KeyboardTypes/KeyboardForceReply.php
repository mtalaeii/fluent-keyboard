<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;
use EasyKeyboard\FluentKeyboard\Tools\KeyboardDocs;

/**
 * Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'
 *
 * @mixin KeyboardDocs
 */
final class KeyboardForceReply extends Keyboard
{
    public function __construct()
    {
        $this->data = ['_' => 'replyKeyboardForceReply'];
    }
}
