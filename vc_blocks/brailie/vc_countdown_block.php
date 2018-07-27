<?php 

/**
 * The Shortcode
 */
function ebor_countdown_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'intro'            => 'Jan 1 2019',
				'custom_css_class' => '',
				'days'             => 'days',
				'hours'            => 'hours',
				'minutes'          => 'minutes',
				'seconds'          => 'seconds',
				'layout'           => 'simple'
			), $atts 
		) 
	);
	
	if( 'simple' == $layout ){
	
		$output = '
			<div class="countdown '. $custom_css_class .'" data-date="'. $intro .'">
				<div class="row text-center">
				
					<div class="col-sm-3">
						<h3 data-days>0</h3>
						<p>'. $days .'</p>
					</div><!--/column -->
					
					<div class="col-sm-3">
						<h3 data-hours>0</h3>
						<p>'. $hours .'</p>
					</div><!--/column -->
					
					<div class="col-sm-3">
						<h3 data-minutes>0</h3>
						<p>'. $minutes .'</p>
					</div><!--/column -->
					
					<div class="col-sm-3">
						<h3 data-seconds>0</h3>
						<p>'. $seconds .'</p>
					</div><!--/column --> 
				
				</div><!-- /.row --> 
			</div><!--/.countdown -->
		';
	
	} elseif( 'boxes' == $layout ){
	
		$output = '
			<div class="countdown '. $custom_css_class .'" data-date="'. $intro .'">
				<div class="row text-center">
				
					<div class="col-sm-3">
						<div class="box box-border">
							<h3 data-days>0</h3>
							<p>'. $days .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-border">
							<h3 data-hours>0</h3>
							<p>'. $hours .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-border">
							<h3 data-minutes>0</h3>
							<p>'. $minutes .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-border">
							<h3 data-seconds>0</h3>
							<p>'. $seconds .'</p>
						</div><!--/.box --> 
					</div><!--/column --> 
				
				</div><!-- /.row --> 
			</div><!--/.countdown --> 
		';
	
	} elseif( 'boxes-colour' == $layout ){
	
		$output = '
			<div class="countdown '. $custom_css_class .'" data-date="'. $intro .'">
				<div class="row text-center">
				
					<div class="col-sm-3">
						<div class="box box-bg bg-blue rounded inverse-text">
							<h3 data-days>0</h3>
							<p>'. $days .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-green rounded inverse-text">
							<h3 data-hours>0</h3>
							<p>'. $hours .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-orange rounded inverse-text">
							<h3 data-minutes>0</h3>
							<p>'. $minutes .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-yellow rounded inverse-text">
							<h3 data-seconds>0</h3>
							<p>'. $seconds .'</p>
						</div><!--/.box --> 
					</div><!--/column --> 
				
				</div><!-- /.row --> 
			</div><!--/.countdown --> 
		';
	
	}
	
	return $output;
}
add_shortcode( 'brailie_countdown', 'ebor_countdown_shortcode' );

/**
 * The VC Functions
 */
function ebor_countdown_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Countdown Timer", 'brailie'),
			"base" => "brailie_countdown",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'brailie'),
					"param_name" => "layout",
					"value" => array(
						'Simple' => 'simple',
						'Boxes' => 'boxes',
						'Boxes Colour' => 'boxes-colour'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Date", 'brailie'),
					"param_name" => "intro",
					"description" => 'Date to count to, formatted Jan 1 2019',
					'value' => 'Jan 1 2019'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'days' text", 'brailie'),
					"param_name" => "days",
					"description" => '"Days" text for your countdown.',
					'value' => 'days'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'hours' text", 'brailie'),
					"param_name" => "hours",
					"description" => '"Hours" text for your countdown.',
					'value' => 'hours'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'minutes' text", 'brailie'),
					"param_name" => "minutes",
					"description" => '"Minutes" text for your countdown.',
					'value' => 'minutes'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'seconds' text", 'brailie'),
					"param_name" => "seconds",
					"description" => '"Seconds" text for your countdown.',
					'value' => 'seconds'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'brailie'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_countdown_shortcode_vc' );