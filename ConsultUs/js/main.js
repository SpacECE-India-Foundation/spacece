/* =================================
------------------------------------
	LERAMIZ - Landing Page Template
	Version: 1.0
 ------------------------------------ 
 ====================================*/


'use strict';


var window_w = $(window).innerWidth();


$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {

	/*------------------
		Navigation
	--------------------*/
	$('.nav-switch').on('click', function(event) {
		$('.main-menu').slideToggle(400);
		event.preventDefault();
	});


	/*------------------
		Background set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});



	$('.gallery').find('.gallery-item').each(function() {
		var pi_height1 = $(this).outerWidth(true),
		pi_height2 = pi_height1/2;
		
		if($(this).hasClass('grid-long') && window_w > 991){
			$(this).css('height', pi_height2);
		}else{
			$(this).css('height', Math.abs(pi_height1));
		}
	});



	$('.gallery').masonry({
		itemSelector: '.gallery-item',
	  	columnWidth: '.grid-sizer',
		gutter: 20
	});


	/*------------------
		Review Slider
	--------------------*/
	$('.review-slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: true,
        autoplay: true,
    });



    $('.clients-slider').owlCarousel({
		loop:true,
		autoplay:true,
		margin:30,
		nav:false,
		dots: true,
		responsive:{
			0:{
				items:2,
				margin:10
			},
			600:{
				items:3
			},
			800:{
				items:3
			},
			1000:{
				items:5
			}
		}
	});


	/*------------------
		Review Slider
	--------------------*/
	var sync1 = $("#sl-slider");
	var sync2 = $("#sl-slider-thumb");
	var slidesPerPage = 4; //globaly define number of elements per page
	var syncedSecondary = true;

	sync1.owlCarousel({
		items : 1,
		slideSpeed : 2000,
		nav: false,
		autoplay: true,
		dots: true,
		loop: true,
		responsiveRefreshRate : 200,
	}).on('changed.owl.carousel', syncPosition);

	sync2.on('initialized.owl.carousel', function () {
		sync2.find(".owl-item").eq(0).addClass("current");
	}).owlCarousel({
		items : slidesPerPage,
		dots: true,
		nav: true,
		margin: 10,
		smartSpeed: 200,
		slideSpeed : 500,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
		responsiveRefreshRate : 100
	}).on('changed.owl.carousel', syncPosition2);

	function syncPosition(el) {
		//if you set loop to false, you have to restore this next line
		//var current = el.item.index;
		//if you disable loop you have to comment this block
		var count = el.item.count-1;
		var current = Math.round(el.item.index - (el.item.count/2) - .5);

		if(current < 0) {
			current = count;
		}
		if(current > count) {
			current = 0;
		}

		//end block
		sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
		var onscreen = sync2.find('.owl-item.active').length - 1;
		var start = sync2.find('.owl-item.active').first().index();
		var end = sync2.find('.owl-item.active').last().index();

		if (current > end) {
			sync2.data('owl.carousel').to(current, 100, true);
		}
		if (current < start) {
			sync2.data('owl.carousel').to(current - onscreen, 100, true);
		}
	}

	function syncPosition2(el) {
		if(syncedSecondary) {
			var number = el.item.index;
			sync1.data('owl.carousel').to(number, 100, true);
		}
	}

	sync2.on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).index();
		sync1.data('owl.carousel').to(number, 300, true);
	});




	/*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});



	$('.video-link').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
    });

	// $('#Number').on('click',function(){
	// 	alert("hiii");
	// 	var val = Number
    //     if (/^\d{10}$/.test(val)) {
    //     // value is ok, use it
    //      } else {
    //       alert("Invalid number; must be ten digits")
    //        return false
    //      }
	//})
	


})(jQuery);

//bug Id-0000074

function validatePassword() {
    var password = $('#regPassword').val();
	var regix = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})");
	if(regix.test(password) == false ) {
		// alert('hh');
		$('.messageBox').html(`<span style="color:red;">
		  Password must be a minimum of 6 characters including number, Upper, Lower And 
		  one special character.
		</span>`);
		return false;
   }
   $('.messageBox').html('');
   return true;
}

// big id-0000026
function validate()
{
  var text = document.getElementById("pno").value;
  var regx = /^[6-9]\d{9}$/ ;
	if(regx.test(text)){
		$('.message').html(`<span style="color:red;"> 
		phone number should be of 10 digits.</span>`); 
		return false;
	}
$('.message').html('');
return true;
}
		// <!-- bug id-0000013 -->
		function validateEmail(email) {
			const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		  }
		  
		  function validate() {
			const $result = $("#result");
			const email = $("#email").val();
			$result.text("");
		  
			if (validateEmail(email)) {
			  $result.text(email + " is valid:");
			  $result.css("color", "green");
			} else {
			  $result.text(email + " is not valid:");
			  $result.css("color", "red");
			}
			return false;
		  }
		  
		  $("#email").on("input", validate);

		  
		  function fvalidate(){
			var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
			var fullname = document.getElementById('fullname').value;
			if(!regName.test(fullname)){
				alert('Please enter your full name (first & last name).');
				document.getElementById('fullname').focus();
				return false;
			}else{
				alert('Valid name given.');
				return true;
			}
		}
		
		function Uvalidation(){
			var username=document.getElementById("uname").value;///get id with value 
			var usernamepattern=/^[A-Za-z .]{3,15}$/;////Regular expression
			if(usernamepattern.test(username))
			{
				document.getElementById("uname").style.backgroundColor='yellow';
			}
			else
			{
				document.getElementById("uname").style.backgroundColor='red'; }
			}

			