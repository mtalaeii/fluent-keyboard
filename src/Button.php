<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard;

abstract class Button
{
    private array $keyboard = [];

    protected function __construct(array $data = [])
    {
        $this->keyboard += \array_filter($data, fn ($v) => !\is_null($v));
    }

    public function __invoke()
    {
        return $this->keyboard;
    }
}
