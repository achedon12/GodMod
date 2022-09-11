<?php

namespace achedon\godmod;

use achedon\godmod\commands\GodModCMD;
use achedon\godmod\events\PlayerEvents;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Godmod extends PluginBase{

    use SingletonTrait;

    public array $godmod = [];

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        PermissionManager::getInstance()->addPermission(new Permission("use.godmod"));

        $this->getServer()->getCommandMap()->register('commands',new GodModCMD());
        $this->getServer()->getPluginManager()->registerEvents(new PlayerEvents(),$this);
    }
}