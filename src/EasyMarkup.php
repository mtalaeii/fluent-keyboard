<?php

namespace EasyKeyboard\FluentKeyboard;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;

trait EasyMarkup
{
    public function addText(string $text)
    {
        return $this->addButton(KeyboardButton::Text($text));
    }

    public function addProfile(string $text, int $user_id)
    {
        return $this->addButton(KeyboardButton::Profile($text, $user_id));
    }

    public function addPoll(string $text, bool $quiz = false)
    {
        return $this->addButton(KeyboardButton::Poll($text, $quiz));
    }

    public function addLocation(string $text)
    {
        return $this->addButton(KeyboardButton::Location($text));
    }

    public function addPhone(string $text)
    {
        return $this->addButton(KeyboardButton::Phone($text));
    }

    public function addSimpleWebApp(string $text, string $url)
    {
        return $this->addButton(KeyboardButton::SimpleWebApp($text, $url));
    }
}