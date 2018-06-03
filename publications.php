<?php
/**
 * Template Name: Publications
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Malta_Map_Society
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="publications-content">
			<?php
			if ( have_rows( 'publications_flx' ) ) {
				while ( have_rows( 'publications_flx' ) ) { the_row();
					$i = 250;
					$layouts = get_row_layout();
					switch ( $layouts ) {
						case 'publications_lyt':
							if ( have_rows( 'publications_rpt' ) ) { ?>
								<section class="publication-section my-4">
								<?php
								while ( have_rows( 'publications_rpt' ) ) { the_row();
									$publicationSectionTitle = get_sub_field( 'publication_section_title' ); ?>
									<div class="publication-type-title p-3 row animus" data-animtype="fadeIn"><?php echo $publicationSectionTitle; ?></div>
									<?php
									if ( have_rows( 'publication_rpt' ) ) {
										while ( have_rows( 'publication_rpt' ) ) { the_row();
											$date = get_sub_field( 'date' );
											$description = get_sub_field( 'description' );
											$imageID = get_sub_field( 'image' );
											$image = wp_get_attachment_image_src( $imageID, 'thumbnail' );

											// Random Icons
											$iconsRep = get_field( 'map_icons_rpt', 'option' );
											$randomRow = $iconsRep[ array_rand( $iconsRep ) ];

											$icon = $randomRow[ 'icon' ];
											$icon = wp_get_attachment_image_src( $icon );
											?>
											<div class="card my-3 row animus" data-animtype="fadeIn">
											<?php
											if ( $date ) { ?>
												<div class="card-header">
													<strong class="date animus" data-animtype="fadeInRight"><?php echo $date; ?></strong>
													<?php if ( $icon[0] ) { ?>
													<img class="icon float-right animus" data-animtype="fadeInLeft" width="25" src="<?php echo $icon[0]; ?>" alt="">
													<?php } ?>
												</div>
											<?php
											} ?>
												<div class="card-body row">
													<div class="description col-sm-12 col-md-8 animus" data-animtype="fadeIn"><?php echo $description; ?></div>
													<div class="image col-sm-12 col-md-4 animus" data-animtype="fadeIn"><img src="<?php echo $image[0]; ?>" alt=""></div>
												</div>
											</div>
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
