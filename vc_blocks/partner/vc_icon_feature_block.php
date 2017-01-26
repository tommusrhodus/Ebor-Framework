<?php 

/**
 * The Shortcode
 */
function ebor_icon_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'layout' => 'standard',
				'link' => '',
				'target' => ''
			), $atts 
		) 
	);
	
	$before = ( $link ) ? '<a href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' : false;
	$after = ( $link ) ? '</a>' : false;
	
	if( 'standard' == $layout ){
		
		$output = '
			<div class="icon-feature">
				'. $before .'
				<div class="icon-feature__title">
					<i class="'. esc_attr($icon) .'"></i>
					<h4>'. htmlspecialchars_decode($title) .'</h4>
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				'. $after .'
			</div>
		';
	
	} elseif( 'boxed' == $layout ){
		
		$output = '
			<div class="icon-feature boxed boxed--sm boxed--border">
				'. $before .'
				<div class="icon-feature__title">
					<i class="'. esc_attr($icon) .'"></i>
					<h4>'. htmlspecialchars_decode($title) .'</h4>
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				'. $after .'
			</div>
		';
	
	} elseif( 'large' == $layout ){
		
		$output = '
			<div class="icon-feature text-center">
				'. $before .'
				<div class="icon-feature__title">
					<i class="'. esc_attr($icon) .'"></i>
					<h3>'. htmlspecialchars_decode($title) .'</h3>
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				'. $after .'
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'partner_icon_box', 'ebor_icon_box_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_box_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Icon Box", 'partner'),
			"base" => "partner_icon_box",
			"category" => esc_html__('partner WP Theme', 'partner'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Click an Icon to choose", 'partner'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'partner'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'partner'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Icon Box Display Type", 'partner'),
					"param_name" => "layout",
					"value" => array(
						'Standard' => 'standard',
						'Boxed' => 'boxed',
						'Large' => 'large'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link URL", 'partner'),
					"param_name" => "link",
					'description' => 'Leave blank not to link block, enter URL to link entire block'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link Target Attribute", 'partner'),
					"param_name" => "target"
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_box_shortcode_vc' );