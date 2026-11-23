<?php
/**
 * Author archive: a short profile followed by the author's posts.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$skeleton_blog_author = get_queried_object();
?>

<main id="primary" class="site-main">
	<div class="container">
		<header class="header small author-header">
			<?php echo get_avatar( $skeleton_blog_author->ID, 96 ); ?>
			<h1 class="title"><?php echo esc_html( $skeleton_blog_author->display_name ); ?></h1>
			<?php if ( $skeleton_blog_author->description ) : ?>
				<p class="tagline"><?php echo esc_html( $skeleton_blog_author->description ); ?></p>
			<?php endif; ?>
			<p class="meta">
				<?php
				$skeleton_blog_count = (int) count_user_posts( $skeleton_blog_author->ID );
				/* translators: %s: number of posts. */
				echo esc_html( sprintf( _n( '%s post', '%s posts', $skeleton_blog_count, 'skeleton-blog' ), number_format_i18n( $skeleton_blog_count ) ) );
				?>
			</p>
		</header>
	</div>

	<?php if ( have_posts() ) : ?>
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
