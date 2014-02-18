<?php

class View {

	function __construct() {}

	public function render($name, $include = false) {
		if($include == true) {

		} else {
			require 'views/header.php';
			require 'views/'.$name.'.php';
			require 'views/footer.php';
		}
	}
}

?>