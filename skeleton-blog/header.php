<?php
/**
 * Header: navigation bar and, on the home page, the hero.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'skeleton-blog' ); ?></a>

<nav class="navbar" aria-label="<?php esc_attr_e( 'Primary', 'skeleton-blog' ); ?>">
	<div class="container navbar-inner">
		<?php skeleton_blog_branding(); ?>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'navbar-list',
				'depth'          => 2,
				'fallback_cb'    => 'skeleton_blog_fallback_menu',
			)
		);
		?>
	</div>
</nav>

<?php skeleton_blog_hero(); ?>

<div id="content" class="site-content">
<?php if ( skeleton_blog_has_sidebar() ) : ?>
<div class="container layout-wrap"><div class="layout-main">
<?php endif; ?>
