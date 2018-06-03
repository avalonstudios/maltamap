<?php
add_action( 'wp_ajax_nopriv_getBackgroundImage', 'getBackgroundImage' );
add_action( 'wp_ajax_getBackgroundImage', 'getBackgroundImage' );
function getBackgroundImage() {
	$defaultBackgroundImage = get_field( 'default_background_image', 'option' );
	echo $defaultBackgroundImage['url'];
	die();
}

add_action( 'wp_ajax_nopriv_getCarouselImages', 'getCarouselImages' );
add_action( 'wp_ajax_getCarouselImages', 'getCarouselImages' );
function getCarouselImages() {
	$frontpage_id = get_option( 'page_on_front' );
	ob_start(); ?>
	<?php if ( have_rows( 'images', $frontpage_id ) ) { $i = 0; ?>
		<div id="carousel" class="carousel slide carousel-slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php while ( Have_rows( 'images', $frontpage_id ) ) { the_row(); ?>
					<?php
					$imageID = get_sub_field( 'image' );
					$image = wp_get_attachment_image_src( $imageID, 'full' );
					$srcset = wp_get_attachment_image_srcset( $imageID );
					?>
					<div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
						<img class="d-block w-100" src="<?php echo $image[0]?>" srcset="<?php echo $srcset; ?>">
					</div>
				<?php
				$i++;
				} ?>
			</div>
		</div>
	<?php } ?>
	<?php
	echo ob_get_clean();
	die();
}

add_action( 'wp_ajax_nopriv_dykPopup', 'dykPopup' );
add_action( 'wp_ajax_dykPopup', 'dykPopup' );
function dykPopup() {
	ob_start(); ?>
	<?php
	$rows = get_field( 'popups', 'option' );
	$randomRow = $rows[ array_rand( $rows ) ];

	$info = $randomRow[ 'info_snippet' ];
	$info = wp_strip_all_tags( $info, true ); ?>
	<button type="button" class="btn btn-info dyk-btn"><i class="far fa-question-circle"></i> Did you know...?</button>
	<div class="info-snippet"><?php echo $info; ?></div>
	<?php
	echo ob_get_clean();
	die();
}