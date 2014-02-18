<div class="container wrap">
	<div class="row">
		<div class="col-md-12 text-center ad">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
            style="display:inline-block;width:970px;height:90px"
            data-ad-client="ca-pub-8778570931017346"
            data-ad-slot="2688583396"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div> 
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Add friends</h3> 
				</div> 
				<div class="panel-body">
					<div class="form-group">
						<label for="InputUsername">Username</label>
						<input type="text" name="username" id="add_user" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-primary btnFriend" id="addFriendBtn">Add Friend</button>
					</div>	
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Remove friends</h3> 
				</div> 
				<div class="panel-body">
					<div class="form-group">
						<label for="InputUsername">Username</label>
						<select id="removeUser" class="form-control" required="required">
							<option selected>Please choose</option>
							<?php echo $this->friend_list ?>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-primary btnFriend" id="removeFriendBtn">Remove Friend</button>
					</div>	
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Display Name</h3> 
				</div> 
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label for="InputUsername">Username</label>
							<select id="changeDisplay" class="form-control" required="required">
								<option selected>Please choose</option>
								<?php echo $this->friend_list ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="InputUsername">Change to</label>
							<input type="text" id="new-display" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<button type="submit"  class="btn btn-block btn-primary btnFriend" id="changeFriendBtn">Change</button>
						</div>		
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-4 text-center">
			<div id="friend-status"></div>
		</div>
	</div>
</div>
