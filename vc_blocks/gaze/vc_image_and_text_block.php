<?php 

/**
 * The Shortcode
 */
function ebor_image_and_text_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image'             => '',
				'label'             => '',
				'link'             => '#',
				'custom_css_class' => ''
			), $atts 
		) 
	);
		
	$output = '
		<a href="'. esc_url( $link ) .'" class="'. $custom_css_class .' image-and-text-block hover-up">
			<div class="work-container">
				<div class="work-img">
					<span class="label-new">'. $label .'</span>                
					'. wp_get_attachment_image( $image, 'large' ) .'
				</div>
				<div class="work-description">'. do_shortcode( $content ) .'</div>
			</div>
		</a>
	';
	
	return $output;
}
add_shortcode( 'gaze_image_and_text_block', 'ebor_image_and_text_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_and_text_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"     => 'gaze-vc-block',
			"name"     => esc_html__( "Image and Text", 'gaze' ),
			"base"     => "gaze_image_and_text_block",
			"category" => esc_html__( 'Gaze WP Theme', 'gaze' ),
			"params"   => array(
				array(
					"type"       => "attach_image",
					"heading"    => esc_html__( "Image", 'gaze' ),
					"param_name" => "image"
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Label", 'gaze' ),
					"param_name" => "label"
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Link", 'gaze' ),
					"param_name" => "link",
					'value'      => '#'
				),
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__( "Block Content", 'gaze' ),
					"param_name" => "content",
					'holder'     => 'div'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Extra CSS Class Name", 'gaze' ),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_image_and_text_block_shortcode_vc' );