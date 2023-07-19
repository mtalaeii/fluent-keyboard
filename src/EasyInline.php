<?php

namespace EasyKeyboard\FluentKeyboard;

use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;

trait EasyInline
{
    public function addCallback(string $text, string $callback)
    {
        return $this->addButton(InlineButton::CallBack($text, $callback));
    }

    public function addWebApp(string $text, string $url)
    {
        return $this->addButton(InlineButton::WebApp($text, $url));
    }

    public function addUrl(string $text, string $url)
    {
        return $this->addButton(InlineButton::Url($text, $url));
    }

    public function addGame(string $text)
    {
        return $this->addButton(InlineButton::Game($text));
    }

    public function addBuy(string $text)
    {
        return $this->addButton(InlineButton::Buy($text));
    }

    public function addSwitchInline(string $text, string $query, bool $same_peer = true)
    {
        return $this->addButton(InlineButton::SwitchInline($text, $query, $same_peer));
    }
}