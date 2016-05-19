<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	global $rand;
	$rand = false;
	$ebor_tabs_count = 0;
	$ebor_tabs_content = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => ''
			), $atts 
		) 
	);
	$output = false;
	
	$rand = wp_rand(0,10000);
		
	$output .= '
		<ul id="tab'. $rand .'" class="nav nav-tabs">'. do_shortcode($content) .'</ul><div id="myTabContent'. $rand .'" class="tab-content">'. $ebor_tabs_content .'</div>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(\'#tab'. $rand .'\').tabCollapse({
				tabsClass: \'hidden-sm hidden-xs\',
				accordionClass: \'visible-sm visible-xs\'
			});
			jQuery(\'#tab'. $rand .'\').on(\'shown-accordion.bs.tabcollapse\', function(){
			    jQuery(\'.panel-group\').find(\'.panel-default:has(".in")\').addClass(\'panel-active\');
			    jQuery(\'.panel-group\').on(\'shown.bs.collapse\', function(e) {
			        jQuery(e.target).closest(\'.panel-default\').addClass(\' panel-active\');
			    }).on(\'hidden.bs.collapse\', function(e) {
			        jQuery(e.target).closest(\'.panel-default\').removeClass(\' panel-active\');
			    });
			});
		});
		</script>
	';
	
	return $output;
}
add_shortcode( 'morello_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	global $rand;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$ebor_tabs_count++;
	$active = ( 1 == $ebor_tabs_count ) ? 'active' : '';
	$ebor_tabs_content .= '<div class="tab-pane fade in '. $active .'" id="tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	$output = ' <li class="'. $active .'"><a href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab">'. htmlspecialchars_decode($title) .'</a></li> ';
	return $output;
}
add_shortcode( 'morello_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
		    'name'                    => esc_html__( 'Tabs' , 'morello' ),
		    'base'                    => 'morello_tabs',
		    'description'             => esc_html__( 'Create Tabbed Content', 'morello' ),
		    'as_parent'               => array('only' => 'morello_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('morello WP Theme', 'morello'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
		    'name'            => esc_html__('Tabs Content', 'morello'),
		    'base'            => 'morello_tabs_content',
		    'description'     => esc_html__( 'Tab Content Element', 'morello' ),
		    "category" => esc_html__('morello WP Theme', 'morello'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'morello_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'morello'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'morello'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_morello_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_morello_tabs_content extends WPBakeryShortCode {}
}