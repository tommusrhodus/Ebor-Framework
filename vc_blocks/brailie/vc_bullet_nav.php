<?php 

/**
 * The Shortcode
 */
function ebor_bullet_nav_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'text' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);

	
	$output = '
		<div class="bullet-nav '. $custom_css_class .'">
			<ul class="nav navbar-nav ml-auto">';
				
				$items = explode( ',', $text );
				foreach ($items as $item) {
					$search  = array( '-', '_' );
					$item_minus_hash = ucwords(str_replace($search, " ", str_replace('#', '', $item)));
					$output .= '<li class="nav-item"><a class="nav-link scroll hint--left hint--rounded hint--start" href="'. $item .'" aria-label="'. $item_minus_hash .'"></a></li>';
				}
				$output .= '
			</ul>
			<!-- /.navbar-nav --> 
		</div>
	';

	return $output;
}
add_shortcode( 'brailie_bullet_nav', 'ebor_bullet_nav_shortcode' );

/**
 * The VC Functions
 */
function ebor_bullet_nav_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("In Page Nav", 'brailie'),
			"base" => "brailie_bullet_nav",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			"params" => array(
				array(
					"type" => "exploded_textarea",
					"heading" => esc_html__("IDs to link to", 'brailie'),
					"param_name" => "text",
					"description" => '1 section ID per line, add a section id (such as #home or #portfolio) for each link you wish to create.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_bullet_nav_shortcode_vc' );