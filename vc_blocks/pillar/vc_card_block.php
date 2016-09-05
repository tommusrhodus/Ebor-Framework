<?php 

/**
 * The Shortcode
 */
function ebor_card_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'type' => 'vertical',
				'link' => '#',
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	if( 'vertical' == $type ){
	
		$output = '
			<div class="card card-1">
				<div class="card__image">
					'. wp_get_attachment_image( $image, 'large' ) .'
				</div>
				<div class="card__body boxed bg--white">
					<div class="card__title">
						<h5>'. htmlspecialchars_decode($title) .'</h5>
					</div>
					<span><em>'. htmlspecialchars_decode($subtitle) .'</em></span>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		';
	
	} elseif( 'square' == $type ){
		
		$output = '
			<div class="project-single-process boxed bg--white">
				<span class="h2">'. htmlspecialchars_decode($subtitle) .'</span>
				<h5>'. htmlspecialchars_decode($title) .'</h5>
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		';
		
	} elseif( 'horizontal' == $type ){
	
		$output = '
			<div class="card card--horizontal card-2">
				<div class="card__image col-sm-5">
					<div class="background-image-holder">
						'. wp_get_attachment_image( $image, 'large' ) .'
					</div>
				</div>
				<div class="card__body col-sm-7	 boxed bg--white">
					<div class="card__title">
						<h4>'. htmlspecialchars_decode($title) .'</h4>
					</div>
					<span><em>'. htmlspecialchars_decode($subtitle) .'</em></span>
					'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
				</div>
			</div>
		';
	
	} elseif( 'vertical-link' == $type ){
	
		$output = '
			<a href="'. esc_url($link) .'">
				<div class="card card-3">
					<div class="card__image">
						'. wp_get_attachment_image( $image, 'large' ) .'
					</div>
					<div class="card__body boxed bg--white">
						<div class="card__title">
							<h5>'. htmlspecialchars_decode($title) .'</h5>
						</div>
						<span><em>'. htmlspecialchars_decode($subtitle) .'</em></span>
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				</div>
			</a>
		';
	
	} elseif( 'horizontal-link' == $type ){
	
		$output = '
			<a href="'. esc_url($link) .'">
				<div class="card card--horizontal card-5">
					<div class="card__image col-sm-7 col-md-8">
						<div class="background-image-holder">
							'. wp_get_attachment_image( $image, 'large' ) .'
						</div>
					</div>
					<div class="card__body col-sm-5 col-md-4 boxed boxed--lg bg--white">
						<div class="card__title">
							<h4>'. htmlspecialchars_decode($title) .'</h4>
						</div>
						<span><em>'. htmlspecialchars_decode($subtitle) .'</em></span>
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				</div>
			</a>
		';
	
	}
	
	return $output;
}
add_shortcode( 'pillar_card', 'ebor_card_shortcode' );

/**
 * The VC Functions
 */
function ebor_card_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
			"name" => esc_html__("Cards", 'pillar'),
			"base" => "pillar_card",
			"category" => esc_html__('pillar WP Theme', 'pillar'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Block Image", 'pillar'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'pillar'),
					"param_name" => "type",
					"value" => array(
						'Vertical Card' => 'vertical',
						'Horizontal Card' => 'horizontal',
						'Square Card' => 'square',
						'Vertical Link Card' => 'vertical-link',
						'Horizontal Link Card' => 'horizontal-link'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'pillar'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'pillar'),
					"param_name" => "subtitle",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Caption Content", 'pillar'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("URL for block (Link Layouts Only)", 'pillar'),
					"param_name" => "link"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_card_shortcode_vc' );