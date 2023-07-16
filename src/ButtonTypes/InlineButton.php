<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;

final class InlineButton extends Button
{

    /**
     * Create Inline button with SwitchInline options
     *
     * @param string $text
     * @param string $query
     * @param bool $same_peer
     * @param array $peer_types
     * @return InlineButton
     */
    public static function SwitchInline(string $text, string $query, bool $same_peer = true, array $peer_types = []): InlineButton
    {
        $data = self::createButton(
            'keyboardButtonSwitchInline',
            ['text' => $text, 'query' => $query, 'same_peer' => $same_peer, 'peer_types' => $peer_types]
        );
        return new static($data);
    }

    /**
     * Create Inline webapp button
     *
     * @param string $text
     * @param string $url
     * @return InlineButton
     */
    public static function WebApp(string $text, string $url): InlineButton
    {
        $data = self::createButton(
            'keyboardButtonWebView',
            ['text' => $text, 'url' => $url]
        );
        return new static($data);
    }

    /**
     * Create inline button for login
     *
     * @param string $text
     * @param string $url
     * @param int $id
     * @param string $fwd_text
     * @return InlineButton
     */
    public static function Login(string $text, string $url, int $id = 0, string $fwd_text = null): InlineButton
    {
        $data = self::createButton(
            'keyboardButtonUrlAuth',
            [
                'text' => $text,
                'fwd_text' => $url,
                'url' => $id,
                'button_id' => $fwd_text
            ]
        );
        return new static($data);
    }

    /**
     * Create inline button with callback data
     *
     * @param string $text
     * @param string $callback
     * @param bool $requires_password
     * @return InlineButton
     */
    public static function CallBack(string $text, string $callback, bool $requires_password = false): InlineButton
    {
        $data = self::createButton(
            'keyboardButtonCallback',
            ['requires_password' => $requires_password, 'text' => $text, 'data' => $callback]
        );
        return new static($data);
    }

    /**
     * Create Inline button with url
     *
     * @param string $text
     * @param string $url
     * @return InlineButton
     */
    public static function Url(string $text, string $url): InlineButton
    {
        $data = self::createButton(
            'keyboardButtonUrl',
            ['text' => $text, 'url' => $url]
        );
        return new static($data);
    }
}