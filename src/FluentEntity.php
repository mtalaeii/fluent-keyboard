<?php

namespace MTProto\FluentKeyboard;
use ArrayAccess;
abstract class FluentEntity implements ArrayAccess
{
    protected static string $buttonType = 'keyboardButtonRow';
    protected array $data = [];

    protected array $defaults = [];

    public function __construct(array $data = [])
    {
        $this->data = $data + $this->data;
    }

    public static function make(): static
    {
        return new static;
    }

    public function __call($name, $arguments): self
    {
        $key = snake_case($name);
        $this->data[$key] = $arguments[0] ?? $this->getDefault($key);

        return $this;
    }

    private function getDefault($key): mixed
    {
        return $this->defaults[$key] ?? null;
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