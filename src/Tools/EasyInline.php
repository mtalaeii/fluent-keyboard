<?php

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardInline;

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
     * Create inline buttons with callback data
     * 
     * @param array $keyboards
     * @return KeyboardInline
     */
    public function addCallbacks(... $keyboards): KeyboardInline
    {
        $callabe = function(array $row)
        {
            array_map($this->addCallback(...), array_keys($row), $row);
            $this->row();
        };
        array_map($callabe, $keyboards);
        return $this;
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
}