<?php

namespace RTG\RankApply;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class RA extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->apply = new Config($this->getDataFolder() . "apply.txt", Config::ENUM, array());
		$pp = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		$this->getLogger()->warning("
		* Starting RankApplier
		* Version 1.0.0
		");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $param) {
		switch(strtolower($cmd->getName())) {
			
			case "apply":
				
				if(isset($param[0])) {
					switch(strtolower($param[0])) {
						
						case "admin":
							
							$n = $sender->getName();
							$min = $this->getConfig()->get("MinAdmin");
							
							if($sender instanceof Player) {
								if($pp->getGroup($sender) === $min) {
									$sender->sendMessage("[RA] You have applied for Admin! You have to wait till your ServerOwner contacts you!");
									$this->apply->set(strtolower($n), "admin");
								}
							}
							return true;
						break;
						
						case "staff":
							return true;
						break;
					}
				}
			
			
			
				return true;
			break;
			
		}
	}
	
	
	
	
}
