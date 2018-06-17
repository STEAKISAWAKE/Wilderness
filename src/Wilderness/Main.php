<?php

declare(strict_types=1);

namespace Wilderness;

use pocketmine\{
	Server, Player
};
use pocketmine\plugin\{
	Plugin, PluginBase
};
use pocketmine\entity\{
	Effect, EffectInstance
};
use pocketmine\command\{
	Command, CommandSender
};
use pocketmine\level\{
	Level, Position
};
use pocketmine\level\particle\{
	SmokeParticle, PortalParticle
};
use pocketmine\level\sound\{
	BlazeShootSound, FizzSound
};

class Main extends PluginBase {
	
	public $wildprefix = "§l§7[§r§dWilderness§7§l]";
	
	public function onEnable(): void{
		$this->getLogger()->info($this->wildprefix . "This plugin has now successfully enabled!");
	}
	
	public function onDisable(): void{
		$this->getLogger()->info($this->wildprefix . "This plugin has now disabled the system!");
	}
	
	public function onCommand(CommandSender $player, Command $cmd, string $label, array $args): bool{
		if(strtolower($cmd->getName()) == "wild") {
			 if($player instanceof Player){
				 if($player->hasPermission("wild.command")){
					 $x = mt_rand(1, 999);
					 $z = mt_rand(1, 999);
					   $y = $player->getLevel()->getHighestBlockAt($x, $z) + 1;
					   $player->teleport(new Position($x, $y, $z, $player->getLevel()));
					   $player->addTitle("§7§l[§d§rWILDERNESS§7§l]§r", "§fTeleporting...");
					   $player->sendMessage("§7-------\n §cTeleporting to random spot\n §cof §dwilderness§c... §7\n-------");
					   $player->getLevel()->addSound(new FizzSound($this, $player));
					   $player->getLevel()->addSound(new BlazeShootSound($this, $player));
					    // PARTICLES \\
					   $wild1 = $this->plugin->getServer()->getDefaultLevel();
		                           $r = rand(1,300);
		                           $g = rand(1,300);
		                           $b = rand(1,300);
		                           $center = new Vector3($x, $y, $z);
		                           $radius = 0.5;
		                           $wildp1 = new SmokeParticle($center, $r, $g, $b, 1);
		                           for($yaw = 0, $y = $center->y; $y < $center->y + 4; $yaw += (M_PI * 2) / 20, $y += 1 / 20) {
			                     $x = -sin($yaw) + $center->x;
			                     $z = cos($yaw) + $center->z;
			                     $wildp1->setComponents($x, $y, $z);
			                     $wild->addParticle($wildp1);
			                    }
		                          $wildp2 = new PortalParticle($center, $r, $g, $b, 1);
		                          for($yaw = 0, $y = $center->y; $y < $center->y + 4; $yaw += (M_PI * 2) / 20, $y += 1 / 20) {
			                    $x = -sin($yaw) + $center->x;
			                    $z = cos($yaw) + $center->z;
			                    $wildp2->setComponents($x, $y, $z);
			                    $wild->addParticle($wildp2);
			                   }
			                 }else{
					     $player->sendMessage("");
					     return false;
				          }
				        }else{
					  $player->sendMessage($this->wildprefix . "§cPlease use Implactor command in-game server!");
					  return false;
			               }
                                      return true;
		                  }
		            }
                      }
