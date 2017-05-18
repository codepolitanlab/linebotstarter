<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \LINE\LINEBot;
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;

class Webhook extends CI_Controller {

	private $bot;
	private $events;
	private $signature; 
	private $user;

	function __construct()
	{
		parent::__construct();
		$this->load->model('tebakkode_m');
	}

	public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo "Hello Coders!";
			header('HTTP/1.1 400 Only POST method allowed');
			exit;
		} 

		// get request
		$body = file_get_contents('php://input');
		$this->signature = isset($_SERVER['HTTP_X_LINE_SIGNATURE']) ? $_SERVER['HTTP_X_LINE_SIGNATURE'] : "-";
		$this->events = json_decode($body, true);

		// log every event requests);
		$this->tebakkode_m->log_events($this->signature, $body);

		// create bot object
		$httpClient = new CurlHTTPClient($_SERVER['CHANNEL_ACCESS_TOKEN']);
		$bot  = new LINEBot($httpClient, ['channelSecret' => $_SERVER['CHANNEL_SECRET']]);

		foreach ($this->events['events'] as $event)
		{
			/* THIS IS THE STRUCTURE
			{
				"events": [
					{
						"replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
						"type": "message",
						"timestamp": 1462629479859,
						"source": {
							"type": "user",
							"userId": "U206d25c2ea6bd87c17655609a1c37cb8"
						},
						"message": {
							"id": "325708",
							"type": "text",
							"text": "Hello, world"
						}
					}
				]
			}
			*/

			// DO YOUR CODE HERE
			
		}

	}
}