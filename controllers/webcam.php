<?php

class Webcam extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->view->script = '
<script>
webcam.set_api_url(\'camera.php\' );
webcam.set_quality( 90 ); 
webcam.set_shutter_sound( true ); 
</script>
<script>
webcam.set_hook(\'onComplete\', \'my_completion_handler\' );

function take_snapshot() {
	document.getElementById(\'upload_results\').innerHTML = \'<h1>Uploading...</h1>\';
	webcam.snap();
}
function my_completion_handler(msg) {
	if (msg.match(/(http\:\/\/\S+)/)) {
		var image_url = RegExp.$1;
		document.getElementById(\'upload_results\').innerHTML = 
		\'<div id="weburl" style="display:none;">\'+ image_url+\'</div>\' + 
		\'<img src="\' + image_url + \'">\' +
		\'<h4>Upload Successful!</h4>\' ;

		webcam.reset();
	}
	else alert("PHP Error: " + msg);
}
</script>';

		$this->view->render('webcam/index');
	}


}