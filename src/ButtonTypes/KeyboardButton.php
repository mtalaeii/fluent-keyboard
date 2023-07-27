<?php

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerType;

class KeyboardButton extends Button
{

    /**
     * @param string $text
     * @param int $user_id
     * @return KeyboardButton
     */
    public static function Profile(string $text, int $user_id): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonUserProfile',
            'text' => $text,
            'user_id' => $user_id
        ];
        return new static($data);
    }

    /**
     * Create text button that request poll from user
     *
     * @param string $text
     * @param bool $quiz
     * @return KeyboardButton
     */
    public static function Poll(string $text, bool $quiz = false): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonRequestPoll',
            'text' => $text,
            'quiz' => $quiz
        ];
        return new static($data);
    }

    /**
     * Create text button that request location from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Location(string $text): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonRequestGeoLocation',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * Create text button that request contact info from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Phone(string $text): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonRequestPhone',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * create simple text keyboard
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Text(string $text): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButton',
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * Create text button that open web app without requiring user information
     *
     * @param string $text
     * @param string $url
     * @return KeyboardButton
     */
    public static function SimpleWebApp(string $text, string $url): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonSimpleWebView',
            'text' => $text,
            'url' => $url
        ];
        return new static($data);
    }

    /**
     * Create a request peer button
     *
     * @param string $text
     * @param int $button_id
     * @param RequestPeerType $peer_type
     * @return KeyboardButton
     */
    public static function Peer(string $text, int $button_id, RequestPeerType $peer_type): KeyboardButton
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