<?php 

/**
 * The Shortcode
 */
function ebor_sharing_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	ob_start();
?>

	<?php
		global $post;
		
		$url[] = '';
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	?>
	
	<div class="row">
	    <div class="col-md-6 col-md-offset-3 text-center">
	    
	        <h6 class="uppercase"><?php echo htmlspecialchars_decode($title); ?></h6>
	        
	        <ul class="social-list list-inline">
	            <li>
	                <a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" onClick="return ebor_tweet()">
	                    <i class="ti-twitter-alt icon icon-sm"></i>
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onClick="return ebor_fb_like()">
	                    <i class="ti-facebook icon icon-sm"></i>
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" onClick="return ebor_pin()">
	                    <i class="ti-pinterest icon icon-sm"></i>
	                </a>
	            </li>
	        </ul>
	        
	    </div>
	</div>
	
	<script type="text/javascript">
		function ebor_fb_like() {
			window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
		function ebor_tweet() {
			window.open('https://twitter.com/share?url=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
		function ebor_pin() {
			window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($url[0]); ?>&description=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
			return false;
		}
	</script>

<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'foundry_sharing', 'ebor_sharing_shortcode' );

/**
 * The VC Functions
 */
function ebor_sharing_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
			"name" => __("Simple Post Sharing", 'foundry'),
			"base" => "foundry_sharing",
			"category" => __('Foundry WP Theme', 'foundry'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Buttons Title", 'foundry'),
					"param_name" => "title"
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_sharing_shortcode_vc' );