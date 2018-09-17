<?php 

/**
 * The Shortcode
 */
function ebor_dribbble_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => '',
				'token' => ''
			), $atts 
		) 
	);

	$output = '
		<div class="shots thumbs owl-dribbble"></div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery.jribbble.setToken("'. esc_js($token) .'");

				jQuery.jribbble.users("'. esc_js($id) .'").shots({per_page: 15}).then(function(shots) {
				  var html = [];
				  
				  jQuery.each(shots, function(i, shot) {
			            html.push(\'<div class="item"><figure>\');
			            html.push(\'<img src="\' + shot.images.normal + \'" \');
			            html.push(\'alt="\' + shot.title + \'"><a href="\' + shot.html_url + \'" class="link-out" target="_blank"><i class="icon-link"></i></a></figure></div>\');
			        });
			
			        jQuery(".shots.thumbs").html(html.join(""));
				});

			});
			jQuery(window).load(function(){
				jQuery(".owl-dribbble").owlCarousel({
				    loop: false,
				    margin: 10,
				    nav: true,
				    navText: ["", ""],
				    dots: false,
				    items: 4,
				    responsive: {
				        0: {
				            items: 1
				        },
				        700: {
				            items: 3
				        },
				        1000: {
				            items: 4
				        }
				    }
				});
			});
		</script>
	';
	
	return $output;
}
add_shortcode( 'kwoon_dribbble_block', 'ebor_dribbble_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_dribbble_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
			"name" => __("Dribbble Feed", 'kwoon'),
			"base" => "kwoon_dribbble_block",
			"category" => __('Kwoon WP Theme', 'kwoon'),
			'description' => 'A swiper of Dribbble images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Username", 'kwoon'),
					"param_name" => "id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'kwoon'),
					"param_name" => "token",
					'description' => 'You’ll need to login to Dribbble and create a Dribbble API application. Fill in the fields and use your web address for the “Website URL” and “Callback URL” fields. Once done click the “Register Application” button and you’ll then see three codes above the form. Grab the “Client Access Token” and paste that above along with your username.'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_dribbble_block_shortcode_vc' );