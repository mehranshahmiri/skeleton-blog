<?php
/**
 * Shown when there is nothing to list.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="container no-results">
	<div class="header small">
		<h1 class="title"><?php esc_html_e( 'Nothing found', 'skeleton-blog' ); ?></h1>
		<?php if ( is_search() ) : ?>
			<p class="tagline"><?php esc_html_e( 'Nothing matched your search. Try different words.', 'skeleton-blog' ); ?></p>
		<?php elseif ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p class="tagline">
				<?php
				printf(
					wp_kses(
						/* translators: %s: link to new post screen. */
						__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'skeleton-blog' ),
						array( 'a' => array( 'href' => array() ) )
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php else : ?>
			<p class="tagline"><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'skeleton-blog' ); ?></p>
		<?php endif; ?>
		<?php get_search_form(); ?>
	</div>
</section>
