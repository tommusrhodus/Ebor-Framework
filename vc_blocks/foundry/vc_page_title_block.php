<?php 

/**
 * The Shortcode
 */
function ebor_page_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'layout' => 'left-short-grey',
				'image' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$icon = ($icon) ? '<i class="'. esc_attr($icon) .'"></i>' : false;
	$image = ($image) ? wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) : false;
	
	if( 'left-short-light' == $layout ){
		$output = ebor_page_title( $title, false, $icon );	
	} elseif( 'left-short-grey' == $layout ){
		$output = ebor_page_title( $title, 'bg-secondary', $icon );	
	} elseif( 'left-short-dark' == $layout ){
		$output = ebor_page_title( $title, 'bg-dark', $icon );	
	} elseif( 'left-short-image' == $layout ) {
		$output = ebor_page_title( $title, 'image-bg overlay', $icon, $image );	
	} elseif( 'left-short-parallax' == $layout ) {
		$output = ebor_page_title( $title, 'image-bg overlay parallax', $icon, $image );	
	} elseif( 'left-large-light' == $layout ){
		$output = ebor_page_title_large( $title, $subtitle, false, $icon );	
	} elseif( 'left-large-grey' == $layout ){
		$output = ebor_page_title_large( $title, $subtitle, 'bg-secondary', $icon );	
	} elseif( 'left-large-dark' == $layout ){
		$output = ebor_page_title_large( $title, $subtitle, 'bg-dark', $icon );	
	} elseif( 'left-large-image' == $layout ){
		$output = ebor_page_title_large( $title, $subtitle, 'image-bg overlay', $icon, $image );	
	} elseif( 'left-large-parallax' == $layout ){
		$output = ebor_page_title_large( $title, $subtitle, 'image-bg overlay parallax', $icon, $image );	
	} elseif( 'center-short-light' == $layout ){
		$output = ebor_page_title_center( $title, false, $icon );	
	} elseif( 'center-short-grey' == $layout ){
		$output = ebor_page_title_center( $title, 'bg-secondary', $icon );	
	} elseif( 'center-short-dark' == $layout ){
		$output = ebor_page_title_center( $title, 'bg-dark', $icon );	
	} elseif( 'center-short-image' == $layout ) {
		$output = ebor_page_title_center( $title, 'image-bg overlay', $icon, $image );	
	} elseif( 'center-short-parallax' == $layout ) {
		$output = ebor_page_title_center( $title, 'image-bg overlay parallax', $icon, $image );	
	} elseif( 'center-large-light' == $layout ){
		$output = ebor_page_title_large_center( $title, $subtitle, false, $icon );	
	} elseif( 'center-large-grey' == $layout ){
		$output = ebor_page_title_large_center( $title, $subtitle, 'bg-secondary', $icon );	
	} elseif( 'center-large-dark' == $layout ){
		$output = ebor_page_title_large_center( $title, $subtitle, 'bg-dark', $icon );	
	} elseif( 'center-large-image' == $layout ){
		$output = ebor_page_title_large_center( $title, $subtitle, 'image-bg overlay', $icon, $image );	
	} elseif( 'center-large-parallax' == $layout ){
		$output = ebor_page_title_large_center( $title, $subtitle, 'image-bg overlay parallax', $icon, $image );	
	}
	
	return $output;
}
add_shortcode( 'foundry_page_title', 'ebor_page_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_page_title_shortcode_vc() {
	
	$title_layouts = ebor_get_page_title_options();
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Page Title", 'foundry'),
			"base" => "foundry_page_title",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'foundry'),
					"param_name" => "subtitle",
				),
				array(
					"type" => "attach_image",
					"heading" => __("Page Title Background Image", 'foundry'),
					"param_name" => "image"
				),
				array(
					"type" => "ebor_icons",
					"heading" => __("Click an Icon to choose", 'foundry'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Page Title Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => $title_layouts
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_page_title_shortcode_vc' );