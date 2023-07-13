<?php

namespace MTProto\FluentKeyboard;
use ArrayAccess;

abstract class Keyboard implements ArrayAccess
{
    use Options;
    protected int $currentRowIndex = 0;
    protected array $data = [
        'rows' => [
            [ '_' => 'keyboardButtonRow', 'buttons' => [] ]
        ]
    ];

    public function init(): array
    {
        return $this->data;
    }

    public function addKeyboard (Button ... $buttons): self
    {
        $row = &$this->data['rows'][$this->currentRowIndex];
        $row['buttons'] = array_map(fn($val) => $val(), $buttons);
        return $this;
    }

    public function Row(?Button ... $button): self
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
            $this->addKeyboard(...$button);
        }
        return $this;
    }

    public function Stack(Button ... $button): self
    {
        array_map($this->Row(...), $button);
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

    public function offsetUnset($offset) :void
    {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->data[$offset] ?? null;
    }
}