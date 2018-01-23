<?php 

/**
 * The Shortcode
 */
function ebor_cards_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro' => '',
				'middle' => '',
				'button_text' => '',
				'button_url' => '',
				'custom_css_class' => '',
				'image' => '',
				'layout' => 'social',
				'icon' => ''
			), $atts 
		) 
	);
	
	if( 'social' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' card card-1 boxed boxed--sm boxed--border">
			
			    <div class="card__top">
			        <div class="card__avatar">
			            <a href="'. esc_url($button_url) .'">
			                '. wp_get_attachment_image( $image, 'thumbnail' ) .'
			            </a>
			            <span><strong>'. $intro .'</strong></span>
			        </div>
			        <div class="card__meta">
			            <span>'. $middle .'</span>
			        </div>
			    </div>
			    
			    <div class="card__body">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>

			</div>
		';
	
	} elseif( 'feature' == $layout ) {
		
		$label = ($middle) ? ' <span class="label">'. $middle .'</span>' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' card card-2 text-center">
			    <div class="card__top">
			    	'. $label .'
			        <a href="'. esc_url($button_url) .'">
			            '. wp_get_attachment_image( $image, 'large' ) .'
			        </a>
			    </div>
			    <div class="card__body">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			    <div class="card__bottom text-center"></div>
			</div>
		';	
		
	} elseif( 'small' == $layout ){
		
		$label = ($middle) ? ' <span class="label">'. $middle .'</span>' : false;
		$class = ($label) ? 'feature--featured' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature feature-1 boxed boxed--border '. $class .'">
			    '. do_shortcode(htmlspecialchars_decode($content)) .' '. $label .'
			</div><!--end feature-->
		';
			
	} elseif( 'small-icon' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature feature-2 boxed boxed--border">
			    <span class="icon '. $icon .' color--primary"></span>
			    <div class="feature__body">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			</div><!--end feature-->
		';	
		
	} elseif( 'large-icon' == $layout ){
		
		$label = ($middle) ? ' <span class="label">'. $middle .'</span>' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature feature-3 boxed boxed--lg boxed--border text-center">
			    <span class="icon icon--lg '. $icon .'"></span>
			    '. do_shortcode(htmlspecialchars_decode($content)) .''. $label .'
			</div><!--end feature-->
		';	
		
	} elseif( 'large-icon-colour' == $layout ){
		
		$label = ($middle) ? ' <span class="label">'. $middle .'</span>' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature feature-3 boxed boxed--lg boxed--border text-center">
			    <span class="icon color--primary icon--lg '. $icon .'"></span>
			    '. do_shortcode(htmlspecialchars_decode($content)) .''. $label .'
			</div><!--end feature-->
		';	
		
	} elseif( 'large-button' == $layout ){
		
		$output = '<div class="'. esc_attr($custom_css_class) .' feature feature-4 boxed boxed--lg boxed--border"><span class="icon '. $icon .'"></span>'. do_shortcode(htmlspecialchars_decode($content)) .'</div>';	
		
	} elseif( 'large-button-image' == $layout ){
		
		$output = '<div class="'. esc_attr($custom_css_class) .'">'. wp_get_attachment_image( $image, 'large' ) .'<div class="feature feature-4 boxed boxed--lg boxed--border">'. do_shortcode(htmlspecialchars_decode($content)) .'</div></div>';	
		
	} elseif( 'side-icon' == $layout ){
		
		$label = ($middle) ? ' <span class="label">'. $middle .'</span>' : false;
		$class = ($label) ? 'feature--featured' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature '. $class .' feature-5 boxed boxed--lg boxed--border">
			    <span class="icon '. $icon .' icon--lg"></span>
			    '. $label .'
			    <div class="feature__body">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			</div>
		';	
		
	} elseif( 'small-top-icon' == $layout ){
		
		$output = '<div class="'. esc_attr($custom_css_class) .' feature feature-6"><i class="icon--sm '. $icon .' color--primary"></i>'. do_shortcode(htmlspecialchars_decode($content)) .'</div>';	
		
	} elseif( 'small-image' == $layout ){
		
		$label = ($middle) ? ' <span class="label">'. $middle .'</span>' : false;
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature feature-1">
			    '. wp_get_attachment_image( $image, 'large' ) .'
			    <div class="feature__body boxed boxed--border">'. do_shortcode(htmlspecialchars_decode($content)) .''. $label .'</div>
			</div><!--end feature-->
		';	
		
	} elseif( 'image-link' == $layout ){
		
		$output = '
			<a href="'. esc_url($button_url). '" class="'. esc_attr($custom_css_class) .' block">
			    <div class="feature feature-7 boxed text-center imagebg" data-overlay="3">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'large' ) .'
			        </div>
			        <h4 class="pos-vertical-center">'. $intro .'</h4>
			    </div>
			</a>
		';
			
	} elseif( 'rounded' == $layout ){
		
		$output = '<div class="'. esc_attr($custom_css_class) .' feature">'. wp_get_attachment_image( $image, 'large', 0, array('class' => 'border--round') ) .''. do_shortcode(htmlspecialchars_decode($content)) .'</div>';	
		
	} elseif( 'button' == $layout ){
		
		$output = '
			<a href="'. esc_url($button_url). '" class="'. esc_attr($custom_css_class) .' block">
			    <div class="feature boxed boxed--border border--round text-center">
			        <i class="icon--lg '. $icon .'"></i><span class="h5 color--primary">'. $intro .'</span>
			    </div>
			</a>
		';	
		
	} elseif( 'image-large' == $layout ){
		
		$output = '
			<div class="'. esc_attr($custom_css_class) .' feature feature-1">
			    '. wp_get_attachment_image( $image, 'large' ) .'
			    <div class="feature__body boxed boxed--lg boxed--border">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
			</div>
		';	
		
	} elseif( 'large-basic-icon' == $layout ){
		
		$output = '<div class="'. esc_attr($custom_css_class) .' text-block text-center"><i class="icon--lg '. $icon .'"></i>'. do_shortcode(htmlspecialchars_decode($content)) .'</div>';	
	}
	
	return $output;
}
add_shortcode( 'stack_cards', 'ebor_cards_shortcode' );

/**
 * The VC Functions
 */
function ebor_cards_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Features Small", 'stackwordpresstheme'),
			"base" => "stack_cards",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Top Left Avatar Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Top Left Text", 'stackwordpresstheme'),
					"param_name" => "intro",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Top Right / Label Text", 'stackwordpresstheme'),
					"param_name" => "middle",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Image Link URL", 'stackwordpresstheme'),
					"param_name" => "button_url"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Social Layout' => 'social',
						'Feature Layout' => 'feature',
						'Small Basic Layout' => 'small',
						'Small Basic Layout with Image on Top' => 'small-image',
						'Small Basic & Side Icon' => 'small-icon',
						'Featured & Large Icon (Grey)' => 'large-icon',
						'Featured & Large Icon (Colour)' => 'large-icon-colour',
						'Large Padding & Button' => 'large-button',
						'Large Padding, Image & Button' => 'large-button-image',
						'Large Icon on Left' => 'side-icon',
						'Small Basic & Top Icon' => 'small-top-icon',
						'Background Image With Title & Link' => 'image-link',
						'Image with rounded edges & text undernearth' => 'rounded',
						'Icon & Title with link (large button)' => 'button',
						'Large Boxed Layout with Image on Top' => 'image-large',
						'Large Grey Icon' => 'large-basic-icon'
					)
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Click an Icon to choose", 'stackwordpresstheme'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Card Content", 'stackwordpresstheme'),
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
add_action( 'vc_before_init', 'ebor_cards_shortcode_vc' );