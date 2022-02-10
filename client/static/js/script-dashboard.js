/*  Table of Contents
01. FLEXSLIDER DASHBOARD SLIDER
02. Video App Header On/Off Clickable Items
03. Video App Header On/Off Clickable Items
04. Range Slider in Header Search
05. Add to Favorites Menu ON/Off
06. Rating Selector
*/

jQuery(document).ready(function($) {
	 'use strict';




/*
=============================================== 01. FLEXSLIDER DASHBOARD SLIDER  ===============================================
*/
     $('.progression-studios-dashboard-slider').flexslider({
 		slideshow: false,  		/* Autoplay True/False */
 		slideshowSpeed: 8000,	/* Autoplay Speed */
 		animation: "fade",		/* Slideshow Transition Animation */
 		animationSpeed: 800, 	/* Slide Transition Speed */
 		directionNav: true,		/* Left/Right Navigation True/False */
 		controlNav: true,		/* Bullet Navigaion True/False */
 		prevText: "",
 		nextText: "",
     });


/*
=============================================== 02. Video App Header On/Off Clickable Items  ===============================================
*/
	$("#header-user-profile-click").click(function() {
		var $this = $("#header-user-profile");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});


	$("#header-user-notification-click").click(function() {
		var $this = $("#header-user-notification");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});


	$("#search-icon-more").click(function() {
		var $this = $("#video-search-header");
	    if ($this.hasClass('active')) {
	        $this.removeClass('active').addClass('hide');
	    } else {
	        $this.addClass('active');
	    }
	});

	/* If clicking outside of boxes, automatically hide */
	$(document).click(function(e) {
	    if (e.target.id != 'header-user-profile' && !$('#header-user-profile').find(e.target).length) {
	        if ($("#header-user-profile").hasClass('active')) {
	        	$("#header-user-profile").removeClass('active').addClass('hide');
	        }
	    }

	    if (e.target.id != 'header-user-notification' && !$('#header-user-notification').find(e.target).length) {
	        if ($("#header-user-notification").hasClass('active')) {
	        	$("#header-user-notification").removeClass('active').addClass('hide');
	        }
	    }

	    if (e.target.id != 'video-search-header' && !$('#video-search-header').find(e.target).length) {
	        if ($("#video-search-header").hasClass('active')) {
	        	$("#video-search-header").removeClass('active').addClass('hide');
	        }
	    }
	});
	


});
