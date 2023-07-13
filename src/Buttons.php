<?php

namespace MTProto\FluentKeyboard;

trait Buttons {
    public function buttonText(string $text): self
    {
        $current = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButton', 'text' => $text];

        return $this;
    }

    public function buttonUrl(string $text, string $url): self
    {
        $current = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonUrl', 'text' => $text, 'url' => $url];

        return $this;
    }

    public function buttonCallBack(string $text, string $callback, $need_password = false): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonCallback', 'requires_password' => $need_password, 'text' => $text, 'data' => $callback];
        return $this;
    }

    public function buttonPhone(string $text): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonRequestPhone', 'text' => $text];
        return $this;
    }

    public function buttonLocation(string $text): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonRequestGeoLocation', 'text' => $text];
        return $this;
    }

    public function buttonGame(string $text): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonGame', 'text' => $text];
        return $this;
    }

    public function buttonBuy(string $text): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonBuy', 'text' => $text];
        return $this;
    }

    public function buttonLogin(string $text, string $url, int $id, string $fwd_text): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = [
            '_'         => 'keyboardButtonUrlAuth',
            'text'      => $text,
            'fwd_text'  => $fwd_text,
            'url'       => $url,
            'button_id' => $id
        ];
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
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonUserProfile', 'text' => $text, 'user_id' => $user_id];
        return $this;
    }

    // TODO: Add Inline Support
    public function buttonWebApp(string $text, string $url): self
    {       
        $current   = &$this->data['rows'][$this->currentRowIndex]['buttons'];
        $current[] = ['_' => 'keyboardButtonWebView', 'text' => $text, 'url' => $url];
        return $this;
    }
}