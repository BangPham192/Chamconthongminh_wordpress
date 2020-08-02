jQuery(document).ready(function() {
  
	jQuery('#main-menu .menu').mobileMenu({
			defaultText: 'Navigate to...',					//default text for select menu
			className: 'select-menu',						//class name
			subMenuDash: '&nbsp;&nbsp;&nbsp;&ndash;'		//submenu separator
	});
	
	jQuery("#main-menu").show();	
	jQuery('#main-menu ul.menu').superfish({				// main menu settings
		hoverClass:  'over', 								// the class applied to hovered list items 
		delay:       100,                            		// one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  		// fade-in and slide-down animation 
		speed:       150,                          			// faster animation speed 
		autoArrows:  false,                           		// disable generation of arrow mark-up 
		dropShadows: true,                            		// disable drop shadows 
		delay       : 0		
	});	
	
	jQuery("#wt-slider").show();
	jQuery('#wt-slider').flexslider({					// slider settings
		animation: "slide",								// animation style
		controlNav: true,								// slider thumnails class
		slideshow: true,								// enable automatic sliding
		directionNav: false,							// disable nav arrows
		slideshowSpeed: 6000,   						// slider speed
		smoothHeight: false,
		keyboard: true,
		mousewheel: true,
		controlsContainer: "#wt-slider .slider-nav",
	});	
	
	
	jQuery(".widget-tab-titles li").click(function() {
		jQuery(".widget-tab-titles li").removeClass('active');
		jQuery(this).addClass("active");
		jQuery(".tab-content").hide();
		var selected_tab = jQuery(this).find("a").attr("href");
		jQuery(selected_tab).fadeIn();
		return false;
	});
    
	jQuery(".widget_video iframe").each(function(){
      var ifr_source = jQuery(this).attr('src');
      var wmode = "wmode=transparent";
      if(ifr_source.indexOf('?') != -1) jQuery(this).attr('src',ifr_source+'&'+wmode);
      else jQuery(this).attr('src',ifr_source+'?'+wmode);
	});	
	
});