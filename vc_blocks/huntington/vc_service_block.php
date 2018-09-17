<?php 

/**
 * The Shortcode
 */
function ebor_service_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'retina_image' => '',
				'title' => '',
				'text' => ''
			), $atts 
		) 
	);
	
	$output = false;
	$image = wp_get_attachment_image_src( $image, 'full' );
	$ret_image = wp_get_attachment_image_src( $retina_image, 'full' );
	$lines = explode( ',', $text );
	
	if($image[0]){
		
		if(!( $ret_image[0] ))
			$ret_image[0] = false;
	
		$output .= '
			<ul class="service_box">
			  <li class="service_item">
			    <div class="icon_box">
			    	<img src="'. esc_url($image[0]) .'" data-src="'. esc_url($image[0]) .'" data-ret="'. $ret_image[0] .'"  alt="'. esc_attr(get_the_title()) .'" class="retina" />
			    </div>
			    <p class="service_name">'. htmlspecialchars_decode($title) .'</p>
			    <ul class="service_details">';
			    
			    foreach( $lines as $line ){
			    	$output .= '<li>' . htmlspecialchars_decode($line) . '</li>';
			    }

			  $output .= '</ul>
			  </li>
			</ul>
		';
	
	}
	
	return $output;
}
add_shortcode( 'huntington_service', 'ebor_service_shortcode' );

/**
 * The VC Functions
 */
function ebor_service_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'huntington-vc-block',
			"name" => esc_html__("Service Popup", 'huntington'),
			"base" => "huntington_service",
			"category" => esc_html__('Huntington WP Theme', 'huntington'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'huntington'),
					"param_name" => "title",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("Pricing details, one per line", 'huntington'),
					"param_name" => "text",
					"value" => '',
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image (48x48px)", 'huntington'),
					"param_name" => "image"
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image Retina (96x96px)", 'huntington'),
					"param_name" => "retina_image"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_shortcode_vc' );