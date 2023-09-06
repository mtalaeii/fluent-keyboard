<?php

namespace EasyKeyboard\FluentKeyboard;

use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;
use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardForceReply;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardHide;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardInline;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerType;

abstract class Keyboard
{
    protected int $currentRowIndex = 0;
    protected array $data = [
        'rows' => [
            ['_' => 'keyboardButtonRow', 'buttons' => []]
        ]
    ];

    public function build(): array
    {
        $keyboard = &$this->data['rows'];
        if (empty($keyboard[$this->currentRowIndex]['buttons']))
            unset($keyboard[$this->currentRowIndex]);

        return $this->data;
    }

    public static function fromRawReplyMarkup(array $rawReplyMarkup): ?self
    {
        $type = $rawReplyMarkup['_'];
        $rows = array_column($rawReplyMarkup['rows'], 'buttons');
        if (!empty($rows)) {
            $options = array_filter([
                'selective' => $rawReplyMarkup['selective'] ?? null,
                'resize' => $rawReplyMarkup['resize'] ?? null,
                'placeholder' => $rawReplyMarkup['placeholder'] ?? null,
                'singleUse' => $rawReplyMarkup['single_use'] ?? null
            ]);
            /** @var KeyboardMarkup|KeyboardInline $keyboard */
            $keyboard = match ($type) {
                'replyInlineMarkup' => KeyboardInline::new(),
                'replyKeyboardMarkup' => KeyboardMarkup::new()
            };
            foreach ($rows as $row) {
                foreach ($row as $button) {
                    $keyboard->addButton(match ($button['_']) {
                        'keyboardButtonSwitchInline' => InlineButton::SwitchInline($button['text'], $button['query'], $button['same_peer'] ?? false, $button['peer_types'] ?? []),
                        'keyboardButtonWebView' => InlineButton::WebApp($button['text'], $button['url']),
                        'keyboardButtonUrlAuth' => InlineButton::Login($button['text'], $button['url'], $button['button_id'] ?? 0, $button['fwd_text'] ?? ''),
                        'keyboardButtonCallback' => InlineButton::CallBack($button['text'], $button['data'], $button['requires_password'] ?? false),
                        'keyboardButtonUrl' => InlineButton::Url($button['text'], $button['url']),
                        'keyboardButtonGame' => InlineButton::Game($button['text']),
                        'keyboardButtonBuy' => InlineButton::Buy($button['text']),
                        'keyboardButton' => KeyboardButton::Text($button['text']),
                        'keyboardButtonUserProfile' => KeyboardButton::Profile($button['text'], $button['user_id']),
                        'keyboardButtonRequestPoll' => KeyboardButton::Poll($button['text'], $button['quiz'] ?? false),
                        'keyboardButtonRequestGeoLocation' => KeyboardButton::Location($button['text']),
                        'keyboardButtonRequestPhone' => KeyboardButton::Phone($button['text']),
                        'keyboardButtonSimpleWebView' => KeyboardButton::SimpleWebApp($button['text'], $button['url']),
                        'keyboardButtonRequestPeer' => KeyboardButton::Peer($button['text'], $button['button_id'] ?? 0, RequestPeerType::fromRawPeerType($button['peer_type']))
                    });
                }
                $keyboard->row();
            }
            array_walk($options,fn(string|bool $value,string $key) => $keyboard->{$key}($value));
            return $keyboard;
        }

        return match ($type) {
            'replyKeyboardHide' => KeyboardHide::new(),
            'replyKeyboardForceReply' => KeyboardForceReply::new(),
            default => null
        };
    }

    public static function new(): static
    {
        return new static;
    }

    /**
     * @throws Exception
     */
    public function __call(string $name, array $arguments)
    {
        if ((!isset($arguments[0]) || $arguments[0])) {
            $fn = match ($name) {
                'resize',
                'selective' => fn(bool $option = true) => $this->data[$name] = $option,
                'singleUse' => fn(bool $option = true) => $this->data['single_use'] = $option,
                'placeholder' => function (string $placeholder = null) {
                    $length = mb_strlen($placeholder);
                    if (isset($placeholder) && $length >= 0 && $length <= 64) {
                        $this->data['placeholder'] = $placeholder;
                    } elseif ($placeholder != null) {
                        throw new Exception('PLACE_HOLDER_MAX_CHAR');
                    }
                },
                default => throw new Exception(
                    sprintf('Call to undefined method %s::%s()', $this::class, $name)
                )
            };
            isset($arguments[0]) ? $fn($arguments[0]) : $fn();
            return $this;
        }
        throw new Exception(
            sprintf('Call to undefined method %s::%s()', $this::class, $name)
        );
    }

    public function addButton(Button ...$buttons): self
    {
        $row = &$this->data['rows'][$this->currentRowIndex];
        $buttons = array_map(fn($val) => $val(), $buttons);
        $row['buttons'] = array_merge($row['buttons'] ?? [], $buttons);
        return $this;
    }

    public function row(?Button ...$button): self
    {
        $keyboard = &$this->data['rows'];

        // Last row is not empty, add new row
        if (!empty($keyboard[$this->currentRowIndex]['buttons'])) {
            $keyboard[] = [
                '_'       => 'keyboardButtonRow',
                'buttons' => []
            ];
            $this->currentRowIndex++;
        }

        if (!empty($button)) {
            $this->addButton(... $button);
            $this->row();
        }

        return $this;
    }

    public function Stack(Button ...$button): self
    {
        array_map($this->row(...), $button);
        return $this;
    }
}
