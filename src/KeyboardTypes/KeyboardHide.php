<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;

final class KeyboardHide extends Keyboard
{
    public function __construct()
    {
        $this->data = ['_' => 'replyKeyboardHide'];
    }
}
