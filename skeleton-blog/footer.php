<?php
/**
 * Footer.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( skeleton_blog_has_sidebar() ) : ?>
</div><!-- .layout-main -->
	<?php get_sidebar(); ?>
</div><!-- .layout-wrap -->
<?php endif; ?>
</div><!-- #content -->

<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<aside class="footer-widgets" aria-label="<?php esc_attr_e( 'Footer', 'skeleton-blog' ); ?>">
		<div class="container">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	</aside>
<?php endif; ?>

<footer class="site-footer">
	<div class="container">
		<?php
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-menu',
					'depth'          => 1,
				)
			);
		}
		if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'container'      => false,
					'menu_class'     => 'footer-menu social-menu',
					'depth'          => 1,
				)
			);
		}
		?>
		<p class="footer-text"><?php skeleton_blog_footer_text(); ?></p>
		<?php if ( skeleton_blog_get( 'show_credit', true ) ) : ?>
			<p>
				<?php
				printf(
					/* translators: 1: theme name, 2: author name, 3: link to Skeleton (getskeleton.com). */
					esc_html__( '%1$s theme by %2$s, free and open source. Built on %3$s by Dave Gamache.', 'skeleton-blog' ),
					'<strong>Skeleton Blog</strong>',
					'Mehran Shahmiri',
					'<a href="' . esc_url( 'http://getskeleton.com/' ) . '" rel="noopener">Skeleton</a>'
				);
				?>
			</p>
		<?php endif; ?>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
