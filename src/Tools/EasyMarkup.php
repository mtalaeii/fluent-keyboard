<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\ChatAdminRights;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeBroadcast;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeChat;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeUser;

trait EasyMarkup
{
    /**
     * create simple text keyboard.
     *
     */
    public function addText(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Text($text));
    }

    /**
     * create simple texts keyboard.
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

    public function addProfile(string $text, int $user_id): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Profile($text, $user_id));
    }

    /**
     * Create text button that open web app without requiring user information.
     *
     */
    public function addSimpleWebApp(string $text, string $url): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::SimpleWebApp($text, $url));
    }

    /**
     * Create text button that request poll from user.
     *
     */
    public function requestPoll(string $text, bool $quiz = false): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Poll($text, $quiz));
    }

    /**
     * Create text button that request location from user.
     *
     */
    public function requestLocation(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Location($text));
    }

    /**
     * Create text button that request contact info from user.
     *
     */
    public function requestPhone(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Phone($text));
    }

    /**
     * Create a request peer user button.
     *
     */
    public function requestUser(string $text, int $button_id, bool $isBot = false, bool $isPremium = false): KeyboardMarkup
    {
        $peerType = RequestPeerTypeUser::new($isBot, $isPremium);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer chat button.
     *
     */
    public function requestChat(
        string $text,
        int  $button_id,
        bool $creator      = false,
        bool $has_username = false,
        bool $forum        = false,
        ?ChatAdminRights $user_admin_rights = null,
        ?ChatAdminRights $bot_admin_rights  = null
    ): KeyboardMarkup {
        $peerType = RequestPeerTypeChat::new(
            $creator,
            $has_username,
            $forum,
            $bot_admin_rights,
            $user_admin_rights
        );
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer broadcast button.
     *
     */
    public function requestChannel(
        string $text,
        int  $button_id,
        bool $creator      = false,
        bool $has_username = false,
        ?ChatAdminRights $user_admin_rights = null,
        ?ChatAdminRights $bot_admin_rights  = null
    ): KeyboardMarkup {
        $peerType = RequestPeerTypeBroadcast::new($creator, $has_username, $bot_admin_rights, $user_admin_rights);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }
}
