<?php
/**
 * Search results.
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
		<div class="container">
			<header class="header small">
				<h1 class="title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search results for: %s', 'skeleton-blog' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
					?>
				</h1>
				<?php get_search_form(); ?>
			</header>
		</div>

		<div class="hero-spacer"></div>

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
					'prev_text' => esc_html__( '&larr; Previous', 'skeleton-blog' ),
					'next_text' => esc_html__( 'Next &rarr;', 'skeleton-blog' ),
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
