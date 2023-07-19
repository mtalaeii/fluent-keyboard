<?php

namespace EasyKeyboard\FluentKeyboard;

trait EasyMethod
{
    public static function addCallback(string $text, string $callback)
    {
        $data = [
            '_' => 'keyboardButtonCallback',
            'text' => $text,
            'data' => $callback
        ];
    }
}