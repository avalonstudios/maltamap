<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Malta_Map_Society
 */
?>
<div class="card">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="card-header">
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="card-img-top mb-3 pb-3 border-bottom"><?php maltamap_post_thumbnail(); ?></div>
				<?php } ?>
				<div class="card-title">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
				</div>
				<?php
				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						maltamap_posted_on();
					//	maltamap_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->


		<div class="card-body">
			<div class="card-text">
				<?php
				the_excerpt();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'maltamap' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
		</div>

		<footer class="text-muted">
			<div class="entry-footer mb-3">
			<?php maltamap_entry_footer(); ?>
			</div>
		</footer><!-- .entry-footer -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div>