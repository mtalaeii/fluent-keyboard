<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;

/**
 * Requests clients to remove the custom keyboard (user will not be able to summon this keyboard; if you want to hide the keyboard from sight but keep it accessible, use one_time_keyboard
 */
final class KeyboardHide extends Keyboard
{
    public function __construct()
    {
        $this->data = ['_' => 'replyKeyboardHide'];
    }
}
