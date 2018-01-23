<?php 

/**
 * The Shortcode
 */
function ebor_icon_and_text_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'layout' => 'top-basic',
				'image' => '',
				'custom_css_class' => '',
				'color' => ''
			), $atts 
		) 
	);
	
	if( 'top-basic' == $layout ){
		
		$colour_output = ( $color ) ? 'style="color: '. $color .';"' : '';
		
		$output = '
			<div class="'. $custom_css_class .'">
				<span class="icon icon-color icon-m mb-5"><i class="'. esc_attr($icon) .'" '. $colour_output .'></i></span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'top-image' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .'">
				<span class="icon icon-img icon-img-s mb-5">
					'. wp_get_attachment_image($image, 'full') .'
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'top-gradient' == $layout ){
		
		$output = '
			<div class="'. $custom_css_class .'">
				<span class="icon text-gradient icon-m mb-5"><i class="'. esc_attr($icon) .'"></i></span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'top-background' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="'. $custom_css_class .'">
				<span class="icon icon-bg icon-s mb-20" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'left-basic' == $layout ){
		
		$colour_output = ( $color ) ? 'style="color: '. $color .';"' : '';
		
		$output = '
			<div class="feature feature-s '. $custom_css_class .'"> 
				<span class="icon icon-color icon-m" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'left-gradient' == $layout ){
		
		$output = '
			<div class="feature feature-s '. $custom_css_class .'"> 
				<span class="icon text-gradient icon-m">
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'left-background' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="feature feature-m '. $custom_css_class .'"> 
				<span class="icon icon-bg icon-s" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'left-image' == $layout ){
		
		$output = '
			<div class="feature feature-m '. $custom_css_class .'"> 
				<span class="icon icon-img icon-img-s">
					'. wp_get_attachment_image($image, 'full') .'
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';	
		
	} elseif( 'top-box' == $layout ){
		
		$colour_output = ( $color ) ? 'style="color: '. $color .';"' : '';
		
		$output = '
			<div class="box box-bg bg-white '. $custom_css_class .'"> 
				<span class="icon icon-m icon-color mb-20" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-box-background' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="box box-bg bg-white '. $custom_css_class .'"> 
				<span class="icon icon-s icon-bg mb-20" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-box-image' == $layout ){
	
		$output = '
			<div class="box box-bg bg-white '. $custom_css_class .'"> 
				<span class="icon icon-img icon-img-s mb-20">
					'. wp_get_attachment_image($image, 'full') .'
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-border' == $layout ){
		
		$colour_output = ( $color ) ? 'style="color: '. $color .';"' : '';
		
		$output = '
			<div class="box border '. $custom_css_class .'"> 
				<span class="icon icon-m icon-color mb-20" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-border-background' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="box border '. $custom_css_class .'"> 
				<span class="icon icon-s icon-bg mb-20" '. $colour_output .'>
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-border-image' == $layout ){
	
		$output = '
			<div class="box border '. $custom_css_class .'"> 
				<span class="icon icon-img icon-img-s mb-20">
					'. wp_get_attachment_image($image, 'full') .'
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-color' == $layout ){
		
		$colour_output = ( $color ) ? 'style="background-color: '. $color .';"' : '';
		
		$output = '
			<div class="box box-bg inverse-text '. $custom_css_class .'" '. $colour_output .'> 
				<span class="icon icon-m mb-20">
					<i class="'. esc_attr($icon) .'"></i>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'side-number' == $layout ){
		
		$colour_output = ( $color ) ? 'style="color: '. $color .'; border-color: '. $color .';"' : '';
		
		$output = '
			<div class="feature feature-m '. $custom_css_class .'"> 
				<span class="icon icon-border icon-xs" '. $colour_output .'>
					<span class="number">'. $icon .'</span>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	} elseif( 'top-number' == $layout ){
		
		$colour_output = ( $color ) ? 'style="color: '. $color .'; border-color: '. $color .';"' : '';
		
		$output = '
			<div class="'. $custom_css_class .'"> 
				<span class="icon icon-border icon-xs mb-20" '. $colour_output .'>
					<span class="number">'. $icon .'</span>
				</span>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'creatink_icon_and_text_block', 'ebor_icon_and_text_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_and_text_block_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Icon and Text", 'creatink'),
			"base" => "creatink_icon_and_text_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'creatink'),
					"param_name" => "layout",
					'holder' => 'div',
					"value" => array(
						'Top Icon Basic Layout'             => 'top-basic',
						'Top Icon Image Layout'             => 'top-image',
						'Top Icon Gradient Layout'          => 'top-gradient',
						'Top Icon Background Layout'        => 'top-background',
						'Left Icon Basic Layout'            => 'left-basic',
						'Left Icon Image Layout'            => 'left-image',
						'Left Icon Gradient Layout'         => 'left-gradient',
						'Left Icon Background Layout'       => 'left-background',
						'Top Icon Box Layout'               => 'top-box',
						'Top Icon Box Background Layout'    => 'top-box-background',
						'Top Icon Box Image Layout'         => 'top-box-image',
						'Top Icon Border Layout'            => 'top-border',
						'Top Icon Border Background Layout' => 'top-border-background',
						'Top Icon Border Image Layout'      => 'top-border-image',
						'Top Icon Box Color Layout'         => 'top-color',
						'Side Number'                       => 'side-number',
						'Top Number'                        => 'top-number',
					)
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Icon", 'creatink'),
					"param_name" => "icon",
					"value" => $icons
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image", 'creatink'),
					"param_name" => "image"
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Icon Colour", 'creatink'),
					"param_name" => "color",
					'description' => 'Leave blank for default colour, make selection for custom colour',
					'value' => ''
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'creatink'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_and_text_block_shortcode_vc' );