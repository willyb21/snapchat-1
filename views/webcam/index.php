<div class="row">
	<div class="col-md-4 col-md-offset-4 text-center">
		<div class="well">
			<h1 class="login-title green">Send Snap From Webcam</h1>
			<hr/>	
			<script>
				document.write(webcam.get_html(320, 260));
			</script>
			<hr/>
			<input class="btn btn-primary" type=button value="Configure..." onClick="webcam.configure()">
			<input class="btn btn-primary" type=button value="Take Snapshot" onClick="take_snapshot()">
		</div>
	</div>
</div>