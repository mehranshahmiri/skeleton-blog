<?php
/**
 * Skeleton Blog functions and definitions.
 *
 * @package Skeleton_Blog
 * @author  Mehran Shahmiri
 * @license GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SKELETON_BLOG_VERSION', '1.1.0' );

/**
 * Theme setup.
 */
function skeleton_blog_setup() {
	load_theme_textdomain( 'skeleton-blog', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);
	add_theme_support(
		'custom-header',
		array(
			'width'       => 1600,
			'height'      => 560,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => false,
		)
	);
	add_theme_support(
		'post-formats',
		array( 'aside', 'gallery', 'image', 'quote', 'link', 'status', 'video', 'audio', 'chat' )
	);
	add_theme_support( 'starter-content', skeleton_blog_starter_content() );

	add_image_size( 'skeleton-blog-card', 640, 420, true );
	add_image_size( 'skeleton-blog-hero', 1600, 800, true );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary menu', 'skeleton-blog' ),
			'footer'  => esc_html__( 'Footer menu', 'skeleton-blog' ),
			'social'  => esc_html__( 'Social links menu', 'skeleton-blog' ),
		)
	);
}
add_action( 'after_setup_theme', 'skeleton_blog_setup' );

/**
 * Content width for embeds and images.
 */
function skeleton_blog_content_width() {
	$GLOBALS['content_width'] = 800;
}
add_action( 'after_setup_theme', 'skeleton_blog_content_width', 0 );

/**
 * Widget areas.
 */
function skeleton_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'skeleton-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Shown beside the content when the layout is set to "Content with sidebar" in the Customizer.', 'skeleton-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer widgets', 'skeleton-blog' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Appears above the footer. Widgets sit in a row on wide screens.', 'skeleton-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'skeleton_blog_widgets_init' );

/**
 * Styles and scripts. The theme loads no external resources.
 */
