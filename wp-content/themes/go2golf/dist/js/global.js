(function(window) {
'use strict';

  var listToggle = '<span class="list-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12.00061 12" fill="currentcolor"><path d="M11.93127,4.18115,6.18274,9.92969a.26038.26038,0,0,1-.36133,0L.07288,4.18115a.26038.26038,0,0,1,0-.36133L1.82239,2.07031a.26038.26038,0,0,1,.36133,0L6.00208,5.90283,9.82043,2.07031a.26038.26038,0,0,1,.36133,0l1.74951,1.74951a.27.27,0,0,1,0,.36133Z"/></svg></span>';

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

	$('[data-nav-toggle]').click(function() {
		$('.c-primary-nav').toggleClass('c-primary-nav--active');
		$('body').toggleClass('no-scrolling');
		($('[data-nav-toggle]').attr('data-nav-toggle') === 'active') ? $('[data-nav-toggle]').attr('data-nav-toggle', 'inactive') : $('[data-nav-toggle]').attr('data-nav-toggle', 'active');
	});

	$('.c-primary-nav__list > .cat-item > a').click(function() {
		event.preventDefault();
		var subNav = $(this).next('.children');
		subNav.toggleClass('is-active');
	});
	
	$('.cat-parent').append(listToggle);
	
	$('.cat-parent').on('click', '.list-toggle', function() {
  	$(this).siblings('.children').toggle();
	});

})(window);