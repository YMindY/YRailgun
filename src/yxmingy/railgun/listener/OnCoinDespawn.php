<?php
namespace yxmingy\railgun\listener;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\Position;
use pocketmine\level\Explosion;
use pocketmine\math\Vector3;
class OnCoinDespawn implements Listener
{
  public function onCoinDespawn(EntityDespawnEvent $event):void
  {
    $entity = $event->getEntity();
    if(substr($entity->getNameTag(),0,12) != "超电磁炮") return;
    $id = substr($entity->getNameTag(),12);
    if(!in_array($id,OnThrowCoin::$flying_coins)) return;
    unset(OnThrowCoin::$flying_coins[array_search($id,OnThrowCoin::$flying_coins)]);
    $entity->getLevel()->addParticle(
      new HeartParticle(
        new Vector3(
          $entity->getX(),
          $entity->getY(),
          $entity->getZ()
        )
      )
    );
    $explosion = new Explosion(new Position($entity->getX(),$entity->getY(),$entity->getZ(),$entity->getLevel()),4);
    $explosion->explodeA();
    $explosion->explodeB();
  }
}