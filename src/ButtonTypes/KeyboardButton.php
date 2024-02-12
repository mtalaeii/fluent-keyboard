<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;
use EasyKeyboard\FluentKeyboard\Tools\PeerType\RequestPeer;

class KeyboardButton extends Button
{
    /**
     * @param string $text Label text on the button
     *
     */
    public static function Profile(string $text, int $userId): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonUserProfile',
            'text' => $text,
            'user_id' => $userId
        ];
        return new static($data);
    }

    /**
     * Create text button that request poll from user.
     *
     * @param string $text Label text on the button
     * @param bool|null $quiz Whether the user can create polls in the quiz mode
     */
    public static function Poll(string $text, ?bool $quiz = null): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonRequestPoll',
            'text' => $text,
            'quiz' => $quiz
        ];
        return new static($data);
    }

    /**
     * Create text button that request location from user.
     *
     * @param string $text Label text on the button
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
     * Create text button that request contact info from user.
     *
     * @param string $text Label text on the button
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
     * create simple text keyboard.
     *
     * @param string $text Label text on the button
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
     * Create text button that open web app without requiring user information.
     *
     * @param string $text Label text on the button
     * @param string $url An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
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
     * Create a request peer button.
     *
     * @param string $text Label text on the button
     * @param int $buttonId Signed 32-bit identifier of the request
     * @param RequestPeer $peerType Pressing the button will open a list of suitable chats. Tapping on a chat will send its identifier to the bot
     */
    public static function Peer(string $text, int $buttonId, RequestPeer $peerType): KeyboardButton
    {
        $data = [
            '_' => 'keyboardButtonRequestPeer',
            'text' => $text,
            'button_id' => $buttonId,
            'peer_type' => $peerType()
        ];
        return new static($data);
    }
}
