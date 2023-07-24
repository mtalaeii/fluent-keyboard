<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerType;

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
     * Create Inline webapp button
     *
     * @param string $text
     * @param string $url
     * @return InlineButton
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
     * Create inline button for login
     *
     * @param string $text
     * @param string $url
     * @param int $button_id
     * @param string|null $fwd_text
     * @return InlineButton
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
     * Create inline button with callback data
     *
     * @param string $text
     * @param string $callback
     * @param bool $requires_password
     * @return InlineButton
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
     * Create Inline button with url
     *
     * @param string $text
     * @param string $url
     * @return InlineButton
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
     * Create game button for your inline game
     *
     * @param string $text
     * @return InlineButton
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
     * Create a buy button for your inline buy request(similar to webapps)
     *
     * @param string $text
     * @return InlineButton
     */
    public static function Buy(string $text): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonBuy',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * Create a request peer button
     *
     * @param string $text
     * @param int $button_id
     * @param RequestPeerType $peer_type
     * @return InlineButton
     */
    public static function Peer(string $text, int $button_id, RequestPeerType $peer_type): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonRequestPeer',
            'text' => $text,
            'button_id' => $button_id,
            'peer_type' => $peer_type()
        ];
        return new static($data);
    }
}