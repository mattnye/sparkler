/* ============================================================================
   jQuery
   ============================================================================ */
$(document).ready(function(){
	
	/* Phone number touch analytics
	   ============================================================================ */
	/*$('.tel-link').on('touchstart', function(){
		ga('send', 'event', 'Phone Numbers', 'Touch');
		//alert('Tel Link');
	});*/
	
	/* Resecure Google Maps
	   The WordPress HTTPS plugin incorrectly removes HTTPS on Google Maps
	   ============================================================================ */
	/*var map_src = $('.map iframe').attr('src');
	if (map_src) {
		var map_new = map_src.replace('http:', 'https:');
		$('.map iframe').attr('src', map_new);
	}*/
	
	/* Stop hash link jump
	   ============================================================================ */
	$('a[href="#"]').click(function(){
		return false;
	});
	
	/* External Link Icon
	   ============================================================================ */
	$('a[target="_blank"]')
		.not('.btn, [class*="a2a_"], :has(img), #nav .menu > ul > li > a')
		.append('<span class="icon icon-after icon-inline icon-external-link"></span>');
	
	/* Dynamic Grid
	   ============================================================================ */
	$('.dynagrid .grid3:nth-child(4n), .dynagrid .grid4:nth-child(3n), .dynagrid .grid6:nth-child(2n)')
		.addClass('last')
		.after('<div class="clear"></div>');
	
	/* Tabs
	   ============================================================================ */
	$('.tabs nav a').click(function(){
		
		// Get nav item index and offset for div
		var i = $(this).parents('.tabs nav').find('a').index(this) + 2;
		
		// Change current tab
		$(this).parents('ul').find('a').removeClass('current');
		$(this).addClass('current');
		
		// Show/hide content
		$(this).parents('.tabs').children('div').hide();
		$(this).parents('.tabs').children('div:nth-child(' + i + ')').show();
		
		// Remove validation errors
		$('.formError').remove();
		
		return false;
	});
	
	/* Accordion
	   ============================================================================ */
	$('.accordion > h3 a').click(function(){
		
		// Change current state
		$(this).parent().siblings('h3').children('a').removeClass('current icon-minus6').addClass('icon-plus5');
		$(this).toggleClass('current icon-minus6 icon-plus5');
		
		// Show/hide content
		$(this).parent().siblings('div').slideUp('fast');
		$(this).parent().next('div:hidden').slideDown('fast');
		
		return false;
	});
	
	/* Animations
	   ============================================================================ */
	(function($) {
	
	    /**
	     * Copyright 2012, Digital Fusion
	     * Licensed under the MIT license.
	     * http://teamdf.com/jquery-plugins/license/
	     *
	     * @author Sam Sehnert
	     * @desc A small plugin that checks whether elements are within
	     *       the user visible viewport of a web browser.
	     *       only accounts for vertical position, not horizontal.
	     */
		$.fn.visible = function(partial) {
		    var $t            = $(this),
			    $w            = $(window),
			    viewTop       = $w.scrollTop(),
			    viewBottom    = viewTop + $w.height(),
			    _top          = $t.offset().top,
			    _bottom       = _top + $t.height(),
			    compareTop    = partial === true ? _bottom : _top,
			    compareBottom = partial === true ? _top : _bottom;
		    
			return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
	    };
	})(jQuery);
	
	var win = $(window);
	var ani = $('.ani');
	
	ani.each(function(i, el) {
	    var el = $(el);
	    if (el.visible(true)) {
		    el.addClass('already-visible');
	    }
	});
	
	win.scroll(function(event) {
	    ani.each(function(i, el) {
		    var el = $(el);
		    if (el.visible(true)) {
				el.addClass('ani-go');
		    }
	    });
	});
	
	/* Parallax
	   ============================================================================ */
	if ($(window).width() > 1006) {
		
		$('.parallax').each(function(){
			var $this = $(this);
			
			$(window).scroll(function(){
				/* TODO: Offset by initial position
				var position = $this.position();
                var yPos = (($(document).scrollTop() - position.top) / $this.data('speed'));*/
				
				var yPos = -(($(this).scrollTop() - 1000) / $this.data('speed'));
				
				// Put together our final background position
				var coords = '50% '+ yPos + 'px';
				
				// Move the background
				$this.css('background-position', coords);
			});
		});
	}
	
	/* Scroll Links
	   ============================================================================ */
	$('a[href*="#"]:not([href="#"])').click(function() {
		
		// Only works for internal links
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			
			// Get target
			var target = $(this.hash);
			
			// use ID attribute if exists, otherwise use name
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			
			// Get header height for offset
			var header_height = $('#header').height();
			
			// Scroll
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - header_height
				}, 800, 'easeOutExpo');
				return false;
			}
		}
	});
	
	/* Top Scroll
	   ============================================================================ */

	// Show/hide button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 500 && $(window).width() > 768) {
			$('.top-scroll').fadeIn();
		} else {
			$('.top-scroll').fadeOut();
		}
	});
	
	// Scroll body to 0px
	$('.top-scroll').click(function(){
		$('html, body').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	/* FancyBox
	   ============================================================================ */
	
	// Single images
	$('a.zoom').fancybox({
		padding			: 15,
		margin			: [42,63,42,63],
		autoSize		: true,
		autoCenter		: true,
		
		openEffect		: 'fade', // elastic, fade, none
		closeEffect		: 'fade', // elastic, fade, none
		nextEffect		: 'none', // elastic, fade, none
		prevEffect		: 'none', // elastic, fade, none
		
		openSpeed		: 250,
		closeSpeed		: 250,
		nextSpeed		: 250,
		prevSpeed		: 250,
		
		helpers : {
			title : {
				type : 'outside', // float, inside, outside, over
			},
			overlay : {
				locked : true,
				css : {
					'background' : 'rgba(0,0,0,.75)',
				},
			},
			/*thumbs : {
				width  : 50,
				height : 50,
			},*/
		},
		beforeShow : function() {
			// Use alt attribute as caption
			/*var alt = this.element.find('img').attr('alt');
			this.inner.find('img').attr('alt', alt);
			this.title = alt;*/
		},
	});
	
	// Gallery images
	$('.gallery-type-image a').fancybox({
		padding			: 15,
		margin			: [42,63,42,63],
		autoSize		: true,
		autoCenter		: true,
		
		openEffect		: 'fade', // elastic, fade, none
		closeEffect		: 'fade', // elastic, fade, none
		nextEffect		: 'none', // elastic, fade, none
		prevEffect		: 'none', // elastic, fade, none
		
		openSpeed		: 250,
		closeSpeed		: 250,
		nextSpeed		: 250,
		prevSpeed		: 250,
		
		helpers : {
			title : {
				type : 'outside', // float, inside, outside, over
			},
			overlay : {
				locked : true,
				css : {
					'background' : 'rgba(0,0,0,.75)',
				},
			},
			/*thumbs : {
				width  : 50,
				height : 50,
			},*/
		},
		beforeLoad : function() {
			// Use gallery caption as caption
			var caption = this.element.parents('.gallery-item').find('.gallery-inner').html();
			this.title = caption;
		},
	});
	
	/* Nav
	   ============================================================================ */	
	
	// Off-canvas more button
	function btn_nav_more_handler() {
		
		// Hide other open dropdowns
		$(this).parent().siblings().children('ul:visible').slideUp('fast');
		$(this).parent().siblings().children('.btn-nav-more')
			.removeClass('click icon-chevron-up2')
			.addClass('icon-chevron-down2');
		
		// Toggle button and dropdown
		$(this).toggleClass('click icon-chevron-down2 icon-chevron-up2');
		$(this).siblings('ul').slideToggle('fast');
		
		return false;
	}
	
	// Dropdown
	function dropdown_handler_on() {
		
		// Add hover to sibling anchors and trail
		$(this).children('a').addClass('hover');
		
		// Dropdown animation
		$(this).find('ul:first').hide().slideDown(600, 'easeOutExpo');
	}
	function dropdown_handler_off() {
		
		// Remove hover
		$(this).children('a').removeClass('hover');
		
		// Hide dropdown
		$(this).find('ul:first').hide();
	}
	
	enquire.register('screen and (max-width:767px)', {
		
		setup : function() {
			
			// Off-canvas menu button
			$('<a>', {
				'href' : '#',
				'class' : 'btn-nav icon icon-menu',
				'text' : 'View main menu',
			}).appendTo('#header .wrap');
			
			$('.btn-nav').click(function(){
				$('html').toggleClass('js-nav');
				return false;
			});
			
			// Off-canvas more button
			$('<a>', {
				'href' : '#',
				'class' : 'btn-nav-more icon icon-chevron-down2',
				'text' : '',
			}).prependTo('#nav li:has(ul)');
		},
		match : function() {
			
			// Bind off-canvas more button click
			$('.btn-nav-more').click(btn_nav_more_handler);
		},
		unmatch : function() {
			
			// Unbind off-canvas more button click
			$('.btn-nav-more').unbind('click');
		}
	});
	
	enquire.register('screen and (min-width:768px)', {
		
		match : function() {
			
			// Reset dropdowns
			$('#nav ul ul').hide();
			$('.btn-nav-more')
				.removeClass('click icon-chevron-up2')
				.addClass('icon-chevron-down2');
			
			// Bind dropdown hover
			$('.nav-hover #nav li').hover(dropdown_handler_on, dropdown_handler_off);
			
			// Bind off-canvas more button click
			$('.nav-click .btn-nav-more').click(btn_nav_more_handler);
		},
		unmatch : function() {
			
			// Unbind dropdown hover animation
			$('.nav-hover #nav li').unbind('mouseenter mouseleave');
			
			// Unbind and rebind off-canvas more button click to prevent double animation
			$('.btn-nav-more').unbind('click');
			$('.btn-nav-more').click(btn_nav_more_handler);
		}
	});
	
	/* Hide/Show Form Fields
	   ============================================================================ */
	// Are you still considering Oliver Heating & Cooling for your home improvement project?
	/*$('#choice_12_1_0').click(function() {$('#field_12_2').show(); $('#field_12_3,#field_12_4').hide();});
	$('#choice_12_1_1').click(function() {$('#field_12_3,#field_12_4').show(); $('#field_12_2').hide();});*/
	
	/* Datepickers
	   ============================================================================ */
	//$('.datepicker').datepicker();
	
	/* Form Validation
	   ============================================================================ */
	//$('form.validate').validationEngine();
	
	/* Zebra Striping
	   ============================================================================ */
	//$('.table-striped tr:nth-child(odd)').addClass('odd');
	
	/* Preload Images
	   ============================================================================ */
	//$('<img />').attr('src','/_img/arrow_top_on.gif');
	
	/* Tooltip
	   ============================================================================ */
	//tooltip();
	
});

