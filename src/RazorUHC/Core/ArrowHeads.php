<?php
namespace Core;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat as TF;
class Main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getServer()->getLogger()->info(TF::GREEN." Enabled!");
	}
	public function onDisable(){
		$this->getServer()->getLogger()->info(TF::RED."Disabled!");
	}
	public function onHit(EntityDamageEvent $ev){
		$player = $ev->getEntity();
		$cause = $player->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent && $ev->getCause() === EntityDamageEvent::CAUSE_PROJECTILE){
			$damager = $cause->getDamager();
			$damager->sendMessage(TF::GOLD.$player->getName().TF::DARK_PURPLE." has ".TF::RED.$player->getHealth().TF::DARK_PURPLE." <3's left!");
		}
	}
}
