/*--------------------------------------------------------------------------------------------------

 File: znscript.js

 Description: This is the main javascript file for this theme
 Please be careful when editing this file

 --------------------------------------------------------------------------------------------------*/
(function ($) {
	$.ZnThemeJs = function () {
		this.scope = $(document);
		this.zinit();
	};

	$.ZnThemeJs.prototype = {
		zinit : function() {
			var fw = this;

			fw.addactions();
			// EVENTS THAT CAN BE REFRESHED
			fw.refresh_events( $(document) );
			// $('.main-menu').ZnMegaMenu();
			fw.enable_responsive_menu();
			// Enable follow menu
			fw.enable_follow_menu();
		},

		refresh_events : function( content ) {

			var fw = this;

			// FITVIDS
			fw.enable_fitvids( content );

			// Enable menu offset - Prevents the submenus from existing the viewport
			fw.enable_menu_offset();

			// Enable magnificpopup lightbox
			fw.enable_magnificpopup( content );
			// Enable blog isotope
			fw.enable_blog_isotope( content );

			// enable woocommerce lazy images
			fw.enable_woo_lazyload( content );
			// Enable header sparckles
			fw.enable_header_sparkles( content );
			// Enable hover borders
			fw.enable_hoverborder( content );
			// Enable partners logo carousel
			fw.enable_partners_logo_carousel( content );
			// Enable recent works carousel
			fw.enable_recent_work_carousel( content );
			// ENABLE CONTACT FORMS
			fw.enable_contact_forms(content);
			// Enable circular carousel
			fw.enable_circular_carousel( content );
			// Enable GENERAL slider
			fw.enable_general_carousel( content );
			// Enable flickr feed
			fw.enable_flickr_feed( content );
			// Enable iCarousel
			fw.enable_icarousel( content );
			// Enable Ios Slider
			fw.enable_ios_slider( content );
			// Enable Portfolio Slider
			fw.enable_portfolio_slider( content );
			// Enable laptop slider
			fw.enable_laptop_slider( content );
			// Enable latest posts css accordion
			fw.enable_latest_posts_accordion( content );
			// Enable portfolio sortable
			fw.enable_portfolio_sortable( content );
			// Enable Grid photo gallery
			fw.enable_gridphotogallery( content );
			// Enable nivo slider
			fw.enable_nivo_slider( content );
			// Enable recent works 2
			fw.enable_recent_works2( content );
			// Enable recent works 3
			fw.enable_recent_works3( content );
			// Enable Latest Posts Carousel
			fw.enableLatestPostsCarousel(content);
			// Enable ScreenShoot box
			fw.enable_screenshoot_box( content );
			// Enable WOW slider
			fw.enable_wow_slider( content );
			// Enable mailchimp subscribe
			fw.enable_mailchimp_subscribe( content );
			// Enable testimonial fader
			fw.enable_testimonial_fader( content );
			// Enable testimonial slider
			fw.enable_testimonial_slider( content );
			// Enable shop limited offers
			fw.enable_shop_limited_offers( content );
			// Enable Static content - showroom carousel
			fw.enable_sc_showroomcarousel( content );
			// Enable Static content - Weather
			fw.enable_static_weather( content );
			// Enable Partners Testimonials Carousel
			fw.enable_testimonials_partners( content );
			// Enable IconBox
			fw.enable_iconbox( content );
			// Enable Appeared Elements
			fw.enable_appeared( content );
			// Enable SearchBox
			fw.enable_searchbox( content );
			// Enable video elements
			fw.enable_bg_video( content );
			// Enable toggle class
			fw.enable_toggle_class( content );
			// Enable diagram
			fw.enable_diagram(content);
			// Enable services
			fw.enable_services(content);
			// Enable twitter fader
			fw.enable_twitter_fader( content );

			fw.enable_shoplatest_presentation(content);
			// enable scrollspy
			fw.enable_scrollspy(content);
			// enable bootstrap tooltips
			fw.enable_tooltips(content);

		},

		RefreshOnWidthChange : function(content) {
		},

		addactions : function() {
			var fw = this;

			// Refresh events on new content
			fw.scope.on('ZnWidthChanged',function(e){
				fw.RefreshOnWidthChange(e.content);
				$(window).trigger('resize');
			});

			// Refresh events on new content
			fw.scope.on('ZnNewContent',function(e){
				fw.refresh_events( e.content );
			});

			// Refresh events on new content
			fw.scope.on('ZnBeforePlaceholderReplace',function(e){
				fw.unbind_events( e.content );
			});

		},

		unbind_events : function( scope ){
			// Remove iosSlider
			var iosSliders = scope.find( '.iosSlider' );
			if( iosSliders.length > 0 ){
				iosSliders.each(function(){
					$(this).iosSlider('destroy');
				});
			}
		},

		enable_woo_lazyload : function (scope){
			// Lazyload Woo Images
			var elements = scope.find( 'img[data-src]' );
			elements.each(function(index, el) {
				var $el = $(el);
				$el.attr('src', $el.attr('data-src') );
				$el.imagesLoaded( function() {
					$el.removeAttr('data-src');
				});
			});
		},

		/**
		 * Fixes submenus exiting the page on smaller screens
		 */
		enable_menu_offset : function(){

			$('#main-menu').find('ul li').on({
				"mouseenter.zn": function () {
					var $submenu = $(this).children('.sub-menu').first();
					if ( $submenu.length > 0 ) {
						var left_offset = $submenu.offset().left;
						var width = $submenu.width();

						if( $('body').has('.boxed') ){
							var pagewidth = $('#page_wrapper').width();
						}
						else{
							var pagewidth = $(window).width();
						}


						if ((left_offset + width) > pagewidth) {
							$submenu.addClass('zn_menu_on_left');
						}
					}
				},
				"mouseleave.zn": function () {
					var $submenu = $(this).children('ul').first();
					$submenu.removeClass('zn_menu_on_left');
				}
			});
		},

		enable_fitvids : function ( scope ) {

			var element = scope.find('.zn_iframe_wrap, .zn_pb_wrapper');
			if (element.length === 0) { return; }

			element.fitVids({ ignore: '.no-adjust'});

		},

		enable_contact_forms : function ( scope )
		{
			var fw = this,
			element = (scope) ? scope.find('.zn_contact_form_container > form') : $('.zn_contact_form_container > form');

			element.on( 'submit', function(e){

				e.preventDefault();

				if ( fw.form_submitting === true ) { return false; }

				fw.form_submitting = true;

				var form = $(this),
					response_container = form.find('.zn_contact_ajax_response:eq(0)'),
					has_error   = false,
					inputs =
					{
						fields : form.find('textarea, select, input[type=text], input[type=checkbox], input[type=hidden]')
					},
					form_id = response_container.attr('id'),
					submit_button = form.find('.zn_contact_submit');

				// FADE THE BUTTON
				submit_button.addClass('zn_form_loading');

				// PERFORM A CHECK ON ELEMENTS :
				inputs.fields.each(function()
				{
					var field       = $(this),
						p_container = field.parent();

					p_container.removeClass('zn_field_not_valid');

					// Check fields that needs to be filled
					if ( field.hasClass('zn_validate_not_empty') ) {
						if ( field.val() === '' )
						{
							p_container.addClass('zn_field_not_valid');
							has_error = true;
						}
					}
					else if ( field.hasClass('zn_validate_is_email') ) {
						if ( !field.val().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) )
						{
							p_container.addClass('zn_field_not_valid');
							has_error = true;
						}
					}
				});

				if ( has_error )
				{
					submit_button.removeClass('zn_form_loading');
					fw.form_submitting = false;
					return false;
				}

				response_container.load( form.attr('action')+' #'+form_id +' > .zn_cf_response' , inputs.fields , function()
				{
					// DO SOMETHING
					fw.form_submitting = false;
					submit_button.removeClass('zn_form_loading');
					inputs.fields.val('');

					// Perform the redirect if the form was valid
					var response = $('#'+form_id +' > .zn_cf_response'),
						redirect_uri = form.data( 'redirect' );
						
					// If the form was successfull
					if( response.hasClass('alert-success') && redirect_uri ){
						window.location.replace(redirect_uri);
					}

				});

				return false;

			});

		},

		/* Button to toggle a class
		* example: class="js-toggle-class" data-target=".kl-contentmaps__panel" data-target-class="is-closed"
		*/
		enable_toggle_class : function( scope ){
			var elements = scope.find( '.js-toggle-class' );
			elements.each(function(index, el) {
				var $el = $(el);
				$(el).on('click',function (e) {
					e.preventDefault();
					var target = $el.attr('data-target'),
						target_class = $el.attr('data-target-class') ? $el.attr('data-target-class') : '';
					if(target && target.length){
						$(target).toggleClass(target_class);
					}
				});
			});
		},

		enable_blog_isotope : function( scope ){
			var elements = scope.find( '.zn_blog_columns' );

			if( elements.length == 0) { return; }
			elements.imagesLoaded( function() {
		        elements.isotope({
		            itemSelector: ".blog-isotope-item",
		            animationEngine: "jquery",
		            animationOptions: {
		                duration: 250,
		                easing: "easeOutExpo",
		                queue: false
		            },
		            filter: '',
		            sortAscending: true,
		            sortBy: ''
		        });
	        });
		},

		/**
		 * Easy Video Background
		 * Based on easy background video plugin
		 * Example data setup attribute:
		 * @since  4.0
		 * data-setup='{ "position": absolute, "loop": true , "autoplay": true, "muted": true, "mp4":"", "webm":"", "ogg":""  }'
		 */
		enable_bg_video : function( scope ){
			var fw = this,
			elements = scope.find('.kl-video');


			elements.each(function(index, el) {
				var $video = $(el),
					_vid_controls = $video.next('.kl-video--controls'),
					_vid_playplause = _vid_controls.find('.btn-toggleplay'),
					_vid_audio = _vid_controls.find('.btn-audio'),
					_data_attribs = $video.attr("data-setup"),
					_options = typeof _data_attribs != 'undefined' ? JSON.parse(_data_attribs) : '{}';

				if(_options.height_container == true)
					$video.closest('.kl-video-container').css('height', $video.height());

				if(_options.hasOwnProperty('muted') && _options.muted == true) _vid_audio.children('i').addClass('mute');
				if(_options.hasOwnProperty('autoplay') && _options.autoplay == false) _vid_playplause.children('i').addClass('paused');

				if(typeof video_background != 'undefined') {
					var Video_back = new video_background( $video,
						{
							//Stick within the div or fixed
							"position": _options.hasOwnProperty('position') ? _options.position : "absolute",
							//Behind everything
							"z-index": _options.hasOwnProperty('zindex') ? _options.zindex : "-1",

							//Loop when it reaches the end
							"loop": _options.hasOwnProperty('loop') ? _options.loop : true,
							//Autoplay at start
							"autoplay": _options.hasOwnProperty('autoplay') ? _options.autoplay : false,
							//Muted at start
							"muted": _options.hasOwnProperty('muted') ? _options.muted : true,

							//Path to video mp4 format
							"mp4": _options.hasOwnProperty('mp4') ? _options.mp4 : false,
							//Path to video webm format
							"webm": _options.hasOwnProperty('webm') ? _options.webm : false,
							//Path to video ogg/ogv format
							"ogg": _options.hasOwnProperty('ogg') ? _options.ogg : false,
							//Path to video flv format
							"flv": _options.hasOwnProperty('flv') ? _options.flv : false,
							//Fallback image path
							"fallback_image": _options.hasOwnProperty('fallback_image') ? _options.fallback_image : false,
							// Youtube Video ID
							"youtube": _options.hasOwnProperty('youtube') ? _options.youtube : false,

							// flash || html5
							"priority": _options.hasOwnProperty('priority') ? _options.priority : "html5",
							// width/height -> If none provided sizing of the video is set to adjust
							"video_ratio": _options.hasOwnProperty('video_ratio') ? _options.video_ratio : false,
							// fill || adjust
							"sizing": _options.hasOwnProperty('sizing') ? _options.sizing : "fill",
							// when to start
							"start": _options.hasOwnProperty('start') ? _options.start : 0
						});
					//Toggle play status
					_vid_playplause.on('click',function(e){
						e.preventDefault();
						Video_back.toggle_play();
						$(this).children('i').toggleClass('paused');
					});
					//Toggle mute
					_vid_audio.on('click',function(e){
						e.preventDefault();
						Video_back.toggle_mute();
						$(this).children('i').toggleClass('mute');
					});
				}
			});

		},

		enable_follow_menu : function(){
			var doc = $(document),
				header = $('header#header'),
				chaser = $('#main-menu > ul'),
				forch = 300,
				visible = false;

			if( ! header.hasClass( 'header--follow' ) ){
				return false;
			}

			if(chaser && chaser.length > 0) {

				chaser.clone()
					.appendTo(document.body)
					.wrap('<div class="chaser"><div class="container"><div class="row"><div class="col-md-12"></div></div></div></div>');

				var _chaser = $('body .chaser');

				if(header && header.length > 0 ) {
					forch = header.offset().top + header.outerHeight(true);
				}

				if(doc.scrollTop() > forch) {
					_chaser.addClass('visible');
					visible = true;
				}

				$(window).on('scroll', function() {
					if (!visible && doc.scrollTop() > forch ) {
						_chaser.addClass('visible');
						visible = true;
					}
					else if (visible && doc.scrollTop() < forch ) {
						_chaser.removeClass('visible');
						visible = false;
					}
				});

			}
		},

		enable_responsive_menu : function(){

			var page_wrapper = $('#page_wrapper'),
				responsive_trigger = $('.zn-res-trigger'),
				menu_activated = false,
				back_text = '<li class="zn_res_menu_go_back"><span class="zn_res_back_icon glyphicon glyphicon-chevron-left"></span><a href="#">'+ZnThemeAjax.zn_back_text+'</a></li>',
				cloned_menu = $('#main-menu > ul').clone().attr({id:"zn-res-menu", "class":""});

			var start_responsive_menu = function()
			{
				var responsive_menu = cloned_menu.prependTo(page_wrapper);

				// BIND OPEN MENU TRIGGER
				responsive_trigger.click(function(e){
					e.preventDefault();
					responsive_menu.addClass('zn-menu-visible');
					set_height();
				});

				// Close the menu when a link is clicked
				responsive_menu.find( 'a' ).on('click',function(e){
					$( '.zn_res_menu_go_back' ).first().trigger( 'click' );
				});

				// ADD ARROWS TO SUBMENUS TRIGGERS
				responsive_menu
					.find('li:has(> ul.sub-menu), li:has(> div.zn_mega_container)')
					.addClass('zn_res_has_submenu')
					.prepend('<span class="zn_res_submenu_trigger glyphicon glyphicon-chevron-right"></span>');
				// ADD BACK BUTTONS
				responsive_menu
					.find('.zn_res_has_submenu > ul.sub-menu, .zn_res_has_submenu > div.zn_mega_container')
					.addBack()
					.prepend(back_text);

				// REMOVE BACK BUTTON LINK
				$( '.zn_res_menu_go_back' ).click(function(e){
					e.preventDefault();
					var active_menu = $(this).closest('.zn-menu-visible');
					active_menu.removeClass('zn-menu-visible');
					set_height();
					if( active_menu.is('#zn-res-menu') ) {
						page_wrapper.css({'height':'auto'});
					}
				});

				// OPEN SUBMENU'S ON CLICK
				$('.zn_res_submenu_trigger').on('click',function(e){
					e.preventDefault();
					$(this).siblings('ul,.zn_mega_container').addClass('zn-menu-visible');
					set_height();
				});
			};

			var set_height = function(){
				var _menu = $('.zn-menu-visible').last(),
					height = _menu.css({height:'auto'}).outerHeight(true),
					window_height  = $(window).height(),
					adminbar_height = 0,
					admin_bar = $('#wpadminbar');

				// CHECK IF WE HAVE THE ADMIN BAR VISIBLE
				if(height < window_height) {
					height = window_height;
					if ( admin_bar.length > 0 ) {
						adminbar_height = admin_bar.outerHeight(true);
						height = height - adminbar_height;
					}
				}
				_menu.attr('style','');
				page_wrapper.css({'height':height});
			};

			// MAIN TRIGGER FOR ACTIVATING THE RESPONSIVE MENU
			$( window ).on( 'debouncedresize' , function(){
				if ( $(window).width() < ZnThemeAjax.res_menu_trigger ) {
					if ( !menu_activated ){
						start_responsive_menu();
						menu_activated = true;
					}
					page_wrapper.addClass('zn_res_menu_visible');
				}
				else{
					// WE SHOULD HIDE THE MENU
					$('.zn-menu-visible').removeClass('zn-menu-visible');
					page_wrapper.css({'height':'auto'}).removeClass('zn_res_menu_visible');
				}
			// Fix for triggering the responsive menu
			}).trigger('debouncedresize');
		},

		enable_header_sparkles : function( content ){

			var sparkles = content.find('.th-sparkles:visible');
			if( sparkles.length == 0 ){ return false; }

			sparkles.each(function(){
				if ($.browser.msie && $.browser.version < 9) {
					return
				}
				var a = 40,
					i = 0;
				for (i; i < a; i++) {
					new Spark( $(this) );
				}

			});

		},

		enable_magnificpopup : function( content )
		{
			if(typeof($.fn.magnificPopup) != 'undefined')
			{
				$('a.kl-login-box').magnificPopup({
					type: 'inline',
					closeBtnInside:true,
					showCloseBtn: true,
					mainClass: 'mfp-fade mfp-bg-lighter'
				});

				$('a[data-lightbox="image"]:not([data-type="video"])').each(function(i,el){
					//single image popup
					if ($(el).parents('.gallery').length == 0) {
						$(el).magnificPopup({
							type:'image',
							tLoading: '',
							mainClass: 'mfp-fade'
						});
					}
				});
			 	$('.mfp-gallery.mfp-gallery--images').each(function(i,el) {
					$(el).magnificPopup({
						delegate: 'a',
						type: 'image',
						gallery: {enabled:true},
						tLoading: '',
						mainClass: 'mfp-fade'
					});
				});
				// Notice the .misc class, this is a gallery which contains a variatey of sources
				// links in gallery need data-mfp attributes eg: data-mfp="image"
				$('.mfp-gallery.mfp-gallery--misc a[data-lightbox="mfp"]').magnificPopup({
					mainClass: 'mfp-fade',
					type: 'image',
					gallery: {enabled:true},
					tLoading: '',
					callbacks: {
						elementParse: function(item) {
							item.type = $(item.el).attr('data-mfp');
						}
					}
				});
				$('a[data-lightbox="iframe"], a[rel="mfp-iframe"]').magnificPopup({type: 'iframe', mainClass: 'mfp-fade', tLoading: ''});
				$('a[data-lightbox="inline"], a[rel="mfp-inline"]').magnificPopup({type: 'inline', mainClass: 'mfp-fade', tLoading: ''});
				$('a[data-lightbox="ajax"], a[rel="mfp-ajax"]').magnificPopup({type: 'ajax', mainClass: 'mfp-fade', tLoading: ''});
				$('a[data-lightbox="youtube"], a[data-lightbox="vimeo"], a[data-lightbox="gmaps"], a[data-type="video"], a[rel="mfp-media"]').magnificPopup({
					disableOn: 700,
					type: 'iframe',
					removalDelay: 160,
					preloader: true,
					fixedContentPos: false,
					mainClass: 'mfp-fade',
					tLoading: ''
				});

				// Enable WooCommerce lightbox
				$('.single_product_main_image .images a').magnificPopup({
					mainClass: 'mfp-fade',
					type: 'image',
					gallery: {enabled:true},
					tLoading: '',
				});

				// Auto-Popup Modal Window - Immediately
				// Options located in Section element > Advanced
				$('body:not(.zn_pb_editor_enabled) .zn_section--auto-immediately').each(function(index, el) {
					$.magnificPopup.open({
						items: {
							src: $(el),
							type: 'inline'
						},
						mainClass: 'mfp-fade'
					});
				});

				// Auto-Popup Modal Window - On Scroll
				// Options located in Section element > Advanced
				$('body:not(.zn_pb_editor_enabled) .zn_section--auto-scroll').each(function(index, el) {
					var isAppeared = false;
					$(window).on('scroll', function(){
						if( $(window).scrollTop() > ($(document).outerHeight()/2) && isAppeared == false){
							$.magnificPopup.open({
								items: {
									src: $(el),
									type: 'inline'
								},
								mainClass: 'mfp-fade'
							});
							isAppeared = true;
						}
					});
				});

				// Auto-Popup Modal Window - On X seconds Delay
				// Options located in Section element > Advanced
				$('body:not(.zn_pb_editor_enabled) .zn_section--auto-delay').each(function(index, el) {
					var isAppeared = false,
						delay = $(el).is("[data-auto-delay]") ? parseInt( $(el).attr("data-auto-delay") ) : 5;
					setTimeout(function(){
						$.magnificPopup.open({
							items: {
								src: $(el),
								type: 'inline'
							},
							mainClass: 'mfp-fade'
						});
						isAppeared = true;
					}, delay*1000);
				});

			}
		},

		enable_hoverborder : function( content ){
			var hoverBorders = content.find('.hoverBorder');
			if(hoverBorders && hoverBorders.length > 0){
				hoverBorders.each(function () {
					$(this)
						.find('img, .hoverborder-img')
						.wrap('<span class="hoverBorderWrapper"/>')
						.after('<span class="theHoverBorder"></span>');
				});
			}
		},

		enable_partners_logo_carousel : function( content ){
			var elements = content.find('.partners_carousel_trigger');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							scroll: 1,
							auto: self.data('autoplay'),
							items: {
								width: 250,
								visible: { min: 3, max: 10 }
							},
							prev	: {
								button	: function(){return self.parents('.partners_carousel').find('.prev');},
								key		: "left"
							},
							next	: {
								button	: function(){return self.parents('.partners_carousel').find('.next');},
								key		: "right"
							}
						});
					}
				});
			}
		},

		enable_recent_work_carousel : function( content ){
			var elements = content.find('.recent_works1');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e);
					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							scroll: 1,
							auto: false,
							items: {
								width: 300,
								visible: { min: 1, max: 3 }
							},
							prev	: {
								button	: function(){return self.closest('.recentwork_carousel').find('.prev');},
								key		: "left"
							},
							next	: {
								button	: function(){return self.closest('.recentwork_carousel').find('.next');},
								key		: "right"
							}
						});
					}
				});
			}
		},

		enable_circular_carousel : function( content )
		{
			var cirContentContainer = content.find('.ca-container'),
				elements = cirContentContainer.children('.ca-wrapper');

			// do the carousel
			if(elements && elements.length > 0 ) {
				$.each(elements, function(i, e){
			        var self = $(e),
			        	autoplay = self.attr('data-autoplay') == '1' ? true : false;;

					if(typeof($.fn.carouFredSel) != 'undefined') {
						self.carouFredSel({
							responsive: true,
							width: '1170',
							height: 450,
							direction : "left",
							items: {
								width: 550,
								visible: {
									min: 1,
									max: 3
								}
							},
							auto: {
								play: autoplay
							},
							scroll 				: {
								items           : 1,
								easing          : "easeInOutExpo",
								duration		: 1000,
								pauseOnHover    : true,
								timeoutDuration	: parseFloat( self.attr('data-timout') )
							},
							prev : {
								button  : self.closest('.ca-container').find('.ca-nav-prev'),
								key     : "left"
							},
							next : {
								button  : self.closest('.ca-container').find('.ca-nav-next'),
								key     : "right"
							},
							swipe: {
								onTouch: true,
								onMouse: true
							}
						});
					}
					// Open wrapper panel
					var opened = false;
					self.find('.js-ca-more').on('click', function(e){
						e.preventDefault();
						var th = $(this).closest('.ca-item'),
							thpos = th.position().left;

						if(!opened){
							self.trigger('stop');
							self.closest('.ca-container').addClass('ca--is-rolling');
							th.addClass('ca--opened');
							th.css({
								"-webkit-transform":"translateX(-"+ thpos +"px)",
								"-ms-transform":"translateX(-"+ thpos +"px)",
								"transform":"translateX(-"+ thpos +"px)"
							});
							opened = true;

						} else if(opened){

							if($(this).hasClass('js-ca-more-close')){

								self.trigger('play', true);
								self.closest('.ca-container').removeClass('ca--is-rolling');
								th.removeClass('ca--opened');
								th.css({
									"-webkit-transform":"translateX(0)",
									"-ms-transform":"translateX(0)",
									"transform":"translateX(0)"
								});
								opened = false;
							}
						}
					});
					// Close wrapper panel
					self.find('.js-ca-close').on('click', function(e){
						e.preventDefault();
						var th = $(this).closest('.ca-item');
						if(opened){
							self.trigger('play', true);
							self.closest('.ca-container').removeClass('ca--is-rolling');
							th.removeClass('ca--opened');
							th.css({
								"-webkit-transform":"translateX(0)",
								"-ms-transform":"translateX(0)",
								"transform":"translateX(0)"
							});
						}
						opened = false;
					});
				});

			}
		},

		enable_general_carousel : function( content ){
			var elements = content.find('.zn_general_carousel'),
				fw = this;

			if(elements && elements.length)
			{
			   if(typeof($.fn.carouFredSel) != 'undefined') {
			    	jQuery.each(elements, function(i, e){

			    		var $el = $(e);

			    		var highlight = function(data) {
				            var item = $el.triggerHandler('currentVisible');
				            $el.children('.cfs--item').removeClass('cfs--active-item');
				            item.addClass('cfs--active-item');
				        };
				        var unhighlight = function(data) {
				            $el.children('.cfs--item').removeClass('cfs--active-item');
				        };

						// Set the carousel defaults
						var defaults = {
							fancy: false
							, transition : 'fade'
							, direction : 'left'
							, responsive: true
					        , auto: true
							, items: {
								visible: 1
						    }
							, scroll: {
								fx: 'fade'
								, timeoutDuration : 9000
								, easing: 'swing'
								, onBefore : unhighlight
				                , onAfter: highlight
							}
							, swipe: {
								onTouch: true,
								onMouse: true
							}
							, pagination: {
								container: $el.parent().find('.cfs--pagination'),
								anchorBuilder: function(nr, item) {
									var thumb = '';
									if( $el.is("[data-thumbs]") && $el.data('thumbs') == 'zn_has_thumbs' ){
										var items = $el.children('li');
										thumb = 'style="background-image:url('+ items.eq(nr-1).attr('data-thumb') + ');"';
									}
									return '<a href="#'+nr+'" '+ thumb +'></a>';
								}
							}
							, next : {
				                button: $el.parent().find('.cfs--next'),
				                key: 'right'
				            }
				            , prev : {
				                button: $el.parent().find('.cfs--prev'),
				                key: 'left'
				            }
				            , onCreate : highlight
						}

			    		if( $el.is("[data-fancy]") )
			    			defaults.fancy = $el.data('fancy');

			    		// Get the custom carousel settings from data attributes
			    		var customSettings = {
			    			scroll: {
			    				fx : $el.is("[data-transition]") ? $el.data('transition') : defaults.transition
			    				, timeoutDuration	: $el.is("[data-timout]") ? parseFloat( $el.data('timout') ) : defaults.scroll.timeoutDuration
			    				, easing: $el.is("[data-easing]") ? $el.data('easing') : defaults.scroll.easing
			    				, onBefore : unhighlight
				                , onAfter: highlight
			    			}
			    			, auto: {
			    				play: $el.is('[data-autoplay]') && $el.attr('data-autoplay') == '1' ? defaults.auto : false
			    			}
							, direction:  $el.is("[data-direction]") ? $el.data('direction') : defaults.direction
						};

						// Special case/callback for the fancy slider
						if ( defaults.fancy ) {
							// var callback = window['slideCompleteFancy']();
							$.extend(customSettings.scroll, {
								onBefore : function(e){ slideCompleteFancy(e, $el) },
								onAfter : function(e){ slideCompleteFancy(e, $el) },
							});
						}

						// Callback function for fancy slider
						function slideCompleteFancy(args, slider) {
							var _arg = $(slider),
								slideshow =  $(slider).closest('.kl-slideshow'),
								color = $(args.items.visible).attr('data-color');

							// slideshow.animate({backgroundColor: color}, 400);
							slideshow.css({backgroundColor: color});
						}

						// Start the carousel already :)
			    		$el.imagesLoaded( function() {
						    $el.carouFredSel($.extend({}, defaults, customSettings));
						});

			    		// fix for up/down direction not riszing the slider
						if( defaults.fancy ){
							$( window ).on( 'debouncedresize' , function(){
								if( $(window).width() < 1199 ){
									$el.trigger("configuration", ["direction", "left"]);
								} else {
									$el.trigger("configuration", ["direction", "up"]);
								}
								$el.trigger('updateSizes');
							});
						}
					});
				}

				return false;

			}
		},

		enable_flickr_feed : function( content ){
			var elements = content.find('.flickr_feeds');
			if(elements && elements.length){
				$.each(elements, function(i, e){
					var self = $(e),
						ff_limit = (self.attr('data-limit') ? self.attr('data-limit') : 6),
						fid = self.attr('data-fid');
					if(typeof($.fn.jflickrfeed) != 'undefined') {
						self.jflickrfeed({
							limit: ff_limit,
							qstrings: { id: fid },
							itemTemplate: '<li><a href="{{image_b}}" data-lightbox="image"><img src="{{image_s}}" alt="{{title}}" /><span class="theHoverBorder"></span></a></li>'
						},
						function(data) {
							self.find(" a[data-lightbox='image']").magnificPopup({type:'image', tLoading: ''});
							self.parent().removeClass('loadingz');
						});
					}
				});
			}
		},


		enable_icarousel : function( content ){
			var elements = content.find('.th-icarousel');
			if(elements && elements.length){
				$.each(elements, function(i, e){

					var element = $(e),
						carouselSettings = {
							easing: 'easeInOutQuint',
							pauseOnHover: true,
							timerPadding: 0,
							timerStroke: 4,
							timerBarStroke: 0,
							animationSpeed: 700,
							nextLabel: "",
        					previousLabel: "",
							autoPlay: element.is("[data-autoplay]") ? element.data('autoplay') : true,
							slides: element.is("[data-slides]") ? element.data('slides') : 7,
							pauseTime: element.is("[data-timeout]") ? element.data('timeout') : 5000,
							perspective: element.is("[data-perspective]") ? element.data('perspective') : 75,
							slidesSpace: element.is("[data-slidespaces]") ? element.data('slidespaces') : 300,
							direction: element.is("[data-direction]") ? element.data('direction') : "ltr",
							timer: element.is("[data-timer]") ? element.data('timer') : "Bar",
							timerOpacity: element.is("[data-timeropc]") ? element.data('timeropc') : 0.4,
							timerDiameter: element.is("[data-timerdim]") ? element.data('timerdim') : 220,
							keyboardNav: element.is("[data-keyboard]") ? element.data('keyboard') : true,
							mouseWheel: element.is("[data-mousewheel]") ? element.data('mousewheel') : true,
							timerColor: element.is("[data-timercolor]") ? element.data('timercolor') : "#FFF",
							timerPosition: element.is("[data-timerpos]") ? element.data('timerpos') : "bottom-center",
							timerX: element.is("[data-timeroffx]") ? element.data('timeroffx') : 0,
							timerY: element.is("[data-timeroffy]") ? element.data('timeroffy') : -20
						};

					// Start the carousel already :)
					if(typeof($.fn.iCarousel) != 'undefined') {
			    		element.imagesLoaded( function() {
						    element.iCarousel(carouselSettings);
						});
					}
				});
			}
		},

		enable_ios_slider : function( content ){

			function slideChange(args) {
				var theSlider = $(args.sliderObject),
					activeSlide = args.currentSlideNumber - 1,
					sliderContainer = theSlider.closest('.iosslider-slideshow');
				// console.log(args);
				// add active to bullets
				sliderContainer.find('.kl-ios-selectors-block .iosslider__bull-item').removeClass('selected');
				sliderContainer.find('.kl-ios-selectors-block .iosslider__bull-item:eq(' + activeSlide + ')').addClass('selected');
				// add active class
				theSlider.find('.iosslider__item').removeClass('kl-iosslider-active');
				theSlider.find('.iosslider__item:eq(' + activeSlide + ')').addClass('kl-iosslider-active');
			}

			function sliderLoaded(args, otherSettings) {
				var theSlider = $(args.sliderObject);
				if (otherSettings.hideControls) theSlider.addClass('hideControls');
				if (otherSettings.hideCaptions) theSlider.addClass('hideCaptions');

				if(typeof( args.currentSlideNumber ) != 'undefined') {
					slideChange(args);
				}
				theSlider.closest('.iosslider-slideshow').addClass('kl-slider-loaded');
			}

			var elements = content.find('.iosSlider');

			if(elements && elements.length){
				$.each( elements , function(i, e){
					var self = $(e),
						selfContainer = self.closest('.kl-slideshow');

					if(typeof($.fn.iosSlider) != 'undefined') {
						self.iosSlider({
							snapToChildren: true,
							desktopClickDrag: self.data('clickdrag') == '1' ? true : false,
							keyboardControls: true,
							autoSlide: self.data('autoplay') == '1' ? true : false,
							autoSlideTimer: self.data('trans'),
							navNextSelector: selfContainer.find('.kl-iosslider-next'),
							navPrevSelector: selfContainer.find('.kl-iosslider-prev'),
							navSlideSelector: selfContainer.find('.kl-ios-selectors-block .item'),
							scrollbar: true,
							scrollbarContainer: selfContainer.find('.scrollbarContainer'),
							scrollbarMargin: '0',
							scrollbarBorderRadius: '4px',
							onSliderLoaded: function(args){
								var otherSettings = {
									hideControls : true,
									hideCaptions : false
								};
								sliderLoaded(args, otherSettings);
							},
							onSlideChange: slideChange,
							infiniteSlider: self.data('infinite')
						});
					}

					$( window ).on( 'debouncedresize' , function(){
						if(typeof($.fn.iosSlider) != 'undefined') {
							self.iosSlider('update');
						}
					});

				});
			}
		},

		enable_portfolio_slider : function( content ){

			var elements = content.find('.psl-carousel__container');

			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e);
			        var highlight = function(data) {
			            var item = self.triggerHandler('currentVisible');
			            self.children('.psl-carousel__item').removeClass('psl--active-item');
			            item.addClass('psl--active-item');
			        };
			        var unhighlight = function(data) {
			            self.children('.psl-carousel__item').removeClass('psl--active-item');
			        };
			        if(typeof($.fn.carouFredSel) != 'undefined') {
				        self.carouFredSel({
				            responsive: true,
				            width: 1140,
				            scroll   : {
				                fx: 'fade',
				                duration     : 1000,
				                timeoutDuration  : 3000,
				                onBefore : unhighlight,
				                onAfter : highlight
				            },
				            auto : false,
				            next : {
				                button: self.closest('.psl-carousel__wrapper').find('.psl__next'),
				                key: 'right'
				            },
				            prev : {
				                button: self.closest('.psl-carousel__wrapper').find('.psl__prev'),
				                key: 'left'
				            },
				            swipe: {
				                onTouch: true,
				                onMouse: true
				            },
				            onCreate : highlight
				        });
				    }
			    });
			}
		},

		enable_testimonials_partners : function( content ){

			var elements = content.find('.ts-pt-partners__carousel');

			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e);
			        var highlight = function(data) {
			            var item = self.triggerHandler('currentVisible');
			            self.children('.ts-pt-partners__carousel-item').removeClass('ts-pt--active-item');
			            item.addClass('ts-pt--active-item');
			        };
			        var unhighlight = function(data) {
			            self.children('.ts-pt-partners__carousel-item').removeClass('ts-pt--active-item');
			        };
			        if(typeof($.fn.carouFredSel) != 'undefined') {
				        self.carouFredSel({
				            responsive: true,
				            items: {
				            	visible: {
				            		min: 1,
				            		max: 5
				            	}
				            },
				            scroll   : {
				                fx: 'fade',
				                duration     : 1000,
				                timeoutDuration  : 3000,
				                onBefore : unhighlight,
				                onAfter : highlight
				            },
				            auto : true,
				            onCreate : highlight
				        });
				    }
			    });
			}
		},

		enable_appeared : function( content ){

			// Iconboxes with appearance effect
			var el = content.find('.el--appear');
			if(el && el.length){
			    $.each(el, function(i, e){
			    	var self = $(e),
			    		loaded = false;
		    		// Appear faded
			    	if(!loaded) {
				        if(self.is( ':in-viewport' )){
				        	self.addClass('el--appeared');
				        	loaded = true;
				        }
		                $(window).scroll(function() {
		                    if(self.is( ':in-viewport' )){
					        	self.addClass('el--appeared');
					        	loaded = true;
					        }
		                });
		            }
			    });
			}
		},

		enable_iconbox : function( content ){

			// Iconboxes with appearance effect
			var el_stage = content.find('.kl-iconbox[data-stageid]');
			if(el_stage && el_stage.length){
			    $.each(el_stage, function(i, e){
			    	var self = $(e),
			    		stageid = self.attr('data-stageid'),
			    		title = self.attr('data-pointtitle') ? 'data-title="'+self.attr('data-pointtitle')+'"' : '',
			    		px = self.attr('data-pointx'),
			    		py = self.attr('data-pointy'),
			    		theStage = $('.'+stageid);

			    	if(stageid && px && py){
			    		var span = $('<span style="top:'+py+'px; left: '+px+'px;" class="stage-ibx__point" '+title+'></span>');
			    		$('.'+stageid).find('.stage-ibx__stage').append( span );
			    		setTimeout(function(){
			    			span.css('opacity',1);
			    		}, 300*i);
			    		self.on('mouseover', span ,function(){
			    			span.addClass('is-hover');
			    		});
			    		self.on('mouseout', span ,function(){
			    			span.removeClass('is-hover');
			    		});
			    	}
			    });
			}
		},

		enable_searchbox : function( content ){

			// Iconboxes with appearance effect
			var el = content.find('.elm-searchbox--eff-typing');
			if(el && el.length){
			    $.each(el, function(i, e){

			        $(e).find('.elm-searchbox__input')
				        .on('focus', function(ev){
				        	$(this).addClass('is-focused');
				        })
				        .on('keyup', function(ev){
				        	if( $(this).val() != '' ){
				        		$(this).addClass('is-focused');
				        	}
				        })
				        .on('blur', function(ev){
				        	if( $(this).val() == '' ){
				        		$(this).removeClass('is-focused');
				        	}
				        });

			    });
			}

		},

		enable_laptop_slider : function( content ){

			function slideChange(args) {
				var iosSlider = args.sliderContainerObject,
					detailsBlock = iosSlider.attr('data-details');

				// Details blocks
				if(typeof detailsBlock != 'undefined'){
					$(detailsBlock).find('.ls_slide_item-details').removeClass('selected');
					$(detailsBlock).find('.ls_slide_item-details:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
				}
				// bullets
				$(iosSlider).closest('.ls__laptop-mask').find('.ls__nav .ls__nav-item').removeClass('selected');
				$(iosSlider).closest('.ls__laptop-mask').find('.ls__nav .ls__nav-item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

				// Item active class
				$(iosSlider).find('.ls__slider-item').removeClass('item--active');
				$(iosSlider).find('.ls__slider-item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('item--active');
			}

			function sliderLoaded(args) {
				slideChange(args);
				args.sliderContainerObject.closest('.kl-slideshow').addClass('kl-slider-loaded');
			}

			var elements = content.find('.zn_laptop_slider');

			if(elements && elements.length && elements.find('.ls__slider-item').length){
				$.each( elements , function(i, e){
					var self = $(e);
					if(typeof($.fn.iosSlider) != 'undefined') {
						self.iosSlider({
							snapToChildren: true,
							desktopClickDrag: true,
							keyboardControls: true,
							autoSlideTimer: parseInt( self.attr('data-trans') ),
							navNextSelector: self.closest('.ls__laptop-mask').find('.ls__arrow-right'),
							navPrevSelector: self.closest('.ls__laptop-mask').find('.ls__arrow-left'),
							navSlideSelector: self.closest('.ls__laptop-mask').find('.ls__nav .ls__nav-item'),
							scrollbar: false,
							onSliderLoaded: sliderLoaded,
							onSlideChange: slideChange,
							infiniteSlider: true,
							autoSlide: self.attr('data-autoplay')
						});
					}
					$( window ).on( 'debouncedresize' , function(){
						if(typeof($.fn.iosSlider) != 'undefined') {
							self.iosSlider('update');
						}
					}).trigger('debouncedresize');
				});
			}

			// Prevent default for bullet navigation
			$( content ).find('.ls__nav-item').click(function(e){ return false; });
		},

		enable_latest_posts_accordion : function( content ){
			var elements = content.find('.css3accordion');
			if(elements && elements.length > 0){
				elements.each(function(i,el){
					$(el).find('.inner-acc').css('width', $(el).width() /2 );
					$(window).resize(function(event) {
						$(el).find('.inner-acc').css('width', $(el).width() /2 );
					});
				});
			}
		},

		enable_portfolio_sortable : function( content )
		{
			var sortBy = 'date', 		/* SORTING: date / name */
				sortAscending = true, 	/* SORTING ORDER: true = Ascending / false = Descending */
				theFilter = $('#portfolio-nav li.current a').attr('data-filter');	        /* DEFAULT FILTERING CATEGORY */

			if(typeof(window.wpkIsotopeSortBy) !== 'undefined'){
				sortBy = window.wpkIsotopeSortBy;
			}
			if(sortBy.length <= 0){
				sortBy = 'name';
			}
			if(window.location.hash.length > 0){
				var hash = window.location.hash.split('#')[1].split('=');
				if(hash[0] == 'sortBy') {
					sortBy = hash[1];
				}
				else if(hash[0] == 'sortAscending'){
					sortAscending = hash[1];
				}
			}

			jQuery(function($){

				wpkznSelector = $("ul#thumbs");
				if(wpkznSelector && wpkznSelector.length > 0)
				{
					wpkznSelector.imagesLoaded( function() {
						wpkznSelector.isotope({
							itemSelector: ".item",
							animationEngine: "jquery",
							animationOptions: {
								duration: 250,
								easing: "easeOutExpo",
								queue: false
							},
							layoutMode: 'masonry',
							filter: theFilter,
							sortAscending: sortAscending,
							getSortData: {
								name: function(elem) {
									return $(elem).find('.name').text();
								},
								date: function(elem) {
									return $(elem).attr('data-date');
								}
							}
						});
						// End isotope
					});

					//#1 Filtering
					var a_elements = $('#portfolio-nav li a');
					if(a_elements && a_elements.length > 0) {
						$.each(a_elements, function (a, b) {
							$(b).on('click', function (w) {
								w.preventDefault();
								$('#portfolio-nav li').removeClass('current');
								$(b).parent().addClass('current');
								wpkznSelector.isotope({filter: $(b).data('filter')});
								wpkznSelector.isotope('updateSortData').isotope();
							});
						});
					}

					//#! Sorting (name | date)
					var b_elements = jQuery('#sortBy li a');
					if(b_elements && b_elements.length > 0){
						b_elements.removeClass('selected');
						$.each(b_elements, function(index, element) {
							var t = $(element),
								csb = t.data('optionValue');
							if(csb == sortBy){
								t.addClass('selected');
							}
							wpkznSelector.isotope({sortBy: csb});
							wpkznSelector.isotope('updateSortData').isotope();

							t.on('click', function(){
								b_elements.removeClass('selected');
								t.addClass('selected');
								csb = t.data('optionValue');
								wpkznSelector.isotope({sortBy: csb});
								wpkznSelector.isotope('updateSortData').isotope();
							});
						});
					}

					//#! Sorting Direction (asc | desc)
					var c_elements = $('#sort-direction li a');
					if(c_elements && c_elements.length > 0) {
						c_elements.removeClass('selected');
						$.each(c_elements,function(index, element) {
							var t = $(element),
								csv = t.data('optionValue');

							if(csv == sortAscending){
								t.addClass('selected');
							}

							wpkznSelector.isotope({sortAscending: sortAscending});
							wpkznSelector.isotope('updateSortData').isotope();

							t.on('click', function(){
								c_elements.removeClass('selected');
								t.addClass('selected');
								csv = t.data('optionValue');
								sortAscending = csv;
								wpkznSelector.isotope({sortAscending: csv});
								wpkznSelector.isotope('updateSortData').isotope();
							});
						});
					}
				}
			});
		},

		enable_gridphotogallery : function( content ){
			var gridPhotoGallery = content.find('.gridPhotoGallery');
			if(typeof($.fn.isotope) != 'undefined') {
				$.each(gridPhotoGallery, function(i, el) {
					var $el = $(el),
						itemWidth = Math.floor( $(el).width() / $el.attr('data-cols') ),
						doIsotope = $el.isotope({
						itemSelector : '.gridPhotoGallery__item',
						masonry: {
							columnWidth: '.gridPhotoGallery__item--sizer',
							gutter:0
						}
					});
					doIsotope.isotope('layout');
				});
			}
		},

		enable_nivo_slider : function( content ){
			var elements = $('.nivoslider .nivoSlider');
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var slider = $(e),
			            transition = slider.attr('data-transition'),
			            autoslide = slider.attr('data-autoslide'),
			            pausetime = slider.attr('data-pausetime');
			        if(typeof($.fn.nivoSlider) != 'undefined') {
				        slider.nivoSlider({
				            effect:transition,
				            boxCols: 8,
				            boxRows: 4,
				            slices:15,
				            animSpeed:500,
				            pauseTime: pausetime,
				            startSlide:0,
				            directionNav:1,
				            controlNav:1,
				            controlNavThumbs:0,
				            pauseOnHover:1,
				            manualAdvance: autoslide,
				            afterLoad: function(){
				                /* slideFirst() */
				                setTimeout(function(){
				                    slider.find('.nivo-caption').animate({left:20, opacity:1}, 500, 'easeOutQuint');
				                }, 1000);
				            },
				            beforeChange: function(){
				                /* slideOut() */
				                slider.find('.nivo-caption').animate({left:120, opacity:0}, 500, 'easeOutQuint');
				            },
				            afterChange: function(){
				                /* slideIn() */
				                slider.find('.nivo-caption').animate({left:20, opacity:1}, 500, 'easeOutQuint');
				            }
				        });
					}
			    });
			}
		},

		enable_recent_works2 : function( content ){
			var elements = content.find('.recent_works2');
			if(elements && elements.length){
				$.each(elements, function(i, e){
				    var self = $(e);
				    if(typeof($.fn.carouFredSel) != 'undefined') {
					    self.carouFredSel({
					        responsive: true,
					        scroll: 1,
					        auto: false,
					        items: {
					        	width: 350,
					            visible: {
					            	min: 1,
					            	max: 4
					            }
					        },
					        prev : {
					            button	: function(){return self.closest('.recentwork_carousel').find('.prev');},
					            key		: "left"
					        },
					        next : {
					            button	: function(){return self.closest('.recentwork_carousel').find('.next');},
					            key		: "right"
					        }
					    });
					}
				});
			}
		},

		enable_recent_works3 : function( content ){
			var elements = content.find('.recent_works3');
			if(elements && elements.length){
				$.each(elements, function(i, e){
				    var self = $(e);
				    if(typeof($.fn.carouFredSel) != 'undefined') {
					    self.carouFredSel({
					        responsive: true,
					        scroll: 1,
					        auto: false,
					        items: {
					        	width: 350,
					            visible: {
					            	min: 1,
					            	max: 5
					            }
					        },
					        prev : {
					            button	: function(){return self.closest('.recentwork_carousel').find('.prev');},
					            key		: "left"
					        },
					        next : {
					            button	: function(){return self.closest('.recentwork_carousel').find('.next');},
					            key		: "right"
					        }
					    });
					}
				});
			}
		},

		enableLatestPostsCarousel : function( content ){
			var elements = content.find('.lp_carousel');
			if(elements && elements.length && (typeof($.fn.carouFredSel) != 'undefined')){
				$.each(elements, function(i, e){
					var self = $(e);
					self.imagesLoaded( function() {
						self.carouFredSel({
							responsive: true,
							scroll: 1,
							auto: false,
							items: {
								width: 350,
								visible: {
									min: 1,
									max: 3
								}
							},
							prev : {
								button	: function(){return self.closest('.latest-posts-carousel').find('.prev');},
								key		: "left"
							},
							next : {
								button	: function(){return self.closest('.latest-posts-carousel').find('.next');},
								key		: "right"
							}
						});
	                });

				});
			}
		},

		enable_screenshoot_box : function( content ){
			var elements = content.find('.zn_screenshot-carousel');
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e),
                        _pDataAttr = self.attr('data-carousel-pagination');

                    var options = {
                        responsive: true,
                        scroll: { fx: "crossfade", duration: "1500" },
                        auto: true,
                        responsive: true,
                        prev : {
                            button	: function(){return self.closest('.thescreenshot').find('.prev');},
                            key		: "left"
                        },
                        next : {
                            button	: function(){return self.closest('.thescreenshot').find('.next');},
                            key		: "right"
                        }
                    };

                    if(typeof(_pDataAttr) != 'undefined'){
                        options['pagination'] = _pDataAttr;
                    }
                    if(typeof($.fn.carouFredSel) != 'undefined') {
                    	self.imagesLoaded( function() {
	                   		self.carouFredSel(options);
	                   	});
	                }
			    });
			}
		},

		enable_wow_slider : function( content ){
			var elements = content.find('.th-wowslider');
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e);
			        if(typeof($.fn.wowSlider) != 'undefined') {
				        self.wowSlider({
				            effect: self.attr('data-transition'),
				            duration:900,
				            delay: self.is('[data-timeout]') ? self.attr('data-timeout') : 3000,
				            width:1170,
				            height:470,
				            cols:6,
				            autoPlay: self.attr('data-autoplay'),
				            stopOnHover:true,
				            loop:true,
				            bullets:true,
				            caption:true,
				            controls:true,
				            captionEffect:"slide",
				            logo:"image/loading_light.gif",
				            images:0,
				            onStep: function(){
								self.addClass('transitioning');
								setTimeout(function(){
									self.removeClass('transitioning');
								}, 1400);

				            }
				        });
				    }
			    });
			}
		},

		enable_mailchimp_subscribe : function( content ){
			var element = content.find('.nl-submit');
			if(element && element.length){
				element.each(function(index, el) {
					$(el).on('click', function(e) {
						e.preventDefault();
				        var self = $(this),
				            ajax_url = self.parent().attr('data-url'),
				            email_field = self.parent().find('.nl-email').val(),
				            result_placeholder = self.parent().next('.zn_mailchimp_result');

				        if(email_field == ''){
				        	self.parent().addClass('has-error');
				        	return;
				        }

				        $.ajax({
				            url: ajax_url,
				            type: 'POST',
				            data: {
				                zn_mc_email: email_field,
				                zn_mailchimp_list: self.parent().find('.nl-lid').val(),
				                zn_ajax: '' // Change here with something different
				            },
				            success: function(data){
				                result_placeholder.html(data);
				            },
				            error: function() {
				                result_placeholder.html('ERROR.').css('color', 'red');
				            }
				        });
				    });
				});
			}
		},

		enable_sc_showroomcarousel : function( content ){
			var elements = content.find(".sc__showroom-carousel");
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			    	var $this = $(e),
			        	$speed = $this.attr("data-speed"),
			        	$pagination = $('<div class="shcar__pagination"></div>');

			        if( $this.attr("data-pag") && $this.attr("data-pag") == "1" )
						$this.parent().prepend($pagination);
					if(typeof($.fn.carouFredSel) != 'undefined') {
				        $this.carouFredSel({
				            responsive:true,
				            height: 220,
				            scroll: { pauseOnHover: true },
				            auto: { timeoutDuration: parseInt($speed) },
				            items: {
								width: 280,
								visible: { min: 1, max: 3 }
							},
							pagination: {
								container: $this.parent().find('.shcar__pagination'),
								anchorBuilder: function(nr, item) {
									return '<a href="#'+nr+'"></a>';
								}
							},
							swipe: {
								onTouch: true,
								onMouse: true
							}
				        });
				    }
			    });
			}
		},

		enable_testimonial_fader : function( content ){
			var elements = content.find(".testimonials_fader_trigger");
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var speed = $(e).data("speed");
			        if(typeof($.fn.carouFredSel) != 'undefined') {
				        $(e).carouFredSel({
				            responsive:true,
				            auto: {timeoutDuration: speed},
				            scroll: { fx: "fade", duration: 1500 }
				        });
				    }
			    });
			}
		},

		enable_twitter_fader : function( content ){
			var elements = content.find(".twitterFeed");
			if(elements && elements.length && (typeof($.fn.carouFredSel) != 'undefined')){
				$.each(elements, function(i, e){
					var speed = 5000;
					var self = $(e);
					if(typeof(self.data('entries')) != 'undefined') {
						$(e).carouFredSel({
							responsive:true,
							auto: {timeoutDuration: speed},
							scroll: {
								fx: "fade",
								duration: 1500
							},
							items: {
								visible: {
									min: 1,
									max: self.data('entries')
								}
							}
						});
					}
				});
			}
		},

		enable_testimonial_slider : function( content ){
			var elements = content.find('.zn_testimonials_carousel');
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e),
			            speed = self.data('speed');
			        if(typeof($.fn.carouFredSel) != 'undefined') {
				        self.carouFredSel({
				                responsive: true,
				                items: { width: 300 },
				                auto: {timeoutDuration: speed},
				                prev	: {
				                    button	: function(){return self.closest('.testimonials-carousel').find('.prev');},
				                    key		: "left"
				                },
				                next	: {
				                    button	: function(){return self.closest('.testimonials-carousel').find('.next');},
				                    key		: "right"
				                }
				        });
				    }
			    });
			}
		},

		enable_shop_limited_offers : function( content ){
			var elements = content.find('.zn_limited_offers');
			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e);
			        // var speed = $(e).data("speed");
			        if(typeof($.fn.carouFredSel) != 'undefined') {

			        	var autoplay = self.attr('data-autoplay') == '1' ? true : false;;

				        self.carouFredSel({
				            responsive: true,
				            width: '92%',
				            scroll: {
				            	items           : 1,
								easing          : "easeInOutExpo",
								duration		: 1000,
								pauseOnHover    : true,
				            	timeoutDuration: self.is("[data-timeout]") ? parseFloat( self.data('timeout') ) : 6000
				            },
				            auto: autoplay,
				            items: {width:190, visible: { min: 2, max: 4 } },
				            prev	: {
				                button	: function(){return self.closest('.limited-offers-carousel').find('.prev');},
				                key		: "left"
				            },
				            next	: {
				                button	: function(){return self.closest('.limited-offers-carousel').find('.next');},
				                key		: "right"
				            }
				        });
				    }
			    });
			}
		},

		enable_static_weather : function( content ){

			var elements = content.find('.sc__weather');

			if(elements && elements.length){
			    $.each(elements, function(i, e){
			        var self = $(e),
			        	loc = self.attr('data-location') ? self.attr('data-location') : '';

			        if( typeof($.simpleWeather) != 'undefined') {

				        $.simpleWeather({
				            woeid: self.attr('data-woeid'),
				            location: loc,
				            unit: self.attr('data-unit'),
				            success: function(weather) {

				                html = '<ul class="scw_list clearfix">';

				                for(var i=0;i<weather.forecast.length;i++) {
				                    html += '<li><i class="wt-icon wt-icon-'+weather.code+'"></i>';
				                    html += '<div class="scw__degs">';
				                    html += '<span class="scw__high">'+weather.forecast[i].high+'&deg;<span class="uppercase">'+weather.units.temp+'</span></span>';
				                    html += '<span class="scw__low">'+weather.forecast[i].low+'</span>';
				                    html += '</div>';
				                    html += '<span class="scw__day">' + weather.forecast[i].day+'</span>';
				                    html += '<span class="scw__alt">' + weather.forecast[i].alt.high+'&deg;<span class="uppercase">'+ weather.alt.unit +'</span></span>';
				                    html += '</li>';
				                }
				                html += '</ul>';

				                jQuery(self).html(html);
				            },
				            error: function(error) {
				                jQuery(self).html('<p>'+error+'</p>');
				                console.warn('Some problems: '+ error);
				            }
				        });
					}
			    });
			}
		},

		enable_diagram: function(content){

			var diagram_el = content.find('.kl-skills-diagram');

			if(diagram_el && diagram_el.length){
				diagram_el.each(function(index, el) {
					if(typeof diagramElement != 'undefined'){
						diagramElement.init( el );
					}
				});
			}

		},

		enable_services: function(content){

			var elements = content.find('.services_box--boxed');

			if(elements && elements.length){
				elements.each(function(index, el) {
					// see how tall the box is and add an extra 30px
					$(el).find('.services_box__list').css('padding-top', $(el).height() + 30 );
					$(el).hover(
						function() {
							$(el).css("z-index", '3' );
						}, function() {
							$( this ).removeAttr( 'style' );
						}
					);

				});
			}

			$(window).on('debouncedresize', function(){
			if(elements && elements.length){
				elements.each(function(index, el) {
					// see how tall the box is and add an extra 30px
					$(el).find('.services_box__list').css('padding-top', $(el).height() + 30 );
				});
			}
			}).trigger('debouncedresize');

		},

		enable_shoplatest_presentation: function(content){

			var lists = content.find('.shop-latest-carousel > ul');
			if(lists && lists.length > 0) {
				lists.each(function (index, element) {
					if(typeof($.fn.carouFredSel) != 'undefined') {
						$(element).imagesLoaded( function() {
							$(element).carouFredSel({
								responsive: true,
								scroll: 1,
								auto:  $(element).is('[data-autoplay]') && $(element).attr('data-autoplay') == 'yes' ? true : false,
								scroll: {
									timeoutDuration : $(element).is('[data-timeout]') ? parseInt($(element).attr('data-timeout')) : '5000'
								},
								// height: 475,
								items: {width: 300, visible: {min: 1, max: 4}},
								prev: {button: $(element).closest('.shop-latest-carousel').find('a.prev'), key: 'left'},
								next: {button: $(element).closest('.shop-latest-carousel').find('a.next'), key: 'right'}
							});
						});
					}
				});
			}
		},

		enable_scrollspy: function(content){
			$('body.kl-scrollspy.kl-sticky-header').scrollspy({ target: '#main-menu' });
			$('body.kl-scrollspy.kl-follow-menu').scrollspy({ target: '.chaser' })
		},

		enable_tooltips: function(content){
			// activate tooltips
			var tooltips = content.find('[data-toggle="tooltip"], [data-rel="tooltip"]');
			if(tooltips && tooltips.length > 0) {
				tooltips.tooltip();
			}
		}

	};

	$(document).ready(function () {
		// Call this on document ready
		$.themejs = new $.ZnThemeJs();
	});

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////  WINDOW LOAD   //////
	$(window).load(function () {
		// REMOVE PRELOADER

		var preloader = $('#page-loading');
		if ( preloader.length > 0 ) {
			preloader.fadeOut( "fast", function() {
				preloader.remove();
			});
		}

	});
	////// END WINDOW LOAD
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*--------------------------------------------------------------------------------------------------
 Sparkles
 --------------------------------------------------------------------------------------------------*/
	var Spark = function(sparkles_container){
		this.sparkles_container = $(sparkles_container);
		this.s = ["shiny-spark1", "shiny-spark2", "shiny-spark3", "shiny-spark4", "shiny-spark5", "shiny-spark6"];
		this.i = this.s[this.random(this.s.length)];
		this.n = document.createElement("span");
		this.newSpeed().newPoint().display().newPoint().fly();
	};
	Spark.prototype.display = function ()
	{
		$(this.n).attr("class", this.i).css("z-index", this.random(3)).css("top", this.pointY).css("left", this.pointX);
		this.sparkles_container.append(this.n);
		return this
	};
	Spark.prototype.fly = function ()
	{
		var a = this;
		$(this.n).animate({top: this.pointY, left: this.pointX}, this.speed, "linear", function ()
		{
			a.newSpeed().newPoint().fly();
		})
	};
	Spark.prototype.newSpeed = function ()
	{
		this.speed = (this.random(10) + 5) * 1100;
		return this
	};
	Spark.prototype.newPoint = function ()
	{
		var parentPos = this.sparkles_container,
			parentSlideshow = parentPos.closest('.kl-slideshow'),
			parentPh = parentPos.closest('.page-subheader');
		if(parentSlideshow.length > 0) {
			parentPos = parentSlideshow;
		} else if(parentPh.length > 0) {
			parentPos = parentPh;
		}
		this.pointX = this.random( parentPos.width() );
		this.pointY = this.random( parentPos.height() );
		return this
	};
	Spark.prototype.random = function (a)
	{
		return Math.ceil(Math.random() * a) - 1
	};

})(jQuery);




