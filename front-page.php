<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Malta_Map_Society
 */

get_header();
$GoT = get_field( 'glossary_of_terms_page', 'option' );
$GoT_pg = $GoT[0]->ID;
?>
	<div id="front-page-carousel"></div>
	<?php if ( have_rows( 'icons' ) ) : ?>
	<div class="front-page-icons card-group my-3">
		<?php while ( have_rows( 'icons' ) ) : the_row(); ?>
			<?php
			$iconID = get_sub_field( 'icon' );
			$title = get_sub_field( 'title' );
			$snippet = get_sub_field( 'snippet' );
			$page_link = get_sub_field( 'page_link' );
			$icon = wp_get_attachment_image_src( $iconID, 'thumbnail', true );
			?>
			<div class="card text-center mx-3">
				<div class="image card-img-top my-3"><img src="<?php echo $icon[0]; ?>" alt=""></div>
				<div class="card-body">
					<div class="title card-title">
						<h3><?php echo $title; ?></h3>
					</div>
					<?php if ( $snippet ) { ?>
						<div class="card-text">
							<?php echo $snippet; ?>
						</div>
					<?php } ?>
				</div>
				<?php if ( $page_link ) { ?>
					<div class="footer card-footer">
						<div class="card-link">
							<a class="btn" href="<?php echo $page_link; ?>">Read more...</a>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; ?>
	</div>
	<?php endif; ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main front-page-content">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
				<div class="container">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php maltamap_post_thumbnail(); ?>

						<div class="entry-content">
							<?php
							the_content( sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'maltamap' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							) );

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'maltamap' ),
								'after'  => '</div>',
							) );
							?>
						</div><!-- .entry-content -->

						<footer class="entry-footer">
							<?php maltamap_entry_footer(); ?>
						</footer><!-- .entry-footer -->
					</article><!-- #post-<?php the_ID(); ?> -->
				</div>
			<?php
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		<?php
		$rows = get_field( 'terms_rpt', $GoT_pg );
		$randomRow = $rows[ array_rand( $rows ) ];

		$term = $randomRow[ 'term' ];
		$definition = $randomRow[ 'definition' ];
		
		$image = $randomRow[ 'image' ];
		$image = wp_get_attachment_image_src( $image, 'medium' );
		
		$imageCap = $randomRow[ 'image_caption' ];
		$termID = preg_replace( "/[^a-zA-Z0-9]/i", '', $term );
		$termID = strtolower( $termID );
		if ( $rows ) { ?>
			<div id="<?php echo $termID; ?>" class="container-fluid h-100 ava-front-quote">
				<div class="row justify-content-center h-100">
					<div class="card my-3 animated fadeIn">
						<div class="row o-gutters">
							<?php if ( $image[0] ) { ?>
								<div class="col-sm-12 col-md-4">
									<div class="image"><img src="<?php echo $image[0]; ?>">
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
									<div class="card-text"><small class="text-muted">Learn something new...</small></div>
									<h3 class="display-4"><?php echo $term; ?></h3>
									<div class="card-text"><?php echo $definition; ?></div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<hr class="my-4">
							<a class="btn btn-lg" href="<?php echo get_page_link( $GoT_pg ), '#', $termID; ?>" role="button">Learn more</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
