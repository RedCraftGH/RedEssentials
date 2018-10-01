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
  
    
  }
}
