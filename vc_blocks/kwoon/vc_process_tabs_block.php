<?php

global $ebor_process_tabs_content;
global $ebor_process_tabs_count;
$ebor_process_tabs_count = 0;

/**
 * The Shortcode
 */
function ebor_process_tabs_shortcode( $atts, $content = null ) {
	
	global $ebor_process_tabs_content;
	global $ebor_process_tabs_count;
	$ebor_process_tabs_content = false;
	
	$rand = wp_rand(0,10000);
	
	$output = '
		<div class="tabs tabs-bottom tab-container ebor-'. $rand .'">
			<div class="panel-container">'. do_shortcode($content) .'</div>
			<ul class="etabs row">'. $ebor_process_tabs_content .'</ul>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(\'.tabs.tabs-bottom.ebor-'. $rand .'\').easytabs({
				    animationSpeed: 300,
				    updateHash: false,
				    cycle: 5000
				});
			});
		</script>
	';
	return $output;
}
add_shortcode( 'kwoon_process_tabs', 'ebor_process_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_process_tabs_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'image_retina' => '',
				'alt' => '',
				'title' => ''
			), $atts 
		) 
	);
	
	global $ebor_process_tabs_content;
	global $ebor_process_tabs_count;
	$ebor_process_tabs_count++;
	
	$image = wp_get_attachment_image_src($image, 'full');
	$image_retina = wp_get_attachment_image_src($image_retina, 'full');
	
	if(!( isset($image[0]) ))
		$image[0] = false;
	
	if(!( isset($image_retina[0]) ))
		$image_retina[0] = false;
	
	$output = '
		<div class="tab-block" id="tab-'. esc_attr($ebor_process_tabs_count) .'">
			'. do_shortcode(htmlspecialchars_decode($content)) .'
		</div>
	';
	
	$ebor_process_tabs_content .= '
		<li class="tab col-sm-3">
			<a href="#tab-'. esc_attr($ebor_process_tabs_count) .'">
				<div class="icon box">
					<img 
						src="'. esc_url($image[0]) .'" 
						data-src="'. esc_url($image[0]) .'" 
						data-ret="'. esc_url($image_retina[0]) .'" 
						class="retina" 
						alt="'. esc_attr($alt) .'" 
					/>
				</div>
				<h4>'. $title .'</h4>
			</a>
		</li>
	';

	return $output;
}
add_shortcode( 'kwoon_process_tabs_content', 'ebor_process_tabs_content_shortcode' );

// Parent Element
function ebor_process_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'                    => __( 'Process Tabs' , 'kwoon' ),
		    'base'                    => 'kwoon_process_tabs',
		    'description'             => __( 'Create tabs of your process/services', 'kwoon' ),
		    'as_parent'               => array('only' => 'kwoon_process_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Kwoon WP Theme', 'kwoon')
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_tabs_shortcode_vc' );

// Nested Element
function ebor_process_tabs_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'            => __('Process Tabs Content', 'kwoon'),
		    'base'            => 'kwoon_process_tabs_content',
		    'description'     => __( 'Proces Tabs Content Element', 'kwoon' ),
		    "category" => __('Kwoon WP Theme', 'kwoon'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'kwoon_process_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Tab Content", 'kwoon'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Tab Title", 'kwoon'),
	            	"param_name" => "title"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Tab Icon Image", 'kwoon'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Tab Icon Retina Image (Double Size)", 'kwoon'),
	            	"param_name" => "image_retina"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Image Alt Text", 'kwoon'),
	            	"param_name" => "alt"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_kwoon_process_tabs extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_kwoon_process_tabs_content extends WPBakeryShortCode {

    }
}