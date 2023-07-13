<?php

namespace MTProto\FluentKeyboard;

abstract class KeyboardMarkup extends FluentEntity
{

    /**
     * Defines the field name that contains the rows and buttons.
     *
     * @var string
     */
    protected static string $keyboardFieldName = 'keyboard';

    protected int $currentRowIndex = 0;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        // Make sure we have one empty row from the beginning
        $this->data = [
            '_' => static::$keyboardFieldName,
            'rows' => [[]]
        ];
    }

    /**
     * Adds a new row to the keyboard.
     *
     * @param  Button[]  $buttons
     * @return $this
     */
    public function row(array $buttons = []): self
    {
        $keyboard = &$this->data['rows'];

        // Last row is not empty, add new row
        if (! empty($keyboard[$this->currentRowIndex])) {
            $keyboard[] = [];
            $this->currentRowIndex++;
        }

        // Buttons have been passed, add them
        if (! empty($buttons)) {
            $keyboard[$this->currentRowIndex] = $buttons;
            $this->currentRowIndex++;
        }

        return $this;
    }


    /**
     * Adds a button to the last row.
     *
     * @param  Button  $button
     * @return $this
     */
    public function button(Button $button): self
    {
        $keyboard = &$this->data['rows'];
        $keyboard[$this->currentRowIndex]['_'] = self::$buttonType;
        $keyboard[$this->currentRowIndex]['buttons'][] = $button;
        return $this;
    }

}