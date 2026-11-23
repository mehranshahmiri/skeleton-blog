<?php
/**
 * Main template: the post list (blog home, and the fallback for everything).
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>

		<?php if ( skeleton_blog_show_hero() ) : ?>
			<div class="container"><h2 class="docs-header"><?php esc_html_e( 'Latest posts', 'skeleton-blog' ); ?></h2></div>
		<?php elseif ( is_home() && ! is_front_page() ) : ?>
			<div class="container">
				<header class="header small"><h1 class="title"><?php single_post_title(); ?></h1></header>
			</div>
			<div class="hero-spacer"></div>
		<?php endif; ?>

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;
		?>

		<div class="container">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => esc_html__( '&larr; Newer', 'skeleton-blog' ),
					'next_text' => esc_html__( 'Older &rarr;', 'skeleton-blog' ),
				)
			);
			?>
		</div>

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</main>

<?php
get_footer();
