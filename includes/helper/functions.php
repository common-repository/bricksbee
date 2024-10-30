<?php
/**
 * Call a shortcode function by tag name.
 *
 * @since  1.0.0
 */
function bb_do_shortcode($tag, array $atts = [], $content = null) {
	global $shortcode_tags;
	if (!isset($shortcode_tags[$tag])) {
		return false;
	}
	return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
}

/**
 * Sanitize html class string
 *
 * @since  1.0.0
 */
function bb_sanitize_html_class($class) {
	$classes   = !empty($class) ? explode(' ', $class) : [];
	$sanitized = [];
	if (!empty($classes)) {
		$sanitized = array_map(function ($cls) {
			return sanitize_html_class($cls);
		}, $classes);
	}
	return implode(' ', $sanitized);
}

/**
 * Allow HTML
 *
 * @since  1.0.0
 */
function bb_allowed_html() {

	$allowed_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'abbr' => array(
			'title' => array(),
		),
		'b' => array(),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'i' => array(),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'ul' => array(
			'class' => array(),
		),
	);
	
	return $allowed_tags;
}

/**
 * Safe style css
 *
 * @since  1.0.0
 */
add_filter( 'safe_style_css', function( $styles ) {
    $styles[] = 'display';
    $styles[] = 'right';
    $styles[] = 'left';
    $styles[] = 'top';
    $styles[] = 'bottom';
    return $styles;
} );