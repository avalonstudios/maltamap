//@prepros-append hide-menu.js
//@prepros-append navigation.js
//@prepros-append ajaxcalls.js

$(function() {
	function isScrolledIntoView(elem) {
		var docViewTop = $(window).scrollTop();
		var docViewBottom = docViewTop + $(window).height();
		var elemTop = $(elem).offset().top;
		var elemBottom = elemTop + $(elem).height();

		return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}
	// If element is scrolled into view, fade it in
	$( window ).on( 'scroll', function() {
		/*if ( isScrolledIntoView( this ) === true) {
		}*/
	});
	$( window ).on( 'load', function() {
		let tmp = 100;
		setTimeout( function() {
			$( '.committee-content .animus' ).each( function() {
				avaAnimate( $( this ) );
			});
			$( '.publications-content .animus' ).each( function() {
				avaAnimate( $( this ) );
			});
		}, 500 );

		function avaAnimate( el ) {
			let elem = el;
			let animType = elem.attr( "data-animtype" );
			setTimeout( function() {
				elem.addClass( 'animated ' + animType );
				elem.removeClass( 'animus' );
			}, tmp += 50 );
		}


		$( '.menu-item-has-children' ).on( 'click', function(e) {
		//	e.preventDefault();
		});

		let wW = $( window ).innerWidth();
		let wH = $( window ).innerHeight();
		let contentHeight = $( '.site-content' ).innerHeight();
		if ( contentHeight < wH ) {
			$( '.site-footer' ).addClass( 'fixed' );
		}

		let navigation = $( '.modal-dialog > nav #primary-menu' );

		navigation.find( '.menu-item-has-children' ).attr({
				"aria-haspopup": 'true',
				"aria-expanded": 'false',
			});
		navigation.find( '.menu-item-has-children' ).addClass( 'dropdown' );//.attr( 'id', 'dropDownMenu' );

		navigation.find( '.sub-menu .menu-item-has-children' ).removeClass( 'dropdown' );//.attr( 'id', 'dropDownMenu' );
		
		navigation.find( '.menu-item-has-children > a' ).addClass( 'dropdown-toggle' ).attr({
				"data-toggle": 'dropdown',				
			});
		navigation.find( '.menu-item-has-children .sub-menu' ).addClass( 'dropdown-menu' );
		navigation.find( '.menu-item-has-children .sub-menu > .menu-item-has-children' ).addClass( 'dropdown-submenu' );

		$('.dropdown-submenu > a').on("click", function(e) {
		    var submenu = $(this);
		   // $('.dropdown-submenu .dropdown-menu').removeClass('show');
		    submenu.next('.dropdown-menu').addClass('show');
		    e.stopPropagation();
		    e.preventDefault();
		});

		$('.dropdown').on("hidden.bs.dropdown", function() {
		    // hide any open menus when parent closes
		 //   $('.dropdown-menu.show').removeClass('show');
		});

		$( '.modal-backdrop' ).bind( 'click', function() {
			navigation.find( '.show' ).removeClass( 'show' );
			//console.log('sam')
		});
		// make the sidebar widgets mosaic
		if ( wW < 992 ) {
			$( '#secondary' ).addClass( 'card-columns' );
			$( '#secondary .widget' ).addClass( 'card' );
		}
		//
		// turn meta links into badges
		$( '.entry-footer span a' ).addClass( 'badge' );
		$( '.entry-footer .cat-links a' ).addClass( 'badge badge-primary' );
		$( '.entry-footer .tags-links a' ).addClass( 'badge badge-secondary' );
		$( '.entry-footer .edit-link a' ).addClass( 'badge badge-dark' );

		// Image gallery
		$( '.gallery' ).addClass( 'card-columns' );
		$( '.gallery' ).find( '.gallery-item' ).addClass( 'card' );
		$( '.gallery' ).find( 'img' ).addClass( 'card-img-top' );
		$( '.gallery' ).find( 'figcaption' ).addClass( 'card-body' );

		// Instantiante Carousel
		$( '#front-page-carousel' ).carousel({
			interval: 3000,
		});

		let navLinks = $( '.post-navigation .nav-links a, .posts-navigation .nav-links a' ).addClass( 'badge badge-primary' );
	});

	$(window).on( 'resize', function(){
		clearTimeout( resizeTimer );
		var resizeTimer = setTimeout( function() {
				onResize();
			},
		250 );
	});
});

function onResize() {
	let wW = $( window ).innerWidth();
	let wH = $( window ).innerHeight();
	let contentHeight = $( '.site-content' ).innerHeight();
	if ( contentHeight < wH ) {
		$( '.site-footer' ).addClass( 'fixed' );
	} else {
		$( '.site-footer' ).removeClass( 'fixed' );		
	}

	if ( wW < 992 ) {
		$( '#secondary' ).addClass( 'card-columns' );
		$( '#secondary .widget' ).addClass( 'card' );
	} else {
		$( '#secondary' ).removeClass( 'card-columns' );
		$( '#secondary .widget' ).removeClass( 'card' );
	}
}