<?php

class Api {

	public static function login() {
		$status = false;
		$privkey="yOS12yir9TxDrwIYRSmjfjIMr6KWBsIM";
		$hashkey="zQ4F403mLlIzJFPQEUDAdz-oBfWnqIah";
		$solvemedia_response = solvemedia_check_answer($privkey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["adcopy_challenge"],
			$_POST["adcopy_response"],
			$hashkey);

		if(isset($_POST['username']) && isset($_POST['password'])) {
			$username =  strtolower(stripslashes(htmlspecialchars($_POST['username'])));
			$password = stripslashes(htmlspecialchars($_POST['password']));
			$snapchat = new Snapchat($username,$password);
			if(!empty($snapchat->auth_token)) {
				Session::set('auth', true);
				Session::set('username', $username);
				Session::set('password', $password);
				Session::set('snapchat', $snapchat);
				$status = true;
				echo json_encode($status);
			} elseif (!$solvemedia_response->is_valid) {
				$status = false;
				echo json_encode($status);
			} else {
				$status = false;
				echo json_encode($status);
			}

			die();
		}
	}

	static function feed() {
		if(isset($_SESSION['username']) && isset($_SESSION['snapchat'])) {
			$username = strtolower($_SESSION['username']);			
			$snaps = $_SESSION['snapchat']->getSnaps();
			$data = [0 => "", 1 => ""];
			if($snaps == null) {

			} else { 
				for($i=0; $i<count($snaps); $i++) {
					$ops = $snaps[$i]->sent;
					//$ops = $ops / 1000;
					//$time = date('jS F Y h:i:s', $ops);
					if ($snaps[$i]->sender !== $username && $snaps[$i]->media_type !== 3) {
						if ($snaps[$i]->status === 1) {
							if ($snaps[$i]->media_type === 0 || $snaps[$i]->media_type === 4) {
								$data[0] .='<a class="list-group-item" href="api/download/'.$snaps[$i]->sender.'/'.$snaps[$i]->id.'/'.$snaps[$i]->media_type.'"><span class="status d o"></span>'.$snaps[$i]->sender.'</a>';
							} else {
								$data[0] .='<a class="list-group-item" href="api/download/'.$snaps[$i]->sender.'/'.$snaps[$i]->id.'/'.$snaps[$i]->media_type.'"><span class="status dv ov"></span>'.$snaps[$i]->sender.'</a>';
							}
						}  elseif ($snaps[$i]->status === 2) {
							if ($snaps[$i]->media_type === 0 || $snaps[$i]->media_type === 4) {
								$data[0] .= '<a class="list-group-item" href="#"><span class="status o"></span>'.$snaps[$i]->sender.'</a>';
							} else {
								$data[0] .= '<a class="list-group-item" href="#"><span class="status ov"></span>'.$snaps[$i]->sender.'</a>';            
							} 
						}
					}
				}	
			}	

			$data[1] = date("n/d/Y G:ia"); 
			echo json_encode($data);
		}
		usleep(500000);
		die();		
	}

	static function download() {
		$data = [0 => "", 1 => "", 2 => ""];
		$root = dirname(__FILE__).'/..';
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$end = $url[4] == 0 ? 'jpeg': 'mp4';
		$folder = '/media/download/';
		$path = $url[2].'_'.$url[3].'.'.$end;
		$fullPath = $folder.$path;
		$full = $root.$folder.$path;
		$data[1] = $url[2].' snapped you:';
		$data[2] = 'http://snapchat.am'.$fullPath;
		if(!file_exists($fullPath)){
			if(isset($url[2]) && isset($url[3]) && isset($url[4])) {
				$content = $_SESSION['snapchat']->getMedia($url[3]);
				file_put_contents($full, $content);
			}
		}
		if(file_exists($full)){
			if($end == 'jpeg') {
				$data[0] = '<img src="'.$fullPath.'"/>';
			} else {
				$data[0] = '<video controls name="media"><source src="'.$fullPath.'" type="video/mp4"></video>';
			}
			

			$data[0] .= ' <div class="form-group form-horizontal"><label class="control-label col-sm-3">Direct Link</label>
    						<div class="col-sm-9"><input onClick="this.select();" type="text" class="form-control directLink"  value="'.$data[2].'" readonly></div></div>';
		}  
		echo json_encode($data);			
	}

	static function feedStory() {
		$data = "";
		if(!isset($_SESSION['stories'])) {
			
		}  elseif (isset($_SESSION['stories'])) {
			
		}
		$stories = $_SESSION['snapchat']->getFriendStories();
		Session::set('stories', $stories);
		$stories = $_SESSION['stories'];
		$names = [];
	
		if(isset($stories)) {				
				foreach($stories as $story) {
					if(!in_array($story->username, $names)) {	
						array_push($names, $story->username);
					}			
				}
		
				foreach($names as $name) {
					$data .= '<a class="list-group-item" href="api/story/'.$name.'">'.$name.'</a>';
				}
			echo json_encode($data);
			}

		
	}

