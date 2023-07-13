<?php

namespace MTProto\FluentKeyboard;
use ArrayAccess;
abstract class Keyboard implements ArrayAccess
{
    protected static string $buttonType = 'keyboardButtonRow';
    protected array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data + $this->data;
    }


    public function offsetSet($offset, $value):void {
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