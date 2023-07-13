<?php

namespace MTProto\FluentKeyboard;

trait Buttons
{
    public function createButton(string $type, array $data)
    {
        $current = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => $type] + $data;
    }

    public function buttonText(string $text): self
    {
        $this->createButton(
            'keyboardButton',
            ['text' => $text]
        );
        return $this;
    }

    public function buttonUrl(string $text, string $url): self
    {
        $this->createButton(
            'keyboardButtonUrl',
            ['text' => $text, 'url' => $url]
        );
        return $this;
    }

    public function buttonCallBack(string $text, string $callback, $need_password = false): self
    {
        $this->createButton(
            'keyboardButtonCallback',
            ['requires_password' => $need_password, 'text' => $text, 'data' => $callback]
        );
        return $this;
    }

    public function buttonPhone(string $text): self
    {
        $this->createButton(
            'keyboardButtonRequestPhone',
            ['text' => $text]
        );
        return $this;
    }

    public function buttonLocation(string $text): self
    {
        $this->createButton(
            'keyboardButtonRequestGeoLocation',
            ['text' => $text]
        );
        return $this;
    }

    public function buttonGame(string $text): self
    {
        $this->createButton(
            'keyboardButtonGame',
            ['text' => $text]
        );
        return $this;
    }

    public function buttonBuy(string $text): self
    {
        $this->createButton(
            'keyboardButtonBuy',
            ['text' => $text]
        );
        return $this;
    }

    public function buttonLogin(string $text, string $url, int $id, string $fwd_text): self
    {
        $this->createButton(
            'keyboardButtonUrlAuth',
            [
                'text'      => $text,
                'fwd_text'  => $fwd_text,
                'url'       => $url,
                'button_id' => $id
            ]
        );
        return $this;
    }

    public function buttonPoll(string $text, bool $quiz = false): self
    {
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonRequestPoll', 'quiz' => $quiz, 'text' => $text];
        return $this;
    }

    public function buttonProfile(string $text, int $user_id): self
    {
        $this->createButton(
            'keyboardButtonUserProfile',
            ['text' => $text, 'user_id' => $user_id]
        );
        return $this;
    }

    public function buttonWebApp(string $text, string $url): self
    {
        $type = basename(get_class($this)) == 'KeyboardInline'
            ? 'keyboardButtonWebView'
            : 'keyboardButtonSimpleWebView';
        $this->createButton(
            $type,
            ['text' => $text, 'url' => $url]
        );
        return $this;
    }
}
