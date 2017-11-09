<?php 

/**
 * The Shortcode
 */
function ebor_image_tile_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'subtitle' => '',
				'url' => '',
				'layout' => 'default'
			), $atts 
		) 
	);
	
	if( 'default' == $layout ){
		
		$output = '
			<div class="masonry-item project">
			    <div class="image-tile inner-title text-center">
			        <a href="'. esc_url($url) .'">
			            '. wp_get_attachment_image( $image, 'grid' ) .'
			            <div class="title">
			                <h5 class="uppercase mb0">'. htmlspecialchars_decode($title) .'</h5>
			                <span>'. htmlspecialchars_decode($subtitle) .'</span>
			            </div>
			        </a>
			    </div>
			</div>
		';
		
	} else {
		
		$output = '
			<div class="image-tile inner-title title-center text-center">
			    <a href="'. esc_url($url) .'">
			         '. wp_get_attachment_image( $image, 'full' ) .'
			        <div class="title">
			        	<h4 class="uppercase mb0">'. htmlspecialchars_decode($title) .'</h4>
			        </div>
			    </a>
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'foundry_image_tile', 'ebor_image_tile_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_tile_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Image Tile", 'foundry'),
			"base" => "foundry_image_tile",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Block Image", 'foundry'),
					"param_name" => "image"
				),
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
					'holder' => 'div',
					'description' => 'Default layout only.'
				),
				array(
					"type" => "textfield",
					"heading" => __("URL for block", 'foundry'),
					"param_name" => "url"
				),
				array(
					"type" => "dropdown",
					"heading" => __("Layout Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Default' => 'default',
						'Vertical Center' => 'vertical'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_tile_shortcode_vc' );