<?php

namespace Corentin503\Events;

use Corentin503\Main;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemFactory;
use pocketmine\utils\Config;

class ItemUseEvent implements Listener
{
    public function onUse(PlayerItemUseEvent $event)
    {
        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml");

        if ($config->get("items")) {
            foreach ($config->get("items") as $items) {
                $arr = explode(":", $items);
                $item = ItemFactory::getInstance()->get($arr[0], $arr[1], 1);

                $player = $event->getPlayer();
                $time = $arr[3] * 20;
                $effect = new EffectInstance(
                    $arr[2],
                    $time,
                    $arr[4],
                    $arr[5]
                );

                $player->getEffects()->add($effect);
                $player->getInventory()->remove($item);
            }
        }
    }
}