/**
 * 
 * Licensed under the MIT license
 *
 */

(function($) {

/*global jQuery, Galleria */

Galleria.addTheme({
	name: 'alaska',
	author: 'GUR',
	css: 'galleria.alaska.css',
	defaults: {
		transition: 'slide',
		thumbCrop:  'height',

		// set this to false if you want to show the caption all the time:
		_toggleInfo: true
	},
	init: function(options) {

		Galleria.requires(1.28, 'This version of alaska theme requires Galleria 1.2.8 or later');

		// add some elements
		this.addElement('info-link','info-close');
		this.append({
			'info' : ['info-link','info-close']
		});

		// cache some stuff
		var info = this.$('info-link,info-close,info-text'),
			touch = Galleria.TOUCH,
			click = touch ? 'touchstart' : 'click';

		// show loader & counter with opacity
		this.$('loader,counter').show().css('opacity', 0.4);

		// some stuff for non-touch browsers
		if (! touch ) {
			this.addIdleState( this.get('image-nav-left'), { left:-50 });
			this.addIdleState( this.get('image-nav-right'), { right:-50 });
			this.addIdleState( this.get('counter'), { opacity:0 });
		}

		// toggle info
		if ( options._toggleInfo === true ) {
			info.bind( click, function() {
				info.toggle();
			});
		} else {
			info.show();
			this.$('info-link, info-close').hide();
		}

		// bind some stuff
		this.bind('thumbnail', function(e) {

			if (! touch ) {
				// fade thumbnails
				$(e.thumbTarget).css('opacity', 0.6).parent().hover(function() {
					$(this).not('.active').children().stop().fadeTo(100, 1);
				}, function() {
					$(this).not('.active').children().stop().fadeTo(400, 0.6);
				});

				if ( e.index === this.getIndex() ) {
					$(e.thumbTarget).css('opacity',1);
				}
			} else {
				$(e.thumbTarget).css('opacity', this.getIndex() ? 1 : 0.6);
			}
		});

		this.bind('loadstart', function(e) {
			if (!e.cached) {
				this.$('loader').show().fadeTo(200, 0.4);
			}

			this.$('info').toggle( this.hasInfo() );

			$(e.thumbTarget).css('opacity',1).parent().siblings().children().css('opacity', 0.6);
		});

		this.bind('loadfinish', function(e) {
			this.$('loader').fadeOut(200);
		});
		
		/* specific alaska */
		
		// creating a bar with all buttons;
		this.addElement("bar"); // generate a div.galleria-bar
		// 
		this.appendChild("container","bar"); // append it to div.galleria-container
		// adding fullscreen button;
		this.addElement("fullscreen"); // generate a div.galleria-fullscreen
		this.appendChild("bar", "fullscreen"); // append it to div.galleria-bar
		// adding play button
		this.addElement("play"); // generate a div.galleria-play
		this.appendChild("bar", "play"); // append it to div.galleria-bar
		
		var play = this.$("play"),
			fullscreen = this.$("fullscreen");
		// click on play;
		// proxy because we want this to be the Galleria current instance;
		play.bind('click', $.proxy( function(event) {
			this.playToggle();
			this.$("play").toggleClass("pause");
		}, this ) );
		// proxy because we want this to be the Galleria current instance;
		fullscreen.bind('click', $.proxy( function(event) {
			this.enterFullscreen(function() {
			// TODO disable image click when we are in fullscreen mode. 
			});
		} , this ) );
		
		// move thumbnails-container into bar to have something nice.
		this.appendChild("bar", "thumbnails-container"); 
	}
});

}(jQuery));
