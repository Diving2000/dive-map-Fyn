$(function(){
	
	/* ==================== Cross-browser compatible WIDTH TEST (for RWD) ==================== */
	function getWidth() {
		if (self.innerHeight) {return self.innerWidth;}
		if (document.documentElement && document.documentElement.clientWidth) {return document.documentElement.clientWidth;}
		if (document.body) {return document.body.clientWidth;}
	}
	
	
	/* ==================== PAN-ZOOM INITIALIZATION ==================== */
	var svgElement = document.querySelector('#Map');
	
	// Custom event handler to enable pinch/zoom and panning on touch
	var eventsHandler;
  eventsHandler = {
  haltEventListeners: ['touchstart', 'touchend', 'touchmove', 'touchleave', 'touchcancel']
  	, init: function(options) {
     	var instance = options.instance
        , initialScale = 1
        , pannedX = 0
        , pannedY = 0

        // Init Hammer, listen only for pointer and touch events
        this.hammer = Hammer(options.svgElement, {
          inputClass: Hammer.SUPPORT_POINTER_EVENTS ? Hammer.PointerEventInput : Hammer.TouchInput
        });

        // Enable pinch
        this.hammer.get('pinch').set({enable: true});

        // Handle double tap
        this.hammer.on('doubletap', function(ev){
          instance.zoomIn()
        });

        // Handle pan
        this.hammer.on('panstart panmove', function(ev){
          // On pan start reset panned variables
          if (ev.type === 'panstart') {
            pannedX = 0
            pannedY = 0
          }

          // Pan only the difference
          instance.panBy({x: ev.deltaX - pannedX, y: ev.deltaY - pannedY});
          pannedX = ev.deltaX
          pannedY = ev.deltaY
        });

        // Handle pinch
        this.hammer.on('pinchstart pinchmove', function(ev){
          // On pinch start remember initial zoom
          if (ev.type === 'pinchstart') {
            initialScale = instance.getZoom();
            instance.zoom(initialScale * ev.scale);
          }
          instance.zoom(initialScale * ev.scale);
        });

        // Prevent moving the page on some devices when panning over SVG
        options.svgElement.addEventListener('touchmove', function(e){ e.preventDefault(); });
      }

    , destroy: function(){
        this.hammer.destroy();
      }
  }
	
	var winWidth = $(window).width();
  var winHeight = $(window).height();
	
	var checkPosition = function(x, y){
    var bBox = svgElement.getBBox();
    var winWidth = $(window).width();
    var winHeight = $(window).height();

    var panLock = {
      xMin: - (bBox.width - (winWidth + 280)),
      xMax: 0,
      yMin: - (bBox.height - winHeight),
      yMax: 0
    };

    var repan = false;

    if (x > panLock.xMax) {
      x = panLock.xMax;
      repan = true;
    }
    if (x < panLock.xMin) {
      x = panLock.xMin;
      repan = true;
    }
    if (y < panLock.yMin) {
      y = panLock.yMin;
      repan = true;
    }
    if (y > panLock.yMax) {
      y = panLock.yMax;
      repan = true;
    }

    if (repan) {
      panZoom.pan({x: x, y: y});
    }
  };

	var panZoom = svgPanZoom(svgElement, {
		panEnabled:true,
		zoomEnabled:true,
		minZoom:1,
		maxZoom:12,
		contain:true,
		fit:1,
		center:1,
		refreshRate:2,
		dblClickZoomEnabled:false,
		customEventsHandler: eventsHandler,
		onZoom: function(){
      var pan = panZoom.getPan();
      checkPosition(pan.x, pan.y);
    },
    onPan: function(x, y){
			var pan = panZoom.getPan();
      checkPosition(pan.x, pan.y);
    }
	});
	
	
	// Custom controls
	document.getElementById('zoom-in').addEventListener('click', function(ev){
  	ev.preventDefault();
		panZoom.zoomIn();
  });
	document.getElementById('zoom-out').addEventListener('click', function(ev){
		ev.preventDefault();
		panZoom.zoomOut();
	});
	document.getElementById('reset').addEventListener('click', function(ev){
		ev.preventDefault();
		panZoom.resetZoom();
	});
	
	
	/* ==================== HOVER TRIGGER - small infoboxes ==================== */
	// Hide all
	$('g[id^="m-"]').hide();
	
	// Show on hover
	$('g[id^="c-"]').on("mouseenter", function(){
		var id = this.id;
		$('#' + id + ' + g[id^="m-"]').fadeIn("fast");
	});
	$('g[id^="c-"]').on("mouseleave", function(){
		$('g[id^="m-"]').fadeOut("fast");
	});
	
	
	/* ==================== CLICK TRIGGER - large infoboxes (only accommodation) ==================== */
	$('rect[id^="p-"]').on("click tap touchstart", function(){
		
		$(".accommodation").removeClass("fadeOut");
		$(".accommodation").addClass("fadeIn");
		
		var identifier = this.id;
		
		$(".accommodation > div." + identifier + "").removeClass("fadeOut");
		$(".accommodation > div." + identifier + "").addClass("fadeIn");
		
		$('body').css({'height':'100vh', 'overflow-y':'hidden'});
		
	});
	
	
	/* ==================== CLICK TRIGGER - closing large infoboxes ==================== */
	
	// If DOM was modified (AJAX)
	$(".modals").bind("DOMSubtreeModified", function() {
		$(".fancybox").fancybox();
				
		$('.close').on("click", function(){
		
			//fadeOut given modal
			$(".modal").removeClass("fadeIn");
			$(".modal").addClass("fadeOut");

			// hide class modals
			$(".modals").removeClass("fadeIn");
			$(".modals").addClass("fadeOut");

			$('iframe').attr("src", " ");
			$('iframe').remove();

			// reset body CSS styles to enable scrolling behavior
			$('body').css({'height':'auto', 'overflow-y':'visible'});

			$(".modals").html('<p class="close" title="Close"></p>');

		});
	});
	
	// If DOM wasn't modified
	$('.close').on("click", function(){
		
		//fadeOut given modal
		$(".modal, .accommodation > div").removeClass("fadeIn");
		$(".modal, .accommodation > div").addClass("fadeOut");

		// hide class modals
		$(".modals, .accommodation").removeClass("fadeIn");
		$(".modals, .accommodation").addClass("fadeOut");

		// remove video
		$('iframe').attr("src", " ");
		$('iframe').remove();

		// reset body CSS styles to enable scrolling behavior
		$('body').css({'height':'auto', 'overflow-y':'visible'});

		// Re-instate close button
		$(".modals").html('<p class="close" title="Close"></p>');

	});
	
	
	/* ==================== Click toggle for 'Map Usage' and 'Icon Key' boxes ==================== */
	$('.fade ul').hide();
	$('.fade h2').append('<span class="fa fa-chevron-down"></span>');
	
	$('.fade h2').on('click', function(){
		$(this).parent().find('h2 span').toggleClass('fa-chevron-down').toggleClass('fa-chevron-up');
		$(this).parent().find('ul').slideToggle();
	});
	
	
	/* ==================== Collapsible sidebar (left) ==================== */
	
	// creates mobile navigation
	function mobileNav(){
		$('.leftSidebar').addClass('mobile-nav');
			
		// if buttons with a class of show-nav and hide-nav don't exist, add them
		var showNav = $('.wrapper').children('button.show-nav');
		if(showNav.length === 0){
			$('.wrapper').prepend('<button class="show-nav">Menu</button>');
		}
		var hideNav = $('.leftSidebar').children('button.hide-nav');
		if(hideNav.length === 0){
			$('.leftSidebar').prepend('<button class="hide-nav">Close</button>');
		}
	}
	
	// if browser window is smaller than 960px and no resize event has fired, 
	// meaning that the browser loads in a small window
	if(getWidth() <= 960){
		mobileNav();
		
		$('button.show-nav').on('click', function(){
			$('.leftSidebar').addClass('expanded');
			$('body').css({'height': '100vh', 'overflow-y':'hidden'});
		});
		$('button.hide-nav').on('click', function(){
			$('.leftSidebar').removeClass('expanded');
			$('body').css({'height': '100vh', 'overflow-y':'hidden'});
		});
	}
	
	// test if window has been resized
	$(window).resize(function() {
		if(getWidth() <= 960){
			mobileNav();
			
			$('button.show-nav').on('click', function(){
				$('.leftSidebar').addClass('expanded');
				$('body').css({'height': '100vh', 'overflow-y':'hidden'});
			});
			$('button.hide-nav').on('click', function(){
				$('.leftSidebar').removeClass('expanded');
				$('body').css({'height': '100vh', 'overflow-y':'hidden'});
			});
			
		}else {
			$('.leftSidebar').removeClass('mobile-nav');
			$('.leftSidebar').removeClass('expanded');
			$('button.show-nav').remove();
			$('button.hide-nav').remove();
		}
	});
	
	
	/* ==================== Prevent map from collapsing in Edge ==================== */
	var isIE = /*@cc_on!@*/false || !!document.documentMode;
	var isEdge = !isIE && !!window.StyleMedia;

	if(isEdge === true){
		$('svg').css({'height': '60vw'});
	}
	
	
	/* ==================== Initialize plugins ==================== */
	$(".fancybox").fancybox();
			
});