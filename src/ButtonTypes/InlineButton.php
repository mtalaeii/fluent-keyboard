<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\{Button, Exception};
use EasyKeyboard\FluentKeyboard\Docs\InlineDocs;

/**
 * @mixin InlineDocs
 */
final class InlineButton extends Button
{
    /**
     * @throws Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if(count($arguments) >= 2){
            switch ($name){
                case 'SwitchInline':
                    $data = self::createButton(
                        'keyboardButtonSwitchInline',
                        ['text' => $arguments[0], 'query' => $arguments[1], 'same_peer' => $arguments[2] ?? true, 'peer_types' => $arguments[3]] ?? []
                    );
                    return new static($data);
                case 'WebApp':
                    $type = basename(get_class(new static)) == 'KeyboardInline'
                        ? 'keyboardButtonWebView'
                        : 'keyboardButtonSimpleWebView';
                    $data = self::createButton(
                        $type,
                        ['text' => $arguments[0], 'url' => $arguments[1]]
                    );
                    return new static($data);

                case 'Login':
                    $data = self::createButton(
                        'keyboardButtonUrlAuth',
                        [
                            'text' => $arguments[0],
                            'fwd_text' => $arguments[3],
                            'url' => $arguments[1],
                            'button_id' => $arguments[2]
                        ]
                    );
                    return new static($data);
                case 'CallBack':
                    $data = self::createButton(
                        'keyboardButtonCallback',
                        ['requires_password' => $arguments[3] ?? false, 'text' => $arguments[0], 'data' => $arguments[1]]
                    );
                    return new static($data);

                case 'Url':
                    $data = self::createButton(
                        'keyboardButtonUrl',
                        ['text' => $arguments[0], 'url' => $arguments[1]]
                    );
                    return new static($data);
                default:
                    throw new Exception(
                        sprintf('Call to undefined method %s()', $name)
                    );
            }
        }
        throw new Exception(
            sprintf('Call to undefined method %s()', $name)
        );
    }

}