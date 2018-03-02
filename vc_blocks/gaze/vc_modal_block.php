<?php 

/**
 * The Shortcode
 */
function ebor_modal_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'description'      => 'Close',
				'button_text'      => 'Content Modal',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$id = sanitize_title( $title );
	
	$output = '
		<a href="#" class="'. $custom_css_class.' btn btn-md btn-dark btn-fill mt-10" data-toggle="modal" data-target="#'. $id .'">
			<span>'. $button_text .'</span>
		</a>
		
		<div class="'. $custom_css_class .' modal fade" id="'. $id .'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">'. $title .'</h4>
					</div>
					
					<div class="modal-body">'. do_shortcode( $content ) .'</div>
					
					<div class="modal-footer">
						<a class="btn btn-md btn-color btn-fill" data-dismiss="modal"><span>'. $description .'</span></a>
					</div>
					
				</div>
			</div>
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_modal_block', 'ebor_modal_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_block_shortcode_vc() {
	
	vc_map( 
		array(
			"icon"        => 'gaze-vc-block',
			"name"        => esc_html__( "Modal", 'gaze' ),
			"base"        => "gaze_modal_block",
			"category"    => esc_html__( 'Gaze WP Theme', 'gaze' ),
			'description' => 'modal elements for modals.',
			"params"      => array(
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Title", 'gaze' ),
					"param_name" => "title",
					'holder'     => 'div'
				),
				array(
					"type"       => "textarea_html",
					"heading"    => esc_html__( "Content", 'gaze' ),
					"param_name" => "content",
					'holder'     => 'div'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Open Button Text", 'gaze' ),
					"param_name"  => "button_text",
					'value'       => 'Content Modal'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Close Button Text", 'gaze' ),
					"param_name"  => "description",
					'value'       => 'Close'
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra CSS Class Name", 'gaze'),
					"param_name"  => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_modal_block_shortcode_vc' );