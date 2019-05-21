<?php
namespace yxmingy\railgun\listener;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\item\
{Item,
ItemIds,
Snowball};
use pocketmine\math\Vector3;
use yxmingy\railgun\Coin;
class OnThrowCoin implements Listener
{
  public static $flying_coins = [];
  public static $coin_levels = [];
  private static function next():int
  {
    $id = -1;
    while(true) {
      if(!in_array(++$id,self::$flying_coins)) return $id;
    }
  }
  public function onThrowCoin(/*PlayerDropItemEvent*/\pocketmine\event\player\PlayerInteractEvent $event):void
  {
    $player = $event->getPlayer();
    if(!$event->getItem() instanceof Snowball) return;
    $event->setCancelled();
    $player->getInventory()->removeItem(new Item(ItemIds::SNOWBALL,0,1));
    $coin = Coin::create(
      $player->getLevel(),
      $player->getX() + 1 * cos(($player->getYaw() + 90) * M_PI / 180),
      $player->getY()+$player->getEyeHeight(),
      $player->getZ() + 1 * sin(($player->getYaw() + 90) * M_PI / 180)
    );
    $coin->setRotation($player->getYaw(),$player->getPitch());
    $motion = new Vector3(
      -sin($player->yaw / 180 * M_PI)  * cos($player->pitch / 180 * M_PI),
      -sin($player->pitch / 180 * M_PI),
      cos($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI)
    );
    $coin->setMotion($motion->multiply(3));
    
    $coin->setNameTagVisible();
    $coin->setNameTagAlwaysVisible();
    
    //$coin->setPosition($player->getPosition());
    $next = self::next();
    $coin->setNameTag("超电磁炮$next");
    self::$flying_coins[] = $next;
    self::$coin_levels[] = $coin->getLevel()->getName();
    $coin->spawnToAll();
  }
}