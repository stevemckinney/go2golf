(function(window) {
'use strict';

	function stickySidebar() {
		if (window.innerWidth >= 960) {
			$('[data-id="product-cta-sidebar"]').stick_in_parent(
				{
					"parent": $('body'),
					"offset_top": 20
				}
			);
		} else {
			$('[data-id="product-cta-sidebar"]').trigger("sticky_kit:detach");
		}
	}
	stickySidebar();

	function productSidebarToggleReveal() {
		if (window.innerWidth <= 670) {
			$('[data-id="product-cta-sidebar"]').css('max-height', '60px');
			var lastScrollTop = (typeof lastScrollTop === 'undefined') ? 0 : lastScrollTop; 
			$(window).scroll(function(event){
				var st = $(this).scrollTop();
				if (st > lastScrollTop){
					$('[data-id="product-cta-sidebar"]').css('max-height', '90px');
				} else {
					$('[data-id="product-cta-sidebar"]').css('max-height', '100vh');
				}
				lastScrollTop = st;
			});
		} else {
			$(window).scroll(function(event){
				$('[data-id="product-cta-sidebar"]').css('max-height', '100vh');
			});
			$('[data-id="product-cta-sidebar"]').css('max-height', '100vh');
		}
	}
	productSidebarToggleReveal();

	function executeWindowResizeFunctions() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {
			stickySidebar();
			productSidebarToggleReveal();
		}, 1000);
	}

	var resizeTimer;
	var cachedWidth = $(window).width();
	window.addEventListener('resize', function() {
		var newWidth = $(window).width();
        if(newWidth !== cachedWidth){
            executeWindowResizeFunctions();
            cachedWidth = newWidth;
        }
	});

	$('.product-categories .cat-item').click(function() {
		var linkForCategory = $(this).children('a').attr('href');
		window.location = linkForCategory;
	});

})(window);