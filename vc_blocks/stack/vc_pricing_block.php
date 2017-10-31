<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'price' => '',
				'currency' => '',
				'button_url' => '',
				'button_text' => '',
				'layout' => 'standard',
				'image' => '',
				'label' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	if( 'standard' == $layout ){
		
		$label = ( $label ) ? '<span class="label">'. $label .'</span>' : false;
		$head_class = ( $label ) ? 'boxed--emphasis' : false;
		$button_class = ( $label ) ? 'btn--primary-1' : 'btn--primary';
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' pricing pricing-1 boxed boxed--lg boxed--border '. $head_class .'">
				<h3>'. htmlspecialchars_decode($title) .'</h3>
				<span class="h2"><strong>'. htmlspecialchars_decode($currency) .''. htmlspecialchars_decode($price) .'</strong></span>
				'. $label .'
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				<a class="btn '. $button_class .'" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
			</div><!--end of pricing-->
		';
	
	} elseif( 'text' == $layout ){
		
		$label = ( $label ) ? '<span class="label">'. $label .'</span>' : false;
		$head_class = ( $label ) ? 'boxed--emphasis' : false;
		$button_class = ( $label ) ? 'btn--primary-1' : 'btn--primary';
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' pricing pricing-1 boxed boxed--border boxed--lg text-center '. $head_class .'">
				<h4>'. htmlspecialchars_decode($title) .'</h4>
				<span class="h1"><span class="pricing__dollar">'. htmlspecialchars_decode($currency) .'</span>'. htmlspecialchars_decode($price) .'</span>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				'. $label .'
				<a class="btn '. $button_class .'" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
			</div><!--end pricing-->
		';
	
	} elseif( 'image' == $layout ){
		
		$label = ( $label ) ? '<span class="label">'. $label .'</span>' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' pricing pricing-1 boxed boxed--border boxed--lg text-center">
				<h4>'. htmlspecialchars_decode($title) .'</h4>
					<span class="h1"><span class="pricing__dollar">'. htmlspecialchars_decode($currency) .'</span>'. htmlspecialchars_decode($price) .'</span>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					'. $label .'
					<a class="btn btn--primary-1" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
				</div><!--end pricing-->	
		';
		
	} elseif( 'wide' == $layout ){
		
		$label = ( $label ) ? '<span class="label">'. $label .'</span>' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' pricing pricing-2 boxed boxed--border boxed--lg">
				'. $label .'
				<div class="col-md-6 text-center">
					<h5>'. htmlspecialchars_decode($title) .'</h5>
					<span class="h1"><span class="pricing__dollar">'. htmlspecialchars_decode($currency) .'</span>'. htmlspecialchars_decode($price) .'</span>
					<a class="btn btn--primary" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a>
				</div>
				<div class="col-md-6">
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div><!--end of pricing-->
		';
		
	} elseif( 'list' == $layout ){
		
		$label = ( $label ) ? '<span class="label">'. $label .'</span>' : false;
		$head_class = ( $label ) ? 'bg--primary' : 'bg--secondary';
		$button = ( $button_url ) ? '<ul><li><a class="btn btn--primary" href="'. esc_url($button_url) .'">'. htmlspecialchars_decode($button_text) .'</a></li></ul>' : '';
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' pricing pricing-3 text-center">
				<div class="pricing__head '. $head_class .' boxed">
					'. $label .'
					<h5>'. htmlspecialchars_decode($title) .'</h5>
					<span class="h1"><span class="pricing__dollar">'. htmlspecialchars_decode($currency) .'</span>'. htmlspecialchars_decode($price) .'</span>
				</div>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				'. $button .'
			</div><!--end pricing-->
		';
		
	}

	return $output;
}
add_shortcode( 'stack_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Pricing Table", 'stackwordpresstheme'),
			"base" => "stack_pricing_table",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'stackwordpresstheme'),
					"param_name" => "title",
					'holder' => 'div',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'stackwordpresstheme'),
					"param_name" => "currency"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Price", 'stackwordpresstheme'),
					"param_name" => "price"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'stackwordpresstheme'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'stackwordpresstheme'),
					"param_name" => "button_url"
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'stackwordpresstheme'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Pricing Table Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Standard' => 'standard',
						'Text' => 'text',
						'Image' => 'image',
						'Wide' => 'wide',
						'List' => 'list',
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Label Text", 'stackwordpresstheme'),
					"param_name" => "label"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=7Ceg4W0RPOc">Video Tutorial</a></div>',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );