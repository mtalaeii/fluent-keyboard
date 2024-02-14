<?php declare(strict_types=1);

namespace EasyKeyboard\FluentKeyboard\Tools;

/**
 * Represents filter to use when selecting chats from switch inline.
 */
final class InlineChoosePeer
{
    private array $data = [];

    /**
     * @param bool      $user       Private chat
     * @param bool|null $bot        Private chat with a bot.
     * @param bool|null $chat       [Chat](https://core.telegram.org/api/channel)
     * @param bool|null $supergroup [Supergroup](https://core.telegram.org/api/channel)
     * @param bool|null $channel    [Channel](https://core.telegram.org/api/channel)
     * @param bool|null $same       Private chat with the bot itself
     */
    public function __construct(
        bool  $user = true,
        ?bool $bot = null,
        ?bool $chat = null,
        ?bool $supergroup = null,
        ?bool $channel = null,
        ?bool $same = null,
    ) {
        $this->data = [
            'inlineQueryPeerTypePM' => $user,
            'inlineQueryPeerTypeBotPM' => $bot,
            'inlineQueryPeerTypeChat' => $chat,
            'inlineQueryPeerTypeMegagroup' => $supergroup,
            'inlineQueryPeerTypeBroadcast' => $channel,
            'inlineQueryPeerTypeSameBotPM' => $same,
        ];
    }

    public function __invoke(): array
    {
        return $this->data;
    }

    public static function fromRawChoose(array $rawPeer): self
    {
        $data = [
            'inlineQueryPeerTypePM' => null,
            'inlineQueryPeerTypeBotPM' => null,
            'inlineQueryPeerTypeChat' => null,
            'inlineQueryPeerTypeMegagroup' => null,
            'inlineQueryPeerTypeBroadcast' => null,
            'inlineQueryPeerTypeSameBotPM' => null,
        ];
        foreach ($rawPeer as ['_' => $type])
            $data[$type] = true;

        return new static(...$data);
    }
}
