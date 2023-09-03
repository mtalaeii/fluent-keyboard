<?php

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeUser;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeChat;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeBroadcast;
use EasyKeyboard\FluentKeyboard\ChatAdminRights;

trait EasyMarkup
{
    /**
     * create simple text keyboard
     *
     * @param string $text
     * @return KeyboardMarkup
     */
    public function addText(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Text($text));
    }

    /**
     * create simple texts keyboard
     * 
     * @param array $keyboards
     * @return KeyboardMarkup
     */
    public function addTexts(... $keyboards): KeyboardMarkup
    {
        $callabe = function(array $row)
        {
            array_map($this->addText(...), $row);
            $this->row();
        };
        array_map($callabe, $keyboards);
        return $this;
    }

    /**
     * @param string $text
     * @param int $user_id
     * @return KeyboardMarkup
     */
    public function addProfile(string $text, int $user_id): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Profile($text, $user_id));
    }
    
    /**
     * Create text button that open web app without requiring user information
     *
     * @param string $text
     * @param string $url
     * @return KeyboardMarkup
     */
    public function addSimpleWebApp(string $text, string $url): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::SimpleWebApp($text, $url));
    }
    

    /**
     * Create text button that request poll from user
     *
     * @param string $text
     * @param bool $quiz
     * @return KeyboardMarkup
     */
    public function requestPoll(string $text, bool $quiz = false): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Poll($text, $quiz));
    }

    /**
     * Create text button that request location from user
     *
     * @param string $text
     * @return KeyboardMarkup
     */
    public function requestLocation(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Location($text));
    }

    /**
     * Create text button that request contact info from user
     *
     * @param string $text
     * @return KeyboardMarkup
     */
    public function requestPhone(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Phone($text));
    }

    /**
     * Create a request peer user button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardMarkup
     */
    public function requestUser(string $text, int $button_id, bool $isBot = false, bool $isPremium = false): KeyboardMarkup
    {
        $peerType = RequestPeerTypeUser::new($isBot, $isPremium);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer chat button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $creator
     * @param bool $has_username
     * @param bool $forum
     * @param ChatAdminRights|null $user_admin_rights
     * @param ChatAdminRights|null $bot_admin_rights
     * @return KeyboardMarkup
     */
    public function requestChat(
        string $text,
        int  $button_id,
        bool $creator      = false,
        bool $has_username = false,
        bool $forum        = false,
        ?ChatAdminRights $user_admin_rights = null,
        ?ChatAdminRights $bot_admin_rights  = null): KeyboardMarkup
    {
        $peerType = RequestPeerTypeChat::new(
            $creator, $has_username, $forum,
            $bot_admin_rights, $user_admin_rights
        );
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer broadcast button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $creator
     * @param bool $has_username
     * @param ChatAdminRights|null $user_admin_rights
     * @param ChatAdminRights|null $bot_admin_rights
     * @return KeyboardMarkup
     */
    public function requestChannel(
        string $text,
        int  $button_id,
        bool $creator      = false,
        bool $has_username = false,
        ?ChatAdminRights $user_admin_rights = null,
        ?ChatAdminRights $bot_admin_rights  = null): KeyboardMarkup
    {
        $peerType = RequestPeerTypeBroadcast::new($creator, $has_username, $bot_admin_rights, $user_admin_rights);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }
}