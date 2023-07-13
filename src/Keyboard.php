<?php

namespace MTProto\FluentKeyboard;
use ArrayAccess;

abstract class Keyboard implements ArrayAccess
{
    use Buttons;
    protected array $data = [
        'rows' => [
            [ '_' => 'keyboardButtonRow', 'buttons' => [] ]
        ]
    ];

    protected int $currentRowIndex = 0;

    public function init(): array
    {
        return $this->data;
    }

    public function singleUse(): self
    {
        $this->data['single_use'] = true;
        return $this;  
    }

    public function resize(): self
    {
        $this->data['resize'] = true;
        return $this;  
    }

    public function selective(): self
    {   
        $this->data['selective'] = true;
        return $this;  
    }
    
    public function inputPlaceHolder(string $text): self
    {
        $length = mb_strlen($text);
        if ($length >= 1 && $length <= 64) {
            $this->data['placeholder'] = $text;
            return $this;
        }
        throw new Exception('PLACE_HOLDER_MAX_CHAR');
        return $this;
    }
    public function row(): self
    {
        $keyboard = &$this->data['rows'];

        // Last row is not empty, add new row
        if (!empty($keyboard[$this->currentRowIndex])) {
            $keyboard[] = [
                '_' => 'keyboardButtonRow',
                'buttons' => []
            ];
            $this->currentRowIndex++;
        }
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