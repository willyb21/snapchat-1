	<div class="container wrap">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Select a Picture</h3>
                </div>
                <div class="panel-body">
                   <?php
			$friends = $_SESSION['snapchat']->getFriends();
			$upload_form="";
			$friend_list = "";
			$upload_form .= '
			<form id="sendPicture" enctype="multipart/form-data" method="POST">
			<div class="form-group">				
			<label>Select a picture</label>
			<div>
				<span class="btn btn-default btn-file">
				    Select a picture or take a picture from iPhone <input id="file" type="file" class="files" name="picture" required="required" accept="image/*">
				</span>
			</div>
			</div>
			
	
			<div class="form-group">
			<label>Recipient:</label>
			<select id="username" name="username" class="form-control" required="required">
			<option selected>Please choose</option>';

			for ($i=0;$i<count($friends);$i++)
			{
				$friend_list .=  '<option>'.$friends[$i]->name.'</option>';
			}
			$upload_form .= $friend_list;
			$upload_form .= '</select>
			</div>
			<div class="form-group">
			<label>Time:</label>
			<select id="time" name="time" class="form-control" required="required">
			<option selected>1</option>';

			for ($i=2;$i<=10;$i++)
			{
				$upload_form .= '<option>'.$i.'</option>';
			}

			$upload_form .= '
			</select>
			</div>
			<div class="form-group">
			<label>Caption</label>
			<input type="text" id="caption" name="caption" class="form-control" maxlength="36">
			</div>
			<input type="submit" id="sendSnap" class="btn btn-lg btn-primary btn-block" value="Send"/>
			</form>
			<div id="status"></div>
			';                  
			echo $upload_form; 
			?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Picture to send</h3>
                </div>
                             <div class="panel-body">
			<img id="preview" src="/imgs/error.png">
                 </div>
                
            </div>
        </div>
    </div>
</div>