<?php 

/**
 * The Shortcode
 */
function ebor_image_caption_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'type' => 'hover-caption',
				'link' => '#'
			), $atts 
		) 
	);
	
	if( 'tile' == $type ){
		
		$output = '
			<div class="horizontal-tile">
			    <div class="tile-left">
			        <a href="'. esc_url($link) .'">
			            <div class="background-image-holder">
			                '. wp_get_attachment_image( $image, 'full', array('class' => 'background-image') ) .'
			            </div>
			        </a>
			    </div>
			    <div class="tile-right bg-secondary">
			        <div class="description">
			            '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			        </div>
			    </div>
			</div>
		';
		
	} else {
		
		$output = '
		    <div class="image-caption cast-shadow '. $type .'">
		        '. wp_get_attachment_image( $image, 'full' ) .'
		        <div class="caption">
		            '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		        </div>
		    </div>
	    ';
	    
	}
	
	return $output;
}
add_shortcode( 'foundry_image_caption', 'ebor_image_caption_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_caption_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Image Caption", 'foundry'),
			"base" => "foundry_image_caption",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Block Image", 'foundry'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display Type", 'foundry'),
					"param_name" => "type",
					"value" => array(
						'Caption on Hover' => 'hover-caption',
						'Static Caption' => 'mb-xs-32',
						'Image & Text Tile' => 'tile'
					)
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Caption Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("URL for block (Tile Layout Only)", 'foundry'),
					"param_name" => "link"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_caption_shortcode_vc' );