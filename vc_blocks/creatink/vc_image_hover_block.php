<?php 

/**
 * The Shortcode
 */
function ebor_image_hover_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'            => '',
				'image'            => '',
				'lightbox_image'   => '',
				'custom_css_class' => '',
				'layout'           => 'basic',
				'video'            => ''
			), $atts 
		) 
	);
	
	echo '
		
		<div class="tiles">
			<div class="items row">
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay1">
						<a href="#"></a>
						<img src="style/images/art/s1.jpg" alt="" />
						<figcaption>
							<i class="et-link from-top"></i>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay1">
						<a href="#"></a>
						<img src="style/images/art/s2.jpg" alt="" />
						<figcaption>
							<h5 class="from-top">View Project</h5>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay2">
						<a href="#"></a>
						<img src="style/images/art/s3.jpg" alt="" />
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay3">
						<a href="#"></a>
						<img src="style/images/art/s4.jpg" alt="" />
						<figcaption>
							<h4 class="from-top mb-5">Sample Title</h4>
							<p class="from-bottom">Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay4">
						<a href="#"></a>
						<img src="style/images/art/s5.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay5">
						<a href="#"></a>
						<img src="style/images/art/s6.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay6">
						<a href="#"></a>
						<img src="style/images/art/s7.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay7">
						<a href="#"></a>
						<img src="style/images/art/s8.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<div class="meta">Some description</div>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay8">
						<a href="#"></a>
						<img src="style/images/art/s9.jpg" alt="" />
						<figcaption>
							<h5 class="mb-0">Sample Title</h5>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
			</div>
			<!--/.row -->
		</div>
		
		<div class="tiles">
			<div class="items row">
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay1 light">
						<a href="#"></a>
						<img src="style/images/art/s1.jpg" alt="" />
						<figcaption>
							<i class="et-link from-top"></i>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay1 light">
						<a href="#"></a>
						<img src="style/images/art/s2.jpg" alt="" />
						<figcaption>
							<h5 class="from-top">View Project</h5>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay2 light">
						<a href="#"></a>
						<img src="style/images/art/s3.jpg" alt="" />
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay3 light">
						<a href="#"></a>
						<img src="style/images/art/s4.jpg" alt="" />
						<figcaption>
							<h4 class="from-top mb-5">Sample Title</h4>
							<p class="from-bottom">Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay4 light">
						<a href="#"></a>
						<img src="style/images/art/s5.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay5 light">
						<a href="#"></a>
						<img src="style/images/art/s6.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay6 light">
						<a href="#"></a>
						<img src="style/images/art/s7.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay7 light">
						<a href="#"></a>
						<img src="style/images/art/s8.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<div class="meta">Some description</div>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay8 light">
						<a href="#"></a>
						<img src="style/images/art/s9.jpg" alt="" />
						<figcaption>
							<h5 class="mb-0">Sample Title</h5>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
			</div>
			<!--/.row -->
		</div>
		
		<div class="tiles">
			<div class="items row">
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay1 color">
						<a href="#"></a>
						<img src="style/images/art/s1.jpg" alt="" />
						<figcaption>
							<i class="et-link from-top"></i>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay1 color">
						<a href="#"></a>
						<img src="style/images/art/s2.jpg" alt="" />
						<figcaption>
							<h5 class="from-top">View Project</h5>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay2 color">
						<a href="#"></a>
						<img src="style/images/art/s3.jpg" alt="" />
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay3 color">
						<a href="#"></a>
						<img src="style/images/art/s4.jpg" alt="" />
						<figcaption>
							<h4 class="from-top mb-5">Sample Title</h4>
							<p class="from-bottom">Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay4 color">
						<a href="#"></a>
						<img src="style/images/art/s5.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay5 color">
						<a href="#"></a>
						<img src="style/images/art/s6.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay6 color">
						<a href="#"></a>
						<img src="style/images/art/s7.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<p>Some description</p>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay7 color">
						<a href="#"></a>
						<img src="style/images/art/s8.jpg" alt="" />
						<figcaption>
							<h4 class="mb-5">Sample Title</h4>
							<div class="meta">Some description</div>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
				<div class="item col-xs-6 col-sm-6 col-md-4">
					<figure class="overlay overlay8 color">
						<a href="#"></a>
						<img src="style/images/art/s9.jpg" alt="" />
						<figcaption>
							<h5 class="mb-0">Sample Title</h5>
						</figcaption>
					</figure>
				</div>
				<!--/column -->
			</div>
			<!--/.row -->
		</div>
		<!-- /.tiles -->
		
	';
	
	$src[0] = '';
	
	if( 'basic' == $layout ){
		
		$src = wp_get_attachment_image_src($lightbox_image, 'full');
		
		$output = '
			<div class="'. $custom_css_class .' light-gallery">
				<figure class="overlay overlay1">
					<a href="'. $src[0] .'" class="lightbox-this"></a> 
					'. wp_get_attachment_image($image, 'large') .'
					<figcaption>
						<h5 class="from-top mb-0">'. $title .'</h5>
					</figcaption>
				</figure>
			</div>
		';
	
	}

	return $output;
}
add_shortcode( 'creatink_image_hover_block', 'ebor_image_hover_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_image_hover_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'creatink-vc-block',
			"name" => esc_html__("Image Hover", 'creatink'),
			"base" => "creatink_image_hover_block",
			"category" => esc_html__('creatink WP Theme', 'creatink'),
			'description' => 'lightbox elements for lightboxs.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Display type", 'creatink'),
					"param_name" => "layout",
					"value" => array(
						'Image' => 'basic',
						'Vimeo Video' => 'vimeo',
						'YouTube Video' => 'youtube',
						'Google Map' => 'map',
						'Image & Caption' => 'caption'
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Initial Image", 'creatink'),
					"param_name" => "image"
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Image in Lightbox", 'creatink'),
					"param_name" => "lightbox_image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hover Title", 'creatink'),
					"param_name" => "title",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Video / Google Maps iFrame URL", 'creatink'),
					"param_name" => "video",
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'creatink'),
					"param_name" => "content",
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'creatink'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_hover_block_shortcode_vc' );