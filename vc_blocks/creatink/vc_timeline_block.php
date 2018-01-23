<?php

/**
 * The Shortcode
 */
function ebor_timeline_shortcode( $atts, $content = null ) {
	global $ebor_accordion_count;
	global $ebor_timeline_layout;
	$ebor_accordion_count = 0;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => 'timeline dot'
			), $atts 
		) 
	);
	
	$ebor_timeline_layout = $type;
	
	if( 'dial-icon' == $type ){
		
		$output = '<div id="dial1"><ul class="dial">'. do_shortcode($content) .'</ul></div>';
		
	} elseif( 'dial-number' == $type ){
		
		$output = '<div id="dial2"><ul class="dial">'. do_shortcode($content) .'</ul></div>';
		
	} else {
		
		$output = '<div class="'. $type .'">'. do_shortcode($content) .'</div>';
	
	}

	return $output;
}
add_shortcode( 'creatink_timeline', 'ebor_timeline_shortcode' );

/**
 * The Shortcode
 */
function ebor_timeline_content_shortcode( $atts, $content = null ) {
	global $ebor_accordion_count;
	global $ebor_timeline_layout;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'color' => ''
			), $atts 
		) 
	);
	
	$ebor_accordion_count++;
	
	if( 'dial-icon' == $ebor_timeline_layout ){
		
		$active = false;
		
		if( 1 == $ebor_accordion_count ){
			$active = 'active';	
		}
		
		$color_output = ( $color ) ? 'style="background-color: '. $color.';"' : '';
		
		$output = '
			<li>
			
				<div class="dial-item '. $active .'" data-cyrcleBox="cf1-'. $ebor_accordion_count .'">
					<span class="icon icon-bg icon-s" '. $color_output .'>
						<i class="'. $icon .'"></i>
					</span>
				</div>
				
				<div class="dial-item-info" id="cf1-'. $ebor_accordion_count .'">
					<div class="dial-item-info-inner">
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				</div>
				
			</li>
		';	
		
	} elseif( 'dial-number' == $ebor_timeline_layout ){
			
		$active = false;
		
		if( 1 == $ebor_accordion_count ){
			$active = 'active';	
		}
		
		$color_output = ( $color ) ? 'style="background-color: '. $color.';"' : '';
		
		$output = '
			<li>
			
				<div class="dial-item '. $active .'" data-cyrcleBox="cf2-'. $ebor_accordion_count .'">
					<span class="icon icon-bg icon-xs" '. $color_output .'>
						<span class="number">'. $icon .'</span>
					</span>
				</div>
				
				<div class="dial-item-info" id="cf2-'. $ebor_accordion_count .'">
					<div class="dial-item-info-inner">
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				</div>
				
			</li>
		';	
			
	} else {

		$class = 'left';
		
		if( 1 == $ebor_accordion_count ){
			$class = 'right';	
		}
		
		if( 2 == $ebor_accordion_count ){
			$ebor_accordion_count = 0;	
		}
		
		$output = '<div class="timeline-block">';
		
		if( 'timeline dot' !== $ebor_timeline_layout && $icon ){
			
			$color_output = ( $color ) ? 'style="background-color: '. $color.';"' : '';
			
			$output .= '
				<div class="timeline-icon"> 
					<span class="icon icon-bg icon-s mb-20" '. $color_output .'>
						<i class="'. $icon .'"></i>
					</span> 
				</div><!-- timeline-icon -->
			';
			
		} else {
			
			$output .= '<div class="timeline-icon"></div>';
			
		}
				
				
		$output .= '		
				<div class="timeline-content box box-bg bg-white box-arrow '. $class .'">
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div><!-- timeline-content --> 
			</div><!-- timeline-block -->
		';
	
	}

	return $output;
}
add_shortcode( 'creatink_timeline_content', 'ebor_timeline_content_shortcode' );

// Parent Element
function ebor_timeline_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
		    'name'                    => esc_html__( 'Timeline' , 'creatink' ),
		    'base'                    => 'creatink_timeline',
		    'description'             => esc_html__( 'Create timeline Content', 'creatink' ),
		    'as_parent'               => array('only' => 'creatink_timeline_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('creatink WP Theme', 'creatink'),
		    'params' => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'creatink'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Dots'           => 'timeline dot',
		    			'Icon'           => 'timeline',
		    			'Dial & Icons'   => 'dial-icon',
		    			'Dial & Numbers' => 'dial-number'
		    		)
		    	)
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_timeline_shortcode_vc' );

// Nested Element
function ebor_timeline_content_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
		    'name'            => esc_html__('Timeline Content', 'creatink'),
		    'base'            => 'creatink_timeline_content',
		    'description'     => esc_html__( 'timeline Content Element', 'creatink' ),
		    "category" => esc_html__('creatink WP Theme', 'creatink'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'creatink_timeline'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'creatink'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "ebor_icons",
	            	"heading" => esc_html__("Icon", 'creatink'),
	            	"param_name" => "icon",
	            	"value" => $icons
	            ),
	            array(
	            	"type" => "colorpicker",
	            	"heading" => esc_html__("Icon Colour", 'creatink'),
	            	"param_name" => "color",
	            	'description' => 'Leave blank for default colour, make selection for custom colour',
	            	'value' => ''
	            ),
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_timeline_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_creatink_timeline extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_creatink_timeline_content extends WPBakeryShortCode {}
}