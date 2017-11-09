<?php 

/**
 * The Shortcode
 */
function ebor_simple_social_icon_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'url' => ''
			), $atts 
		) 
	);
	
	$output = '
		<ul>
		    <li>
		        <a href="'. esc_url($url) .'" target="_blank">
		            <h6 class="uppercase">
		                <i class="'. esc_attr($icon) .'">&nbsp;</i> '. $title .'</h6>
		        </a>
		    </li>
		</ul>
	';
	
	return $output;
}
add_shortcode( 'foundry_simple_social_icon', 'ebor_simple_social_icon_shortcode' );

/**
 * The VC Functions
 */
function ebor_simple_social_icon_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Simple Social Icon", 'foundry'),
			"base" => "foundry_simple_social_icon",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Click an Icon to choose", 'foundry'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => __("Link URL", 'foundry'),
					"param_name" => "url",
					'description' => 'e.g: http://twitter.com/madeinebor',
					'holder' => 'div',
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_simple_social_icon_shortcode_vc' );