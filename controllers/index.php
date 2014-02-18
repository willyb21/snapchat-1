<?php
class Index extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if (empty($_SESSION['snapchat']->auth_token)) {
			$this->view->render('login/index');	
		} else {
			
			if (Session::get('auth') == true) {
				$this->view->script = '<script>
							$(function() {	   
								feed();
								feedStory();
							});	
							</script>';
			}

			$this->view->render('index/index');
		}
	}

}
?>