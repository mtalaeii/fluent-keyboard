<?php

namespace EasyKeyboard\FluentKeyboard\Docs;

use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;

interface InlineDocs
{
    /**
     * Create Inline webapp button
     *
     * @param string $text
     * @param string $url
     * @return InlineButton
     */
    public static function WebApp(string $text, string $url): InlineButton;

    /**
     * Create Inline button with SwitchInline options
     *
     * @param string $text
     * @param string $query
     * @param bool $same_peer
     * @param array $peer_types
     * @return InlineButton
     */
    public static function SwitchInline(string $text, string $query, bool $same_peer = true, array $peer_types = []): InlineButton;

    /**
     * Create inline button for login
     *
     * @param string $text
     * @param string $url
     * @param int $id
     * @param string $fwd_text
     * @return InlineButton
     */
    public static function Login(string $text, string $url, int $id, string $fwd_text): InlineButton;

    /**
     * Create inline button with callback data
     *
     * @param string $text
     * @param string $callback
     * @param $need_password
     * @return InlineButton
     */
    public static function CallBack(string $text, string $callback, bool $need_password = false): InlineButton;

    /**
     * Create Inline button with url
     *
     * @param string $text
     * @param string $url
     * @return InlineButton
     */
    public static function Url(string $text, string $url): InlineButton;

}