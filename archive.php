<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Malta_Map_Society
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) { ?>
				<div class="card-deck my-3">
				<?php
				$i = 0;
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( 'template-parts/content', 'standard' ); ?>

					<?php $i++; ?>

					<?php
					if ( $i % 3 == 0 ) { ?>
						</div>
						<div class="card-deck">
					<?php
					} ?>

				<?php
				endwhile; ?>
				</div>
				<?php
				the_posts_navigation();
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
