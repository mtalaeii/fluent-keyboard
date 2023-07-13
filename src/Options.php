<?php

namespace MTProto\FluentKeyboard;

trait Options {
    public function singleUse(): self
    {
        $this->data['single_use'] = true;
        return $this;  
    }

    public function resize(): self
    {
        $this->data['resize'] = true;
        return $this;  
    }

    public function selective(): self
    {   
        $this->data['selective'] = true;
        return $this;  
    }
    
    public function inputPlaceHolder(string $text): self
    {
        $length = mb_strlen($text);
        if ($length >= 1 && $length <= 64) {
            $this->data['placeholder'] = $text;
            return $this;
        }
        throw new Exception('PLACE_HOLDER_MAX_CHAR');
        return $this;
    }
}