<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard;

use RangeException;
use OutOfBoundsException;
use Reymon\EasyKeyboard\Tools\InlineChoosePeer;
use EasyKeyboard\FluentKeyboard\ButtonTypes\InlineButton;
use EasyKeyboard\FluentKeyboard\ButtonTypes\KeyboardButton;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardHide;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardInline;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardMarkup;
use EasyKeyboard\FluentKeyboard\Tools\PeerTypes\RequestPeerType;
use EasyKeyboard\FluentKeyboard\KeyboardTypes\KeyboardForceReply;

/**
 * Main class for Keyboard.
 */
abstract class Keyboard
{
    protected int $currentRowIndex = 0;

    protected array $data = [
        'rows' => [
            ['_' => 'keyboardButtonRow', 'buttons' => []]
        ]
    ];

    /**
     * To cast fluent-keyboard to Telegram MTProto keyboard.
     *
     * @return list<array> Telegram MTProto Keyboard
     */
    public function build(): array
    {
        $keyboard = &$this->data['rows'];
        if (empty($keyboard[$this->currentRowIndex]['buttons'])) {
            unset($keyboard[$this->currentRowIndex]);
        }

        return $this->data;
    }

    /**
     * To cast Telegram MTProto keyboard to fluent-keyboard.
     *
     * @param array $rawReplyMarkup array of Telegram MTProto Keyboard
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply|null
     */

    public static function fromRawReplyMarkup(array $rawReplyMarkup): ?self
    {
        $type = $rawReplyMarkup['_'];
        $rows = \array_column($rawReplyMarkup['rows'], 'buttons');
        if (!empty($rows)) {
            $options = \array_filter([
                'selective'   => $rawReplyMarkup['selective'] ?? null,
                'resize'      => $rawReplyMarkup['resize'] ?? null,
                'placeholder' => $rawReplyMarkup['placeholder'] ?? null,
                'singleUse'   => $rawReplyMarkup['single_use'] ?? null
            ]);
            /** @var KeyboardMarkup|KeyboardInline $keyboard */
            $keyboard = match ($type) {
                'replyInlineMarkup' => KeyboardInline::new(),
                'replyKeyboardMarkup' => KeyboardMarkup::new()
            };
            foreach ($rows as $row) {
                foreach ($row as $button) {
                    $keyboard->addButton(match ($button['_']) {
                        'keyboardButton'                   => KeyboardButton::Text($button['text']),
                        'keyboardButtonUserProfile'        => KeyboardButton::Profile($button['text'], $button['user_id']),
                        'keyboardButtonRequestPoll'        => KeyboardButton::Poll($button['text'], $button['quiz'] ?? false),
                        'keyboardButtonRequestGeoLocation' => KeyboardButton::Location($button['text']),
                        'keyboardButtonRequestPhone'       => KeyboardButton::Phone($button['text']),
                        'keyboardButtonSimpleWebView'      => KeyboardButton::SimpleWebApp($button['text'], $button['url']),
                        'keyboardButtonGame'               => InlineButton::Game($button['text']),
                        'keyboardButtonBuy'                => InlineButton::Buy($button['text']),
                        'keyboardButtonWebView'            => InlineButton::WebApp($button['text'], $button['url']),
                        'keyboardButtonUrl'                => InlineButton::Url($button['text'], $button['url']),
                        'keyboardButtonSwitchInline'       => InlineButton::SwitchInline(
                            $button['text'],
                            $button['query'],
                            $button['same_peer'] ?? false,
                            isset($button['peer_types']) ? InlineChoosePeer::fromRawChoose($button['peer_types']) : null
                        ),
                        'keyboardButtonUrlAuth' => InlineButton::Login(
                            $button['text'],
                            $button['url'],
                            $button['button_id'] ?? 0,
                            $button['fwd_text'] ?? ''
                        ),
                        'keyboardButtonCallback' => InlineButton::CallBack(
                            $button['text'],
                            $button['data'],
                            $button['requires_password'] ?? false
                        ),
                        'keyboardButtonRequestPeer' => KeyboardButton::Peer(
                            $button['text'],
                            $button['button_id'] ?? 0,
                            RequestPeerType::fromRawPeerType($button['peer_type'])
                        )
                    });
                }
                $keyboard->row();
            }
            \array_walk($options, fn (string|bool $value, string $key) => $keyboard->{$key}($value));
            return $keyboard;
        }

        return match ($type) {
            'replyKeyboardHide'       => KeyboardHide::new(),
            'replyKeyboardForceReply' => KeyboardForceReply::new(),
            default => null
        };
    }

