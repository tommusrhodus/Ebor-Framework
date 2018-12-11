<?php 

/**
 * The Shortcode
 */
function ebor_services_icon_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'icon-color color-dark',
				'icon'  => '',
				'align' => 'center',
				'font_size' => '48px',
				'boxed' => 'not-boxed',
				'custom_css_class' => ''
			), $atts 
		) 
	);
		
	$output = '
		<div class="'. $boxed .' wpb_content_element icon-block text-'. $align .' '. esc_attr( $custom_css_class ) .'">
			<span class="icon '. $layout .' mb-20" style="font-size: '. $font_size .';">
				<i class="fa '. $icon .'"></i>
			</span><div class="clearfix"></div>'. do_shortcode( $content ) .'</div>
	';
	
	return $output;
}
add_shortcode( 'brailie_services_icon_block', 'ebor_services_icon_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_services_icon_block_shortcode_vc() {

	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('brailie_get_icons') ){
		$icons = array_values(brailie_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Services - Icon", 'brailie'),
			"base" => "brailie_services_icon_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'Service icon block with selectable layouts',
			"params" => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Icon Display type", 'brailie'),
					"param_name" => "layout",
					"value"      => array(
						'Standard (Dark)' => 'icon-color color-dark',
						'Highlight Color' => 'icon-color color-default',
						'Gradient'        => 'icon-color color-gradient',
						'Standard Background (Dark)' => 'icon-bg bg-dark',
						'Highlight Background Color' => 'icon-bg bg-default',
						'Gradient Background'        => 'icon-bg bg-gradient'
					)
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Icon Alignment", 'brailie'),
					"param_name" => "align",
					"value"      => array(
						'Center' => 'center',
						'Left' => 'left',
						'Right' => 'right'
					)
				),
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Box Borders", 'brailie'),
					"param_name" => "boxed",
					"value"      => array(
						'No Borders' => 'not-boxed',
						'Bordered' => 'box box-border'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Icon Size", 'stackwordpresstheme'),
					"param_name" => "font_size",
					'value' => '48px'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'brailie'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'brailie'),
					"param_name" => "content",
					'holder' => 'div'
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
add_action( 'vc_before_init', 'ebor_services_icon_block_shortcode_vc' );