<?php 

/**
 * The Shortcode
 */
function ebor_title_card_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
		    <div class="col-sm-12">
		        <div class="pull-left">
		            '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'inline-block image-small') ) .'
		        </div>
		        <div class="inline-block p32 p0-xs mb-xs-24">
		            <h3 class="uppercase mb8">'. $title .'</h3>
		            <h5 class="uppercase">'. $subtitle.'</h5>
		        </div>
		    </div>
		</div>
	';
	
	return $output;
}
add_shortcode( 'foundry_title_card', 'ebor_title_card_shortcode' );

/**
 * The VC Functions
 */
function ebor_title_card_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Title Card", 'foundry'),
			"base" => "foundry_title_card",
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
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_title_card_shortcode_vc' );