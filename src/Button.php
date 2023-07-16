<?php

namespace EasyKeyboard\FluentKeyboard;

abstract class Button
{
    private array $keyboard = [];

    public function __invoke()
    {
        return $this->keyboard;
    }

    public function __construct(array $data = [])
    {
        $this->keyboard = $data + $this->keyboard;
    }
}
