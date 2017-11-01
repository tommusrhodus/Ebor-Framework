<?php 

/**
 * The Shortcode
 */
function ebor_wizard_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="wizard '. esc_attr($custom_css_class) .'">'. do_shortcode($content) .'</div>';

	return $output;
}
add_shortcode( 'stack_wizard', 'ebor_wizard_shortcode' );

/**
 * The Shortcode
 */
function ebor_wizard_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '
		<h5 class="'. esc_attr($custom_css_class) .'">'. $title .'</h5>
		<section class="'. esc_attr($custom_css_class) .'">
		    <div class="pos-vertical-center">
		        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		    </div>
		</section>
	';

	return $output;
}
add_shortcode( 'stack_wizard_content', 'ebor_wizard_content_shortcode' );

// Parent Element
function ebor_wizard_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Wizard' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_wizard',
		    'description'             => esc_html__( 'Create Wizard Content', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_wizard_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_wizard_shortcode_vc' );

// Nested Element
function ebor_wizard_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Wizard Content', 'stackwordpresstheme'),
		    'base'            => 'stack_wizard_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_wizard'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'stackwordpresstheme'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'stackwordpresstheme'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
	            	"param_name" => "custom_css_class",
	            	"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=YHRpDbuybXw">Video Tutorial</a></div>',
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_wizard_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_wizard extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_wizard_content extends WPBakeryShortCode {}
}