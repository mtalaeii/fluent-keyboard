<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools;

use Reymon\EasyKeyboard\Tools\InlineChoosePeer;
use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardInline;

trait EasyInline
{
    /**
     * Create inline button with callback data.
     *
     * @param string $text Label text on the button
     * @param string $callback Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     */
    public function addCallback(string $text, string $callback): KeyboardInline
    {
        return $this->addButton(InlineButton::CallBack($text, $callback));
    }

    /**
     * Create inline buttons with callback data.
     *
     * @param array $keyboards
     */
    public function addCallbacks(... $keyboards): KeyboardInline
    {
        $callabe = function (array $row): void {
            \array_map($this->addCallback(...), \array_keys($row), $row);
            $this->row();
        };
        \array_map($callabe, $keyboards);
        return $this;
    }

    /**
     * Create Inline webapp button.
     *
     * @param string $text Label text on the button
     * @param string $url An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public function addWebApp(string $text, string $url): KeyboardInline
    {
        return $this->addButton(InlineButton::WebApp($text, $url));
    }

    /**
     * Create Inline button with url.
     *
     * @param string $text Label text on the button
     * @param string $url  HTTP or tg:// URL to be opened when the button is pressed. Links `tg://user?id=<user_id>` can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
     */
    public function addUrl(string $text, string $url): KeyboardInline
    {
        return $this->addButton(InlineButton::Url($text, $url));
    }

    /**
     * Create game button for your inline game.
     *
     * @param string $text Label text on the button
     */
    public function addGame(string $text): KeyboardInline
    {
        return $this->addButton(InlineButton::Game($text));
    }

    /**
     * Create a buy button for your inline buy request(similar to webapps).
     *
     * @param string $text Label text on the button
     */
    public function addBuy(string $text): KeyboardInline
    {
        return $this->addButton(InlineButton::Buy($text));
    }

    /**
     * Create Inline button with SwitchInline options.
     *
     * @param string $text Label text on the button
     * @param string $query Data to be sent in a [callback query](https://core.telegram.org/bots/api#callbackquery) to the bot when button is pressed, 1-64 bytes
     * @param bool $same Pressing the button will insert the bot's username and the specified inline query in the current chat's input field
     * @param InlineChoosePeer|null $peerTypes Filter to use when selecting chats.
     */
    public function addSwitchInline(string $text, string $query, bool $same_peer = true, ?InlineChoosePeer $peerTypes = null): KeyboardInline
    {
        return $this->addButton(InlineButton::SwitchInline($text, $query, $same_peer, $peerTypes));
    }
}
