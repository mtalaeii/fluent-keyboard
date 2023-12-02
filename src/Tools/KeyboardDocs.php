<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools;

use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardForceReply;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;

interface KeyboardDocs
{
    /**
     * Make current keyboard to be just used once.
     *
     */
    public function singleUse(bool $singleUse = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Make current keyboard size smaller.
     *
     */
    public function resize(bool $resize = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Make current keyboard selective.
     *
     */
    public function selective(bool $selective = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Create placeholder for current keyboard it can be also empty string.
     *
     */
    public function placeholder(?string $placeholder = null): KeyboardMarkup|KeyboardForceReply;
}
