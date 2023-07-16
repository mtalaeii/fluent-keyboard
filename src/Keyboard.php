<?php

namespace EasyKeyboard\FluentKeyboard;

use ArrayAccess;

abstract class Keyboard
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
        if ((!isset($arguments[0]) || $arguments[0])) {
            $fn = match ($name) {
                'resize',
                'selective' => fn(bool $option = true) => $this->data[$name] = $option,
                'singleUse' => fn(bool $option = true) => $this->data['single_use'] = $option,
                'placeholder' => function (string $placeholder = null) {
                    $length = mb_strlen($placeholder);
                    if (isset($placeholder) && $length >= 0 && $length <= 64) {
                        $this->data['placeholder'] = $placeholder;
                    } elseif ($placeholder != null) {
                        throw new Exception('PLACE_HOLDER_MAX_CHAR');
                    }
                },
                default => throw new Exception(
                    sprintf('Call to undefined method %s::%s()', $this::class, $name)
                )
            };
            isset($arguments[0]) ? $fn($arguments[0]) : $fn();
            return $this;
        }
        throw new Exception(
            sprintf('Call to undefined method %s::%s()', $this::class, $name)
        );
    }

    public function addButton(Button ...$buttons): self
    {
        $row = &$this->data['rows'][$this->currentRowIndex];
        $buttons = array_map(fn($val) => $val(), $buttons);
        $row['buttons'][] = array_shift($buttons);
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
            $this->currentRowIndex++;
        }
        return $this;
    }

    public function Stack(Button ...$button): self
    {
        $counter = 0;
        $count = count($button);
        array_map(function ($button)use(&$counter,$count){
            $this->addButton($button);
            if($count-1 != $counter)$this->row();
            $counter++;
        }, $button);
        return $this;
    }
}
