<?php 

/**
 * The Shortcode
 */
function ebor_skills_bar_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'number' => '',
				'alignment' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="'. $alignment .' skills skill-bars"><ul class="skills-ul"><li><span>'. wp_specialchars_decode($title, ENT_QUOTES) .'</span><div class="skill-bar-holder"><div class="skill-capacity" style="width: '. (int)$number .'%;"></div></div></li></ul></div>';
	
	return $output;
}
add_shortcode( 'pivot_skills_bar', 'ebor_skills_bar_shortcode' );

/**
 * The VC Functions
 */
function ebor_skills_bar_shortcode_vc() {
	
	$align_types = array(
		'skills-left' => 'Right',
		'skills-right' => 'Left',
	);
	
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
			"name" => __("Pivot - Skills Bar", 'pivot'),
			"base" => "pivot_skills_bar",
			"category" => __('Pivot - Misc', 'pivot'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Alignment", 'pivot'),
					"param_name" => "alignment",
					"value" => array_flip($align_types),
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'pivot'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Skill Percentage", 'pivot'),
					"param_name" => "number",
					"value" => "",
					"description" => 'Enter 0 - 100 only',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_skills_bar_shortcode_vc' );