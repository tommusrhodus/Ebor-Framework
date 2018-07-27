<?php 

/**
 * The Shortcode
 */
function ebor_modal_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'trigger' => 'button',
				'label'   => 'See Gallery',
			), $atts 
		) 
	);

	$rand = wp_rand(0,10000);

	if($trigger == 'button_white') {
		$output = '
		 	<a href="#" data-toggle="modal" data-target="#myModal'.$rand.'" class="btn btn-full-rounded btn-white">' .$label. '</a>
			<div class="modal inverse-text modal-transparent faded" id="myModal'.$rand.'" tabindex="-1" role="dialog"> <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"></a>
    			<div class="modal-dialog modal-lg" role="document">
      				<div class="modal-content text-center">
     					'. do_shortcode($content) .'
	           		</div>
	        	</div>
		    </div>
		';
	}
	
	if($trigger == 'button') {
		$output = '
		 	<a href="#" data-toggle="modal" data-target="#myModal'.$rand.'" class="btn btn-full-rounded">' .$label. '</a>
			<div class="modal inverse-text modal-transparent faded" id="myModal'.$rand.'" tabindex="-1" role="dialog"> <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"></a>
    			<div class="modal-dialog modal-lg" role="document">
      				<div class="modal-content text-center">
     					'. do_shortcode($content) .'
	           		</div>
	        	</div>
		    </div>
		';
	}

	if($trigger == 'link') {
		$output = '
		 	<a href="#" data-toggle="modal" data-target="#myModal'.$rand.'">' .$label. '</a>
			<div class="modal inverse-text modal-transparent faded" id="myModal'.$rand.'" tabindex="-1" role="dialog"> <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"></a>
    			<div class="modal-dialog modal-lg" role="document">
      				<div class="modal-content text-center">
     					'. do_shortcode($content) .'
	           		</div>
	        	</div>
		    </div>
		';
	}

	return $output;
}
add_shortcode( 'brailie_modal_block', 'ebor_modal_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
			"name" => esc_html__("Modal", 'brailie'),
			"base" => "brailie_modal_block",
			"category" => esc_html__('brailie WP Theme', 'brailie'),
			'description' => 'A flexible modal block',
			"params" => array(
				array(
					"type"       => "dropdown",
					"heading"    => esc_html__("Trigger", 'brailie'),
					"param_name" => "trigger",
					"value"      => array(
						'Button' => 'button',
						'White Button' => 'button_white',
						'Link'   => 'link'
					)
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__("Button/Link Text", 'brailie'),
					"param_name" => "label",
					'holder'     => 'div'
				),
				array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Content", 'brailie'),
	            	"param_name" => "content"
	            ),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_modal_block_shortcode_vc' );