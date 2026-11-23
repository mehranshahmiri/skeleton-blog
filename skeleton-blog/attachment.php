<?php
/**
 * An attachment page (image, file).
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
					<?php if ( $post->post_parent ) : ?>
						<p class="tagline">
							<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>">&larr; <?php echo esc_html( get_the_title( $post->post_parent ) ); ?></a>
						</p>
					<?php endif; ?>
				</header>

				<div class="entry-content">
					<?php
					if ( wp_attachment_is_image() ) {
						echo '<p class="attachment-image">' . wp_get_attachment_image( get_the_ID(), 'large' ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core function output.
						if ( has_excerpt() ) {
							echo '<p class="wp-caption-text">' . esc_html( get_the_excerpt() ) . '</p>';
						}
					} else {
						printf(
							'<p><a class="button button-primary" href="%s">%s</a></p>',
							esc_url( wp_get_attachment_url() ),
							esc_html__( 'Download the file', 'skeleton-blog' )
						);
					}
					the_content();
					?>
				</div>
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
