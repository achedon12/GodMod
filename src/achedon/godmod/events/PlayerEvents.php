<?php

namespace achedon\godmod\events;

use achedon\godmod\Godmod;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;

class PlayerEvents implements Listener{

    public function onDamage(EntityDamageEvent $event){
        $entity = $event->getEntity();
        if($entity instanceof Player){
            if(isset(Godmod::getInstance()->godmod[$entity->getName()])){
                $event->cancel();
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event){
        if(isset(Godmod::getInstance()->godmod[$event->getPlayer()->getName()])){
            unset(Godmod::getInstance()->godmod[$event->getPlayer()->getName()]);
        }
    }
}