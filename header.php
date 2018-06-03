<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Malta_Map_Society
 */

$showSidebar = get_field( 'show_sidebar' );
define( 'SHOW_SIDEBAR', $showSidebar );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( !empty( SHOW_SIDEBAR ) || is_single() || is_archive() ) {
	?><div id="page" class="site"><?php
} else {
	?><div id="page" class="site no-sidebar"><?php
} ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'maltamap' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigatio" class="main-navigatio navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<div class="row no-gutters">
						<div class="col-9">
							<div class="site-branding row no-gutters">
								<div class="col-6 col-md-4">
									<?php the_custom_logo(); ?>
								</div>
								<div class="col-6 col-md-8 site-title-wrapper">
									<?php
									if ( is_front_page() && is_home() ) :
										?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php
									else :
										?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
										<?php
									endif;
									$maltamap_description = get_bloginfo( 'description', 'display' );
									/*if ( $maltamap_description || is_customize_preview() ) :
										?>
										<p class="site-description"><?php echo $maltamap_description; // WPCS: xss ok. ?></p>
									<?php endif;*/ ?>
								</div>
							</div><!-- .site-branding -->
						</div>
						<div class="col-3">
							<button class='btn navbar-btn btn-link pull-right' data-target='#modalNavigation' data-toggle='modal' type='button'>
								<span class='sr-only'>Open navigation</span>
								<i class="fas fa-bars"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</nav><!-- #site-navigation -->
		<div class="modal fade modal-fullscreen-menu" id="modalNavigation" role="dialog" tabindex="-1">
			<button class="close" type="button" aria-label="Close" data-dismiss="modal">
				<span class="sr-only">Close navigation</span>
				<span>Close &times;</span>
			</button>
			<div class="modal-dialog">
				<?php
				wp_nav_menu( array(
					'theme_location'	=> 'menu-1',
					'menu_id'			=> 'primary-menu',
					'menu_class'		=> 'navbar-nav',
					'container'			=> 'nav',
				) );
				?>
			</div>
		</div>
		

	</header><!-- #masthead -->
	<div id="content" class="site-content">