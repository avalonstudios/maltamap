let loaded = false;
$(function() {
	$( window ).on( 'load', function() {
		hideMenu();
	});
	$(window).on( 'resize', function(){
		clearTimeout( resizeTimer );
		var resizeTimer = setTimeout( function() {
				hideMenu();
			},
		250 );
	});
});

function hideMenu() {
	let adminTrue;
	let adminBar = $( '#wpadminbar' ).length;
	let adminBarHeight;
	let headerHeight = $( '.site-header' ).outerHeight();
	let totalHeight = headerHeight;
	if ( adminBar == 1 ) {
		adminTrue = true;
		adminBarHeight = $( '#wpadminbar' ).outerHeight();
		totalHeight = headerHeight + adminBarHeight;
		let checkScroll = $( window ).scrollTop();
		//if ( checkScroll === 0 ) {
			$( '.site-header, .site-content' ).addClass( 'nav-down' );
			$( '.site-header.nav-down' ).css( 'top', adminBarHeight );
		//}
	} else {
		adminTrue = false;
	}

	if ( loaded === false ) {
		$( '.site-header, .site-content' ).addClass( 'nav-down' );
		$( '.site-content.nav-down' ).css( 'padding-top', totalHeight );
		loaded = true;
	}
	// Hide Header on on scroll down
	let didScroll;
	let lastScrollTop = 0;
	let delta = 5;
	let navbarHeight = $( '.site-header' ).outerHeight();


	$( window ).scroll( function ( event ) {
		didScroll = true;
	});

	setInterval( function() {
		if ( didScroll ) {
			hasScrolled();
			didScroll = false;
		}
	}, 250 );

	function hasScrolled() {
		var st = $( window ).scrollTop();

		// Make sure they scroll more than delta
		if ( Math.abs( lastScrollTop - st ) <= delta )
			return;

		// If they scrolled down and are past the navbar, add class .nav-up.
		// This is necessary so you never see what is "behind" the navbar.
		if ( st > lastScrollTop && st > navbarHeight ) {
			// Scroll Down
				$( '.site-header, .site-content' ).removeClass( 'nav-down' ).addClass( 'nav-up' );
			if ( st > navbarHeight ) {
				$( '.nav-up' ).css( 'top', '-82px' );
			} else {
				$( '.nav-up' ).css( 'top', adminBarHeight );
			}
		} else {
			// Scroll Up
			if ( st + $( window ).height() < $( document ).height() ) {
				$( '.site-header, .site-content' ).removeClass( 'nav-up' ).addClass( 'nav-down' );
				if ( adminTrue ) {
					$( '.nav-down' ).css( 'top', adminBarHeight );
					/*if ( st != 0 ) {
						$( '.nav-down' ).css( 'top', 0 );
					} else {
						$( '.nav-down' ).css( 'top', adminBarHeight );
					}*/
				} else {
					$( '.nav-down' ).css( 'top', 0 );					
				}
			}
		}
		lastScrollTop = st;
	}
}