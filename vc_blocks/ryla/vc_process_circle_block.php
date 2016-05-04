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
				'color' => '#67b7d4'
			), $atts 
		) 
	);
	
	$id = wp_rand(0,1000);
	
	$output = '
		<div class="circle-progress-wrapper bm40 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.0s">
			<div class="circle-progress circle circle'. esc_attr($id) .'"> 
				<strong>'. $title .'</strong> 
			</div>
		</div>

		<script type="text/javascript">
			jQuery(window).load(function() {
				var circle'. esc_attr($id) .' = new ProgressBar.Circle(".circle.circle'. esc_attr($id) .'", {
			        color: "'. $color .'",
			        trailColor: "rgba(0,0,0,0.05)",
				    strokeWidth: 4,
				    trailWidth: 4,
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
add_shortcode( 'ryla_progress_circle', 'ebor_progress_circle_shortcode' );

/**
 * The VC Functions
 */
function ebor_progress_circle_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
			"name" => __("Progress Circle", 'ryla'),
			"base" => "ryla_progress_circle",
			"category" => __('ryla WP Theme', 'ryla'),
			'description' => 'Counter elements for icons.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'ryla'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Progress Value", 'ryla'),
					"param_name" => "percent",
					'holder' => 'div',
					'value' => '0.4',
					'description' => 'Will be converted to a percentage, but please use 0 to 1. E.g: 0.45'
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Colour", 'ryla'),
					"param_name" => "color",
					'value' => '#67b7d4'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_progress_circle_shortcode_vc' );