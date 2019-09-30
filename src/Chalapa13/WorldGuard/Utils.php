<?php

/**
*
*  _     _  _______  ______    ___      ______   _______  __   __  _______  ______    ______  
* | | _ | ||       ||    _ |  |   |    |      | |       ||  | |  ||   _   ||    _ |  |      | 
* | || || ||   _   ||   | ||  |   |    |  _    ||    ___||  | |  ||  |_|  ||   | ||  |  _    |
* |       ||  | |  ||   |_||_ |   |    | | |   ||   | __ |  |_|  ||       ||   |_||_ | | |   |
* |       ||  |_|  ||    __  ||   |___ | |_|   ||   ||  ||       ||       ||    __  || |_|   |
* |   _   ||       ||   |  | ||       ||       ||   |_| ||       ||   _   ||   |  | ||       |
* |__| |__||_______||___|  |_||_______||______| |_______||_______||__| |__||___|  |_||______| 
*
* By Chalapa13.
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* GitHub: https://github.com/Chalapa13
*/

namespace Chalapa13\WorldGuard;

use pocketmine\Player;
use pocketmine\network\mcpe\protocol\SetPlayerGameTypePacket;
use pocketmine\entity\{Entity, Animal, Monster};

class Utils {

    const GAMEMODES = [
        "0" => 0,
        "s" => 0,
        "survival" => 0,
        "1" => 1,
        "c" => 1,
        "creative" => 1,
        "2" => 2,
        "a" => 2,
        "adventure" => 2,
        "3" => 3,
        "sp" => 3,
        "spectator" => 3
    ];

    const GM2STRING = [
        0 => "survival",
        1 => "creative",
        2 => "adventure",
        3 => "spectator"
    ];

    public static function getRomanNumber(int $integer, $upcase = true) : string
    {
        $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
        $return = '';
        while($integer > 0) {
            foreach($table as $rom=>$arb) {
                if($integer >= $arb) {
                    $integer -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }
        return $return;
    }

    public static function disableFlight(Player $player)
    {
        $player->setAllowFlight(false);
        $pk = new SetPlayerGameTypePacket();
        $pk->gamemode = $player->getGamemode() & 0x01;
        $player->dataPacket($pk);
        $player->setFlying(false);
        $player->sendSettings();
    }

    public static function gm2string(int $gm) : string
    {
        return self::GM2STRING[$gm] ?? "survival";
    }

    /**
     * @param Player $player
     * @param string $msg
     * @return mixed
     *
     * Use this to parse aliases in a string
     */
    public static function aliasParse(Player $player, string $msg)
    {
        $parsedMsg = str_replace("{player_name}", $player->getName() ,$msg);
        $parsedMsg = str_replace("&", "§", $parsedMsg);

        return $parsedMsg;
    }


    /**
     * @param Entity $ent
     * @return bool
     *
     * Pass an entity to this function and it checks if its an animal or not.
     */
    public static function isAnimal(Entity $ent)
    {
        if($ent instanceof Animal)
            return true;

        $classname = strtolower(get_class($ent));

        if(strpos($classname, "bat") !== false ||
            strpos($classname, "chicken") !== false ||
            strpos($classname, "cow") !== false ||
            strpos($classname, "donkey") !== false ||
            strpos($classname, "horse") !== false ||
            strpos($classname, "llama") !== false ||
            strpos($classname, "mooshroom") !== false ||
            strpos($classname, "mule") !== false ||
            strpos($classname, "ocelot") !== false ||
            strpos($classname, "parrot") !== false ||
            strpos($classname, "pig") !== false ||
            strpos($classname, "polarbear") !== false ||
            strpos($classname, "rabbit") !== false ||
            strpos($classname, "sheep") !== false ||
            strpos($classname, "wolf") !== false ||
            strpos($classname, "animal")
        )
            return true;

        return false;
    }

    /**
     * @param string $classname
     * @return bool
     *
     * Pass an entity to this function and it checks if its a monster or not.
     */
    public static function isMonster(Entity $ent)
    {
        if($ent instanceof Monster)
            return true;

        $classname = strtolower(get_class($ent));

        if(strpos($classname, "blaze") !== false ||
            strpos($classname, "cavespider") !== false ||
            strpos($classname, "elderguardian") !== false ||
            strpos($classname, "enderdragon") !== false ||
            strpos($classname, "enderman") !== false ||
            strpos($classname, "endermite") !== false ||
            strpos($classname, "evoker") !== false ||
            strpos($classname, "ghast") !== false ||
            strpos($classname, "guardian") !== false ||
            strpos($classname, "husk") !== false ||
            strpos($classname, "magmacube") !== false ||
            strpos($classname, "pigzombie") !== false ||
            strpos($classname, "shulker") !== false ||
            strpos($classname, "silverfish") !== false ||
            strpos($classname, "skeleton") !== false ||
            strpos($classname, "slime") !== false ||
            strpos($classname, "spider") !== false ||
            strpos($classname, "stray") !== false ||
            strpos($classname, "undead") !== false ||
            strpos($classname, "vex") !== false ||
            strpos($classname, "vindicator") !== false ||
            strpos($classname, "witch") !== false ||
            strpos($classname, "wither") !== false ||
            strpos($classname, "witherskeleton") !== false ||
            strpos($classname, "zombievillager") !== false ||
            strpos($classname, "monster")
        )
            return true;

        return false;
    }
}