(function ($)
{
	"use strict";

	$(function($)
	{


		// prevent clicking on cart button
		// for touch screens
		if (Modernizr.touch) {
			$('a[href="#"]').on('click', function(e){
				e.preventDefault();
			});
		}

		$('body').bind('added_to_cart',function (evt,ret) {
			var mycart = $('#mycartbtn'); // ID must be provided
			if(mycart && mycart.length > 0) {
				var mycartTop = mycart.offset().top,
					mycartLeft = mycart.offset().left,
					butonCart = $('.to_cart button.addtocart '),
					buttonCartHome = $('.add_to_cart_button '),
					placeholderdiv = $('<div class="popupaddcart">'+zn_do_login.add_to_cart_text+'</div>');

				$('body').append(placeholderdiv);
				$(placeholderdiv).hide();
				$(placeholderdiv).fadeIn('slow', 'easeInOutExpo',function() {
					//console.log( $(this) );
					var zn_pos_top = $(this).offset().top,
						zn_pos_left = $(this).offset().left;
					$(this)
						.css({margin:0,left:zn_pos_left,top:zn_pos_top,position:'absolute'})
						.delay(800)
						.animate(
						{
							top: mycartTop,
							left:mycartLeft,
							opacity:1
						}, 2000, 'easeInOutExpo', function() {
							$(this).remove();
						});
				});
			}
		});

		/* sliding panel toggle (support panel) */
		var sliding_panel = $('#sliding_panel'),
			slider_panel_container = $('#sliding_panel .container'),
			slider_height = 0;
		if(slider_panel_container && slider_panel_container.length > 0) {
			slider_height = $('#sliding_panel .container').height();
		}
		var open_sliding_panel = $('#open_sliding_panel');
		if(open_sliding_panel && open_sliding_panel.length > 0)
		{
			open_sliding_panel.on('click',function (e){
				e.preventDefault();
				sliding_panel.toggleClass('is-opened');
				$(this).toggleClass('active');
			});
		}
		// --- end sliding panel

		// LOGIN FORM
		var zn_form_login = $('.zn_form_login');
		zn_form_login.on('submit', function(event){
			event.preventDefault();

			var form = $(this),
				warning = false,
				button = $('.zn_sub_button', this),
				values = form.serialize();

			$('input', form).each(function(){
				if (!$(this).val())
					warning = true;
			});

			if (warning) {
				button.removeClass('zn_blocked');
				return false;
			}

			if (button.hasClass('zn_blocked')) {
				return false;
			}

			button.addClass('zn_blocked');

			$.post(zn_do_login.ajaxurl, values, function (resp)
			{
				var data = $(document.createElement('div')).html(resp);

				if ($('#login_error', data).length) {
					// data.find('a').attr('onClick', 'ppOpen(\'#forgot_panel\', \'mfp-forgot-panel\');return false;');
					$('div.links', form).html(data);
					button.removeClass('zn_blocked');
				}
				else {
					if ($('.zn_login_redirect', form).length > 0) {
						$.magnificPopup.close();
						window.location = $('.zn_login_redirect', form).val();
					}
				}
				button.removeClass('zn_blocked');
			});
		});

		// LOST PASSWORD
		var zn_form_lost_pass = $('.zn_form_lost_pass');
		zn_form_lost_pass.on('click', function(){
			event.preventDefault();

			var form = $(this),
				warning = false,
				button = $('.zn_sub_button', this),
				values = form.serialize() + '&ajax_login=true';

			$('input', form).each(function(){
				if (!$(this).val())
					warning = true;
			});

			if (warning) {
				button.removeClass('zn_blocked');
				return false;
			}

			if (button.hasClass('zn_blocked')) {
				return;
			}

			button.addClass('zn_blocked');

			$.ajax({
				url: form.attr('action'), data: values, type: 'POST', cache: false, success: function (resp)
				{
					var data = $(document.createElement('div')).html(resp);

					$('div.links', form).html('');

					if ($('#login_error', data).length) {
						// We have an error
						var error = $('#login_error', data);
						// error.find('a').attr('onClick', 'ppOpen(\'#forgot_panel\', \'mfp-forgot-panel\');return false;');
						$('div.links', form).html(error);
					}
					else if ($('.message', data).length) {
						var message = $('.message', data);
						$('div.links', form).html(message);
					}
					else {
						jQuery.magnificPopup.close();
						window.location = $('.zn_login_redirect', form).val();
					}
					button.removeClass('zn_blocked');
				}, error: function (jqXHR, textStatus, errorThrown){
					$('div.links', form).html(errorThrown);
				}
			});
		});

		// Made the shop image to change on hover over thumbnails
		if ( typeof ZnWooCommerce != 'undefined' ){
			if ( ZnWooCommerce.show_thumb_on_hover ){
				var znwoo_main_imgage = $( 'a.woocommerce-main-image' ).attr( 'href' );

				$('.single_product_main_image').hover(function(){

						$('.thumbnails',this).find('a').hover(function(el){

							var width  = $('.woocommerce-main-image').width();
							var height = $('.woocommerce-main-image').height();

							var photo_fullsize = $( this ).attr( 'href' );
							$( '.woocommerce-main-image img' ).attr( 'src', photo_fullsize );
							$( '.woocommerce-main-image' ).css({'min-width': width,'min-height': height});
						}) ;

				},
				function(){
					$( '.woocommerce-main-image img' ).attr( 'src', znwoo_main_imgage ).removeAttr('style');
					$( '.woocommerce-main-image' ).removeAttr('style');
				});

			}
		}


		// --- search panel
		var searchBtn = $('#search .searchBtn'),
			searchPanel = searchBtn.next(),
			searchP = searchBtn.parent();
		if( searchBtn && searchBtn.length > 0 ){
			searchBtn.on('click', function(e){
				e.preventDefault();
				var self = $(this);
				var target = $('span:first-child', self);
				if (!self.hasClass('active')) {
					self.addClass('active');
					target.toggleClass('glyphicon-remove');
					searchPanel.addClass('panel-opened');
				}
				else {
					self.removeClass('active');
					target.toggleClass('glyphicon-remove');
					searchPanel.removeClass('panel-opened');
				}
			});
			if(! searchBtn.hasClass('alw-visible')){
				$(document).click(function(e){
					var searchBtn = $('#search .searchBtn');
					searchBtn.removeClass('active');
					searchBtn.next().removeClass('panel-opened');
					$('span:first-child', searchBtn).removeClass('glyphicon-remove').addClass('glyphicon-search');
				});
			}
			searchP.click(function (event){
				event.stopPropagation();
			});
		}

		// --- end search panel

		/* scroll to top */
		var toTop = $("#totop");
		if(toTop && toTop.length > 0){
			toTop.on('click',function (e){
				e.preventDefault();
				$('body,html').animate({scrollTop: 0}, 800, 'easeOutExpo');
			});
		}
		// --- end scroll to top

		/* Tonext button - Scrolls to next block (used for fullscreen slider) */
		$(".js-tonext-btn").on('click',function (e) {
			e.preventDefault();
			var endof = $(this).attr('data-endof') ? $(this).attr('data-endof') : false,
				dest = 0;

			if ( endof )
				dest = $(endof).height() + $(endof).offset().top;

			//go to destination
			$('html,body').animate({scrollTop: dest}, 1000, 'easeOutExpo');
		});

		/* Smooth scroll to id */
		$("a[data-target='smoothscroll'][href*=#]:not([href=#]), .main-menu a[href*=#]:not([href=#])").on('click',function (e) {
			//e.preventDefault();

			var url = $(this).attr('href'),
				href = url.substring(url.indexOf('#'));

			if( typeof href !== 'undefined' && href.indexOf("#") != -1 && $(href).length > 0 ) {

				var offset = $(href).offset().top;

				if( $('#wpadminbar').length > 0 ){
					offset -= $('#wpadminbar').outerHeight();
				}
				if( $('.chaser').length > 0 ){
					offset -= $('.chaser').outerHeight();
				}


				//go to destination
				if( $(href).length )
					$('html,body').stop().animate({scrollTop: offset }, 1000, 'easeOutExpo');
			} else {
				console.log('Not a valid link');
			}
		});




		/**
		 * Add a modifier class to an element, upon user defined scrolling target element or number
		 * @forch 					Is the point where, upon scrolling, the class modifier is added. Default is "1".
		 * @targetElementForClass	Target element which will have the modifier class. Default is "body".
		 * @classForVisibleState	Modifier class name. Default is "is--visible".
		 * usage: <tag class="js-scroll-event" data-forch="100" or data-forch="#some_id" data-target="#header" data-visibleclass="is--scrolling"></tag>
		 */
		$(".js-scroll-event").each(function(index, el) {

			var $el = $(el),
				defaultForch = 1,
				visible = false,
				doc = $(document),
				targetElementForClass = $el.data().hasOwnProperty('target') ? $el.data("target") : 'body',
				classForVisibleState = $el.data().hasOwnProperty('visibleclass') ? $el.data("visibleclass") : 'is--visible';

			var forch = function() {
				var f,
					dataForch = $el.attr('data-forch');
				// check if data-forch attribute is added
				if( typeof dataForch !== 'undefined' && dataForch != ''){
					// check if it's a numeric value
					if( !isNaN(parseFloat(dataForch)) && isFinite(dataForch) ){
						f = parseInt(dataForch);
					}
					// or an id/class of an element.
					else {
						var specifiedElement = $(dataForch).first();
						// check if element exists
						if(specifiedElement && specifiedElement.length > 0) {
							// get it's top offset
							f = specifiedElement.offset().top;
						}
						else {
							f = defaultForch;
						}
					}
				}
				// otherwise just add the default
				else {
					f = defaultForch;
				}
				return f;
			};

			// Check if page is scrolled after the forch
			if(doc.scrollTop() > forch() ) {
				$(targetElementForClass).addClass(classForVisibleState);
				visible = true;
			}

			$(window).on('scroll', function() {
				// if page is scrolled after the forch add class
				if (!visible && doc.scrollTop() > forch() ) {
					$(targetElementForClass).addClass(classForVisibleState);
					visible = true;
				}
				// if page is scrolled before the forch remove the class
				else if (visible && doc.scrollTop() < forch() ) {
					$(targetElementForClass).removeClass(classForVisibleState);
					visible = false;
				}
			});
		});

		$('.zn_pb_editor_enabled .toggle-header').on('click', function(e){
			e.preventDefault();
			$(this).toggleClass('site-header--hide');
		});

		// Check portfolio content
	    $.each( $('.portfolio-item-desc-inner-compacted') , function(i, el){
			var $el = $(el),
				collapseAt = $el.is('[data-collapse-at]') && $el.attr('data-collapse-at') ? $el.attr('data-collapse-at') : 150;
			if( $el.outerHeight() < parseInt(collapseAt) ){
				$el.parent('.portfolio-item-desc').addClass('no-toggle');
			}
		});

	    if( $("html").hasClass("no-touch") ){

			// Check portfolio content
            $.each( $('.portfolio-item-content.affixcontent') , function(i, el){

				var $el = $(el);
				var portfolio_page = $el.closest('.hg-portfolio-item');

				portfolio_page.imagesLoaded( function() {

					var el_size = $el.outerHeight(true),
						container_size = portfolio_page.outerHeight(true),
						container_offset = portfolio_page.offset().top,
						w_height = $(window).height(),
						max = container_size - el_size - 60,
						offset_top = 100,
						top = 0;

					// Only start if the element is smaller than parent

					$(window).scroll(function() {
						if( el_size < container_size && w_height > el_size ){
							var w_scroll_top = $(window).scrollTop();

							// Start when scrolling bigger than top position
							if( w_scroll_top + offset_top >=  container_offset ){

								// If reached bottom
								if( ( container_offset + container_size <= w_scroll_top + w_height  ) ) {
									top = max;
									$el.css('top', top);
								}
								else if( ( container_offset + container_size + offset_top ) >= w_scroll_top ){
									$el.addClass( 'stickit' );
									top = w_scroll_top - container_offset + offset_top;
									$el.css('top', top);
								}
								else{
									$el.removeClass( 'stickit' );
									$el.css('top', '');
								}
							}
							else{
								$el.removeClass( 'stickit' );
								$el.css('top', '');

							}
						}
					}).scroll();


					$(window).on('debouncedresize', function(){
						el_size = $el.outerHeight(true),
							container_size = portfolio_page.outerHeight(true),
							container_offset = portfolio_page.offset().top,
							w_height = $(window).height(),
							max = container_size - el_size - 60,
							offset_top = 100,
							top = 0;
					});
				});

			});
		}

	});	// doc.ready end //

})(jQuery);

