<?php

namespace achedon\godmod\commands;

use achedon\godmod\Godmod;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\Server;

class GodModCMD extends Command implements PluginOwned
{

    public function __construct()
    {
        $this->setPermission("godmod.command.use");
        parent::__construct("godmod", "enter in godmod", "/godmod", ["god"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$sender instanceof Player) {
            return;
        }
        if (!$sender->hasPermission("godmod.command.use") && !Server::getInstance()->isOp($sender->getName())) {
            $sender->sendMessage("§cYou can't use this command");
            return;
        }
        if (isset(Godmod::getInstance()->godmod[$sender->getName()])) {
            unset(Godmod::getInstance()->godmod[$sender->getName()]);
            $sender->sendMessage("§cYou are not current in godmod");
        } else {
            Godmod::getInstance()->godmod[$sender->getName()] = $sender;
            $sender->sendMessage("§eYou are now in godmod");
        }
    }

    public function getOwningPlugin(): Plugin
    {
        return Godmod::getInstance();
    }
}