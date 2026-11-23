<?php
/**
 * The sidebar (shown when the Customizer layout is "Content with sidebar").
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'skeleton-blog' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