$(window).load(function(){
	
	/* FlexSlider
	   ============================================================================ */
	
	// Thumbnails
	$('.flexslider.thumbs').flexslider({
		controlNav: 'thumbnails',       // Boolean or 'thumbnails': Create navigation for paging control of each slide? Note: Leave true for manualControls usage
		directionNav: false,            // Boolean: Create navigation for previous/next navigation? (true/false)
		prevText: '<span class="icon icon-inline icon-chevron-left2"></span>',  // String: Set the text for the "previous" directionNav item
		nextText: '<span class="icon icon-inline icon-chevron-right2"></span>', // String: Set the text for the "next" directionNav item
    });
		
	// Default
	$('.flexslider').flexslider({
		namespace: 'flex-',             // String: Prefix string attached to the class of every element generated by the plugin
		selector: '.slides > li',       // Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
		animation: 'fade',              // String: Select your animation type, "fade" or "slide"
		easing: 'swing',                // String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
		direction: 'horizontal',        // String: Select the sliding direction, "horizontal" or "vertical"
		reverse: false,                 // Boolean: Reverse the animation direction
		animationLoop: true,            // Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		smoothHeight: false,            // Boolean: Allow height of the slider to animate smoothly in horizontal mode  
		startAt: 0,                     // Integer: The slide that the slider should start on. Array notation (0 = first slide)
		slideshow: true,                // Boolean: Animate slider automatically
		slideshowSpeed: 7000,           // Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 800,            // Integer: Set the speed of animations, in milliseconds
		initDelay: 0,                   // Integer: Set an initialization delay, in milliseconds
		randomize: false,               // Boolean: Randomize slide order
		
		// Usability Features
		pauseOnAction: true,            // Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		pauseOnHover: false,            // Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		useCSS: true,                   // Boolean: Slider will use CSS3 transitions if available
		touch: true,                    // Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
		video: false,                   // Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
		
		// Primary Controls
		controlNav: true,               // Boolean or 'thumbnails': Create navigation for paging control of each slide? Note: Leave true for manualControls usage
		directionNav: true,             // Boolean: Create navigation for previous/next navigation? (true/false)
		prevText: '<span class="icon icon-inline icon-chevron-left2"></span>',  // String: Set the text for the "previous" directionNav item
		nextText: '<span class="icon icon-inline icon-chevron-right2"></span>', // String: Set the text for the "next" directionNav item
		
		// Secondary Navigation
		keyboard: true,                 // Boolean: Allow slider navigating via keyboard left/right keys
		multipleKeyboard: false,        // Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard 
		                                // navigation with more than one slider present.
										
		mousewheel: false,              // Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel)
		pausePlay: false,               // Boolean: Create pause/play dynamic element
		pauseText: 'Pause',             // String: Set the text for the "pause" pausePlay item
		playText: 'Play',               // String: Set the text for the "play" pausePlay item
		
		// Special Properties
		controlsContainer: '',          // jQuery Object/Selector: Declare which container the navigation elements should be appended too. 
		                                // Default container is the FlexSlider element. Example use would be $(".flexslider-container"). 
										// Property is ignored if given element is not found.
										
		manualControls: '',             // jQuery Object/Selector: Declare custom control navigation. 
		                                // Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. 
										// The number of elements in your controlNav should match the number of slides/tabs.
										
		sync: '',                       // Selector: Mirror the actions performed on this slider with another slider. Use with care.
		asNavFor: '',                   // Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
		
		// Carousel Options
		itemWidth: 0,                   // Integer: Box-model width of individual carousel items, including horizontal borders and padding.
		itemMargin: 0,                  // Integer: Margin between carousel items.
		minItems: 0,                    // Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
		maxItems: 0,                    // Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
		move: 0,                        // Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
										
		// Callback API
		start: function(){},            // Callback: function(slider) - Fires when the slider loads the first slide
		before: function(){},           // Callback: function(slider) - Fires asynchronously with each slider animation
		after: function(){},            // Callback: function(slider) - Fires after each slider animation completes
		end: function(){},              // Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
		added: function(){},            // Callback: function(slider) - Fires after a slide is added
		removed: function(){}           // Callback: function(slider) - Fires after a slide is removed
	});
	
	/* Isotope
	   ============================================================================ */
	
	// Cache container
	/*var $c = $('.isotope');
	
	// Check for container
	if ($c.length) {
		
		/**
		 * Combination Filters
		 */
		
		// Flatten object by concatting values
		/*function concat_values(obj) {
			var value = '';
			for (var prop in obj) {
			    value += obj[prop];
			}
			return value;
		}
		
		// Store filter for each group
		var filters = {};
		
		$('.isotope-group a').click(function(){
			var $this = $(this);
		    
			// Get group key
		    var $group = $this.parents('.isotope-group');
		    var filter_group = $group.attr('data-filter-group');
		    
			// Set filter for group
		    filters[filter_group] = $this.attr('data-filter');
		    
			// Combine filters
		    var filter_value = concat_values(filters);
			
			// Filter and sort items
		    $c.isotope({
				layoutMode : 'fitRows',
				filter : filter_value,
			});
			
			// Change current state
			$(this).parents('.isotope-group').find('a').removeClass('current');
			$(this).addClass('current');
			
			return false;
		});
		
		/**
		 * Single Filters
		 */
		/*$('.isotope-filters a').click(function(){
			
			// Filter and sort items
			var attr = $(this).attr('data-filter');
			$c.isotope({
				layoutMode : 'fitRows',
				filter : attr,
			});
			
			// Change current state
			$(this).parents().find('.isotope-filters a').removeClass('current');
			$(this).addClass('current');
			
			return false;
		});
	}*/
});

/* Tooltip
   ============================================================================ */
/*this.tooltip = function(){	
		xOffset = 10;
		yOffset = 20;		
	$("a.tooltip").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("a.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});
};*/