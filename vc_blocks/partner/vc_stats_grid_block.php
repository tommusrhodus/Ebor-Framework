<?php 

/**
 * The Shortcode
 */
function ebor_stats_grid_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'main_title' => '',
				'icon' => 'icon-compass',
				'title1' => '',
				'content1' => '',
				'title2' => '',
				'content2' => '',
				'title3' => '',
				'content3' => '',
				'title4' => '',
				'content4' => '',
			), $atts 
		) 
	);

	$output = '
		<div class="section-about-principles">
			<div class="row">
				<div class="col-sm-12">
					<div class="boxed boxed--lg bg--dark text-center">
						<h6>'. $main_title .'</h6>
						<i class="icon--partner '. esc_attr($icon) .'"></i>
						<div>
							<div class="col-sm-6 text-center">
								<h1>'. $title1 .'</h1>
								'. wpautop($content1) .'
							</div>
							<div class="col-sm-6 text-center">
								<h1>'. $title2 .'</h1>
								'. wpautop($content2) .'
							</div>
							<div class="col-sm-6 text-center">
								<h1>'. $title3 .'</h1>
								'. wpautop($content3) .'
								</div>
							</div>
							<div class="col-sm-6 text-center">
								<h1>'. $title4 .'</h1>
								'. wpautop($content4) .'
							</div>
						</div><!--end of principles-->
					</div>
				</div>
			</div><!--end of row-->
		</div>
	';

	return $output;
}
add_shortcode( 'partner_stats_grid_block', 'ebor_stats_grid_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_stats_grid_block_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
			"name" => esc_html__("Stats Grid", 'partner'),
			"base" => "partner_stats_grid_block",
			"category" => esc_html__('partner WP Theme', 'partner'),
			'description' => 'Show your stats in a small bordered box',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Main Title", 'partner'),
					"param_name" => "main_title",
					'holder' => 'div'
				),
				array(
					"type" => "ebor_icons",
					"heading" => esc_html__("Click an Icon to choose", 'partner'),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title 1", 'partner'),
					"param_name" => "title1",
					'holder' => 'div'
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Content 1", 'partner'),
					"param_name" => "content1",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title 2", 'partner'),
					"param_name" => "title2",
					'holder' => 'div'
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Content 2", 'partner'),
					"param_name" => "content2",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title 3", 'partner'),
					"param_name" => "title3",
					'holder' => 'div'
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Content 3", 'partner'),
					"param_name" => "content3",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title 4", 'partner'),
					"param_name" => "title4",
					'holder' => 'div'
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Content 4", 'partner'),
					"param_name" => "content4",
					'holder' => 'div'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_stats_grid_block_shortcode_vc' );