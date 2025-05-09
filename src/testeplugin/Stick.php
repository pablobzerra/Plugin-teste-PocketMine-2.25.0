<?php

//Stick personalizado
namespace testeplugin;

//imports
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\ItemTypeIds;
use pocketmine\utils\TextFormat;
use pocketmine\entity\projectile\Snowball;
use pocketmine\math\Vector3;
use pocketmine\entity\Location;

class Stick implements Listener {

    private $plugin; //<- criando uma variavel privada

    //Especie de init do python: __init__(self)
    public function __construct(Main $plugin) {
        $this -> plugin = $plugin;
        //self.plugin = plugin
    }


    public function onPlayerInteract(PlayerInteractEvent $event) {
        $player = $event -> getPlayer(); //estanciando o player
        $item = $player -> getInventory() -> getItemInHand();  //mao do jogador


        $item_id = $item->getTypeId(); //Id do iten segurado na mao
        $item_stick = ItemTypeIds::STICK; // objeto item: stick do minecraft
        
        //$item_stick = Item::STICK; -- error -> versao antiga
        //$item_id = $item -> getId(); -- error -> versao antiga 

        if ($item_id === $item_stick) {
            $event -> cancel(); //cancela o uso padrao
            

        
            $loc = $player -> getLocation();

    
            $snowball = new Snowball(
            $loc,
            $player
            //,$player->getDirectionVector()->multiply(1.5) // direção e velocidade
        );

        $snowball -> setMotion($player -> getDirectionVector() -> multiply(2));
        //$player->getWorld()->addEntity($snowball);
        $snowball->spawnToAll(); //cria entidades sem adicionar fisicamente 

        }
    }


}