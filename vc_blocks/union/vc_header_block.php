<?php 

/**
 * The Shortcode
 */
function ebor_hero_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => '1'
			), $atts 
		) 
	);
	
	ob_start();
	
	$attachments = explode(',', $image);
	
	if(!(is_array($attachments)))
		$attachments[0] = false;
		
	if( '1' == $layout ) :
?>
	
	<section class="header header-1 fullscreen overlay">
		<div class="background-image-holder">
			<?php echo wp_get_attachment_image( $attachments[0], 'full', 0, array('class' => 'background-image') ); ?>
		</div>
	
		<div class="container">
			<div class="row">
				<div class="text-center col-sm-12">
					<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
				</div>
			</div>
		</div>
	</section>
	
<?php elseif( '2' == $layout ) : ?>
	
	<section class="header header-3 overlay-primary parallax">
		<div class="background-image-holder">
			<?php echo wp_get_attachment_image( $attachments[0], 'full', 0, array('class' => 'background-image') ); ?>
		</div>
	
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
				</div>
			</div>
		</div>
	</section>
	
<?php elseif( '3' == $layout ) : ?>
	
	<section class="header header-4 fullscreen burns-effect overlay">
		<div class="image-slider">
			<ul class="slides">
			
				<?php foreach($attachments as $attachment) : ?>
					<li>
						<div class="background-image-holder">
							<?php echo wp_get_attachment_image( $attachment, 'full', 0, array('class' => 'background-image') ); ?>
						</div>
		
						<div class="container">
							<div class="row">
								<div class="col-sm-12 text-center">
									<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach; ?>

			</ul>
		</div>
	</section>
	
<?php else : ?>

	<section class="gallery gallery-1">
		<div class="image-slider">
			<ul class="slides">
			
				<?php foreach($attachments as $attachment) : ?>
					<li>
						<div class="background-image-holder">
							<?php echo wp_get_attachment_image( $attachment, 'full', 0, array('class' => 'background-image') ); ?>
						</div>
		
						<div class="container">
							<div class="row">
								<div class="col-sm-12 text-center">
									<?php echo wpautop(do_shortcode(htmlspecialchars_decode($content))); ?>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach; ?>

			</ul>
		</div>
	</section>
	
<?php
	endif;
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'union_hero', 'ebor_hero_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'union-vc-block',
			"name" => __("Hero Header", 'union'),
			"base" => "union_hero",
			"category" => __('Union WP Theme', 'union'),
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => __("Background Image(s)", 'union'),
					"param_name" => "image",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'union'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Layout", 'union'),
					"param_name" => "layout",
					"value" => array_flip(array(
						'1' => 'Full Height Static',
						'2' => 'Half Height Static',
						'3' => 'Full Height Slideshow',
						'4' => 'Half Height Slideshow'
					))
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_hero_shortcode_vc' );