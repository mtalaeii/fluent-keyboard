<?php declare(strict_types=1);

/**
 * This file is part of Reymon.
 * Reymon is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * Reymon is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Mahdi <mahdi.talaee1379@gmail.com>
 * @author    AhJ <AmirHosseinJafari8228@gmail.com>
 * @copyright Copyright (c) 2023, ReymonTg
 * @license   https://choosealicense.com/licenses/gpl-3.0/ GPLv3
 */

namespace Reymon\EasyKeyboard\Tools;

final class InlineChoosePeer
{
    private array $data = [];

    public function __construct(
        bool  $users = true,
        ?bool $bots = null,
        ?bool $chats = null,
        ?bool $supergroups = null,
        ?bool $channels = null,
        ?bool $same = null,
    ) {
        $this->data = [
            'inlineQueryPeerTypePM' => $users,
            'inlineQueryPeerTypeBotPM' => $bots,
            'inlineQueryPeerTypeChat' => $chats,
            'inlineQueryPeerTypeMegagroup' => $supergroups,
            'inlineQueryPeerTypeBroadcast' => $channels,
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
