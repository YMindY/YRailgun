<?php
/*
  Date: 2019.1.1
  Author: xMing
  Editor: Quoda
  Mantra: 新年快乐!
*/
namespace yxmingy\railgun;
class Main extends ListenerManager
{
  const PLUGIN_NAME = "YRailgun";
  public function onLoad()
  {
    self::assignInstance();
    self::info("[".self::PLUGIN_NAME."] is Loading...");
  }
  public function onEnable()
  {
    self::registerListeners();
    //$this->getScheduler()->scheduleRepeatingTask(new task\ParticleTask(),2);
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new task\ParticleTask($this),2);
    self::notice("[".self::PLUGIN_NAME."] is Enabled by xMing!");
  }
  public function onDisable()
  {
    self::warning("[".self::PLUGIN_NAME."] is Turned Off.");
  }
}