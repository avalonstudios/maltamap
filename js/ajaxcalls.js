$(function() {
	let loaded = false;
	let backgroundImg;
	let carouselImages;
	let wW = $( window ).innerWidth();

	$( window ).on( 'load', function() {
		wW = $( window ).innerWidth();
		if ( wW >= 992 ) {
			loaded = true;
		}
		jQuery.ajax({
			url : ajaxObj.ajaxURL,
			type : 'POST',
			data : {
				action : 'getBackgroundImage',
			},
			success : function( imageURL ) {
				backgroundImg = imageURL;
				outputImage( backgroundImg );
			},
		});

		jQuery.ajax({
			url : ajaxObj.ajaxURL,
			type : 'POST',
			data : {
				action : 'getCarouselImages',
			},
			success : function( carouselImg ) {
				carouselImages = carouselImg;
				outputCarouselImages( carouselImages );
			}
		});

		// "Did you know" Popups
		let timer;
		let dykStatus = 'closed';

		$( '#dykpopup' ).on( 'click', '.dyk-btn', function() {
			$( '#dykpopup' ).toggleClass( 'open closed' );
			if ( dykStatus === 'closed' ) {
				clearTimeout( timer );
				dykStatus = 'open';
			} else if ( dykStatus === 'open' ) {
				setTimer();
				$( '#dykpopup' ).addClass( 'out' );
				dykStatus = 'closed';
			}
		});

		setTimer();
		function setTimer() {
			let $randomTime = getRndInteger( 10, 20 );
			timer = setTimeout(
				function() {
					randomPopup();
				}, $randomTime * 1000 );
		}

		function randomPopup( min, max ) {
			jQuery.ajax({
				url : ajaxObj.ajaxURL,
				type : 'POST',
				data : {
					action : 'dykPopup',
				},
				success : function( data ) {
					$( '#dykpopup' ).html( data );
					$( '#dykpopup' ).removeClass( 'out' );
					clearTimeout( timer );
				}
			});
		}
		function getRndInteger(min, max) {
			return Math.floor(Math.random() * (max - min + 1) ) + min;
		}
	});

	function outputImage( backgroundImg ) {
		if ( backgroundImg ) {
			if ( wW >= 992 ) { //&& loaded === false ) {
				$('.ava-background-image').append(
					'<div style="background: url(' + backgroundImg + ');" />'
				);
			}
		}
	}

	function outputCarouselImages( carouselImages ) {
		if ( wW >= 992 ) { //&& loaded === false ) {
			$('#front-page-carousel').append( carouselImages );
		}
	}

	$( window ).on( 'resize', function() {
		wW = $( window ).innerWidth();
		if ( wW >= 992 && loaded === false ) {
			loaded = true;
			outputImage( backgroundImg );
			outputCarouselImages( carouselImages );
		}
	});
});