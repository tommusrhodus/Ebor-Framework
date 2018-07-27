<?php 

/**
 * The Shortcode
 */
function ebor_image_text_tile_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'standard',
				'link'   => '',
				'image'  => '',
				'hover_text'  => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$link   = vc_build_link( $link );
	$before = ( isset( $link['url'] ) && $link['url'] !== '' ) ? '<a href="'. esc_url( $link['url'] ) .'">' : '';
	$after  = ( is_array( $link ) ) ? '</a>' : '';
		
	if( 'rounded' == $layout ){
	
		$output = '
			<div class="item text-center '. esc_attr( $custom_css_class ).'">
				<figure class="overlay rounded overlay1 mb-20">
					'. $before .'
						<span class="bg"></span>
						'. wp_get_attachment_image( $image, 'large' ) .'
					'. $after.'
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
			  				<h5 class="mb-0">'. $hover_text .'</h5>
						</div>
					</figcaption>
				</figure>
				'. do_shortcode($content) .'
			</div>
		';
	
	} elseif( 'standard' == $layout ){
	
		$output = '
			<div class="item text-center '. esc_attr( $custom_css_class ).'">
				<figure class="overlay overlay1 mb-20">
					'. $before .'
						<span class="bg"></span>
						'. wp_get_attachment_image( $image, 'large' ) .'
					'. $after.'
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
			  				<h5 class="mb-0">'. $hover_text .'</h5>
						</div>
					</figcaption>
				</figure>
				'. do_shortcode($content) .'
			</div>
		';
	
	} elseif( 'overlay' == $layout ){
	
		$output = '
			<div class="item text-center '. esc_attr( $custom_css_class ).'">
				<figure class="overlay-info hovered">
					'. $before .'
					'. wp_get_attachment_image( $image, 'large' ) .'
					'. $after.'
					<figcaption class="d-flex">
						<div class="align-self-center mx-auto">
							'. do_shortcode($content) .'
						</div> 
					</figcaption>
				</figure>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'brailie_image_text_tile_block', 'ebor_image_text_tile_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_text_tile_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Image and Text Tile", 'brailie'),
			"base" => "brailie_image_text_tile_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'A flexible image based tile',
			"params" => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Display type", 'brailie'),
					"param_name" => "layout",
					"value"      => array(
						'Standard' => 'standard',
						'Rounded'  => 'rounded',
						'Overlay' => 'overlay',
					)
				),
				array(
					"type"       => "vc_link",
					"heading"    => esc_html__("Link image?", 'brailie'),
					"param_name" => "link"
				),
				array(
					"type"       => "attach_image",
					"heading"    => esc_html__("Block Image", 'brailie'),
					"param_name" => "image"
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Hover Text (not shown within Overlay layout)", 'brailie'),
					"param_name" => "hover_text",
					'holder'     => 'div'
				),
				array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Text", 'brailie'),
	            	"param_name" => "content",
	            	"description" => '<strong>PLEASE NOTE</strong> - If your using the "Overlay" layout, this text is shown over the image at all times',
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
add_action( 'vc_before_init', 'ebor_image_text_tile_block_shortcode_vc' );