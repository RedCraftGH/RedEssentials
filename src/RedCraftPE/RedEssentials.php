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
      @mkdir($this->getDataFolder());
      $this->saveResource("config.yml");
      $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }
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
     }
    return false;
  }
  public function onMove(PlayerMoveEvent $event) {
  
    $player = $event->getPlayer();
    if ($player->isOnGround()) {
      
      $position = array($player->getX(), $player->getY(), $player->getZ());
      $this->config->setNested($player->getName(), $position);
      $this->config->save();
    } elseif (!$player->isOnGround()) {
    
      if ($player->getY() <= -1) {
      
        $array = $this->config->get($player->getName());
        $player->teleport(new Vector3($array[0], $array[1], $array[2]));
      }
    }
  }
}
