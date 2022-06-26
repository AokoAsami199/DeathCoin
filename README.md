# DeathCoin

# Features 
- When a Player Dies, They Lose Coin
- Coin Loss on Death is Configurable
- Killer gets the coin after killing a player (optional)
- Coin loss on natural deaths (optional)
- Very customizable
# Important
- This plugin Requires CoinAPI by OneBone and BeeAZ (https://github.com/BeeAZ-pm-pl/CoinAPI-4.0.0)
# Config

```
# How much coin will the victims lose when they die? Type Options: "all", "half", "percent", "amount"
# all = Removes all of the victim's coin when they die
# half = Removes half of the victim's coin when they die  
# percent = Removes a percentage of the victim's coin. Example, If Coin-Loss = 25, 25% of the victim's coin will be removed
# amount = Removed the specified amount of coin. Example, If Coin-Loss = 25, the victim's will lost $25.
Type: percent

# Coin-Loss: does not need to be set if Type: is set to "all" or "half"
Coin-Loss: 25

# Should the victim lose Coin if they are not killed by another player
LoseCoinNaturally: false

# Should the killer gain the Coin the victim lost?
KillerGainCoin: true

```
# Credits
- ElectroGamesYT
- AokoAsami199


