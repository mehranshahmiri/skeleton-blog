<?php
/**
 * Front page. With "Your latest posts" it behaves like the blog home; with a static page it shows the hero,
 * the page content and the three latest posts.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'posts' === get_option( 'show_on_front' ) ) {
	include get_home_template();
	return;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		if ( '' !== trim( get_the_content() ) ) :
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="container">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php edit_post_link( esc_html__( 'Edit', 'skeleton-blog' ), '<p class="edit-link">', '</p>' ); ?>
				</div>
			</article>
			<?php
		endif;
	endwhile;

	$skeleton_blog_latest = new WP_Query(
		array(
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( $skeleton_blog_latest->have_posts() ) :
		?>
		<section class="front-latest">
			<div class="container"><h2 class="docs-header"><?php esc_html_e( 'Latest posts', 'skeleton-blog' ); ?></h2></div>
			<?php
			while ( $skeleton_blog_latest->have_posts() ) :
				$skeleton_blog_latest->the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			wp_reset_postdata();
			$skeleton_blog_posts_page = (int) get_option( 'page_for_posts' );
			if ( $skeleton_blog_posts_page ) :
				?>
				<div class="container front-more">
					<a class="button" href="<?php echo esc_url( get_permalink( $skeleton_blog_posts_page ) ); ?>"><?php esc_html_e( 'All posts', 'skeleton-blog' ); ?></a>
				</div>
			<?php endif; ?>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();
