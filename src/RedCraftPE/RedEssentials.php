<?PHP

namespace RedCraftPE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;

class RedEssentials extends PluginBase implements Listener {

  public function onEnable() : void {

    $this->getLogger()->info(TextFormat::RED . "RedEssentials is now enabled on " . $this->getServer()->getName());
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    if(!file_exists($this->getDataFolder() . "config.yml")){
      
      $this->saveDefaultConfig();
      $this->getConfig()->set("Safe Void", false);
      $this->getConfig()->set("Void Worlds", []);
      $this->getConfig()->set("No Hunger", false);
    }
    $this->cfg = $this->getConfig();
    $this->cfg->save();
    $this->reloadConfig();
  }
  public function onDisable() : void {

  $this->getLogger()->info(TextFormat::RED . "RedEssentials is now disabled on " . $this->getServer()->getName());
  }
  public function onLoad() : void {

  $this->getLogger()->info(TextFormat::RED . "RedEssentials is now loaded on " . $this->getServer()->getName());
  }
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {

    $command = strtolower($command->getName());
    $prefix = TextFormat::RED . "Red" . TextFormat::BLUE . "Essentials" . TextFormat::WHITE . " > ";

    switch ($command) {
      case "gmc":
        if ($sender->hasPermission("redessentials.gmc") || $sender->hasPermission("redessentials.*")) {
          
          if (!$args) {
            
            if ($sender->getGamemode() === 1) {
              
              $sender->sendMessage($prefix . TextFormat::RED . "You are already in gamemode creative.");
              return true;
            }
            
            $sender->setGamemode(1);
            $sender->sendMessage($prefix . TextFormat::GREEN . "Your gamemode has been set to creative.");
            return true;
          } elseif ($args[0]) {
            
            $player = $this->getServer()->getPlayerExact("$args[0]");
            if (!$player) {
              
              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
              return true;
            }
            
            $player->setGamemode(1);
            $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s gamemode has been set to creative.");
            return true;
          } else {
            
            return false;
          }
        }
        break;
      case "gms":
        if ($sender->hasPermission("redessentials.gms") || $sender->hasPermission("redessentials.*")) {
          
          if (!$args) {
            
            if ($sender->getGamemode() === 0) {
              
              $sender->sendMessage($prefix . TextFormat::RED . "You are already in gamemode survival.");
              return true;
            }
            
            $sender->setGamemode(0);
            $sender->sendMessage($prefix . TextFormat::GREEN . "Your gamemode has been set to survival.");
            return true;
          } elseif ($args[0]) {
            
            $player = $this->getServer()->getPlayerExact("$args[0]");
            if (!$player) {
              
              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
              return true;
            }
            $player->setGamemode(0);
            $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s gamemode has been set to survival.");
            return true;
          } else {
            
            return false;
          }
        }
        break;
      case "gma":
        if ($sender->hasPermission("redessentials.gma") || $sender->hasPermission("redessentials.*")) {
          
          if (!$args) {
            
            if ($sender->getGamemode() === 2) {
              
              $sender->sendMessage($prefix . TextFormat::RED . "You are already in gamemode adventure.");
              return true;
            }
            
            $sender->setGamemode(2);
            $sender->sendMessage($prefix . TextFormat::GREEN . "Your gamemode has been set to adventure.");
            return true;
          } elseif ($args[0]) {
            
            $player = $this->getServer()->getPlayerExact("$args[0]");
            if (!$player) {
              
              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
              return true;
            }
            $player->setGamemode(2);
            $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s gamemode has been set to adventure.");
            return true;
          } else {
            
            return false;
          }
        }
        break;

      case "heal":

        if ($sender->hasPermission("redessentials.heal") || $sender->hasPermission("redessentials.*")) {

          if (!$args) {

            $sender->setHealth(20);

            $sender->sendMessage($prefix . TextFormat::GREEN . "You have been healed.");

            return true;

          } elseif ($args[0]) {

            $player = $this->getServer()->getPlayerExact("$args[0]");

            if (!$player) {

              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);

              return true;

            }

            $player->setHealth(20);

            $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s has been healed.");

            return true;

          } else {

            return false;

          }
        }
        break;
      case "feed":

        if ($sender->hasPermission("redessentials.feed") || $sender->hasPermission("redessentials.*")) {

          if (!$args) {

            $sender->setFood(20);

            $sender->sendMessage($prefix . TextFormat::GREEN . "You have been fed.");

            return true;

          } elseif ($args[0]) {

            $player = $this->getServer()->getPlayerExact("$args[0]");

            if (!$player) {

              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);

              return true;

            }

            $player->setFood(20);

            $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s has been fed.");

            return true;

          } else {

            return false;

          }
        }
        break;

      case "starve":

