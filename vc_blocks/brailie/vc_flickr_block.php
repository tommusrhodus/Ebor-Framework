<?php 

/**
 * The Shortcode
 */
function ebor_flickr_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'token'  => '51789731@N07',
				'count'  => '10',
				'layout' => 'standard',
				'custom_css_class' => ''
			), $atts 
		) 
	);
		
	if( 'standard' == $layout ){
	
		$output = '
			<div class="tiles tiles-s '. esc_attr( $custom_css_class ).'">
				<div id="flickrfeed" class="items row" data-count="'. $count .'" data-id="'. $token .'"></div>
			</div>
		';
	
	} elseif( 'row' == $layout ){
	
		$output = '
			<div class="tiles tiles-s '. esc_attr( $custom_css_class ).'">
				<div id="flickrfeed2" class="items row" data-count="'. $count .'" data-id="'. $token .'"></div>
			</div>
		';
	
	} elseif( 'carousel' == $layout ){
		
		$output = '
			<div class="swiper-container-wrapper '. esc_attr( $custom_css_class ).'" data-aos="fade">
				<div class="swiper-container swiper-flickr">
					<div id="flickrfeed3" class="swiper-wrapper" data-count="'. $count .'" data-id="'. $token .'"></div>
				</div>
				<div class="swiper-pagination gap-large swiper-flickr-pagination"></div>
			</div>
		';
		
	} elseif( 'widget' == $layout ){
	
		$output = '
			<div class="tiles tiles-s '. esc_attr( $custom_css_class ).'">
				<div id="flickrfeed4" class="items row" data-count="'. $count .'" data-id="'. $token .'"></div>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'brailie_flickr_block', 'ebor_flickr_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_flickr_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Flickr Feed", 'brailie'),
			"base" => "brailie_flickr_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'A swiper of flickr images.',
			"params" => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value"      => array(
						'Standard (5 Items to Row)' => 'standard',
						'Row (6 Items to Row)'      => 'row',
						'Carousel'                  => 'carousel',
						'Widget (3 Items to Row)'   => 'widget'  
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Flickr ID", 'brailie'),
					"param_name" => "token",
					'value'      => '51789731@N07',
					'description' => '<code>IMPORTANT NOTE:</code> This is the Flickr block, it will grab your latest Flickr images. For this to work, the block requires you enter a numeric ID in the correct field. Please grab your numeric Flickr ID from here: <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a>'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Count", 'brailie'),
					"param_name" => "count",
					'value' => '10'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_flickr_block_shortcode_vc' );