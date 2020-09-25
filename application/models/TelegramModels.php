<?php
class TelegramModels extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	function sendMessageChannel($apiToken, $data) {
		$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) ."&parse_mode=html");
		return json_decode($response, true);

	}
}
?>