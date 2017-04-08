<?php


namespace Core;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\entity\Effect;
use pocketmine\block\IronOre;
use pocketmine\block\GoldOre;
use pocketmine\block\Sand;
use pocketmine\block\Gravel;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\command\Command;
use pocketmine\level\Level;
use pocketmine\scheduler\CallbackTask;
use pocketmine\scheduler\PluginTask;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\enchantment\Enchantment;

class Core extends PluginBase implements Listener {
public $pvp;
    public $prefix = TextFormat::DARK_GRAY . "[" . TextFormat::RED . "RazorUHC" . TextFormat::DARK_GRAY . "] " . TextFormat::GRAY;
    public $globalmute = false;
    public $spam = [];
   public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "Cord")), 0);
    		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "Alive")), 20 * 1160);
    		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "msg")), 20 * 1120);
    $this->pvp = FALSE;
   }
	public function Cord(){
	foreach($this->getServer()->getOnlinePlayers() as $player){
	if($player->getInventory()->getItemInHand()->getId() == "345") {
	$x = $player->getFloorX();
	$y = $player->getFloorY();
	$z = $player->getFloorZ();
 	$player->sendPopup($this->prefix . "§7X: §c$x §7Y: §c$y §7Z: §c$z");
}
}
}
public function Alive (){
	foreach($this->getServer()->getOnlinePlayers() as $p){
		$p->sendMessage($this->prefix .  "§2Follow us on Twitter: §a@RazorUHC ");
	}	
}
public function msg (){

 foreach($this->getServer()->getOnlinePlayers() as $p){

$p->sendMessage($this->prefix . "§aGoodluck, and have fun!");
}
}
  	
  public function onBreak(BlockBreakEvent $event) {
    if($event->getBlock()->getId() == 15) {
      $drops = array(Item::get(265, 0, 2));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 14) {
      $drops = array(Item::get(266, 0, 2));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 18) {
      $drops = array(Item::get(260, 0, 1));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 161) {
      $drops = array(Item::get(260, 0, 1));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 17) {
      $drops = array(Item::get(5, 0, 5));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 13) {
      $drops = array(Item::get(262, 0, 15));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 16) {
      $drops = array(Item::get(438, 6, 1));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 49) {
      $drops = array(Item::get(116, 0, 1));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 74) {
      $drops = array(Item::get(438, 13, 1));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 83) {
      $drops = array(Item::get(438, 15, 1));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 2) {
      $drops = array(Item::get(364, 0, 2));
      $event->setDrops($drops);
    }
    if($event->getBlock()->getId() == 3) {
      $drops = array(Item::get(364, 0, 2));
      $event->setDrops($drops);
    }
  }
