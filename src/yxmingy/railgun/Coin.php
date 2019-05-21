<?php
namespace yxmingy\railgun;
use pocketmine\level\Level;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\CompoundTag;
class Coin extends \pocketmine\entity\Snowball
{
    public static function create(Level $level,$x,$y,$z){
	    $nbt=new CompoundTag("",[
			"Pos"=>new ListTag("Pos",[
				new DoubleTag("",$x),
				new DoubleTag("",$y),
				new DoubleTag("",$z)
				]
			),
			"Motion"=>new ListTag("Motion",[
				new DoubleTag("",0),
				new DoubleTag("",0),
				new DoubleTag("",0)
				]
			),
			"Rotation"=>new ListTag("Rotation",[
				new FloatTag("",0),
				new FloatTag("",0)
				]
			)
		]);
		return new Coin($level,$nbt);
    }
}