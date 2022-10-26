<?php

namespace Corentin503;

use Corentin503\Events\ItemUseEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    private static Main $main;

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents(new ItemUseEvent(),$this);
    }

    public static function getInstance(): Main
    {
        return self::$main;
    }
}