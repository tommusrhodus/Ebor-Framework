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
						<div class="box box-bg bg-white">
							<h3 data-days class="icon-color color-blue">0</h3>
							<p>'. $days .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-white">
							<h3 data-hours class="icon-color color-green">0</h3>
							<p>'. $hours .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-white">
							<h3 data-minutes class="icon-color color-pink">0</h3>
							<p>'. $minutes .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-white">
							<h3 data-seconds class="icon-color color-yellow">0</h3>
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
						<div class="box box-bg bg-blue inverse-text">
							<h3 data-days>0</h3>
							<p>'. $days .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-green inverse-text">
							<h3 data-hours>0</h3>
							<p>'. $hours .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-pink inverse-text">
							<h3 data-minutes>0</h3>
							<p>'. $minutes .'</p>
						</div><!--/.box --> 
					</div><!--/column -->
					
					<div class="col-sm-3">
						<div class="box box-bg bg-yellow inverse-text">
							<h3 data-seconds>0</h3>
							<p>'. $seconds .'</p>
						</div><!--/.box --> 
					</div><!--/column --> 
				
				</div><!-- /.row --> 
			</div><!--/.countdown --> 
		';
	
	} else {
	
		$output = '
			<div class="countdown '. $custom_css_class .'" data-date="'. $intro .'">
				<div class="row discs inverse-text">
				
					<div class="col-sm-6 col-md-3">
						<div class="disc disc-blue">
							<div class="text">
								<h3 data-days>0</h3>
								<p>'. $days .'</p>
							</div>
						</div>
					</div><!-- /column -->
					
					<div class="col-sm-6 col-md-3">
						<div class="disc disc-green">
							<div class="text">
								<h3 data-hours>0</h3>
								<p>'. $hours .'</p>
							</div>
						</div>
					</div><!-- /column -->
					
					<div class="col-sm-6 col-md-3">
						<div class="disc disc-yellow">
							<div class="text">
								<h3 data-minutes>0</h3>
								<p>'. $minutes .'</p>
							</div>
						</div>
					</div><!-- /column -->
					
					<div class="col-sm-6 col-md-3">
						<div class="disc disc-pink">
							<div class="text">
								<h3 data-seconds>0</h3>
								<p>'. $seconds .'</p>
							</div>
						</div>
					</div><!-- /column --> 
				
				</div><!--/.row --> 
			</div><!--/.countdown -->
		';
	
	}
	
	return $output;
}
add_shortcode( 'creatink_countdown', 'ebor_countdown_shortcode' );

/**
 * The VC Functions
 */
function ebor_countdown_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Countdown Timer", 'creatink'),
			"base" => "creatink_countdown",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display Type", 'creatink'),
					"param_name" => "layout",
					"value" => array(
						'Simple' => 'simple',
						'Boxes' => 'boxes',
						'Boxes Colour' => 'boxes-colour',
						'Coloured Discs' => 'discs'
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Date", 'creatink'),
					"param_name" => "intro",
					"description" => 'Date to count to, formatted Jan 1 2019',
					'value' => 'Jan 1 2019'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'days' text", 'creatink'),
					"param_name" => "days",
					"description" => '"Days" text for your countdown.',
					'value' => 'days'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'hours' text", 'creatink'),
					"param_name" => "hours",
					"description" => '"Hours" text for your countdown.',
					'value' => 'hours'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'minutes' text", 'creatink'),
					"param_name" => "minutes",
					"description" => '"Minutes" text for your countdown.',
					'value' => 'minutes'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("'seconds' text", 'creatink'),
					"param_name" => "seconds",
					"description" => '"Seconds" text for your countdown.',
					'value' => 'seconds'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_countdown_shortcode_vc' );