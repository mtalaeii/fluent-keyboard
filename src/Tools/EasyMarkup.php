<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\ChatAdminRights;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;
use EasyKeyboard\FluentKeyboard\Tools\PeerType\RequestUser;
use EasyKeyboard\FluentKeyboard\Tools\PeerType\RequestGroup;
use EasyKeyboard\FluentKeyboard\Tools\PeerType\RequestChannel;

trait EasyMarkup
{
    /**
     * Create simple text keyboard.
     *
     * @param string $text Label text on the button
     */
    public function addText(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Text($text));
    }

    /**
     * Create simple texts keyboard.
     *
     * @param array $keyboards
     */
    public function addTexts(... $keyboards): KeyboardMarkup
    {
        $callabe = function (array $row): void {
            \array_map($this->addText(...), $row);
            $this->row();
        };
        \array_map($callabe, $keyboards);
        return $this;
    }

    /**
     * Create text button that open web app without requiring user information.
     *
     * @param string $text Label text on the button
     * @param string $url  An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public function addSimpleWebApp(string $text, string $url): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::SimpleWebApp($text, $url));
    }

    /**
     * Create text button that request poll from user.
     *
     * @param string    $text Label text on the button
     * @param bool|null $quiz Whether the user can create polls in the quiz mode
     */
    public function requestPoll(string $text, ?bool $quiz = null): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Poll($text, $quiz));
    }

    /**
     * Create text button that request location from user.
     *
     * @param string $text Label text on the button
     */
    public function requestLocation(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Location($text));
    }

    /**
     * Create text button that request contact info from user.
     *
     * @param string $text Label text on the button
     */
    public function requestPhone(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Phone($text));
    }

    /**
     * Create a request peer user button.
     *
     * @param string    $text     Label text on the button
     * @param int       $buttonId Signed 32-bit identifier of the request
     * @param bool|null $bot      Whether request a bot
     * @param bool|null $premium  Whether request a premium user,
     */
    public function requestUser(string $text, int $buttonId, ?bool $bot = null, ?bool $premium = null): KeyboardMarkup
    {
        $peer = RequestUser::new($bot, $premium);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peer));
    }

    /**
     * Create a request peer chat button.
     *
     * @param string               $text            Label text on the button
     * @param int                  $buttonId        Signed 32-bit identifier of the request
     * @param bool|null            $creator         Whether request a chat owned by the user
     * @param bool|null            $hasUsername     Whether request a supergroup or a channel with a username
     * @param bool|null            $forum           Whether request a forum supergroup
     * @param ChatAdminRights|null $userAdminRights Required administrator rights of the user in the chat
     * @param ChatAdminRights|null $botAdminRights  Required administrator rights of the bot in the chat
     */
    public function requestGroup(string $text, int $buttonId, ?bool $creator = null, ?bool $hasUsername = null, ?bool $forum = null, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): KeyboardMarkup
    {
        $peer = RequestGroup::new($creator, $hasUsername, $forum, $userAdminRights, $botAdminRights);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peer));
    }

    /**
     * Create a request peer broadcast button.
     *
     * @param string               $text            Label text on the button
     * @param int                  $buttonId        Signed 32-bit identifier of the request
     * @param bool|null            $creator         Whether request a channel owned by the user
     * @param bool|null            $hasUsername     Whether request a supergroup or a channel with a username
     * @param ChatAdminRights|null $userAdminRights Required administrator rights of the user in the channel
     * @param ChatAdminRights|null $botAdminRights  Required administrator rights of the bot in the channel
     */
    public function requestChannel(string $text, int $buttonId, ?bool $creator = null, ?bool $hasUsername = null, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): KeyboardMarkup
    {
        $peer = RequestChannel::new($creator, $hasUsername, $botAdminRights, $userAdminRights);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peer));
    }
}
