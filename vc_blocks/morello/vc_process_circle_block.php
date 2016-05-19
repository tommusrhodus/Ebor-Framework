<?php 

/**
 * The Shortcode
 */
function ebor_progress_circle_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'percent' => '0.4',
				'color' => '#7bc4e6'
			), $atts 
		) 
	);
	
	$id = wp_rand(0,1000);
	
	$output = '
		<div class="circle-progress-wrapper bm40 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.0s">
			<div class="circle-progress circle circle'. esc_attr($id) .'"> 
				<h4>'. $title .'</h4> 
			</div>
		</div>

		<script type="text/javascript">
			jQuery(window).load(function() {
				var circle'. esc_attr($id) .' = new ProgressBar.Circle(".circle.circle'. esc_attr($id) .'", {
			        color: "'. $color .'",
			        trailColor: "rgba(255,255,255,0.1)",
				    strokeWidth: 2,
				    trailWidth: 2,
				    duration: 4500,
				    easing: "easeInOut",
				    text: {
				        value: "'. esc_js($percent) .'"
				    },
				    step: function(state, bar) {
				        bar.setText((bar.value() * 100).toFixed(0));
				    }
			    });
			
			    circle'. esc_attr($id) .'.animate('. esc_js($percent) .');
			});
		</script>
	';
	return $output;
}
add_shortcode( 'morello_progress_circle', 'ebor_progress_circle_shortcode' );

/**
 * The VC Functions
 */
function ebor_progress_circle_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'morello-vc-block',
			"name" => __("Progress Circle", 'morello'),
			"base" => "morello_progress_circle",
			"category" => __('morello WP Theme', 'morello'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'morello'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Progress Value", 'morello'),
					"param_name" => "percent",
					'holder' => 'div',
					'value' => '0.4',
					'description' => 'Will be converted to a percentage, but please use 0 to 1. E.g: 0.45'
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Colour", 'morello'),
					"param_name" => "color",
					'value' => '#7bc4e6'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_progress_circle_shortcode_vc' );