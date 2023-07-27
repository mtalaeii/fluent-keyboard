<?php

namespace EasyKeyboard\FluentKeyboard\Tools\PeerTypes;
abstract class RequestPeerType
{
    protected array $types = [];
    protected abstract function setPredict();
    public function __invoke(): array
    {
        return $this->types;
    }

    public function __construct(array $data)
    {
        $this->types = $data + $this->types;
    }
}