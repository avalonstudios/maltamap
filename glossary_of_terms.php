<?php
/**
 * Template Name: Glossary
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Malta_Map_Society
 */
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php
			if ( have_rows( 'terms_rpt' ) ) { ?>
				<?php
				while ( have_rows( 'terms_rpt' ) ) { the_row(); ?>
					<?php
					$term = get_sub_field( 'term' );
					$definition = get_sub_field( 'definition' );
					$imageID = get_sub_field( 'image' );
					$image = wp_get_attachment_image_src( $imageID, 'medium' );
					$imageFull = wp_get_attachment_image_src( $imageID, 'full' );
					$imageSrcset = wp_get_attachment_image_srcset( $imageID );
					$imgCap = get_sub_field( 'image_caption' );
					$termID = preg_replace( "/[^a-zA-Z0-9]/i", '', $term );
					$termID = strtolower( $termID );
					?>
					<div id="<?php echo $termID; ?>" class="container-fluid h-100 glossary-terms">
						<div class="row justify-content-center h-100">
							<div class="card my-3">
								<div class="row o-gutters">
									<?php if ( $image[0] ) { ?>
										<div class="col-sm-12 col-md-4">
											<div class="image">
												<a href="<?php echo $imageFull[0]; ?>" data-rel="lightbox">
													<img src="<?php echo $image[0]; ?>" srcset="<?php echo $imageSrcset; ?>">
												</a>
												<?php if ( $imageCap ) { ?>
													<div class="col-12">
														<span class="image-caption"><?php echo $imageCap; ?></span>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
									<div class="col-sm-12 col-md-8">
										<div class="card-body">
											<h3 class="display-4"><?php echo $term; ?></h3>
											<div class="card-text"><?php echo $definition; ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				} ?>
			<?php
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( SHOW_SIDEBAR ) {
	get_sidebar();
}
get_footer();
