<?php
/**
 * Comments and the comment form.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area docs-section">
	<div class="container">
		<?php if ( have_comments() ) : ?>
			<h2 class="docs-header">
				<?php
				$skeleton_blog_count = get_comments_number();
				printf(
					/* translators: 1: comment count, 2: post title. */
					esc_html( _n( '%1$s comment on "%2$s"', '%1$s comments on "%2$s"', $skeleton_blog_count, 'skeleton-blog' ) ),
					esc_html( number_format_i18n( $skeleton_blog_count ) ),
					esc_html( get_the_title() )
				);
				?>
			</h2>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 48,
					)
				);
				?>
			</ol>

			<?php the_comments_navigation(); ?>

			<?php if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'skeleton-blog' ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php comment_form(); ?>
	</div>
</section>
