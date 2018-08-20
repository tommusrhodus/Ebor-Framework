<?php 

/**
 * The Shortcode
 */
function ebor_animated_heading_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'text' => '',
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	$output = '
		<div class="headline text-center">
			<h2>'. htmlspecialchars_decode($title) .'</h2>
			<p class="lead animated-text letters type"> 
				<span>'. htmlspecialchars_decode($subtitle) .'</span> 
				<span class="animated-text-wrapper waiting">
	';
	
	if( is_array($lines) ){
		foreach($lines as $key => $line){
			$class = ( 0 == $key ) ? 'is-visible' : '';
			$output .= '<b class="'. $class .'">'. htmlspecialchars_decode($line) .'</b>';
		}
	}
					
	$output .= '
				</span> 
			</p>
		</div>
		<div class="divide30"></div>
	';
	
	return $output;
}
add_shortcode( 'hygge_animated_heading', 'ebor_animated_heading_shortcode' );

/**
 * The VC Functions
 */
function ebor_animated_heading_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
			"name" => __("Animated Heading", 'hygge'),
			"base" => "hygge_animated_heading",
			"category" => __('Hygge WP Theme', 'hygge'),
			'description' => 'Create an animated heading for the section, uses an animated typing effect.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'hygge'),
					"param_name" => "title",
					'holder' => 'h4'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'hygge'),
					"param_name" => "subtitle",
					'holder' => 'p'
				),
				array(
					"type" => "exploded_textarea",
					"heading" => __("Animated Word, 1 per line", 'hygge'),
					"param_name" => "text"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_animated_heading_shortcode_vc' );