function skeleton_blog_scripts() {
	$uri = get_template_directory_uri();
	$ver = SKELETON_BLOG_VERSION;

	wp_enqueue_style( 'skeleton-blog-normalize', $uri . '/css/normalize.css', array(), $ver );
	wp_enqueue_style( 'skeleton-blog-skeleton', $uri . '/css/skeleton.css', array( 'skeleton-blog-normalize' ), $ver );
	wp_enqueue_style( 'skeleton-blog-style', get_stylesheet_uri(), array( 'skeleton-blog-skeleton' ), $ver );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skeleton_blog_scripts' );

/**
 * Navigation markup: add Skeleton-style classes to primary menu items.
 *
 * @param string[] $classes Item classes.
 * @param WP_Post  $item    Menu item.
 * @param stdClass $args    Menu args.
 * @return string[]
 */
function skeleton_blog_nav_item_class( $classes, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$classes[] = 'navbar-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'skeleton_blog_nav_item_class', 10, 3 );

/**
 * Add navbar-link class to primary menu links.
 *
 * @param array    $atts Link attributes.
 * @param WP_Post  $item Menu item.
 * @param stdClass $args Menu args.
 * @return array
 */
function skeleton_blog_nav_link_atts( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$atts['class'] = 'navbar-link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'skeleton_blog_nav_link_atts', 10, 3 );

/**
 * Fallback menu when no primary menu is assigned.
 */
function skeleton_blog_fallback_menu() {
	echo '<ul class="navbar-list">';
	printf(
		'<li class="navbar-item"><a class="navbar-link" href="%s">%s</a></li>',
		esc_url( home_url( '/' ) ),
		esc_html__( 'Home', 'skeleton-blog' )
	);
	$pages = get_pages(
		array(
			'sort_column' => 'menu_order,post_title',
			'number'      => 6,
		)
	);
	foreach ( $pages as $page ) {
		printf(
			'<li class="navbar-item"><a class="navbar-link" href="%s">%s</a></li>',
			esc_url( get_permalink( $page ) ),
			esc_html( get_the_title( $page ) )
		);
	}
	echo '</ul>';
}

/**
 * Excerpts.
 */
/**
 * Excerpt length in words.
 *
 * @return int
 */
function skeleton_blog_excerpt_length() {
	return 32;
}
add_filter( 'excerpt_length', 'skeleton_blog_excerpt_length' );

/**
 * Excerpt ellipsis.
 *
 * @return string
 */
function skeleton_blog_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'skeleton_blog_excerpt_more' );

/**
 * Comment form defaults: Skeleton button class.
 *
 * @param array $defaults Defaults.
 * @return array
 */
function skeleton_blog_comment_form_defaults( $defaults ) {
	$defaults['class_submit']  = 'button-primary';
	$defaults['title_reply']   = esc_html__( 'Leave a comment', 'skeleton-blog' );
	$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'skeleton-blog' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required></textarea></p>';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'skeleton_blog_comment_form_defaults' );

/**
 * Theme helpers.
 */

/**
 * Read a theme mod with a default.
 *
 * @param string $key     Setting key without prefix.
 * @param mixed  $fallback Default value.
 * @return mixed
 */
function skeleton_blog_get( $key, $fallback = '' ) {
	return get_theme_mod( 'skeleton_blog_' . $key, $fallback );
}

/**
 * Estimated reading time in minutes.
 *
 * @param int|WP_Post|null $post Post.
 * @return int
 */
function skeleton_blog_reading_time( $post = null ) {
	$content = get_post_field( 'post_content', $post );
	$words   = str_word_count( wp_strip_all_tags( strip_shortcodes( $content ) ) );
	return max( 1, (int) ceil( $words / 220 ) );
}

/**
 * Print the meta line: date, reading time, first category.
 */
function skeleton_blog_meta_line() {
	$parts   = array();
	$parts[] = sprintf(
		'<time datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);
	if ( skeleton_blog_get( 'show_reading_time', true ) ) {
		$minutes = skeleton_blog_reading_time();
		/* translators: %d: reading time in minutes. */
		$parts[] = esc_html( sprintf( _n( '%d min read', '%d min read', $minutes, 'skeleton-blog' ), $minutes ) );
	}
	$cats = get_the_category();
	if ( ! empty( $cats ) ) {
		$parts[] = esc_html( $cats[0]->name );
	}
	echo '<p class="meta">' . implode( ' &middot; ', $parts ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- each part escaped above.
}

/**
 * Whether the hero shows on this request.
 *
 * @return bool
 */
function skeleton_blog_show_hero() {
	return is_front_page() && ! is_paged() && skeleton_blog_get( 'show_hero', true );
}

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function skeleton_blog_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'skeleton_blog_options',
		array(
			'title'    => esc_html__( 'Skeleton Blog', 'skeleton-blog' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_show_hero',
		array(
			'default'           => true,
			'sanitize_callback' => 'skeleton_blog_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_show_hero',
		array(
			'label'   => esc_html__( 'Show the hero on the home page', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_hero_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_hero_text',
		array(
			'label'       => esc_html__( 'Hero text', 'skeleton-blog' ),
			'description' => esc_html__( 'Leave empty to use the site tagline.', 'skeleton-blog' ),
			'section'     => 'skeleton_blog_options',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_hero_button_label',
		array(
			'default'           => esc_html__( 'Read the latest', 'skeleton-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_hero_button_label',
		array(
			'label'   => esc_html__( 'Hero button label (empty hides it)', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_hero_button_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_hero_button_url',
		array(
			'label'       => esc_html__( 'Hero button link', 'skeleton-blog' ),
			'description' => esc_html__( 'Leave empty to link to the latest post.', 'skeleton-blog' ),
			'section'     => 'skeleton_blog_options',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_show_reading_time',
		array(
			'default'           => true,
			'sanitize_callback' => 'skeleton_blog_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_show_reading_time',
		array(
			'label'   => esc_html__( 'Show reading time', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_show_author_box',
		array(
			'default'           => true,
			'sanitize_callback' => 'skeleton_blog_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_show_author_box',
		array(
			'label'   => esc_html__( 'Show the author box under posts', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_footer_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_footer_text',
		array(
			'label'   => esc_html__( 'Footer text', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_layout',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'skeleton_blog_sanitize_layout',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_layout',
		array(
			'label'   => esc_html__( 'Layout', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'radio',
			'choices' => array(
				'none'  => esc_html__( 'Single column', 'skeleton-blog' ),
				'right' => esc_html__( 'Content with sidebar', 'skeleton-blog' ),
			),
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_color_scheme',
		array(
			'default'           => 'light',
			'sanitize_callback' => 'skeleton_blog_sanitize_scheme',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_color_scheme',
		array(
			'label'   => esc_html__( 'Colour scheme', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'radio',
			'choices' => array(
				'light' => esc_html__( 'Light', 'skeleton-blog' ),
				'dark'  => esc_html__( 'Dark', 'skeleton-blog' ),
				'auto'  => esc_html__( 'Follow the visitor\'s device', 'skeleton-blog' ),
			),
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_accent',
		array(
			'default'           => '#33C3F0',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'skeleton_blog_accent',
			array(
				'label'   => esc_html__( 'Accent colour', 'skeleton-blog' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'skeleton_blog_show_credit',
		array(
			'default'           => true,
			'sanitize_callback' => 'skeleton_blog_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'skeleton_blog_show_credit',
		array(
			'label'   => esc_html__( 'Show the theme credit in the footer', 'skeleton-blog' ),
			'section' => 'skeleton_blog_options',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'skeleton_blog_customize_register' );

/**
 * Sanitize a checkbox.
 *
 * @param mixed $value Value.
 * @return bool
 */
function skeleton_blog_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Sanitize the layout choice.
 *
 * @param string $value Value.
 * @return string
 */
function skeleton_blog_sanitize_layout( $value ) {
	return in_array( $value, array( 'none', 'right' ), true ) ? $value : 'none';
}

/**
 * Sanitize the colour scheme choice.
 *
 * @param string $value Value.
 * @return string
 */
function skeleton_blog_sanitize_scheme( $value ) {
	return in_array( $value, array( 'light', 'dark', 'auto' ), true ) ? $value : 'light';
}

/**
 * Live (no-JavaScript) previews in the Customizer through selective refresh.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function skeleton_blog_customize_partials( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'            => '.site-branding',
			'render_callback'     => 'skeleton_blog_branding',
			'container_inclusive' => true,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'skeleton_blog_hero',
		array(
			'selector'            => '.hero-region',
			'settings'            => array( 'blogname', 'blogdescription', 'skeleton_blog_hero_text', 'skeleton_blog_hero_button_label', 'skeleton_blog_hero_button_url', 'skeleton_blog_show_hero' ),
			'render_callback'     => 'skeleton_blog_hero',
			'container_inclusive' => true,
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'skeleton_blog_footer_text',
		array(
			'selector'        => '.footer-text',
			'settings'        => array( 'skeleton_blog_footer_text' ),
			'render_callback' => 'skeleton_blog_footer_text',
		)
	);
}
add_action( 'customize_register', 'skeleton_blog_customize_partials', 20 );

/**
 * Site branding: custom logo or site name.
 */
function skeleton_blog_branding() {
	echo '<div class="site-branding">';
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		printf( '<a href="%s" rel="home">%s</a>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
	}
	echo '</div>';
}

/**
 * The home page hero (title, tagline, button, optional header image).
 */
function skeleton_blog_hero() {
	echo '<div class="hero-region">';
	if ( skeleton_blog_show_hero() ) {
		$hero_text = skeleton_blog_get( 'hero_text', '' );
		if ( '' === $hero_text ) {
			$hero_text = get_bloginfo( 'description' );
		}
		$btn_label = skeleton_blog_get( 'hero_button_label', __( 'Read the latest', 'skeleton-blog' ) );
		$btn_url   = skeleton_blog_get( 'hero_button_url', '' );
		if ( '' === $btn_url ) {
			$latest  = get_posts(
				array(
					'numberposts' => 1,
					'post_status' => 'publish',
				)
			);
			$btn_url = $latest ? get_permalink( $latest[0] ) : '';
		}
		if ( has_header_image() ) {
			echo '<div class="header-image">';
			the_header_image_tag();
			echo '</div>';
		}
		echo '<header class="container"><section class="header"><h1 class="title">' . esc_html( get_bloginfo( 'name' ) ) . '</h1>';
		if ( '' !== $hero_text ) {
			echo '<p class="tagline">' . esc_html( $hero_text ) . '</p>';
		}
		if ( '' !== $btn_label && '' !== $btn_url ) {
			echo '<a class="button button-primary" href="' . esc_url( $btn_url ) . '">' . esc_html( $btn_label ) . '</a>';
		}
		echo '</section><div class="hero-spacer"></div></header>';
	}
	echo '</div>';
}

/**
 * Footer text (or the default copyright line).
 */
function skeleton_blog_footer_text() {
	$footer_text = skeleton_blog_get( 'footer_text', '' );
	if ( '' !== $footer_text ) {
		echo wp_kses_post( $footer_text );
	} else {
		/* translators: 1: year, 2: site name. */
		printf( esc_html__( '&copy; %1$s %2$s.', 'skeleton-blog' ), esc_html( gmdate( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) );
	}
}

/**
 * Should the sidebar show on this request?
 *
 * @return bool
 */
function skeleton_blog_has_sidebar() {
	if ( 'right' !== skeleton_blog_get( 'layout', 'none' ) || ! is_active_sidebar( 'sidebar-1' ) ) {
		return false;
	}
	if ( is_404() || is_page_template( array( 'page-templates/full-width.php', 'page-templates/landing.php' ) ) ) {
		return false;
	}
	return true;
}

/**
 * Body classes: colour scheme, layout.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function skeleton_blog_body_class( $classes ) {
	$classes[] = 'scheme-' . skeleton_blog_get( 'color_scheme', 'light' );
	$classes[] = skeleton_blog_has_sidebar() ? 'has-sidebar' : 'no-sidebar';
	return $classes;
}
add_filter( 'body_class', 'skeleton_blog_body_class' );

/**
 * Darken a hex colour by a percentage.
 *
 * @param string $hex     Colour like #33C3F0.
 * @param float  $percent 0-100.
 * @return string
 */
function skeleton_blog_darken( $hex, $percent ) {
	$hex = ltrim( $hex, '#' );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$out = '#';
	foreach ( str_split( $hex, 2 ) as $part ) {
		$out .= str_pad( dechex( (int) round( hexdec( $part ) * ( 1 - $percent / 100 ) ) ), 2, '0', STR_PAD_LEFT );
	}
	return $out;
}

/**
 * WCAG relative luminance of a hex colour.
 *
 * @param string $hex Colour.
 * @return float
 */
function skeleton_blog_luminance( $hex ) {
	$hex = ltrim( $hex, '#' );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$channels = array();
	foreach ( str_split( $hex, 2 ) as $part ) {
		$value      = hexdec( $part ) / 255;
		$channels[] = $value <= 0.03928 ? $value / 12.92 : pow( ( $value + 0.055 ) / 1.055, 2.4 );
	}
	return 0.2126 * $channels[0] + 0.7152 * $channels[1] + 0.0722 * $channels[2];
}

/**
 * WCAG contrast ratio between two hex colours.
 *
 * @param string $a Colour.
 * @param string $b Colour.
 * @return float
 */
function skeleton_blog_contrast( $a, $b ) {
	$la = skeleton_blog_luminance( $a );
	$lb = skeleton_blog_luminance( $b );
	return ( max( $la, $lb ) + 0.05 ) / ( min( $la, $lb ) + 0.05 );
}

/**
 * Pick white or near-black text, whichever reads better on the given background.
 *
 * @param string $hex Colour.
 * @return string
 */
function skeleton_blog_on_color( $hex ) {
	return skeleton_blog_contrast( $hex, '#ffffff' ) >= skeleton_blog_contrast( $hex, '#111111' ) ? '#ffffff' : '#111111';
}

/**
 * Darken a colour until it reaches AA contrast (4.5:1) on white, for link text.
 *
 * @param string $hex Accent colour.
 * @return string
 */
function skeleton_blog_link_color( $hex ) {
	for ( $i = 0; $i < 40 && skeleton_blog_contrast( $hex, '#ffffff' ) < 4.5; $i++ ) {
		$hex = skeleton_blog_darken( $hex, 4 );
	}
	return $hex;
}

/**
 * Print the accent colour (and custom background) as CSS variables.
 */
function skeleton_blog_dynamic_css() {
	$accent = sanitize_hex_color( skeleton_blog_get( 'accent', '#33C3F0' ) );
	$css    = '';
	if ( $accent && '#33c3f0' !== strtolower( $accent ) ) {
		$link  = skeleton_blog_link_color( $accent );
		$css  .= ':root{--sb-accent:' . $accent . ';--sb-accent-dark:' . skeleton_blog_darken( $accent, 12 ) . ';--sb-on-accent:' . skeleton_blog_on_color( $accent ) . ';--sb-link:' . $link . ';--sb-link-hover:' . skeleton_blog_darken( $link, 18 ) . '}';
	}
	$bg = get_background_color();
	if ( $bg && 'ffffff' !== strtolower( $bg ) && 'light' === skeleton_blog_get( 'color_scheme', 'light' ) ) {
		$css .= 'body{--sb-bg:#' . sanitize_hex_color_no_hash( $bg ) . '}';
	}
	if ( '' !== $css ) {
		echo '<style id="skeleton-blog-colors">' . $css . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- values sanitized above.
	}
}
add_action( 'wp_head', 'skeleton_blog_dynamic_css', 20 );

/**
 * Starter content for a fresh install (shown in the Customizer preview).
 *
 * @return array
 */
function skeleton_blog_starter_content() {
	return array(
		'widgets'   => array(
			'footer-1'  => array( 'search', 'recent-posts' ),
			'sidebar-1' => array( 'search', 'recent-posts', 'categories' ),
		),
		'posts'     => array(
			'home',
			'about',
			'contact',
			'blog',
		),
		'options'   => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		'nav_menus' => array(
			'primary' => array(
				'name'  => esc_html__( 'Primary menu', 'skeleton-blog' ),
				'items' => array( 'page_home', 'page_about', 'page_blog', 'page_contact' ),
			),
			'footer'  => array(
				'name'  => esc_html__( 'Footer menu', 'skeleton-blog' ),
				'items' => array( 'page_about', 'page_contact' ),
			),
			'social'  => array(
				'name'  => esc_html__( 'Social links menu', 'skeleton-blog' ),
				'items' => array( 'link_facebook', 'link_twitter', 'link_instagram', 'link_email' ),
			),
		),
	);
}