        if ($sender->hasPermission("redessentials.starve") || $sender->hasPermission("redessentials.*")) {

          if (!$args) {

           $sender->setFood(0);
           $sender->sendMessage($prefix . TextFormat::GREEN . "You are starving.");
            return true;
         } elseif ($args[0]) {

           $player = $this->getServer()->getPlayerExact("$args[0]");

           if (!$player) {

             $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
             return true;
            }

            $player->setFood(0);
            $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s is starving.");
            return true;
          } else {

            return false;
          }
        }
        break;
      case "freeze":
        if ($sender->hasPermission("redessentials.freeze") || $sender->hasPermissions("redessentials.*")) {
          if (!$args) {

            return false;
          } else {

            $player = $this->getServer()->getPlayerExact(implode(" ", $args));
            if (!$player) {

              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
              return true;
            }

            if ($player->isImmobile()) {

              $sender->sendMessage($prefix . TextFormat::RED . $player->getName() . " is already frozen");
              return true;
            }

            $player->setImmobile(true);
            $sender->sendMessage($prefix . TextFormat::GREEN . $player->getName() . " is now frozen.");
            return true;
          }
          return false;
        }
        break;
      case "unfreeze":
        if ($sender->hasPermission("redessentials.ufreeze") || $sender->hasPermissions("redessentials.*")) {
          if (!$args) {

            return false;
          } else {

            $player = $this->getServer()->getPlayerExact(implode(" ", $args));
            if (!$player) {

              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
              return true;
            }

            if (!$player->isImmobile()) {

              $sender->sendMessage($prefix . TextFormat::RED . $player->getName() . " is not frozen.");
              return true;
            }

            $player->setImmobile(false);
            $sender->sendMessage($prefix . TextFormat::GREEN . $player->getName() . " is no longer frozen.");
            return true;
          }
          return false;
        }
        break;
      case "hunger":
        if ($sender->hasPermission("redessentials.hunger") || $sender->hasPermission("redessentials.*")) {
        
          if (!$args) {
            
            return false; 
          } else {
          
            if ($args[0] === "off") {
            
              if ($this->cfg->get("No Hunger") === false) { 
                
                $this->cfg->set("No Hunger", true);
                $sender->sendMessage($prefix . TextFormat::GREEN . " No Hunger is now enabled!");
                return true;
              } else {
              
                $sender->sendMessage($prefix . TextFormat::RED . " No hunger is already enabled!");
                return true;
              }
            } elseif ($args[0] === "on") {
            
              if ($this->cfg->get("No Hunger") === true) { 
                
                $this->cfg->set("No Hunger", false);
                $sender->sendMessage($prefix . TextFormat::GREEN . " No Hunger is now disabled!");
                return true;
              } else {
              
                $sender->sendMessage($prefix . TextFormat::RED . " No hunger is already disabled!");
                return true;
              }
            } else {
            
              return false;
            }
          }
        }
        break;
      case "svoid":
        
        if ($sender->hasPermission("redessentials.svoid") || $sender->hasPermission("redessentials.*")) {
        
          if (!$args) {

            return false;
          } elseif (count($args) === 1) {

            if ($args[0] === "on") {

              if ($this->cfg->get("Safe Void") === true) {

                $sender->sendMessage($prefix . TextFormat::RED . "Safe void is already enabled!");
                return true;
              }

              $sender->sendMessage($prefix . TextFormat::GREEN . "Safe Void has been enabled!");
              $this->cfg->set("Safe Void", true);
              $this->cfg->save();
              return true;
            } elseif ($args[0] === "off") {

              if ($this->cfg->get("Safe Void") === false) {

                $sender->sendMessage($prefix . TextFormat::RED . "Safe void is already disabled!");
                return true;
              }

              $sender->sendMessage($prefix . TextFormat::GREEN . "Safe void has been disabled!");
              $this->cfg->set("Safe Void", false);
              $this->cfg->save();
              return true;
            } else {

              return false;
            }
          } else {

            $level = $this->getServer()->getLevelByName($args[1]);
            if (!$level) {

              $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a world with the name " . TextFormat::WHITE . $args[1]);
              return true;
            }
            if ($args[0] === "on") {

              if (in_array($args[1], $this->cfg->get("Void Worlds", []))) {

                $sender->sendMessage($prefix . TextFormat::WHITE . $args[1] . TextFormat::RED . " already has Safe Void enabled!");
                return true;
              }

              $sender->sendMessage($prefix . TextFormat::GREEN . "Safe Void has been enabled in " . TextFormat::WHITE . $args[1]);
              $voidWorlds = $this->cfg->get("Void Worlds");
              $voidWorlds[] = $args[1];
              $this->cfg->set("Void Worlds", $voidWorlds);
              $this->cfg->save();
              return true;
            } elseif ($args[0] === "off") {

              if (!(in_array($args[1], $this->cfg->get("Void Worlds", [])))) {

                $sender->sendMessage($prefix . TextFormat::WHITE . $args[1] . TextFormat::RED . " does not have Safe Void enabled!");
                return true;
              }

              $sender->sendMessage($prefix . TextFormat::GREEN . "Safe Void has been disabled in " . TextFormat::WHITE . $args[1]);
              $this->cfg->removeNested("Void Worlds", $args[1]);
              $this->cfg->save();
              return true;
            } else {

              return false;
            }
          }
        }
        break;
    }
  }
  public function onMove(PlayerMoveEvent $event) {

    $player = $event->getPlayer();
    if ($this->cfg->get("No Hunger") === true) {
      
      if ($player->getFood() < 20) {

        $player->setFood(20); 
      }
    }
    
    if ($this->cfg->get("Safe Void") === true) {
      
      if ($player->getY() <= -1) {

        $player->teleport($player->getSpawn());
      }
    } elseif (in_array($player->getLevel()->getName(), $this->cfg->get("Void Worlds", []))) {
    
      if ($player->getY() <= -1) {

        $player->teleport($player->getSpawn());
      }
    } 
  }
}
