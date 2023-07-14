<?php

namespace EasyKeyboard\FluentKeyboard;

final class Button
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

    private static function createButton(string $type, array $data): array
    {
        return ['_' => $type] + $data;
    }

    public function requestContact(): static
    {
        if (array_key_exists('text', $this->keyboard))
            $this->keyboard['_'] = 'keyboardButtonRequestPhone';
        return $this;
    }

    public function requestLocation(): static
    {
        if (array_key_exists('text', $this->keyboard))
            $this->keyboard['_'] = 'keyboardButtonRequestGeoLocation';
        return $this;
    }

    public function callbackData(string $data): static
    {
        if (array_key_exists('text', $this->keyboard)) {
            $this->keyboard['_'] = 'keyboardButtonCallback';
            $this->keyboard['data'] = $data;
        }
        return $this;
    }

    public static function Text(string $text): static
    {
        $data = self::createButton(
            'keyboardButton',
            ['text' => $text]
        );
        return new static($data);
    }

    public static function Url(string $text, string $url): static
    {
        $data = self::createButton(
            'keyboardButtonUrl',
            ['text' => $text, 'url' => $url]
        );
        return new static($data);
    }

    public static function CallBack(string $text, string $callback, $need_password = false): static
    {
        $data = self::createButton(
            'keyboardButtonCallback',
            ['requires_password' => $need_password, 'text' => $text, 'data' => $callback]
        );
        return new static($data);
    }

    public static function Phone(string $text): static
    {
        $data = self::createButton(
            'keyboardButtonRequestPhone',
            ['text' => $text]
        );
        return new static($data);
    }

    public static function Location(string $text): static
    {
        $data = self::createButton(
            'keyboardButtonRequestGeoLocation',
            ['text' => $text]
        );
        return new static($data);
    }

    public static function Game(string $text): static
    {
        $data = self::createButton(
            'keyboardButtonGame',
            ['text' => $text]
        );
        return new static($data);
    }

    public static function Buy(string $text): static
    {
        $data = self::createButton(
            'keyboardButtonBuy',
            ['text' => $text]
        );
        return new static($data);
    }

    public static function Login(string $text, string $url, int $id, string $fwd_text): static
    {
        $data = self::createButton(
            'keyboardButtonUrlAuth',
            [
                'text' => $text,
                'fwd_text' => $fwd_text,
                'url' => $url,
                'button_id' => $id
            ]
        );
        return new static($data);
    }

    public static function Poll(string $text, bool $quiz = false): static
    {
        $data = self::createButton(
            'keyboardButtonRequestPoll',
            ['quiz' => $quiz, 'text' => $text]
        );
        return new static($data);
    }

    public static function Profile(string $text, int $user_id): static
    {
        $data = self::createButton(
            'keyboardButtonUserProfile',
            ['text' => $text, 'user_id' => $user_id]
        );
        return new static($data);
    }

    public static function WebApp(string $text, string $url): static
    {
        $type = basename(get_class(new static)) == 'KeyboardInline'
            ? 'keyboardButtonWebView'
            : 'keyboardButtonSimpleWebView';
        $data = self::createButton(
            $type,
            ['text' => $text, 'url' => $url]
        );
        return new static($data);
    }

    public static function SwitchInline(string $text, string $query, bool $same_peer = true, array $peer_types = []): static
    {
        $data = self::createButton(
            'keyboardButtonSwitchInline',
            ['text' => $text, 'query' => $query, 'same_peer' => $same_peer, 'peer_types' => $peer_types]
        );
        return new static($data);
    }
}
