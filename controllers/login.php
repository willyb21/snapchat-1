<?php
class Login extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if (empty($_SESSION['snapchat']->auth_token)) {
			$this->view->render('login/index');	
		} else {
			$this->view->render('index/index');
		}
	}

}
?>