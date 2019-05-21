<?php
namespace yxmingy\railgun\task;
use pocketmine\Server;
use pocketmine\level\particle\HeartParticle;
use pocketmine\math\Vector3;
use yxmingy\railgun\listener\OnThrowCoin;
class ParticleTask extends \pocketmine\scheduler\PluginTask
{
  public function onRun($currenttick)
  {
    if(empty(OnThrowCoin::$flying_coins)) {
      OnThrowCoin::$coin_levels = [];
      return;
    }
    foreach(OnThrowCoin::$coin_levels as $levelname) {
      $level = Server::getInstance()->getLevelbyName($levelname);
      if($level == null) continue;
      foreach($level->getEntities() as $entity) {
        if(substr($entity->getNameTag(),0,12) != "超电磁炮") continue;
        $level->addParticle(
          new HeartParticle(
            new Vector3(
              $entity->getX(),
              $entity->getY(),
              $entity->getZ()
            )
          )
        );
      }
    }
  }
}