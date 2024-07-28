$(document).ready(function() {
	$('.chat_icon').click(function() {
		$('.chat_box').toggleClass('active');
	});

$('.chat_video').click(function() {
	//alert("clicked");
		window.location.href="./agoraTest/index.html";
	});
	$('.my-conv-form-wrapper').convform({selectInputStyle: 'disable'})
});
