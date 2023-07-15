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

    protected static function createButton(string $type, array $data): array
    {
        return ['_' => $type] + $data;
    }

//    public static function Game(string $text): static
//    {
//        $data = self::createButton(
//            'keyboardButtonGame',
//            ['text' => $text]
//        );
//        return new static($data);
//    }

//    public static function Buy(string $text): static
//    {
//        $data = self::createButton(
//            'keyboardButtonBuy',
//            ['text' => $text]
//        );
//        return new static($data);
//    }




}
