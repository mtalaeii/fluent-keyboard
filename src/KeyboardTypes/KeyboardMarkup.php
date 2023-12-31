<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;
use EasyKeyboard\FluentKeyboard\Tools\EasyMarkup;
use EasyKeyboard\FluentKeyboard\Tools\KeyboardDocs;

/**
 * Represents a custom keyboard with reply options
 *
 * @mixin KeyboardDocs
 */
final class KeyboardMarkup extends Keyboard
{
    use EasyMarkup;
    public function __construct()
    {
        $this->data['_'] = 'replyKeyboardMarkup';
    }
}
