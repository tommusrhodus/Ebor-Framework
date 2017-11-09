<?php

/**
 * The Shortcode
 */
function ebor_toggles_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'accordion-1 one-open'
			), $atts 
		) 
	);
	
	$output = '<ul class="accordion '. esc_attr($type) .'">'. do_shortcode($content) .'</ul>';

	return $output;
}
add_shortcode( 'foundry_toggles', 'ebor_toggles_shortcode' );

/**
 * The Shortcode
 */
function ebor_toggles_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li>
		    <div class="title">
		        <span>'. htmlspecialchars_decode($title) .'</span>
		    </div>
		    <div class="content">
		        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		    </div>
		</li>
	';

	return $output;
}
add_shortcode( 'foundry_toggles_content', 'ebor_toggles_content_shortcode' );

// Parent Element
function ebor_toggles_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Toggles' , 'foundry' ),
		    'base'                    => 'foundry_toggles',
		    'description'             => __( 'Create Accordion Content', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_toggles_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Display type", 'foundry'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Buttons, One At A Time' => 'accordion-1 one-open',
		    			'Buttons, Multiple Open' => 'accordion-1',
		    			'Text, One At A Time' => 'accordion-2 one-open',
		    			'Text, Multiple Open' => 'accordion-2'
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_toggles_shortcode_vc' );

// Nested Element
function ebor_toggles_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Toggles Content', 'foundry'),
		    'base'            => 'foundry_toggles_content',
		    'description'     => __( 'Toggle Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_toggles'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'foundry'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'foundry'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_toggles_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_toggles extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_toggles_content extends WPBakeryShortCode {

    }
}