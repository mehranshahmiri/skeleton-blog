<?php
/**
 * Title: Call to action band
 * Slug: skeleton-blog/call-to-action-band
 * Categories: call-to-action
 * Keywords: newsletter, subscribe, cta
 *
 * @package Skeleton_Blog
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}},"border":{"top":{"color":"#eeeeee","width":"1px"},"bottom":{"color":"#eeeeee","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:#eeeeee;border-top-width:1px;border-bottom-color:#eeeeee;border-bottom-width:1px;padding-top:4rem;padding-bottom:4rem"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Stay in the loop', 'skeleton-blog' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'skeleton-blog' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Subscribe', 'skeleton-blog' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
