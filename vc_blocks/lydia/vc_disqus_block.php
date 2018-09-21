<?php 

/**
 * The Shortcode
 */
function ebor_disqus_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => ''
			), $atts 
		) 
	);
	
	ob_start();
?>

	<div id="disqus" class="thin">
	  <div id="disqus_thread"></div>
	  <script type="text/javascript">
		    /* * * CONFIGURATION VARIABLES * * */
		    var disqus_shortname = '<?php echo esc_html($id); ?>';
		    
		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function() {
		        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
		        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		    })();
		</script>
	  <noscript>
	  Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a>
	  </noscript>
	</div>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'lydia_disqus_block', 'ebor_disqus_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_disqus_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Disqus Comments", 'lydia'),
			"base" => "lydia_disqus_block",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Disqus Username", 'lydia'),
					"param_name" => "id"
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_disqus_block_shortcode_vc' );