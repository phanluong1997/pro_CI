<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Dashboard_Controller {
	/**
	Controller main template user
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	//Main action
	public function index()
	{
		$data = array(
			'data_index'	=> $this->get_index(),
			'title'		=>	'Dashboard',
			'template' 	=> 	'dashboard/home/index'
		);
		$this->load->view('dashboard/default/index', isset($data)?$data:NULL);
	}

	//Test sendEmail (incomplete) - OT1
	public function send()
	{
		$this->load->library('email');

		$subject = 'This is a test';
		$message = 'Test message';

		// Get full html:
		$body = 'Bằng một cách thần kỳ nào đó thì em đã gửi được cái mail rồi a ợ :v';
		
		// End attaching the logo.

		$result = $this->email
		    ->from('sentemail.optech@gmail.com')
		    ->reply_to('sentemail.optech@gmail.com')    // Optional, an account where a human being reads.
		    ->to('phucthao205@gmail.com')
		    ->subject($subject)
		    ->message($body)
		    ->send();

		var_dump($result);
		echo '<br />';
		echo $this->email->print_debugger();

		exit;
		// 
	}

	
	
}
