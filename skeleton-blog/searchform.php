<?php
/**
 * Search form.
 *
 * @package Skeleton_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$skeleton_blog_uid = wp_unique_id( 'search-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $skeleton_blog_uid ); ?>"><?php esc_html_e( 'Search for:', 'skeleton-blog' ); ?></label>
	<div class="row">
		<div class="eight columns">
			<input type="search" id="<?php echo esc_attr( $skeleton_blog_uid ); ?>" class="u-full-width" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'skeleton-blog' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
		</div>
		<div class="four columns">
			<input type="submit" class="button-primary u-full-width" value="<?php echo esc_attr_x( 'Search', 'submit button', 'skeleton-blog' ); ?>">
		</div>
	</div>
</form>
