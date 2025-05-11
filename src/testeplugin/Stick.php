<?php

//Stick personalizado
namespace testeplugin;

//imports

use Locale;
use pocketmine\entity\Location;
use pocketmine\event\Listener;
//use pocketmine\event\player\PlayerInteractEvent; <-  click no bloco
use pocketmine\event\player\PlayerItemUseEvent; // click no ar
use pocketmine\item\ItemTypeIds;
//use pocketmine\utils\TextFormat;
use pocketmine\entity\projectile\Snowball;
//use pocketmine\math\Vector3;
//use pocketmine\entity\Location;

class Stick implements Listener {

    private $plugin; //<- criando uma variavel privada

    //Especie de init do python: __init__(self)
    public function __construct(Main $plugin) {
        $this -> plugin = $plugin;
        //self.plugin = plugin
    }


    public function onPlayerInteract(PlayerItemUseEvent $event) {
        $player = $event -> getPlayer(); //estanciando o player
        $item = $player -> getInventory() -> getItemInHand();  //mao do jogador
        //$action = $event -> getAction(); <- acao !PlayerInteractEvent

        
        //$this -> plugin -> getServer()-> getLogger() -> info((string)$action);


        $item_id = $item->getTypeId(); //Id do iten segurado na mao
        $item_stick = ItemTypeIds::STICK; // objeto item: stick do minecraft
        
        //$item_stick = Item::STICK; -- error -> versao antiga
        //$item_id = $item -> getId(); -- error -> versao antiga 

        if ($item_id === $item_stick) {
            $event -> cancel(); //cancela o uso padrao
            
            $loc = $player->getLocation(); // <- esta é a forma correta

            /*

            getLocation() contem |
                                 v
            getX(); < -
            getY(); < -
            getZ(); < - 

            */

            $x = $loc->getX();
            $y = $loc->getY() + 5;
            $z = $loc->getZ();

            $world = $loc->getWorld(); // o mundo que esta 
            $yaw = $loc->getYaw();  // rotacao horizontal
            $pitch = $loc->getPitch(); // rotacao vertical

            $i = new Location($x, $y, $z, $world, $yaw, $pitch);
                
            $snowball = new Snowball(
            $i,
            $player
            //,$player->getDirectionVector()->multiply(1.5) // direção e velocidade
        );

        $snowball -> setMotion($player -> getDirectionVector() -> multiply(2));
        //$player->getWorld()->addEntity($snowball);
        $snowball->spawnToAll(); //cria entidades sem adicionar fisicamente 

        }
    }


}