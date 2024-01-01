<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\ButtonTypes;

use EasyKeyboard\FluentKeyboard\Button;
use Reymon\EasyKeyboard\Tools\InlineChoosePeer;

final class InlineButton extends Button
{
    /**
     * Create Inline button with SwitchInline options.
     *
     * @param string $text Label text on the button
     * @param string $query Data to be sent in a [callback query](https://core.telegram.org/bots/api#callbackquery) to the bot when button is pressed, 1-64 bytes
     * @param bool $same Pressing the button will insert the bot's username and the specified inline query in the current chat's input field
     * @param InlineChoosePeer|null $peerTypes Filter to use when selecting chats.
     */
    public static function SwitchInline(string $text, string $query, bool $same = false, ?InlineChoosePeer $peerTypes = null): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonSwitchInline',
            'text' => $text,
            'query' => $query,
            'same_peer' => $same,
            'peer_types' => $peerTypes ? $peerTypes() : null
        ];
        return new static($data);
    }

    /**
     * Create Inline webapp button.
     *
     * @param string $text Label text on the button
     * @param string $url An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
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
     * @param string $text Label text on the button
     * @param string $url An HTTPS URL used to automatically authorize the user
     * @param int $buttonId Signed 32-bit identifier of the request
     * @param string $fwdText New text of the button in forwarded messages
     */
    public static function Login(string $text, string $url, int $buttonId = 0, ?string $fwdText = null): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonUrlAuth',
            'text' => $text,
            'fwd_text' => $fwdText,
            'url' => $url,
            'button_id' => $buttonId
        ];
        return new static($data);
    }

    /**
     * Create inline button with callback data.
     *
     * @param string $text Label text on the button
     * @param string $callback Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     * @param bool|null $password
     */
    public static function CallBack(string $text, string $callback, ?bool $password = null): InlineButton
    {
        $data = [
            '_' => 'keyboardButtonCallback',
            'text' => $text,
            'data' => $callback,
            'requires_password' => $password
        ];
        return new static($data);
    }

    /**
     * Create Inline button with url.
     *
     * @param string $text Label text on the button
     * @param string $url  HTTP or tg:// URL to be opened when the button is pressed. Links `tg://user?id=<user_id>` can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
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
     * @param string $text Label text on the button
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
     * @param string $text Label text on the button
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
