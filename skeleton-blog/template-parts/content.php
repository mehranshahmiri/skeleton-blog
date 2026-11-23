<?php
/**
 * A post in a list: thumbnail on the left, text on the right.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'docs-section post' ); ?>>
	<div class="container">
		<div class="row">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="five columns">
					<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
						<?php
						the_post_thumbnail(
							'skeleton-blog-card',
							array(
								'class'   => 'thumb',
								'loading' => 'lazy',
							)
						);
						?>
					</a>
				</div>
				<div class="seven columns">
			<?php else : ?>
				<div class="twelve columns">
			<?php endif; ?>
				<?php if ( 'post' === get_post_type() ) : ?>
					<?php skeleton_blog_meta_line(); ?>
				<?php endif; ?>
				<?php the_title( '<h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
				<?php the_excerpt(); ?>
				<a class="button" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'Read', 'skeleton-blog' ); ?>
					<span class="screen-reader-text"><?php echo esc_html( ' ' . get_the_title() ); ?></span>
				</a>
			</div>
		</div>
	</div>
</article>
