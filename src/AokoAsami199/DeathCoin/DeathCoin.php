<?php

namespace AokoAsami199\DeathCoin;

use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use onebone\coinapi\CoinAPI;

class DeathCoin extends PluginBase implements Listener{

    public function onEnable() : void
    {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDeath(PlayerDeathEvent $event) : void
    {
        $player = $event->getPlayer();
        if(!$player->getLastDamageCause() instanceof EntityDamageByEntityEvent) return;
        $playerCoin = CoinAPI::getInstance()->myCoin($player);
        $damager = $player->getLastDamageCause()->getDamager();
        if (!$damager instanceof Player)
        {
            $this->naturalCoinLoss($player, $playerCoin);
            return;
        }
        if ($this->getConfig()->get("Type") == "all"){
            if ($this->getConfig()->get("KillerGainCoin"))
            {
                $damager->sendMessage("§aYou have killed " . $player->getName() . " and stole $" . $playerCoin);
                CoinAPI::getInstance()->addCoin($damager, $playerCoin);
            }
            $player->sendMessage("§aYou have died and lost $" . $playerCoin);
            CoinAPI::getInstance()->reduceCoin($player, $playerCoin);
        }
        if ($this->getConfig()->get("Type") == "half"){
            if ($this->getConfig()->get("KillerGainCoin"))
            {
                $damager->sendMessage("§aYou have killed " . $player->getName() . " and stole $" . $playerCoin / 2);
                CoinAPI::getInstance()->addCoin($damager, $playerCoin / 2);
            }
            $player->sendMessage("§aYou have died and lost $" . $playerCoin / 2);
            CoinAPI::getInstance()->reduceCoin($player, $playerCoin / 2);
        }
        if ($this->getConfig()->get("Type") == "amount"){
            if ($this->getConfig()->get("KillerGainCoin"))
            {
                $damager->sendMessage("§aYou have killed " . $player->getName() . " and stole $" . (double)$this->getConfig()->get("Coin-Loss"));
                CoinAPI::getInstance()->addCoin($damager, (double)$this->getConfig()->get("Coin-Loss"));
            }
            $player->sendMessage("§aYou have died and lost $" . (double)$this->getConfig()->get("Coin-Loss"));
            CoinAPI::getInstance()->reduceCoin($player, (double)$this->getConfig()->get("Coin-Loss"));
        }
        if ($this->getConfig()->get("Type") == "percent"){
            if ($this->getConfig()->get("KillerGainCoin"))
            {
                $damager->sendMessage("§aYou have killed " . $player->getName() . " and stole $" . ((double)$this->getConfig()->get("Coin-Loss") / 100) * $playerCoin);
                CoinAPI::getInstance()->addCoin($damager, ((double)$this->getConfig()->get("Coin-Loss") / 100) * $playerCoin);
            }
            $player->sendMessage("§aYou have died and lost $" . ((double)$this->getConfig()->get("Coin-Loss") / 100) * $playerCoin);
            CoinAPI::getInstance()->reduceCoin($player, ((double)$this->getConfig()->get("Coin-Loss") / 100) * $playerCoin);
        }
    }

    public function naturalCoinLoss($player, $playerCoin)
    {
        if (!$this->getConfig()->get("LoseCoinNaturally")) return;
        if ($this->getConfig()->get("Type") == "all"){
            $player->sendMessage("§aYou have died and lost $" . $playerCoin);
            CoinAPI::getInstance()->reduceCoin($player, $playerCoin);
        }
        if ($this->getConfig()->get("Type") == "half"){
            $player->sendMessage("§aYou have died and lost $" . $playerCoin / 2);
            CoinAPI::getInstance()->reduceCoin($player, $playerCoin / 2);
        }
        if ($this->getConfig()->get("Type") == "amount"){
            $player->sendMessage("§aYou have died and lost $" . (double)$this->getConfig()->get("Coin-Loss"));
            CoinAPI::getInstance()->reduceCoin($player, (double)$this->getConfig()->get("Coin-Loss"));
        }
        if ($this->getConfig()->get("Type") == "percent"){
            $player->sendMessage("§aYou have died and lost $" . ((double)$this->getConfig()->get("Coin-Loss") / 100) * $playerCoin);
            CoinAPI::getInstance()->reduceCoin($player, ((double)$this->getConfig()->get("Coin-Loss") / 100) * $playerCoin);
        }
    }

}
