<?php

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\KeyboardTypes\{KeyboardForceReply, KeyboardMarkup};

interface KeyboardDocs
{

    /**
     * Make current keyboard to be just used once
     *
     * @param bool $singleUse
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function singleUse(bool $singleUse = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Make current keyboard size smaller
     *
     * @param bool $resize
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function resize(bool $resize = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Make current keyboard selective
     *
     * @param bool $selective
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function selective(bool $selective = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Create placeholder for current keyboard it can be also empty string
     *
     * @param bool|null $placeholder
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function placeholder(?bool $placeholder = null): KeyboardMarkup|KeyboardForceReply;


}