<?php

class Send extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if (empty($_SESSION['snapchat']->auth_token)) {
			$this->view->render('login/index');	
		} else {
			$this->view->render('send/index');
		}
	}

	public function other($arg = false) {
		require 'models/help_model.php';
		$model = new Help_Model();
	}

}