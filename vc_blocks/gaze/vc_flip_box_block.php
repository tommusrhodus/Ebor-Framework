<?php 

/**
 * The Shortcode
 */
function ebor_flip_box_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'button_url'       => '#',
				'button_text'      => '',
				'icon'             => '',
				'custom_css_class' => '',
				'price'			   => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="'. $custom_css_class .' service-item-box style-7 flip-card text-center">
		
			<div class="front">
				<a href="#" class="icon-holder"><i class="'. esc_attr( $icon ) .'"></i></a>
				<div class="service-text">'. $content .'</div>
			</div>
			
			<div class="back">
				<h4 class="uppercase mb-20">'. $price .'</h4>
				<a href="'. esc_url( $button_url ) .'" class="btn btn-md btn-color"><span>'. $button_text .'</span></a>
			</div>
		
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_flip_box_block', 'ebor_flip_box_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_flip_box_block_shortcode_vc() {
	
	$icons = array_keys(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Flip Boxes", 'gaze' ),
			"base"        => "gaze_flip_box_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'A box which flips on hover.',
			"params"      => array(
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__( "Content", 'gaze' ),
					"param_name" => "content",
					'holder'     => 'div'
				),
				array(
					"type"       => "ebor_icons",
					"heading"    => esc_html__( "Icon", 'gaze' ),
					"param_name" => "icon",
					"value"      => $icons
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Button URL", 'gaze' ),
					"param_name" => "button_url",
					'value'      => '#'
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Button Text", 'gaze' ),
					"param_name" => "button_text"
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Price", 'gaze' ),
					"param_name" => "price",
					'value'      => 'From $199'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Extra CSS Class Name", 'gaze' ),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_flip_box_block_shortcode_vc' );