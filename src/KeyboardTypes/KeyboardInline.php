<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\KeyboardTypes;

use EasyKeyboard\FluentKeyboard\Keyboard;
use EasyKeyboard\FluentKeyboard\Tools\EasyInline;

/**
 * Represents an inline keyboard that appears right next to the message it belongs to.
 */
final class KeyboardInline extends Keyboard
{
    use EasyInline;
    public function __construct()
    {
        $this->data['_'] = 'replyInlineMarkup';
    }
}
