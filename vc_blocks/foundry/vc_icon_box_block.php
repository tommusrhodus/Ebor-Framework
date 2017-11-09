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
				'layout' => 'large-centered',
				'link' => '',
				'target' => ''
			), $atts 
		) 
	);
	
	$before = ( $link ) ? '<a href="'. esc_url($link) .'" target="'. esc_attr($target) .'">' : false;
	$after = ( $link ) ? '</a>' : false;
	
	if( '' == $icon )
		$icon = 'none';
	
	if( 'large-centered' == $layout ){
		$output = '
			<div class="feature feature-1">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'large-centered-bordered' == $layout ) {
		$output = '
			<div class="feature feature-1 bordered">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'large-centered-boxed' == $layout ) {
		$output = '
			<div class="feature feature-1 boxed">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'large-circular' == $layout ) {
		$output = '
			<div class="feature feature-2">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'large-circular-bordered' == $layout ) {
		$output = '
			<div class="feature feature-2 bordered">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'large-circular-boxed' == $layout ) {
		$output = '
			<div class="feature feature-2 boxed">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	}  elseif( 'large-circular-centered' == $layout ) {
		$output = '
			<div class="feature feature-2 filled text-center">
				'. $before .'
			    <div class="text-center">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			        <h5 class="uppercase">'. htmlspecialchars_decode($title) .'</h5>
			    </div>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'small-left' == $layout ) {
		$output = '
			<div class="feature feature-3">
				'. $before .'
			    <div class="left">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			    </div>
			    <div class="right">
			        <h5 class="uppercase mb16">'. htmlspecialchars_decode($title) .'</h5>
			        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    </div>
			    '. $after .'
			</div>
		';
	} elseif( 'small-left-bordered' == $layout ) {
		$output = '
			<div class="feature feature-3 bordered">
				'. $before .'
			    <div class="left">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			    </div>
			    <div class="right">
			        <h5 class="uppercase mb16">'. htmlspecialchars_decode($title) .'</h5>
			        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    </div>
			    '. $after .'
			</div>
		';
	} elseif( 'small-left-boxed' == $layout ) {
		$output = '
			<div class="feature feature-3 boxed">
				'. $before .'
			    <div class="left">
			        <i class="'. esc_attr($icon) .' icon-sm"></i>
			    </div>
			    <div class="right">
			        <h5 class="uppercase mb16">'. htmlspecialchars_decode($title) .'</h5>
			        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    </div>
			    '. $after .'
			</div>
		';
	} elseif( 'large-left' == $layout ) {
		$output = '
			<div class="feature feature-3 feature-4">
				'. $before .'
			    <div class="left">
			        <i class="'. esc_attr($icon) .' icon-lg"></i>
			    </div>
			    <div class="right">
			        <h5 class="uppercase mb16">'. htmlspecialchars_decode($title) .'</h5>
			        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    </div>
			    '. $after .'
			</div>
		';
	} elseif( 'large-left-bordered' == $layout ) {
		$output = '
			<div class="feature feature-3 feature-4 bordered">
				'. $before .'
			    <div class="left">
			        <i class="'. esc_attr($icon) .' icon-lg"></i>
			    </div>
			    <div class="right">
			        <h5 class="uppercase mb16">'. htmlspecialchars_decode($title) .'</h5>
			        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    </div>
			    '. $after .'
			</div>
		';
	} elseif( 'large-left-boxed' == $layout ) {
		$output = '
			<div class="feature feature-3 feature-4 boxed">
				'. $before .'
			    <div class="left">
			        <i class="'. esc_attr($icon) .' icon-lg"></i>
			    </div>
			    <div class="right">
			        <h5 class="uppercase mb16">'. htmlspecialchars_decode($title) .'</h5>
			        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    </div>
			    '. $after .'
			</div>
		';
	} elseif( 'large-left-top' == $layout ) {
		$output = '
			<div class="mb40 mb-xs-24">
				'. $before .'
			    <i class="'. esc_attr($icon) .' icon inline-block mb16 fade-3-4"></i>
			    <h4>'. htmlspecialchars_decode($title) .'</h4>
			    '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			    '. $after .'
			</div>
		';
	} elseif( 'fashion' == $layout ) {
		$output = '
			'. $before .'
			<div class="bg-secondary pt96 pb96 text-center fade-on-hover">
			    <i class="'. esc_attr($icon) .' icon icon-sm mb8"></i>
			    <h6 class="uppercase mb0">'. htmlspecialchars_decode($title) .'</h6>
		    </div>
		    '. $after .'
		';
	}
	
	return $output;
}
add_shortcode( 'foundry_icon_box', 'ebor_icon_box_shortcode' );

/**
 * The VC Functions
 */
function ebor_icon_box_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Icon Box", 'foundry'),
			"base" => "foundry_icon_box",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Click an Icon to choose", 'foundry'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'foundry'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Block Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Icon Box Display Type", 'foundry'),
					"param_name" => "layout",
					"value" => array(
						'Large Centered' => 'large-centered',
						'Large Centered Bordered' => 'large-centered-bordered',
						'Large Centered Boxed' => 'large-centered-boxed',
						'Large Circular' => 'large-circular',
						'Large Circular Bordered' => 'large-circular-bordered',
						'Large Circular Boxed' => 'large-circular-boxed',
						'Large Circular Centered' => 'large-circular-centered',
						'Small Left' => 'small-left',
						'Small Left Bordered' => 'small-left-bordered',
						'Small Left Boxed' => 'small-left-boxed',
						'Large Left' => 'large-left',
						'Large Left Bordered' => 'large-left-bordered',
						'Large Left Boxed' => 'large-left-boxed',
						'Large Left Top' => 'large-left-top',
						'Boxed Icon & Title' => 'fashion',
					)
				),
				array(
					"type" => "textfield",
					"heading" => __("Link URL", 'foundry'),
					"param_name" => "link",
					'description' => 'Leave blank not to link block, enter URL to link entire block'
				),
				array(
					"type" => "textfield",
					"heading" => __("Link Target Attribute", 'foundry'),
					"param_name" => "target"
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_icon_box_shortcode_vc' );