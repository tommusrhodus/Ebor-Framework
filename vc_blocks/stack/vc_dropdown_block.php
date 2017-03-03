<?php 

/**
 * The Shortcode
 */
function ebor_dropdown_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'custom_css_class' => '',
				'column_width' => '4'
			), $atts 
		) 
	);
	
	$output = '
		<div class="dropdown '. esc_attr($custom_css_class) .'">
			<span class="dropdown__trigger">'. $title .' <i class="stack-down-open"></i></span>
			<div class="dropdown__container">
				<div class="container">
					<div class="row">
						<div class="col-sm-'. $column_width .' col-md-'. $column_width .' dropdown__content">
							'. do_shortcode(htmlspecialchars_decode($content)) .'
						</div>
					</div><!--end row-->
				</div><!--end container-->
			</div><!--end dropdown container-->
		</div>
	';

	return $output;
}
add_shortcode( 'stack_dropdown', 'ebor_dropdown_shortcode' );

/**
 * The VC Functions
 */
function ebor_dropdown_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Dropdown Container", 'stackwordpresstheme'),
			"base" => "stack_dropdown",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'stackwordpresstheme'),
					"param_name" => "title"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Dropdown Width", 'stackwordpresstheme'),
					"param_name" => "column_width",
					"description" => 'Width in columns, Enter 1 to 12 only. 4 Default.',
					'value' => '4'
				),
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
add_action( 'vc_before_init', 'ebor_dropdown_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_dropdown extends WPBakeryShortCodesContainer {}
}