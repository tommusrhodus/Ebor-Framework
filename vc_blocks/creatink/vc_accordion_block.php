<?php

/**
 * The Shortcode
 */
function ebor_accordion_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'panel-group-bg',
				'open' => 'yes'
			), $atts 
		) 
	);
	
	global $ebor_accordion_count;
	global $rand;
	global $ebor_accordion_open;
	$ebor_accordion_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	$ebor_accordion_open = $open;
	
	$output .= '
		<div class="panel-group '. esc_attr($type) .' ebor-'. $rand .'" id="accordion-'. $rand .'">'. do_shortcode($content) .'</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				jQuery(\'.panel-group.ebor-'. $rand .'\').find(\'.panel:has(".in")\').addClass(\'panel-active\');
				
			    jQuery(\'.panel-group.ebor-'. $rand .'\').on(\'shown.bs.collapse\', function(e) {
			        jQuery(e.target).closest(\'.panel\').addClass(\' panel-active\');
			    }).on(\'hidden.bs.collapse\', function(e) {
			        jQuery(e.target).closest(\'.panel\').removeClass(\' panel-active\');
			    });
			});  
		</script>
	';

	return $output;
}
add_shortcode( 'creatink_accordion', 'ebor_accordion_shortcode' );

/**
 * The Shortcode
 */
function ebor_accordion_content_shortcode( $atts, $content = null ) {
	global $ebor_accordion_count;
	global $rand;
	global $ebor_accordion_open;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$ebor_accordion_count++;
	$active = $in = false;
	
	if( 1 == $ebor_accordion_count && 'yes' == $ebor_accordion_open ){
		$active = 'active';
		$in = 'in';	
	}
	
	$output = '
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title">
					<a data-toggle="collapse" class="panel-toggle '. esc_attr($active) .'" data-parent="#accordion-'. $rand .'" href="#collapse-'. $rand .'-'. esc_attr($ebor_accordion_count) .'">'. htmlspecialchars_decode($title) .'</a>
				</div>
			</div>
			<div id="collapse-'. $rand .'-'. esc_attr($ebor_accordion_count) .'" class="panel-collapse collapse '. esc_attr($in) .'">
				<div class="panel-body">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
			</div>
	   </div>
	';

	return $output;
}
add_shortcode( 'creatink_accordion_content', 'ebor_accordion_content_shortcode' );

// Parent Element
function ebor_accordion_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
		    'name'                    => esc_html__( 'Accordion' , 'creatink' ),
		    'base'                    => 'creatink_accordion',
		    'description'             => esc_html__( 'Create Accordion Content', 'creatink' ),
		    'as_parent'               => array('only' => 'creatink_accordion_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
		    			'Background' => 'panel-group-bg',
		    			'Line'       => 'panel-group-lined',
		    			'Border'     => 'panel-group-border',
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("First item open by default?", 'creatink'),
		    		"param_name" => "open",
		    		"value" => array(
		    			'Yes' => 'yes',
		    			'No' => 'no'
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_shortcode_vc' );

// Nested Element
function ebor_accordion_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
		    'name'            => esc_html__('Accordion Content', 'creatink'),
		    'base'            => 'creatink_accordion_content',
		    'description'     => esc_html__( 'Accordion Content Element', 'creatink' ),
		    "category" => esc_html__('creatink WP Theme', 'creatink'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'creatink_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'creatink'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'creatink'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_creatink_accordion extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_creatink_accordion_content extends WPBakeryShortCode {}
}