    /**
     * Create new fluent-keyboard.
     *
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
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
                'selective' => fn (bool $option = true) => $this->data[$name] = $option,
                'singleUse' => fn (bool $option = true) => $this->data['single_use'] = $option,
                'placeholder' => function (string $placeholder = null): void {
                    $length = \mb_strlen($placeholder);
                    if (isset($placeholder) && $length >= 0 && $length <= 64) {
                        $this->data['placeholder'] = $placeholder;
                    } elseif ($placeholder != null) {
                        throw new Exception('PLACE_HOLDER_MAX_CHAR');
                    }
                },
                default => throw new Exception(
                    \sprintf('Call to undefined method %s::%s()', $this::class, $name)
                )
            };
            isset($arguments[0]) ? $fn($arguments[0]) : $fn();
            return $this;
        }
        throw new Exception(
            \sprintf('Call to undefined method %s::%s()', $this::class, $name)
        );
    }

    /**
     * To add button(s) to fluent-keyboard.
     *
     * @param KeyboardButton|InlineButton ...$buttons
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */

    public function addButton(Button ...$buttons): self
    {
        $row = &$this->data['rows'][$this->currentRowIndex];
        $buttons = \array_map(fn ($val) => $val(), $buttons);
        $row['buttons'] = \array_merge($row['buttons'] ?? [], $buttons);
        return $this;
    }

    /**
     * To add a button by it coordinates to fluent-keyboard (Note that coordinates start from 0 look like arrays indexes).
     *
     * @param KeyboardButton|InlineButton ...$buttons
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public function addToCoordinates(int $row, int $column, Button ...$buttons): self
    {
        $buttons = \array_map(fn (Button $button) => $button(), $buttons);
        \array_splice($this->data['rows'][$row]['buttons'], $column, 0, $buttons);
        return $this;
    }

    /**
     * To replace a button by it coordinates to fluent-keyboard (Note that coordinates start from 0 look like arrays indexes).
     *
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     * @throws OutOfBoundsException
     */
    public function replaceIntoCoordinates(int $row, int $column, Button ...$buttons): self
    {
        if (\array_key_exists($row, $this->data['rows']) && \array_key_exists($column, $this->data['rows'][$row]['buttons'])) {
            $buttons = \array_map(fn (Button $button) => $button(), $buttons);
            \array_splice($this->data['rows'][$row]['buttons'], $column, \count($buttons), $buttons);
            return $this;
        }
        throw new OutOfBoundsException("Please be sure that $row and $column exists in array keys!");
    }

    /**
     * To remove button by it coordinates to fluent-keyboard (Note that coordinates start from 0 look like arrays indexes).
     *
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     * @throws OutOfBoundsException
     */
    public function removeFromCoordinates(int $row, int $column, int $count = 1): self
    {
        if (\array_key_exists($row, $this->data['rows']) && \array_key_exists($column, $this->data['rows'][$row]['buttons'])) {
            \array_splice($this->data['rows'][$row]['buttons'], $column, $count);
            $currentRow = $this->data['rows'][$row];
            if (\count($currentRow['buttons']) == 0) {
                \array_splice($this->data['rows'], $row, 1);
            }
            return $this;
        }
        throw new OutOfBoundsException("Please be sure that $row and $column exists in array keys!");
    }

    /**
     * Remove the last button from fluent-keyboard.
     *
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     * @throws RangeException
     */
    public function remove(): self
    {
        if (
            !empty($rows = $this->data['rows']) &&
            !empty($endButtons = \end($rows)['buttons'])
        ) {
            $endRow = \array_keys($rows);
            $endButton = \array_keys($endButtons);
            if (\count($endButtons) == 1) {
                unset($this->data['rows'][\end($endRow)]);
            }
            unset($this->data['rows'][\end($endRow)]['buttons'][\end($endButton)]);
            return $this;
        }
        throw new RangeException("Keyboard array is already empty!");
    }

    /**
     * Add a new raw with specified button ( pass null to only add new row).
     *
     * @param KeyboardButton|InlineButton|null ...$button
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
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

    /**
     * Add specified buttons to fluent-keyboard (each button will add to new row).
     *
     * @param KeyboardButton|InlineButton|null ...$button
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public function Stack(Button ...$button): self
    {
        \array_map($this->row(...), $button);
        return $this;
    }
}
