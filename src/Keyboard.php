<?php

namespace EasyKeyboard\FluentKeyboard;

use EasyKeyboard\FluentKeyboard\Types\{KeyboardMarkup, KeyboardForceReply};
use ArrayAccess;

/**
 * Abstract keyboard class
 *
 * @method self singleUse(bool $singleUse = true)
 * @method self resize(bool $resize = true)
 * @method self selective(bool $selective = true)
 * @method self placeholder(bool $placeholder = null)
 */
abstract class Keyboard implements ArrayAccess
{
    protected int $currentRowIndex = 0;
    protected array $data = [
        'rows' => [
            ['_' => 'keyboardButtonRow', 'buttons' => []]
        ]
    ];

    public function init(): array
    {
        return $this->data;
    }

    public static function make(): static
    {
        return new static;
    }

    /**
     * @throws Exception
     */
    public function __call(string $name, array $arguments)
    {
        if (in_array(get_class($this), [KeyboardMarkup::class, KeyboardForceReply::class]) && ($arguments[0] || !isset($arguments[0]))) {
            $fn = match ($name) {
                'singleUse' => fn(bool $singleUse) => $this->data['singleUse'] = $singleUse,

                'resize'    => fn(bool $resize = true) => $this->data['resize']    = $resize,

                'selective' => fn(bool $selective = true) => $this->data['selective'] = $selective,

                'placeholder' => function (string $placeholder = null) {
                    $length = mb_strlen($placeholder);
                    if (isset($placeholder) && $length >= 0 && $length <= 64) {
                        $this->data['placeholder'] = $placeholder;
                    } elseif ($placeholder != null) {
                        throw new Exception('PLACE_HOLDER_MAX_CHAR');
                    }
                },
                default => throw new Exception(
                    sprintf('Call to undefined method %s::%s()', get_class($this), $name)
                )
            };
            isset($arguments[0]) ? $fn($arguments[0]) : $fn();
            return $this;
        }
        throw new Exception(
            sprintf('Call to undefined method %s::%s()', get_class($this), $name)
        );
    }

    public function addButton(Button ...$buttons): self
    {
        $row = &$this->data['rows'][$this->currentRowIndex];
        $row['buttons'] = array_map(fn($val) => $val(), $buttons);
        return $this;
    }

    public function row(?Button ...$button): self
    {
        $keyboard = &$this->data['rows'];

        // Last row is not empty, add new row
        if (!empty($keyboard[$this->currentRowIndex]['buttons'])) {
            $keyboard[] = [
                '_' => 'keyboardButtonRow',
                'buttons' => []
            ];
            $this->currentRowIndex++;
        }

        if (!empty($button)) {
            $this->addButton(...$button);
        }
        return $this;
    }

    public function Stack(Button ...$button): self
    {
        array_map($this->row(...), $button);
        return $this;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->data[$offset] ?? null;
    }
}
