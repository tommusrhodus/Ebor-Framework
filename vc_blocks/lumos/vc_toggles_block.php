<?php

global $ebor_toggles_count;

/**
 * The Shortcode
 */
function ebor_toggles_shortcode( $atts, $content = null ) {
	global $ebor_toggles_count;
	$ebor_toggles_count = 0;
	global $rand;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	$output = false;
	$rand = false;
	
	$rand = wp_rand(0,10000);
	
	if( $title )
		$output = '<h3 class="section-title">'. htmlspecialchars_decode($title) .'</h3>';
		
	$output .= '
		<div class="panel-group ebor-'. $rand .'" id="accordion-'. $rand .'">'. do_shortcode($content) .'</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				jQuery(\'.panel-group.ebor-'. $rand .'\').find(\'.panel-default:has(".in")\').addClass(\'panel-active\');
				
			    jQuery(\'.panel-group.ebor-'. $rand .'\').on(\'shown.bs.collapse\', function(e) {
			        jQuery(e.target).closest(\'.panel-default\').addClass(\' panel-active\');
			    }).on(\'hidden.bs.collapse\', function(e) {
			        jQuery(e.target).closest(\'.panel-default\').removeClass(\' panel-active\');
			    });
			});  
		</script>
	';

	return $output;
}
add_shortcode( 'lumos_toggles', 'ebor_toggles_shortcode' );

/**
 * The Shortcode
 */
function ebor_toggles_content_shortcode( $atts, $content = null ) {
	global $ebor_toggles_count;
	global $rand;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$ebor_toggles_count++;
	$active = $in = false;
	
	if( 1 == $ebor_toggles_count ){
		$active = 'active';
		$in = 'in';	
	}
	
	$output = '<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" class="panel-toggle '. esc_attr($active) .'" data-parent="#accordion-'. $rand .'" href="#collapse'. $rand .'-'. esc_attr($ebor_toggles_count) .'">'. htmlspecialchars_decode($title) .'</a>
						</h4>
					</div>
					<div id="collapse'. $rand .'-'. esc_attr($ebor_toggles_count) .'" class="panel-collapse collapse '. esc_attr($in) .'">
						<div class="panel-body">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
					</div>
			   </div>';

	return $output;
}
add_shortcode( 'lumos_toggles_content', 'ebor_toggles_content_shortcode' );

// Parent Element
function ebor_toggles_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
		    'name'                    => __( 'Toggles' , 'lumos' ),
		    'base'                    => 'lumos_toggles',
		    'description'             => __( 'Create Accordion Content', 'lumos' ),
		    'as_parent'               => array('only' => 'lumos_toggles_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('lumos WP Theme', 'lumos'),
		    'params' => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'lumos'),
		    		"param_name" => "title",
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
			"icon" => 'lumos-vc-block',
		    'name'            => __('toggles Content', 'lumos'),
		    'base'            => 'lumos_toggles_content',
		    'description'     => __( 'Toggle Content Element', 'lumos' ),
		    "category" => __('lumos WP Theme', 'lumos'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'lumos_toggles'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'lumos'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'lumos'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_toggles_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_lumos_toggles extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_lumos_toggles_content extends WPBakeryShortCode {

    }
}