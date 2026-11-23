<?php
/**
 * A static page.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container">
				<header class="header small">
					<?php the_title( '<h1 class="title">', '</h1>' ); ?>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-hero"><?php the_post_thumbnail( 'skeleton-blog-hero' ); ?></div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skeleton-blog' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>
				<?php edit_post_link( esc_html__( 'Edit', 'skeleton-blog' ), '<p class="edit-link">', '</p>' ); ?>
			</div>
		</article>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main>

<?php
get_footer();
