<?php 

/**
 * The Shortcode
 */
function ebor_section_title_shortcode( $atts, $content = null ) {

	$output = '
		<div class="row  mb64 mb-xs-40">
		    <div class="col-sm-12 text-center">
		        <div class="ribbon">
		            <h6 class="uppercase mb0">'. strip_tags(htmlspecialchars_decode(trim($content))) .'</h6>
		        </div>
		    </div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'padre_section_title', 'ebor_section_title_shortcode' );

/**
 * The VC Functions
 */
function ebor_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'padre-vc-block',
			"name" => esc_html__("Ribbon Title", 'padre'),
			"base" => "padre_section_title",
			"category" => esc_html__('padre WP Theme', 'padre'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'padre'),
					"param_name" => "content",
					'holder' => 'div',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_section_title_shortcode_vc' );