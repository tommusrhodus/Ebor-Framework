<?php

/**
 * The Shortcode
 */
function ebor_tabbed_media_player_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'              => '',
				'media_player_image' => '',
				'custom_css_class'   => '',
				'layout'             => 'html5',
				'mp4'                => '',
				'webm'               => ''
			), $atts 
		) 
	);
	
	global $ebor_tabbed_media_player_count;
	global $rand;
	$ebor_tabbed_media_player_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);

	$output .= '
		<div id="tabbed-media-player-'.$rand.'" class="tabs-wrapper filtered">
			<ul class="nav nav-tabs justify-content-center tabbed-filter-holder"></ul>
			<div class="space10"></div>
			<div class="tab-content">
            	'. do_shortcode($content) .'
           	</div>
        </div>';

	return $output;
}
add_shortcode( 'brailie_tabbed_media_player', 'ebor_tabbed_media_player_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabbed_media_player_content_shortcode( $atts, $content = null ) {
	global $ebor_tabbed_media_player_count;
	global $rand;
	global $ebor_tabbed_media_player_type;
	
	extract( 
		shortcode_atts( 
			array(
				'filter'              => '',
				'media_player_image' => '',
				'custom_css_class'   => '',
				'layout'             => 'html5',
				'mp4'                => '',
				'webm'               => ''
			), $atts
		) 
	);
	
	$ebor_tabbed_media_player_count++;

	$image_url = wp_get_attachment_url($media_player_image);
	$image = wp_get_attachment_image($media_player_image, 'full');

	$src[0] = '';
	
	if( 'html5' == $layout ){
		
		$src = wp_get_attachment_image_src($media_player_image, 'full');
		
		$output = '
			<div class="item col-lg-6" data-item-tab-filter-id="#'. (str_replace(' ', '-', strtolower($filter))) .'" data-item-tab-filter-name="#'. $filter .'">
				<div class="wpb_content_element">
					<video class="js-player" poster="'. $src[0] .'" controls>
						<source src="'. $mp4 .'" type="video/mp4">
						<source src="'. $webm .'" type="video/webm">
					</video>
				</div>
			</div>
		';
	
	} elseif( 'audio' == $layout ){
	
		$output = '
			<div class="item col-lg-6" data-item-tab-filter-id="#'. (str_replace(' ', '-', strtolower($filter))) .'" data-item-tab-filter-name="#'. $filter .'">
				<audio class="wpb_content_element js-player" controls>
					<source src="'. $mp4 .'" type="audio/mp3">
				</audio>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'brailie_tabbed_media_player_content', 'ebor_tabbed_media_player_content_shortcode' );

// Parent Element
function ebor_tabbed_media_player_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'                    => esc_html__( 'Tabbed Media Player' , 'brailie' ),
		    'base'                    => 'brailie_tabbed_media_player',
		    'as_parent'               => array('only' => 'brailie_tabbed_media_player_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabbed_media_player_shortcode_vc' );

// Nested Element
function ebor_tabbed_media_player_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'            => esc_html__('Tabbed Media Player Item', 'brailie'),
		    'base'            => 'brailie_tabbed_media_player_content',
		    'description'     => esc_html__( 'Add an image to your image gallery', 'brailie' ),
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_tabbed_media_player'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
				array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Filter", 'brailie'),
		    		"param_name" => "filter",
		    		'holder' => 'div'
		    	),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value" => array(
						'Local Video' => 'html5',
						'Local Audio' => 'audio'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Poster Image", 'brailie'),
					"param_name" => "media_player_image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__(".mp4 Video File URL / .mp3 Audio File URL", 'brailie'),
					"param_name" => "mp4"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__(".webm Video File URL", 'brailie'),
					"param_name" => "webm"
				),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabbed_media_player_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_tabbed_media_player extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_tabbed_media_player_content extends WPBakeryShortCode {}
}