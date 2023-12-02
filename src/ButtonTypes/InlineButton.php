<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;

final class InlineButton extends Button
{
    /**
     * Create Inline button with SwitchInline options.
     *
     */
    public static function SwitchInline(string $text, string $query, bool $same_peer = true, array $peer_types = []): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonSwitchInline',
            'text' => $text,
            'query' => $query,
            'same_peer' => $same_peer,
            'peer_types' => $peer_types
        ];
        return new static($data);
    }

    /**
     * Create Inline webapp button.
     *
     */
    public static function WebApp(string $text, string $url): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonWebView',
            'text' => $text,
            'url' => $url
        ];
        return new static($data);
    }

    /**
     * Create inline button for login.
     *
     */
    public static function Login(string $text, string $url, int $button_id = 0, ?string $fwd_text = null): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonUrlAuth',
            'text' => $text,
            'fwd_text' => $fwd_text,
            'url' => $url,
            'button_id' => $button_id
        ];
        return new static($data);
    }

    /**
     * Create inline button with callback data.
     *
     */
    public static function CallBack(string $text, string $callback, bool $requires_password = false): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonCallback',
            'text' => $text,
            'data' => $callback,
            'requires_password' => $requires_password
        ];
        return new static($data);
    }

    /**
     * Create Inline button with url.
     *
     */
    public static function Url(string $text, string $url): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonUrl',
            'text' => $text,
            'url' => $url
        ];
        return new static($data);
    }

    /**
     * Create game button for your inline game.
     *
     */
    public static function Game(string $text): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonGame',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * Create a buy button for your inline buy request(similar to webapps).
     *
     */
    public static function Buy(string $text): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonBuy',
            'text' => $text
        ];
        return new static($data);
    }
}
