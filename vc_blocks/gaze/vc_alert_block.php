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
	
	if( 'warning' == $type ){
		$output = '<div class="fade in alert alert-warning">'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'danger' == $type ){
		$output = '<div class="fade in alert alert-danger">'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'success' == $type ){
		$output = '<div class="fade in alert alert-success">'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'info' == $type ){
		$output = '<div class="fade in alert alert-info">'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'warningDismiss' == $type ){
		$output = '<div class="fade in alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'dangerDismiss' == $type ){
		$output = '<div class="fade in alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'successDismiss' == $type ){
		$output = '<div class="fade in alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. htmlspecialchars_decode($content) .'</div>';
	} elseif( 'infoDismiss' == $type ){
		$output = '<div class="fade in alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. htmlspecialchars_decode($content) .'</div>';
	}

	return $output;
	
}
add_shortcode( 'gaze_alert_block', 'ebor_alert_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_alert_block_shortcode_vc() {
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Alert Bar", 'gaze' ),
			"base"        => "gaze_alert_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'An alert bar ideal for drawing attention.',
			"params"      => array(
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__( "Alert Content", 'gaze' ),
					"param_name" => "content",
					'holder'     => 'div'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( "Display Type", 'gaze' ),
					'param_name' => 'type',
					'value'      => array(
						'Warning'              => 'warning',
						'Danger'               => 'danger',
						'Success'              => 'success',
						'Info'                 => 'info',
						'Warning With Dismiss' => 'warningDismiss',
						'Danger With Dismiss'  => 'dangerDismiss',
						'Success With Dismiss' => 'successDismiss',
						'Info With Dismiss'    => 'infoDismiss'
					),
					'description' => "Choose a display style for this alert."
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_alert_block_shortcode_vc' );