if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
	var msViewportStyle = document.createElement("style");
	msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
	document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
}

/*jshint browser:true */
/*!
 * FitVids 1.1
 *
 * Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
 * Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
 * Released under the WTFPL license - http://sam.zoy.org/wtfpl/
 *
 */
!function(t){"use strict";t.fn.fitVids=function(e){var i={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var r=document.head||document.getElementsByTagName("head")[0],a=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}",d=document.createElement("div");d.innerHTML='<p>x</p><style id="fit-vids-style">'+a+"</style>",r.appendChild(d.childNodes[1])}return e&&t.extend(i,e),this.each(function(){var e=['iframe[src*="player.vimeo.com"]','iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="kickstarter.com"][src*="video.html"]',"object","embed"];i.customSelector&&e.push(i.customSelector);var r=".fitvidsignore";i.ignore&&(r=r+", "+i.ignore);var a=t(this).find(e.join(","));a=a.not("object object"),a=a.not(r),a.each(function(e){var i=t(this);if(!(i.parents(r).length>0||"embed"===this.tagName.toLowerCase()&&i.parent("object").length||i.parent(".fluid-width-video-wrapper").length)){i.css("height")||i.css("width")||!isNaN(i.attr("height"))&&!isNaN(i.attr("width"))||(i.attr("height",9),i.attr("width",16));var a="object"===this.tagName.toLowerCase()||i.attr("height")&&!isNaN(parseInt(i.attr("height"),10))?parseInt(i.attr("height"),10):i.height(),d=isNaN(parseInt(i.attr("width"),10))?i.width():parseInt(i.attr("width"),10),o=a/d;if(!i.attr("id")){var h="fitvid"+e;i.attr("id",h)}i.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*o+"%"),i.removeAttr("height").removeAttr("width")}})})}}(window.jQuery||window.Zepto);
