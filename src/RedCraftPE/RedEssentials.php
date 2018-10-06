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
    }
    $this->cfg = $this->getConfig();
    if (!$this->cfg->exists("Safe Void") {
      
      $this->cfg->set("Safe_Void", false);
    }
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
        if ($sender->hasPermission("redessentials.freeze") || $sender->hasPermissions("redessentials.*") {
          if (!args) {

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
        if ($sender->hasPermission("redessentials.ufreeze") || $sender->hasPermissions("redessentials.*") {
          if (!args) {

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
    }
  }
  public function onMove(PlayerMoveEvent $event) {

    $player = $event->getPlayer();
    
    if ($this->cfg->get("Safe Void") === true) {
      if ($player->getY() <= -1) {

        $player->teleport($player->getSpawn());
      }
    }
  }
}
