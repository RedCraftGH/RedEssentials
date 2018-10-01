<?PHP

namespace RedCraftPE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;

class RedEssentials extends PluginBase implements Listener {

  public function onEnable() : void {
  
    $this->getServer()->info(TextFormat::RED . "RedEssentials is now enabled on " . $this->getServer()->getName());
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  public function onDisable() : void {
  
  $this->getServer()->info(TextFormat::RED . "RedEssentials is now disabled on " . $this->getServer()->getName());
  }
  public function onLoad() : void {
  
  $this->getServer()->info(TextFormat::RED . "RedEssentials is now loaded on " . $this->getServer()->getName());
  }
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
  
    $command = strtolower($command->getName());
    $prefix = TextFormat::RED . "Red" . TextFormat::BLUE . "Essentials" . TextFormat::WHITE . " > ";
    
    switch ($command) {
      case "gmc":
        if (!$args) {
          if ($sender->getGamemode() === 1) {
            $sender->sendMessage($prefix . TextFormat::RED . "You are already in gamemode creative.");
            return false;
          }
          $sender->setGamemode(1);
          $sender->sendMessage($prefix . TextFormat::GREEN . "Your gamemode has been set to creative.");
          return true;
        } elseif ($args[0]) {
          $player = $this->getServer()->getPlayerExact("$args[0]");
          if (!$player) {
            $sender->sendMessage($prefix . TextFormat::RED . "I cannot find a player with the name " . $args[0]);
            return false;
          }
          $player->setGamemode(1);
          $player->sendMessage($prefix . TextFormat::GREEN . $player->getName() . "'s gamemode has been set to creative.");
        } else {
          return false;
        }
       break;
     }
    return false;
  }
}
