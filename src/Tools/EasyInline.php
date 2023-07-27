<?php

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardInline;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeUser;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeChat;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerTypeBroadcast;
use EasyKeyboard\FluentKeyboard\ChatAdminRights;

trait EasyInline
{

    /**
     * Create inline button with callback data
     *
     * @param string $text
     * @param string $callback
     * @return KeyboardInline
     */
    public function addCallback(string $text, string $callback): KeyboardInline
    {
        return $this->addButton(InlineButton::CallBack($text, $callback));
    }

    /**
     * Create Inline webapp button
     *
     * @param string $text
     * @param string $url
     * @return KeyboardInline
     */
    public function addWebApp(string $text, string $url): KeyboardInline
    {
        return $this->addButton(InlineButton::WebApp($text, $url));
    }

    /**
     * Create Inline button with url
     *
     * @param string $text
     * @param string $url
     * @return KeyboardInline
     */
    public function addUrl(string $text, string $url): KeyboardInline
    {
        return $this->addButton(InlineButton::Url($text, $url));
    }


    /**
     * Create game button for your inline game
     *
     * @param string $text
     * @return KeyboardInline
     */
    public function addGame(string $text): KeyboardInline
    {
        return $this->addButton(InlineButton::Game($text));
    }


    /**
     * Create a buy button for your inline buy request(similar to webapps)
     *
     * @param string $text
     * @return KeyboardInline
     */
    public function addBuy(string $text): KeyboardInline
    {
        return $this->addButton(InlineButton::Buy($text));
    }


    /**
     * Create Inline button with SwitchInline options
     *
     * @param string $text
     * @param string $query
     * @param bool $same_peer
     * @param array $peer_types
     * @return KeyboardInline
     */
    public function addSwitchInline(string $text, string $query, bool $same_peer = true, array $peer_types = []): KeyboardInline
    {
        return $this->addButton(InlineButton::SwitchInline($text, $query, $same_peer, $peer_types));
    }

    /**
     * Create a request peer user button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardInline
     */
    public function requestPeerUser(string $text, int $button_id, bool $isBot = false, bool $isPremium = false): KeyboardInline
    {
        $peerType = RequestPeerTypeUser::new($isBot, $isPremium);
        return $this->addButton(InlineButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer chat button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardInline
     */
    public function requestPeerChat(
        string $text,
        int  $button_id,
        bool $creator = false,
        bool $has_username = false,
        bool $forum = false,
        ?array $user_admin_rights = null,
        ?array $bot_admin_rights = null): KeyboardInline
    {
        $botRights = ChatAdminRights::new(
            ...array_filter($user_admin_rights, 'is_bool')
        );
        $adminRights = ChatAdminRights::new(
           ...array_filter($bot_admin_rights, 'is_bool')
        );
        $peerType = RequestPeerTypeChat::new($creator, $has_username, $forum, $botRights, $adminRights);
        return $this->addButton(InlineButton::Peer($text, $button_id, $peerType));
    }

    /**
     * Create a request peer broadcast button
     *
     * @param string $text
     * @param int $button_id
     * @param bool $isBot
     * @param bool $isPremium
     * @return KeyboardInline
     */
    public function requestPeerBroadcast(
        string $text,
        int  $button_id,
        bool $creator = false,
        bool $has_username = false,
        ?array $user_admin_rights = null,
        ?array $bot_admin_rights = null): KeyboardInline
    {
        $botRights = ChatAdminRights::new(
            ...array_filter($user_admin_rights, 'is_bool')
        );
        $adminRights = ChatAdminRights::new(
           ...array_filter($bot_admin_rights, 'is_bool')
        );
        $peerType = RequestPeerTypeBroadcast::new($creator, $has_username, $botRights, $adminRights);
        return $this->addButton(InlineButton::Peer($text, $button_id, $peerType));
    }
}