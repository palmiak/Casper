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
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {

        //functions
        imagesLoaded( 'body', function() {
            $("#preloader").fadeOut("fast");
            $("body").removeClass("preload");
        });

		function pad (str, max) {
		    str = str.toString();
		    return str.length < max ? pad("0" + str, max) : str;
		  }

        $(document).foundation(); // Foundation JavaScript

        WebFontConfig = {
          google: { families: [ 'Allura::latin,latin-ext' ] }
        };
        (function() {
          var wf = document.createElement('script');
          wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
          wf.type = 'text/javascript';
          wf.async = 'true';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(wf, s);
        })();

		wow = new WOW ({
			mobile: false
		});
		wow.init();

		$("a[href='#mainnav']").click(function() {
			$("html, body").animate({ scrollTop: 0 }, "normal");
			return false;
		});

		$('.album-image').magnificPopup({
			type: 'image',
			image: {
				markup: '<div class="mfp-figure">'+
				        '<div class="mfp-close"></div>'+
				        '<div class="mfp-img"></div>'+
						'<h5 class="mfp-title "></h5>'+
				        '<div class="mfp-bottom-bar">'+
				          '<div class=""></div>'+
				          '<div class="mfp-counter"></div>'+
				        '</div>'+
				      '</div>',
				titleSrc: function(item) {
					if( item.el.attr('data-link') !== '' ){
						return '<h4 class="lb-title text-center georgia yellow">' + item.el.attr('title') + '</h4>' + '<div class="mfp-button"><a target="about:blank" class="button borders yellow block" href="' + item.el.attr('data-link') + '">Chcesz kupić? Kliknij tutaj <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>';
					} else {
						return '<h4 class="lb-title text-center georgia yellow">' + item.el.attr('title') + '</h4>';
					}

				},
			},
			gallery: {
	            enabled: true
          	},
			callbacks: {
				elementParse: function(item) {
			      // Function will fire for each target element
			      // "item.el" is a target DOM element (if present)
			      // "item.src" is a source that you may modify
				  console.log( item );
				  console.log( item.el.attr('data-link') );
			    },
			}

		});
		var $container = $('.gallery-list-static').imagesLoaded( function() {
		  // initialize Packery after all images have loaded
		  $container.packery({
			itemSelector: '.item',
			gutter: 0,
			percentPosition: true
		  });
		});

		// fixed menu po scrollu
		var nav_height = $("#mainnav").height();
		var nav_scroll = jQuery(document).scrollTop();
		if(nav_scroll>nav_height){
		   jQuery('#mainnav').addClass('addbg');
		} else {
		   jQuery('#mainnav').removeClass('addbg');
		}

		jQuery( window ).scroll(function() {
			var nav_height = $("#mainnav").height();
			var nav_scroll = jQuery(document).scrollTop();
			if(nav_scroll>nav_height){
			   jQuery('#mainnav').addClass('addbg');
			} else {
			   jQuery('#mainnav').removeClass('addbg');
			}
		});

		$(".scrollarrow").click(function() {
			$('html, body').animate({
				scrollTop: $("#first").offset().top - nav_height
			}, 1000);
		});

		imagesLoaded( '.main-slider', function() {
			$('.main-slider').flickity({
			  cellAlign: 'center',
			  prevNextButtons: true,
			  pageDots: false,
			  wrapAround: true
			});
		});

		$("#mobilemenu").hide();
		$(".mobilemenu-btn").click(function() {
		  $("body").toggleClass("preload");
		  $("#mobilemenu").slideToggle("normal");
		  return false;
		});

		$('.mobilemenu-btn').click(function() {
		  $(this).toggleClass('open');
		});

		/**
		 * ALM - wywoływanie equalizera na kazde doczytanie
		 */
		$.fn.almComplete = function(alm){
			new Foundation.Equalizer($(".eq_row")).applyHeight();
  		};

		/**
		 * ALM - ukrywanie buttona
		 */

		$.fn.almDone = function(){
       		$( '.alm-btn-wrap' ).hide();
    	};

		// Replace all SVG images with inline SVG
		jQuery('img.svg').each(function(){
		 var $img = jQuery(this);
		 var imgID = $img.attr('id');
		 var imgClass = $img.attr('class');
		 var imgURL = $img.attr('src');

		 jQuery.get(imgURL, function(data) {
		     // Get the SVG tag, ignore the rest
		     var $svg = jQuery(data).find('svg');

		     // Add replaced image's ID to the new SVG
		     if(typeof imgID !== 'undefined') {
		         $svg = $svg.attr('id', imgID);
		     }
		     // Add replaced image's classes to the new SVG
		     if(typeof imgClass !== 'undefined') {
		         $svg = $svg.attr('class', imgClass+' replaced-svg');
		     }

		     // Remove any invalid XML tags as per http://validator.w3.org
		     $svg = $svg.removeAttr('xmlns:a');

		     // Replace image with new SVG
		     $img.replaceWith($svg);

		 }, 'xml');
		});

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },

    'post_type_archive_albumy': {
		init: function() {
			packeryInit = false;
			if( packeryInit !== true ){
				var $container = $('.gallery-list').imagesLoaded( function() {
		          // initialize Packery after all images have loaded
		          $container.packery({
		            itemSelector: '.item',
		            gutter: 0,
					percentPosition: true
		          });
		        });


				packeryInit = true;
			}

		    $.fn.almComplete = function(alm){ // Ajax Load More callback function
				$('.gallery-list').imagesLoaded( function() {
		    		$container.packery('reloadItems'); // Reload masonry items after callback
					$container.packery();
				});
		    };
	    },
	    finalize: function() {
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
