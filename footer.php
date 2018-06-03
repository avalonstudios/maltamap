<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Malta_Map_Society
 */

?>
	<div id="dykpopup" class="closed"></div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="copyright">
				<a href="<?php echo get_bloginfo( 'url' ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( '%s', 'maltamap' ), 'Copyright ' . date('Y') . ' ' . get_bloginfo( 'name' ) );
					?>
				</a>
			</div>
			<span class="sep"></span>
			<div class="designer">
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Website Design by %1$s.', 'maltamap' ), '<a title="Web Design Malta" href="https://avalonstudios.eu">Avalon Studios</a>' );
				?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php
$opacity = get_field( 'background_image_opacity', 'option' );
$opacity = $opacity / 100;

$bgCol = get_field( 'background_overlay_color', 'option' );
$bgOp = get_field( 'background_overlay_opacity', 'option' );
$bgOp = $bgOp / 100;
?>
<div class="ava-background-overlay" style="<?php if ( $bgCol ) { ?>background-color: <?php echo $bgCol; ?>;<?php } ?><?php if ( $bgOp ) { ?>opacity: <?php echo $bgOp; ?><?php } ?>"></div>
<div class="ava-background-image" style="<?php if ( $opacity ) { ?>opacity:<?php echo $opacity; ?>;<?php } ?>"></div>
</body>
</html>