<?php
/**
 * A single post.
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
					<?php
					$skeleton_blog_cats = get_the_category();
					if ( ! empty( $skeleton_blog_cats ) ) {
						echo '<p class="docs-header"><a href="' . esc_url( get_category_link( $skeleton_blog_cats[0] ) ) . '">' . esc_html( $skeleton_blog_cats[0]->name ) . '</a></p>';
					}
					the_title( '<h1 class="title">', '</h1>' );
					?>
					<p class="tagline">
						<?php
						$skeleton_blog_by = sprintf(
							/* translators: %s: author name. */
							esc_html__( 'By %s', 'skeleton-blog' ),
							esc_html( get_the_author() )
						);
						$skeleton_blog_minutes = skeleton_blog_reading_time();
						echo $skeleton_blog_by . ' &middot; ' . esc_html( get_the_date() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
						if ( skeleton_blog_get( 'show_reading_time', true ) ) {
							/* translators: %d: reading time in minutes. */
							echo ' &middot; ' . esc_html( sprintf( _n( '%d min read', '%d min read', $skeleton_blog_minutes, 'skeleton-blog' ), $skeleton_blog_minutes ) );
						}
						?>
					</p>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-hero"><?php the_post_thumbnail( 'skeleton-blog-hero' ); ?></div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: post title. */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'skeleton-blog' ),
								array( 'span' => array( 'class' => array() ) )
							),
							wp_kses_post( get_the_title() )
						)
					);
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skeleton-blog' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<footer class="entry-footer">
					<?php the_tags( '<p class="tags-links">' . esc_html__( 'Tagged: ', 'skeleton-blog' ), ', ', '</p>' ); ?>
					<?php edit_post_link( esc_html__( 'Edit', 'skeleton-blog' ), '<p class="edit-link">', '</p>' ); ?>
				</footer>

				<?php if ( skeleton_blog_get( 'show_author_box', true ) && get_the_author_meta( 'description' ) ) : ?>
					<div class="author-box">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 72 ); ?>
						<div>
							<h5><?php the_author(); ?></h5>
							<p><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
						</div>
					</div>
				<?php endif; ?>

				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( '&larr; Older', 'skeleton-blog' ) . '</span><span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Newer &rarr;', 'skeleton-blog' ) . '</span><span class="nav-title">%title</span>',
					)
				);
				?>
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
