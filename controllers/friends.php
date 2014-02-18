<?php

class Friends extends Controller {
	
	function __construct() {
		parent::__construct();
	}

	function index() {

		if (empty($_SESSION['snapchat']->auth_token)) {
			$this->view->render('login/index');	
		} else {
			$friends = $_SESSION['snapchat']->getFriends();
			$this->view->friend_list = "";

			for ($i=0;$i<count($friends);$i++) {
				$this->view->friend_list .=  '<option>'.$friends[$i]->name.'</option>';
			}

			$this->view->render('friends/index');
		}
	}
}
?>