<?php

/**
 * The Shortcode
 */
function ebor_timetable_shortcode( $atts, $content = null ) {
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$output = false;
	if( $title )
		$output = '<h1>'. htmlspecialchars_decode($title) .'</h1>';
	$output .= '<ul class="schedule-overview">'. do_shortcode($content) .'</ul>';
	
	return $output;
}
add_shortcode( 'meetup_timetable', 'ebor_timetable_shortcode' );

/**
 * The Shortcode
 */
function ebor_timetable_content_shortcode( $atts, $content = null ) {
	
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'time' => ''
			), $atts 
		) 
	);
	
	$output = '<li>
		<div class="schedule-title">
			<span class="time">'. htmlspecialchars_decode($time) .'</span>
			<span class="title">'. htmlspecialchars_decode($title) .'</span>
		</div>
		
		<div class="schedule-text">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
		
		<div class="marker-pin">
			<div class="top"></div>
			<div class="middle"></div>
			<div class="bottom"></div>
		</div>
	</li>';

	return $output;
}
add_shortcode( 'meetup_timetable_content', 'ebor_timetable_content_shortcode' );

// Parent Element
function ebor_timetable_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
		    'name'                    => __( 'Timetables' , 'meetup' ),
		    'base'                    => 'meetup_timetable',
		    'description'             => __( 'Create timetable Content', 'meetup' ),
		    'as_parent'               => array('only' => 'meetup_timetable_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Meetup - WP Theme', 'meetup'),
		    'params' => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'meetup'),
		    		"param_name" => "title",
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_timetable_shortcode_vc' );

// Nested Element
function ebor_timetable_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'meetup-vc-block',
		    'name'            => __('Timetables Content', 'meetup'),
		    'base'            => 'meetup_timetable_content',
		    'description'     => __( 'timetable Content Element', 'meetup' ),
		    "category" => __('meetup WP Theme', 'meetup'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'meetup_timetable'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'meetup'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Time", 'meetup'),
		    		"param_name" => "time",
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'meetup'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_timetable_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_meetup_timetable extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_meetup_timetable_content extends WPBakeryShortCode {

    }
}