$(function() {
	$("#addFriendBtn").click(add_friend);
    $("#removeFriendBtn").click(remove_friend);
    $("#changeFriendBtn").click(change_friend);

	$('#login').submit(function(e){
		e.preventDefault();
		var url = $(this).attr('action');
		var data = $(this).serialize();
		login(url, data);     
	});

	$('#sendPicture').submit(function(e){
		e.preventDefault();
		var username = $('#username').val();
		var time = $('#time').val();
		var caption = $('#caption').val();
   		sendSnap(username, time, caption);
	});

	$('#feed-refresh').click(function(e){
		$('#feed').html("");
		$('#snap-loading').show();
		e.preventDefault();
		feed();     
	});

	$('#story-refresh').click(function(e){
		$('#feed-story').html("");
		$('#story-loading').show();
		e.preventDefault();
		feedStory();     
	});

	$('body').on('click', '#feed a',function(e){
		$('#feed a').removeClass('active');
    	$(this).addClass('active');
		$('#show-loading').show();
		var url = $(this).attr('href');		
		e.preventDefault();
		download(url);     
	});

	$('body').on('click', '#feed-story a',function(e){
		$('#feed-story a').removeClass('active');
    	$(this).addClass('active');
		$('#show-loading').show();
		var url = $(this).attr('href');		
		e.preventDefault();
		story(url);     
	});

    function readURL(e) {
        if (e.files && e.files[0]) {
            var t = new FileReader;
            t.onload = function (e) {
                $("#preview").attr("src", e.target.result)
            };
            t.readAsDataURL(e.files[0])
        }
    }

    $(".files").change(function () {
        readURL(this)
    });
    
	
	$('#show-loading').hide();

});	

function sendSnap(username, time, caption) {
	var file =  $("#file")[0].files[0];
	var formData = new FormData($("#sendPicture"));
	formData.append("username", username);
	formData.append("time", time);
    formData.append("caption", caption);
    formData.append("file", file);
    $('#sendSnap').attr({'disabled' : 'true', 'value' : 'Submitting...' });

    $.ajax({
      url: 'api/send',
      type: 'POST',
      data: formData,
      success: function(data){
      	data = jQuery.parseJSON(data);
        $('#sendSnap').removeAttr('disabled').attr('value', 'Submit');   
        $('#status').html(data);
      },
      error: function(){
        $('#sendSnap').removeAttr('disabled').attr('value', 'Submit');     
      },
      cache: false,
      contentType: false,
      processData: false 
    });
}	
function add_friend() {
	var username = $("#add_user").val();
	friend("add", username)
}

function remove_friend() {
	var username = $("#removeUser option:selected").text();
	friend("remove", username)
}

function change_friend() {
	var username = $("#changeDisplay option:selected").text();
	var display = $("#new-display").val();
	friend("change", username, display)
}

function login(url, data) {
	$('.oops').html("");
	$('#btnLogin').attr('disabled','disabled');
	$("#btnLogin").css('background', 'url(/imgs/submit.gif) 50% -3px');
	$("#btnLogin").css('color', 'transparent');		
	$.post(url, data).done(function(data){
		$('#btnLogin').removeAttr('disabled');
		$("#btnLogin").css('color', '#ffffff');
		$("#btnLogin").css('background', '#4ea885');
		data = jQuery.parseJSON(data);
		if(data === false) {
			$(".oops").append('<div class="alert alert-warning">We\'re sorry, that password does not match the username or email address provided or the captcha may be incorrect.</div>');
		} else if (data == true) {
			location.reload();
		}
	});
}	

function download(url) {
	$.post(url).done(function(data){
		data = jQuery.parseJSON(data);
		$('#showcase').html(data[0]);
		$('#feed-title').html(data[1]);
		$('#show-loading').hide();
	});
}

function story(url) {
	$.post(url).done(function(data){
		data = jQuery.parseJSON(data);
		$('#showcase').html(data);
		$('#show-loading').hide();
	});
}	

function feed() {
	$.post('api/feed').done(function(data){
		data = jQuery.parseJSON(data);
		$('#feed').html(data[0]);
		$('#feed-time').html(data[1]);
		$('#snap-loading').hide();
	});

}	

function feedStory() {
	$.post('api/feedStory').done(function(data){
		data = jQuery.parseJSON(data);
		$('#feed-story').html(data);
		$('#story-loading').hide();
	});
}

function friend(choice, user, display){
	event.preventDefault();
	$.ajax({
		type: "POST",
		url: '/api/friend',
		data: {
			choice: choice,
			user: user,
			display: display
		},
		beforeSend: function(){
			$('.btnFriend').attr('disabled','disabled');
		},
		complete: function(){
			$('.btnFriend').removeAttr('disabled')
		},
		success: function(data){          
			data = jQuery.parseJSON(data);
			if(choice == "add") {
				$('#friend-status').html(''
					+'<div class="alert alert-danger">'
					+'You have sucessfully added <strong>'+user+'</strong>.'
					+'</div>'
					);
			} else if(choice == "remove") {
				$('#friend-status').html(''
					+'<div class="alert alert-danger">'
					+'You have sucessfully removed <strong>'+user+'</strong>.'
					+'</div>'
					);
			} else if(choice == "change") {
				$('#friend-status').html(''
					+'<div class="alert alert-danger">'				
					+'You have sucessfully changed <strong>'+user+'</strong> '
					+'to <strong>'+display+'</strong>.'
					+'</div>'
					);
			}

		}
	});
}

