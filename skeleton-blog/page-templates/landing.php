<?php
/**
 * Template Name: Landing page (no title, no comments)
 * Template Post Type: page
 *
 * A wide, clean canvas for block patterns: only the page content, no title, image, comments or sidebar.
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
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<?php edit_post_link( esc_html__( 'Edit', 'skeleton-blog' ), '<p class="edit-link">', '</p>' ); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
