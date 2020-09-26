<?php
class CoinModel extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	
	/*--------------------------
			GET PRICE COIN
	---------example-----------

	Bitcoin: symbol = btc
	Ethereum: symbol = eth
	Tether: symbol = usdt
	Pipple: symbol = xrp
	Bitcoin Cash: symbol = bch

	--------------------------*/
	function getPriceUsd($coin){
		$result = 0;
		//get price list coin from API
		$jsonDatePriceCoin = file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=&sparkline=false');
		//convert array list to json
		$arrayDatePriceCoin = json_decode($jsonDatePriceCoin,true);
		//get price detail to array
		if (!empty($arrayDatePriceCoin)) {
			foreach ($arrayDatePriceCoin as $val) {
				if ($val['symbol'] == $coin) {
					$result = (float)$val['current_price'];
				}
			}
		}
		return $result;
	}
}
?>