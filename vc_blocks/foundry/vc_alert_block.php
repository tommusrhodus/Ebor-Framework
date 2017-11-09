<?php 

/**
 * The Shortcode
 */
function ebor_alert_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'warning'
			), $atts 
		) 
	);
	
	if( 'success' == $type ){
		
		$output = '
			<div class="alert alert-success alert-dismissible" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			    </button>
			    '. htmlspecialchars_decode($content) .'
			</div>
		';
		
	} elseif( 'danger' == $type ){
		
		$output = '
			<div class="alert alert-danger alert-dismissible" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			    </button>
			    '. htmlspecialchars_decode($content) .'
			</div>
		';
		
	} elseif( 'warning' == $type ){
		
		$output = '
			<div class="alert alert-warning alert-dismissible" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			    </button>
			    '. htmlspecialchars_decode($content) .'
			</div>
		';
		
	}

	return $output;
}
add_shortcode( 'foundry_alert_block', 'ebor_alert_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_alert_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Alert Bar", 'foundry'),
			"base" => "foundry_alert_block",
			"category" => __('Foundry WP Theme', 'foundry'),
			'description' => 'An alert bar ideal for drawing attention.',
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Alert Content", 'foundry'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					'type' => 'dropdown',
					'heading' => "Display Type",
					'param_name' => 'type',
					'value' => array(
						'Warning' => 'warning',
						'Danger' => 'danger',
						'Success' => 'success'
					),
					'description' => "Choose a display style for this alert."
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_alert_block_shortcode_vc' );