<?php 

/**
 * The Shortcode
 */
function ebor_image_tile_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'class' => '',
				'layout' => 'service'
			), $atts 
		) 
	);
	
	if( 'service' == $layout ){
		
		$output = '
			<div class="hover-element service-element '. esc_attr($class) .'">
				<div class="hover-element__initial">
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
				<div class="hover-element__reveal" data-overlay="7">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'large' ) .'
					</div>	
				</div>
			</div>
		';
	
	} elseif( 'stat' == $layout) {
		
		$output = '
			<div class="section--card">
				<div class="boxed stat-simple '. esc_attr($class) .'">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'large' ) .'
					</div>
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
			</div>
		';
		
	} else {
		
		$output = '
			<div class="hover-element case-study-element '. esc_attr($class) .'">
				<div class="hover-element__initial text-center">
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
				<div class="hover-element__reveal" data-overlay="7">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'large' ) .'
					</div>	
				</div>
			</div>
		';
		
	}

	return $output;
}
add_shortcode( 'partner_image_tile_block', 'ebor_image_tile_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_tile_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Image Tiles", 'partner'),
			"base" => "partner_image_tile_block",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Simple text and a button to grab attention',
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Modal background?", 'partner'),
					"param_name" => "image"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'partner'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Additional Class", 'partner'),
					"param_name" => "class",
					'description' => 'Add an additional class if you need, hint, enter <code>hover--active</code> for an alternate view.'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout", 'partner'),
					"param_name" => "layout",
					"value" => array(
						'Bottom Left Text' => 'service',
						'Centered Text' => 'case-study',
						'Bottom Left Text, Light Background' => 'stat'
					)
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_tile_block_shortcode_vc' );