
(function($){
	$(function(){
		/**
		 * Swap Images
		 */
		(function(){
			var images = [];
			$(".swap-image").each(function(i){
				var img = $(this);
				img.data( "default-src", img.attr("src") );
				img.data( "hover-src", img.attr("src").replace( /(.+?)(\..+?)$/, "$1-hover$2" ) );
				img.hover(
					function(){ img.attr( "src", img.data("hover-src") ); },
					function(){ img.attr("src", img.data("default-src") ); }
				);
				images[i] = new Image();
				images[i].src = img.data( "hover-src" );
			});
		})();

		/**
		 * PageTop
		 */
		$(".to-pagetop").click(function(){
			$("html,body").animate({
				"scrollTop" : 0
			});
			this.blur();
			return false;
		});

		/**
		 * Activate sub menu
		 */
		(function(){
			var c = [ "home", "type", "feature", "case", "price", "contact" ];
			$.each( c, function( i, v ){
				if( $("body").hasClass( v ) ){
					$("#navi-" + v).addClass("active");
				}
			});
		})();

		/**
		 * Open popup
		 */
		(function(){
			$(".popup-window").click(function(){
				var win = window.open( $(this).attr("href"), "upr_popup", "width=840,height=800,scrollbars=yes" );
				if( win ){ win.focus(); }
				return false;
			});
		})();

		/**
		 * Close window
		 */
		(function(){
			$(".close-window a").click(function(){
				window.close();
				return false;
			});
		})();

	});
})(jQuery);
