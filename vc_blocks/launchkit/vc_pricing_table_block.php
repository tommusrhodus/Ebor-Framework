<?php 

/**
 * The Shortcode
 */
function ebor_pricing_table_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'text' => '',
				'currency' => '$',
				'amount' => '3',
				'button_url' => '',
				'detail' => '',
				'feature' => 'no',
				'icon' => 'none',
				'button_text' => '',
				'layout' => 'small'
			), $atts 
		) 
	);
	
	$lines = explode( ',', $text );
	
	ob_start();
	
	if('small' == $layout) :
?>
	
	<div class="pricing pricing-4">
		<div class="pricing-option text-center">
			<h6><?php echo htmlspecialchars_decode($title); ?></h6>
			<div class="price-container">
				<span class="dollar"><?php echo htmlspecialchars_decode($currency); ?></span>
				<span class="price"><?php echo htmlspecialchars_decode($amount); ?></span>
			</div>
			<?php echo do_shortcode(htmlspecialchars_decode($content)); ?>
			<a href="<?php echo esc_url($button_url); ?>" class="btn btn-filled"><?php echo htmlspecialchars_decode($detail); ?></a>	
		</div>
	</div>	
	
<?php else : ?>
	
	<div class="pricing pricing-3">
		<a href="<?php echo esc_url($button_url); ?>">
			<div class="pricing-option text-center <?php echo esc_attr($feature); ?>">
				<?php if(!( 'none' == $icon )) : ?>
				<i class="icon-<?php echo esc_attr(str_replace('icon-', '', $icon)); ?>"></i>
				<?php endif; ?>
				<h6><?php echo htmlspecialchars_decode($title); ?></h6>
				<div class="price-container">
					<span class="dollar"><?php echo htmlspecialchars_decode($currency); ?></span>
					<span class="price"><?php echo htmlspecialchars_decode($amount); ?></span>
					<span class="terms"><?php echo htmlspecialchars_decode($detail); ?></span>
				</div>
				<?php echo do_shortcode(htmlspecialchars_decode($content)); ?>
			</div>
		</a>
	</div>
			
<?php
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'launchkit_pricing_table', 'ebor_pricing_table_shortcode' );

/**
 * The VC Functions
 */
function ebor_pricing_table_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
			"name" => __("Pricing table", 'launchkit'),
			"base" => "launchkit_pricing_table",
			"category" => __('LaunchKit WP Theme', 'launchkit'),
			"params" => array(
				array(
					"type" => "ebor_icons",
					"heading" => __("Click an Icon to choose", 'launchkit'),
					"param_name" => "icon",
					"value" => array_values(ebor_get_icons()),
					'holder' => 'div',
					'description' => 'Type "none" or leave blank to hide icons.'
				),
				array(
					"type" => "textfield",
					"heading" => __("Pricing Table URL", 'launchkit'),
					"param_name" => "button_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Currency", 'launchkit'),
					"param_name" => "currency",
					"value" => '$',
				),
				array(
					"type" => "textfield",
					"heading" => __("Amount", 'launchkit'),
					"param_name" => "amount",
					"value" => '3',
				),
				array(
					"type" => "textfield",
					"heading" => __("Detail", 'launchkit'),
					"param_name" => "detail",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'launchkit'),
					"param_name" => "title",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'launchkit'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Pricing Table Layout", 'launchkit'),
					"param_name" => "layout",
					"value" => array_flip(array(
						'small' => 'Small Pricing Table',
						'large' => 'Border Pricing Table'
					))
				),
				array(
					"type" => "dropdown",
					"heading" => __("Featured?", 'launchkit'),
					"param_name" => "feature",
					"value" => array_flip(array(
						'no' => 'No',
						'active' => 'Yes'
					))
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_pricing_table_shortcode_vc' );