public function onJoin(PlayerJoinEvent $event){
$player = $event->getPlayer();
$name = $player->getName();
$player->sendTip("§fWelcome to §2Razor!");
$this->getServer()->broadcastMessage("§7[§a+§7]  ".$event->getPlayer()->getName()." ");
$event->setJoinMessage("");
}
public function onQuit(PlayerQuitEvent $event){
$player = $event->getPlayer();
$name = $player->getName();
$this->getServer()->broadcastMessage("§7[§c-§7]  ".$event->getPlayer()->getName()." ");
$event->setQuitMessage("");
}
public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {

	$cmd = strtolower($cmd->getName());
$players = $sender->getName();
	switch($cmd){
case 'Razor':
if ($sender->isOp()){
switch($args[0]){

case "reset":
foreach($this->getServer()->getOnlinePlayers() as $p){
$p->setMaxHealth(20);
$p->setHealth(20);
$p->setFood(20);
$p->setGamemode(0);
$p->getInventory()->clearAll();
$p->removeAllEffects();
}
$this->getServer()->broadcastMessage("§7[§cRazorUHC§7] §fThe UHC has restarted!");
return true;
break;

case "help":
$sender->sendMessage("§7[ §cRazor§f Host Commands§7 ]");
$sender->sendMessage("§b/UHC reset: §fResets the UHC!");
$sender->sendMessage("§b/UHC meetup: §fGives everyone meetup kit!");
$sender->sendMessage("§b/UHC start: §fStarts the UHC!");
$sender->sendMessage("§b/UHC tpall: §fTeleports everyone!");
$sender->sendMessage("§b/UHC meetop: §fGives OP meetup kit!");
$sender->sendMessage("§b/UHC pvp <on/off>: §fTurns PvP on or Off");
$sender->sendMessage("§b/Razor scenario <effect>: §fSelect Scenario.");

$sender->sendMessage("§b/UHC globalmute: §fSilences the non-ops.");
return true;
break;
case "pvp":
if($args[1] == "on"){
 $this->pvp = TRUE;
 $this->getServer()->broadcastMessage("§7[§cRazorUHC§7] §cPvP has been enabled!");
 
   
 }

 If($args[1] == "off"){
$this->pvp = FALSE;
 $this->getServer()->broadcastMessage("§7[§cRazorUHC§7] §cPvP has been disabled! ");
}
return true;
break;

case "scenario":
if($args[1] == "hero"){
 $this->getServer()->broadcastMessage(" ");
 $this->getServer()->broadcastMessage(" ");
 foreach($this->getServer()->getOnlinePlayers() as $p){
 	           $kit = rand(1, 2);
 	           $speed = Effect::getEffect($kit);
                    $speed->setAmplifier(1);
                    $speed->setVisible(true);
                    $speed->setDuration(1000000);
                    $p->addEffect($speed);
   }
 }
return true;
break;
 case "meetup":
foreach($this->getServer()->getOnlinePlayers() as $p){
$p->setMaxHealth(20);
$p->setHealth(20);
$p->setFood(20);
$p->setGamemode(0);
$p->getInventory()->clearAll();
$p->getInventory()->addItem(Item::get(276, 0, 1));
$p->getInventory()->addItem(Item::get(ITEM::GOLDEN_APPLE, 0, 6));
$p->getInventory()->addItem(Item::get(ITEM::GOLDEN_APPLE, 0, 9));
$p->getInventory()->addItem(Item::get(364, 0, 64));
$p->getInventory()->addItem(Item::get(278, 0, 1));$p->getInventory()->addItem(Item::get(279, 0, 1));
$p->getInventory()->addItem(Item::get(1, 0, 64));
$p->getInventory()->addItem(Item::get(5, 0, 64));

$p->getInventory()->setHelmet(Item::get(310, 0, 1));
$p->getInventory()->setChestplate(Item::get(311, 0, 1));
$p->getInventory()->setLeggings(Item::get(312, 0, 1));
$p->getInventory()->setBoots(Item::get(313, 0, 1));
$p->getInventory()->sendArmorContents($p);
}	            
$this->getServer()->broadcastMessage("§7[§cRazorUHC§7]§a The meetup kit has been given to you!");
return true;
break;


case "start":
foreach($this->getServer()->getOnlinePlayers() as $p){
$p->setMaxHealth(20);
$p->setHealth(20);
$p->setFood(20);
$p->setGamemode(0);
$p->getInventory()->clearAll();

$p->getInventory()->addItem(Item::get(257, 0, 1));
$p->getInventory()->addItem(Item::get(364, 0, 64));
$p->getInventory()->addItem(Item::get(50, 0, 16));
$p->getInventory()->addItem(Item::get(345, 0, 1));


$p->getInventory()->setBoots(Item::get(301, 0, 1));
$p->getInventory()->sendArmorContents($player);
}	            

$this->getServer()->broadcastMessage("§7[§bRazorUHC§7] §aThe UHC is starting in 10seconds...§cDO NOT LOG");
Sleep(10);
$this->getServer()->broadcastMessage("§7[§cRazorUHC§7] §aThe UHC has started! goodluck.");
return true;
break;


case "meetop":
foreach($this->getServer()->getOnlinePlayers() as $p){
$p->setMaxHealth(20);
$p->setHealth(20);
$p->setFood(20);
$p->setGamemode(0);
$p->getInventory()->clearAll();
$p->getPlayer()->removeAllEffects();
$casco = Item::get(Item::DIAMOND_HELMET, 0, 1);
$protection = Enchantment::getEnchantment(0);
$protection->setLevel(1);
$casco->addEnchantment($protection);
$p->getInventory()->setHelmet($casco);
$peto = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
$protection = Enchantment::getEnchantment(0);
$protection->setLevel(2);
$peto->addEnchantment($protection);
$p->getInventory()->setChestplate($peto);
$pantalon = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
$protection = Enchantment::getEnchantment(0);
$protection->setLevel(2);
$pantalon->addEnchantment($protection);
$p->getInventory()->setLeggings($pantalon);
$botas = Item::get(Item::DIAMOND_BOOTS, 0, 1);
$protection = Enchantment::getEnchantment(0);
$protection->setLevel(1);
$botas->addEnchantment($protection);
$p->getInventory()->setBoots($botas);
$espada = Item::get(Item::DIAMOND_SWORD, 0, 1);
$sharpness = Enchantment::getEnchantment(9);
$sharpness->setLevel(2);
$espada->addEnchantment($sharpness);
$p->getInventory()->addItem($espada);
$pico = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
$efficiency = Enchantment::getEnchantment(15);
$efficiency->setLevel(3);
$pico->addEnchantment($efficiency);
$p->getInventory()->addItem($pico);
$hacha = Item::get(Item::DIAMOND_AXE, 0, 1);
$efficiency = Enchantment::getEnchantment(15);
$efficiency->setLevel(3);
$hacha->addEnchantment($efficiency);
$p->getInventory()->addItem($hacha);
$p->getInventory()->addItem(Item::get(322, 0, 15));
$p->getInventory()->addItem(Item::get(364, 0, 64));
$p->getInventory()->addItem(Item::get(1, 0, 64));
$p->getInventory()->addItem(Item::get(5, 0, 64));
$p->getInventory()->addItem(Item::get(30,0,64));
$this->getServer()->broadcastMessage("§7[§cRazorUHC§7]§a The OP Meetup kit has been given to you!");
}
return true;
break;
///GlobalMute///

            case "globalmute":
                if ($sender->hasPermission("razor.all")) {
                    if ($this->globalmute === false) {
                        $this->getServer()->broadcastMessage($this->prefix . TextFormat::WHITE . "§fGlobalmute has been enabled!");
                        $this->globalmute = true;
                        return true;
                    } else {
                        $this->getServer()->broadcastMessage($this->prefix . TextFormat::WHITE . "§fGlobalmute has been disabled!");
                        $this->globalmute = false;
                        return true;
                    }
                }


case "tpall":
foreach($this->getServer()->getOnlinePlayers() as $p){
$p->teleport(new Vector3($sender->x, $sender->y, $sender->z));
$this->getServer()->broadcastMessage("§7[§cRazorUHC§7]  §fTeleporting...");
}
return true;
break;

}
}else{
	$sender->sendMessage("§7[§cRazorUHC§7] §fNo permission.");
}
return true;
break;

}
}
    public function onPlayerDeath(PlayerDeathEvent $event)
    {
        $player = $event->getPlayer();
        $player->setGamemode(3);
        if ($player instanceof Player) {
            $cause = $player->getLastDamageCause();
            if ($cause instanceof EntityDamageByEntityEvent) {
                $killer = $cause->getDamager();
                $killer->setHealth($killer->getHealth() + 10);
                $killer->sendMessage("§7[§cRazorUHC§7] §fYou have been healed!");
                $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §7was killed by§c " . $killer->getName() . ".");
            } else {
                $cause = $player->getLastDamageCause()->getCause();
                if($cause === EntityDamageEvent::CAUSE_SUFFOCATION)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fSuffocated.");
                } elseif ($cause === EntityDamageEvent::CAUSE_DROWNING)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fDropped dead.");
                } elseif ($cause === EntityDamageEvent::CAUSE_FALL)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fBurnt.");
                } elseif ($cause === EntityDamageEvent::CAUSE_FIRE)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fBurnt.");
                } elseif ($cause === EntityDamageEvent::CAUSE_FIRE_TICK)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fTried to swim in lava.");
                } elseif ($cause === EntityDamageEvent::CAUSE_LAVA)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fExploded.");
                } elseif ($cause === EntityDamageEvent::CAUSE_BLOCK_EXPLOSION)
                {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §fhas passed away.");
                } else {
                    $event->setDeathMessage($this->prefix . TextFormat::RED . $player->getName() . " §has passed away.");
                }
            }
        }
    }
////Mute and Grade////
    public function onChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        if ($this->globalmute === true) {
            if (!$event->getPlayer()->hasPermission("razor.all")) {
                $event->setCancelled();
                $player->sendMessage($this->prefix . "§fWait a few seconds...");
            }
        } else {
            if(!$player->hasPermission("razor.all"))
            {
                if(!isset($this->spam[$player->getName()]))
                {
                    $lastTime = 0;
                } else {
                    $lastTime = $this->spam[$player->getName()];
                }
                if(time() - $lastTime > 5)
                {
                    $this->spam[$player->getName()] = time();
                } else {
                    $event->setCancelled(true);
                    $player->sendMessage($this->prefix . TextFormat::GRAY . "§fSpamming is not allowed.");
                }
            }


    }
