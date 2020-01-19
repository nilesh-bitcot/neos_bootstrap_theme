<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neos_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
$sticky_nav = '';
$menu_class = '';
$nav_menu_theme = '';
if( get_option('nbt_set_nav_align') ){
	$options = get_option( 'nbt_set_nav_align' );
	if($options['nbt_nav_align_to'])
		$menu_class = $options['nbt_nav_align_to'];
	if($options['nbt_nav_theme']){
		$nav_menu_theme = $options['nbt_nav_theme'];
		$nav_menu_theme = 'navbar-'.$nav_menu_theme.' bg-'.$nav_menu_theme;
	}else if(empty($options['nbt_nav_theme'])){
		$nav_menu_theme = 'navbar-light bg-light';
	}
	if($options['nbt_nav_sticky'] == '1')
		$sticky_nav = 'sticky-top';
}

?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'neos_theme' ); ?></a>	
	<header id="masthead" class="site-header <?php echo $sticky_nav; ?>">
		<nav id="site-navigation" class="main-navigation navbar navbar-expand-md <?php echo $nav_menu_theme; ?>" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				
				<div class="site-branding navbar-brand">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$neos_theme_description = get_bloginfo( 'description', 'display' );
					if ( $neos_theme_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $neos_theme_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
			    
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#neos_theme_nav_div" aria-controls="neos_theme_nav_div" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				</button>
			    <?php
			    
			    wp_nav_menu( array(
					    'theme_location'  => 'menu-1',
					    'menu_id'        => 'primary-menu',
					    'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
					    'container'       => 'div',
					    'container_class' => 'collapse navbar-collapse',
					    'container_id'    => 'neos_theme_nav_div',
					    'menu_class'      => 'navbar-nav navbar-right '.$menu_class,
					    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					    'walker'          => new WP_Bootstrap_Navwalker(),
					) );
			    ?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="content" class="site-content container">
