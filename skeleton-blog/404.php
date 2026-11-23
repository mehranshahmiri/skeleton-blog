<?php
/**
 * 404 page.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<section class="container error-404 not-found">
		<div class="header small">
			<p class="big" aria-hidden="true">404</p>
			<h1 class="title"><?php esc_html_e( 'That page cannot be found', 'skeleton-blog' ); ?></h1>
			<p class="tagline"><?php esc_html_e( 'It may have moved or never existed. Try a search, or head back home.', 'skeleton-blog' ); ?></p>
			<?php get_search_form(); ?>
			<p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the blog', 'skeleton-blog' ); ?></a></p>
		</div>
	</section>
</main>

<?php
get_footer();
