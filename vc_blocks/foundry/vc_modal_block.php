<?php 

/**
 * The Shortcode
 */
function ebor_modal_shortcode( $atts, $content = null ) {
	
	global $foundry_modal_content;
	
	extract( 
		shortcode_atts( 
			array(
				'image' => false,
				'fullscreen' => 'no',
				'button_text' => '',
				'icon' => '',
				'delay' => false,
				'align' => 'text-center',
				'cookie' => false,
				'manual_id' => false,
				'hide_button' => 'no'
			), $atts 
		) 
	);
	
	$id = ( $manual_id ) ? $manual_id : rand(0, 10000);
	
	$cookie = ( $cookie ) ? 'data-cookie="'. $cookie .'"' : false;

	$classes = ($image) ? 'image-bg overlay' : false;
	
	if( 'yes' == $fullscreen ){
		$classes .= ' fullscreen';	
	}
	
	if( 'fullwidth' == $fullscreen ){
		$classes .= ' fullscreen fullwidth';	
	}
	
	if( $delay ){
		$delay = 'data-time-delay="'. (int) $delay .'"';	
	}
	
	$output = '<div class="modal-container '. $align .'">';
	
	if( 'no' == $hide_button )
		$output .= '<a class="btn btn-lg btn-modal" href="#" modal-link="'. esc_attr($id) .'"><i class="'. $icon .'"></i> '. $button_text .'</a>';
	
	$output2 = '<div class="foundry_modal text-center '. $classes .'" '. $delay .' '. esc_attr($cookie) .' modal-link="'. esc_attr($id) .'"><i class="ti-close close-modal"></i>';
	
	if($image){
		$output2 .= '
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			</div>
		';	
	}
	
	if( 'fullwidth' == $fullscreen ){
		$output2 .= '<div class="foundry-modal-content">';
	}
	
	$output2 .= do_shortcode($content);
	
	if( 'fullwidth' == $fullscreen ){
		$output2 .= '</div>';
	}
	
	$output2 .= '</div>';
	
	$output .= '</div>';
	
	$foundry_modal_content .= $output2;
	
	return $output;
}
add_shortcode( 'foundry_modal', 'ebor_modal_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Modal' , 'foundry' ),
		    'base'                    => 'foundry_modal',
		    'description'             => __( 'Create a modal popup', 'foundry' ),
		    'as_parent'               => array('except' => 'foundry_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array(
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => __("Button Icon, click to choose", 'foundry'),
		    		"param_name" => "icon",
		    		"value" => $icons,
		    		'description' => 'Type "none" or leave blank to hide icons.'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Button Text", 'foundry'),
		    		"param_name" => "button_text"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Hide Button?", 'foundry'),
		    		"param_name" => "hide_button",
		    		"value" => array(
		    			'No' => 'no',
		    			'Yes' => 'yes'
		    		)
		    	),
		    	array(
		    		"type" => "attach_image",
		    		"heading" => __("Modal background image?", 'foundry'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Show Full Height?", 'foundry'),
		    		"param_name" => "fullscreen",
		    		"value" => array(
		    			'No' => 'no',
		    			'Yes' => 'yes',
		    			'FullHeight & FullWidth' => 'fullwidth'
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Button Alignment", 'foundry'),
		    		"param_name" => "align",
		    		"value" => array(
		    			'Center' => 'text-center',
		    			'Left' => 'text-left',
		    			'Right' => 'text-right'
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Delay Timer", 'foundry'),
		    		"param_name" => "delay",
		    		'description' => 'Leave blank for infinite delay (manual trigger only) enter milliseconds for automatic popup on timer, e.g: 2000'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Cookie Name", 'foundry'),
		    		"param_name" => "cookie",
		    		'description' => 'Set a plain text cookie name here to stop the delay popup if someone has already closed it.'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Set a manual ID for your modal (numeric)", 'foundry'),
		    		"param_name" => "manual_id",
		    		'description' => 'Not required, only set if you require a static ID for your modal, numeric only!'
		    	),
		    )
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_modal_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_modal extends WPBakeryShortCodesContainer {

    }
}