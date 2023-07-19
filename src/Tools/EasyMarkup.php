<?php

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;

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
}