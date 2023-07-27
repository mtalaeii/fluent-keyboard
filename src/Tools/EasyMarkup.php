<?php

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeUser;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeChat;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeBroadcast;
use EasyKeyboard\FluentKeyboard\ChatAdminRights;
use EasyKeyboard\FluentKeyboard\Keyboard;

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
     * @param string $text
     * @param int $user_id
     * @return KeyboardMarkup
     */
    public function addProfile(string $text, int $user_id): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Profile($text, $user_id));
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
     * Create a request peer user button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardMarkup
     */
    public function requestPeerUser(string $text, int $button_id, bool $isBot = false, bool $isPremium = false): KeyboardMarkup
    {
        $peerType = RequestPeerTypeUser::new($isBot, $isPremium);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer chat button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardMarkup
     */
    public function requestPeerChat(
        string $text,
        int  $button_id,
        bool $creator = false,
        bool $has_username = false,
        bool $forum = false,
        array $user_admin_rights = [],
        array $bot_admin_rights = []): KeyboardMarkup
    {
        $botRights = ChatAdminRights::new(
            ...array_filter($user_admin_rights, 'is_bool')
        );
        $adminRights = ChatAdminRights::new(
           ...array_filter($bot_admin_rights, 'is_bool')
        );
        $peerType = RequestPeerTypeChat::new($creator, $has_username, $forum, $botRights, $adminRights);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer broadcast button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardMarkup
     */
    public function requestPeerBroadcast(
        string $text,
        int  $button_id,
        bool $creator = false,
        bool $has_username = false,
        array $user_admin_rights = [],
        array $bot_admin_rights = []): KeyboardMarkup
    {
        $botRights = ChatAdminRights::new(
            ...array_filter($user_admin_rights, 'is_bool')
        );
        $adminRights = ChatAdminRights::new(
           ...array_filter($bot_admin_rights, 'is_bool')
        );
        $peerType = RequestPeerTypeBroadcast::new($creator, $has_username, $botRights, $adminRights);
        return $this->addButton(KeyboardButton::Peer($text, $button_id, $peerType));
    }
}