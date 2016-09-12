/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

function menu() {
	console.log( 'plum' );
	var $document = $(document);
	$document.ready(function () {

		var $postContent = $(".post-content");
		$postContent.fitVids();

		$(".scroll-down").arctic_scroll();

		$(".menu-button, .nav-cover, .nav-close").on("click", function(e){
			e.preventDefault();
			$("body").toggleClass("nav-opened nav-closed");
		});

	});
}

function popup() {
	$('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function(){
		//single image popup
		if ($(this).parents('.gallery').length === 0) {
				$(this).magnificPopup({type:'image'});
		}
	});
	//gallery popup
	$('.gallery a[href*=".jpg"], .gallery a[href*=".jpeg"], .gallery a[href*=".png"], .gallery a[href*=".gif"]').each(function() {
		$(this).magnificPopup({
				type: 'image',
				gallery: {enabled:true}
		});
	});
}
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
		  WebFontConfig = {
			  google: { families: [ 'Merriweather:300,300i,700,700i' , 'Open+Sans:400,700' ] }
		  };
		  (function() {
			  var wf = document.createElement('script');
			  wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			  wf.type = 'text/javascript';
			  wf.async = 'true';
			  var s = document.getElementsByTagName('script')[0];
			  s.parentNode.insertBefore(wf, s);
		  })();


		  menu();
		  Barba.Pjax.start();
		  var FadeTransition = Barba.BaseTransition.extend({
		    start: function() {
		      /**
		       * This function is automatically called as soon the Transition starts
		       * this.newContainerLoading is a Promise for the loading of the new container
		       * (Barba.js also comes with an handy Promise polyfill!)
		       */

		      // As soon the loading is finished and the old page is faded out, let's fade the new page
		      Promise
		        .all([this.newContainerLoading, this.fadeOut()])
		        .then(this.fadeIn.bind(this));
		    },

		    fadeOut: function() {
		      /**
		       * this.oldContainer is the HTMLElement of the old Container
		       */

		      return $(this.oldContainer).animate({ opacity: 0 }).promise();
		    },

		    fadeIn: function() {
		      /**
		       * this.newContainer is the HTMLElement of the new Container
		       * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
		       * Please note, newContainer is available just after newContainerLoading is resolved!
		       */

		      var _this = this;
		      var $el = $(this.newContainer);

		      $(this.oldContainer).hide();

		      $el.css({
		        visibility : 'visible',
		        opacity : 0
		      });

		      $el.animate({ opacity: 1 }, 400, function() {
		        /**
		         * Do not forget to call .done() as soon your transition is finished!
		         * .done() will automatically remove from the DOM the old Container
		         */
				document.body.scrollTop = 0;
		        _this.done();
		      });
		    }
		  });

		  /**
		   * Next step, you have to tell Barba to use the new Transition
		   */

		  Barba.Pjax.getTransition = function() {
		    /**
		     * Here you can use your own logic!
		     * For example you can use different Transition based on the current page or link...
		     */

		    return FadeTransition;
		  };

		  Barba.Dispatcher.on( 'transitionCompleted', function() {
			  	$("body").removeClass("nav-opened nav-closed");
			  	menu();
				popup();
		  });

		  popup();


	      // Arctic Scroll by Paul Adam Davis
	      // https://github.com/PaulAdamDavis/Arctic-Scroll
	      $.fn.arctic_scroll = function (options) {

	          var defaults = {
	              elem: $(this),
	              speed: 500
	          },

	          allOptions = $.extend(defaults, options);

	          allOptions.elem.click(function (event) {
	              event.preventDefault();
	              var $this = $(this),
	                  $htmlBody = $('html, body'),
	                  offset = ($this.attr('data-offset')) ? $this.attr('data-offset') : false,
	                  position = ($this.attr('data-position')) ? $this.attr('data-position') : false,
	                  toMove;

	              if (offset) {
	                  toMove = parseInt(offset);
	                  $htmlBody.stop(true, false).animate({scrollTop: ($(this.hash).offset().top + toMove) }, allOptions.speed);
	              } else if (position) {
	                  toMove = parseInt(position);
	                  $htmlBody.stop(true, false).animate({scrollTop: toMove }, allOptions.speed);
	              } else {
	                  $htmlBody.stop(true, false).animate({scrollTop: ($(this.hash).offset().top) }, allOptions.speed);
	              }
	          });

	      };
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
