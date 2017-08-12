(function(window) {
'use strict';

	function stickySidebar() {
		setTimeout(function() {
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
		}, 500);
	}

	window.addEventListener('resize', stickySidebar);

})(window);