	static function story() {
		if(!isset($_SESSION['stories'])) {
			$stories = $_SESSION['snapchat']->getFriendStories();
			Session::set('stories', $stories);
			
		}  else {
			$snapchat = $_SESSION['snapchat'];
			$stories = $_SESSION['stories'];
		}
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$teller = $url[2];
		$storage = array();
		for ($i=0; $i<count($stories); $i++) {
			$dt = "";
			if($stories[$i]->media_type == 0) {
				$dt = '.jpg';
			} else {
				$dt = '.mp4';
			}
			$prePath = 'media/story/story_'.$stories[$i]->username.'_'.$stories[$i]->media_id.$dt;			
			if($stories[$i]->username == $teller) {
				$finalPath = 'media/story/story_'.$stories[$i]->username.'_'.$stories[$i]->media_id.$dt;
				$fullPath = 'http://snapchat.am/'.$finalPath;
				if (file_exists($prePath) && filesize($prePath) > 0) {					
					if($dt == '.jpg') {
						$storage[] = '<img class="1" src="'.$finalPath.'"/>';
					} else {
						$storage[] = '<video controls name="media"><source src="'.$finalPath.'" type="video/mp4"></video>';
					}
				} else {
					$data = $snapchat->getStory($stories[$i]->media_id, $stories[$i]->media_key, $stories[$i]->media_iv);  
					file_put_contents($finalPath, $data);
					if($dt == '.jpg') {
						$storage[] = '<img src="'.$finalPath.'"/>';
					} else {
						$storage[] = '<video controls name="media"><source src="'.$finalPath.'" type="video/mp4"></video>';
					}

				}
			$storage[] = '<div class="form-group form-horizontal"><label class="control-label col-sm-3">Direct Link</label>
    						<div class="col-sm-9"><input onClick="this.select();" type="text" class="form-control directLink"  value="'.$fullPath.'" readonly></div></div>';
			}
		}

		echo json_encode($storage);
	}

	static function send() {
		if(isset($_SESSION['snapchat'])) {
			$snapchat = $_SESSION['snapchat'];
		}
		$stamp = time();
		$username = $_POST['username'];
		$time = $_POST['time'];
		$path = 'media/upload/'.$username.'_'.$stamp.'.jpg';

		$allowedExts = array("jpg", "jpeg", "gif", "png");
		@$extension = end(explode('.', $_FILES["file"]["name"]));

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/png")
		|| ($_FILES["file"]["type"] == "image/pjpeg"))
		&& ($_FILES["file"]["size"] < 5242880)
		&& in_array($extension, $allowedExts))
		{
			list($width, $height, $type, $attr) = getimagesize($_FILES['file'] ['tmp_name']);
			switch ($type) {
				case IMAGETYPE_GIF:
					$image = imagecreatefromgif($_FILES['file']['tmp_name']) or die($error);
					break;
				case IMAGETYPE_JPEG:
					$image = imagecreatefromjpeg($_FILES['file']['tmp_name']) or die($error);
					break;
				case IMAGETYPE_PNG:
					$image = imagecreatefrompng($_FILES['file']['tmp_name']) or die($error);
					break;
				default:
					die($status);
			}
		}
 		
		imagejpeg($image, $path);
		imagedestroy($image);

		if(file_exists($path)) {
			$id = $snapchat->upload(
				Snapchat::MEDIA_IMAGE,
				file_get_contents($path)
				);
			$send = $snapchat->send($id, array($username, $time));
			$data = '<br/><div class="alert alert-success">Snap sent to <strong>'.$username.'</strong>!</div>';
		}
		echo json_encode($data);
	}

	static function friend(){
		if(isset($_SESSION['snapchat'])) {
			$snapchat = $_SESSION['snapchat'];
			$username = strip_tags(stripslashes(htmlspecialchars($_POST['user'])));
			$which = strip_tags(stripslashes(htmlspecialchars($_POST['choice'])));
			$display = isset($_POST['display']) ? $_POST['display'] : null;		
			if($which == "add") {
				$snapchat->addFriend($username);
				$data = 1;
			} else if ($which == "remove") {
				$snapchat->deleteFriend($username);
				$data = 1;
			} else if ($which == "change") {
				$snapchat->setDisplayName($username, $display);
				$data = 1;
			} else {
				$data = 0;
			}
			echo json_encode($data);
			} 
	}

}

?>