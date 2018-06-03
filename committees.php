<?php
/**
 * Template Name: Committees
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Malta_Map_Society
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="committee-content">
			<?php
			if ( have_rows( 'committees_flx' ) ) {
				while ( have_rows( 'committees_flx' ) ) { the_row();
					$i = 250;
					$layouts = get_row_layout();
					switch ( $layouts ) {
						case 'committee_lyt':
							if ( have_rows( 'committees_rpt' ) ) { ?>
								<section class="committee-section my-4">
								<?php
								while ( have_rows( 'committees_rpt' ) ) { the_row();
									$publicationSectionTitle = get_sub_field( 'committee_name' ); ?>
									<div class="committee-title p-3 animus fadeIn"><?php echo $publicationSectionTitle; ?></div>
									<?php
									if ( have_rows( 'members_rpt' ) ) {
										while ( have_rows( 'members_rpt' ) ) { the_row();
											$position = get_sub_field( 'position' );
											$name = get_sub_field( 'name' );
											$imageID = get_sub_field( 'image' );
											$image = wp_get_attachment_image_src( $imageID, 'thumbnail' );

											// Random Icons
											$iconsRep = get_field( 'map_icons_rpt', 'option' );
											$randomRow = $iconsRep[ array_rand( $iconsRep ) ];

											$icon = $randomRow[ 'icon' ];
											$icon = wp_get_attachment_image_src( $icon );
											?>
											<div class="member my-3 p-2 row justify-content-center">
											<?php
											if ( $position ) { ?>
												<h3 class="position col-sm-12 col-md-4 animus" data-animtype="fadeIn"><strong><?php echo $position; ?></strong></h3>
												<div class="name col-sm-6 col-md-4 animus" data-animtype="fadeInRight"><?php echo $name; ?></div>
												<div class="image col-sm-6 col-md-2 animus" data-animtype="fadeInLeft"><img src="<?php echo $image[0]; ?>" alt=""></div>
											<?php
											} else { ?>
												<div class="position col-sm-12 col-md-4"></div>
												<div class="name col-sm-12 col-md-4 animus" data-animtype="fadeInRight"><?php echo $name; ?></div>
												<div class="image col-sm-12 col-md-2 animus" data-animtype="fadeInLeft"><img src="<?php echo $image[0]; ?>" alt=""></div>
											<?php } ?>
											</div>
											<hr class="my-1 animus zoomIn">
										<?php
										$i += 250;
										} // endwhile
									} // endif
								} // endwhile
								?>
								</section>
							<?php
							} // endif
							break;
					}
				} // endwhile 
			} // endif 
			?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( SHOW_SIDEBAR ) {
	get_sidebar();
}
get_footer();
