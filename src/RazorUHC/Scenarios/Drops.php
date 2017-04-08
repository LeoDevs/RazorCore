<?php

namespace Scenarios;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\player\PlayerDeathEvent;
use pocketmine\entity\Effect;

	/*
	Author: Zuruki
	Description: Heals killer + drops a golden apple on victim's death.
	This is for RazorUHC's core.
				*/
class Drops extends PluginBase implements Listener {
	public function onDeath(PlayerDeathEvent $e){
	$cause = $e->getEntity()->getLastDamageCause();
	if ($cause instanceof EntityDamageEvent and $cause->getDamager() instanceof Player) {
	$killer = $cause->getDamager();
	$causename = $cause->getPlayer()->getName();
	//everything is now defined. the killer is $killer, the victim of death is $cause, name of victim is $causename.
	$e->setDrops(array(Item::get(322,0,0)));
	$killer->addEffect(Effect::getEffect(Effect::REGENERATION)->setAmplifier(4)->setDuration(5));
       $killer->getPlayer()->sendMessage("§8[§2RazorUHC§8] §aYou've killed " . $causename . "and earned regeneration!");
	// Adds Regeneration to Killer.
	}
}
	
