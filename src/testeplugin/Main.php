<?php

namespace testeplugin; // <- pasta principal

//imports
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;


class Main extends PluginBase {

    //private $stick; //criando um variavel privada

    public function onEnable(): void {
        //$this -> stick = new Stick($this); // estanciando uma classe (novo objeto)

        //registrar evento
        $this -> getServer() -> getPluginManager() -> registerEvents(new Stick($this), $this) ;
        $this -> getLogger() -> info("Teste ativado");
    }

    public function onDisable(): void {
        $this -> getLogger() -> info("Teste desativado!");
    }

}

