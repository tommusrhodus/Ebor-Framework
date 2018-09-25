<?php 

/**
 * The Shortcode
 */
function ebor_clients_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'slides' => ''
			), $atts 
		) 
	);
	
	$output = false;
	$slides = explode(',', $slides);
	
	if( is_array($slides) ){
		
		$output .= '<div class="row client-logo-row add-top-half">';
		
		$i = 0;
		$count = count($slides);
		foreach( $slides as $logo ){
			$i++;
			
			$output .= '
				<article class="col-md-3 text-center client-logo no-pad">
					<div class="client-logo-inner">
						<a href="#">'. wp_get_attachment_image($logo, 'full') .'</a>
					</div>
				</article>
			';
			
			if( $i % 4 == 0 && !($i == $count) )
				$output .= '</div><div class="row client-logo-row">';	
		}
		
		$output .= '</div>';
		  	
	}
	
	return $output;
}
add_shortcode( 'expose_clients', 'ebor_clients_shortcode' );

/**
 * The VC Functions
 */
function ebor_clients_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
			"name" => __("Clients Logos", 'expose'),
			"base" => "expose_clients",
			"category" => __('Expose WP Theme', 'expose'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Client Logos", 'expose'),
					"param_name" => "slides",
					"value" => '',
					"description" => __('Add logos to show in the client grid, 300x200px recommended.', 'expose')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_clients_shortcode_vc' );