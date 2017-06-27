<?php 

/**
 * The Shortcode
 */
function ebor_comments_shortcode( $atts, $content = null ) {
	global $post;
	$commenter = wp_get_current_commenter();
	$custom_comment_form = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
		    'author' => '<div class="row"><div class="col-sm-4"><label>' . esc_html__('Your Name','stack') . ':</label><input type="text" id="author" name="author" placeholder="' . esc_html__('Type name here','stack') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" /></div>',
		    'email'  => '<div class="col-sm-4"><label>' . esc_html__('Email Address','stack') . ':</label><input name="email" type="text" id="email" placeholder="' . esc_html__('you@example.com','stack') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div>',
		    'url'    => '<div class="col-sm-4"><label>' . esc_html__('Your URL','stack') . ':</label><input name="url" type="text" id="url" placeholder="' . esc_html__('example.com','stack') . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" /></div></div>')
		),
		'comment_field' => '<label>' . esc_html__('Comment','stack') . ':</label><textarea name="comment" placeholder="' . esc_html__('Your comment here','stack') . '" id="comment" aria-required="true" rows="4"></textarea>',
		'cancel_reply_link' => esc_html__( 'Cancel' , 'stack' ),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'label_submit' => esc_html__( 'Submit Comment' , 'stack' )
	);
	
	//Gather comments for a specific page/post 
	$comments = get_comments(array(
		'post_id' => $post->ID,
		'status' => 'approve' //Change this to the type of comments to be displayed
	));
	
	ob_start();
?>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			
			<?php if( comments_open() ) : ?>
			
				<div class="comments">
				
					<h3><?php comments_number( esc_html__('0 Comments','stack'), esc_html__('1 Comment','stack'), esc_html__('% Comments','stack') ); ?></h3>
					
					<?php
						echo '<ul id="singlecomments" class="comments__list">';
						wp_list_comments('type=comment&callback=ebor_custom_comment', $comments);
						echo '</ul>';
						paginate_comments_links();
					?>
					
				</div><!--end comments-->
				
				<div class="comments-form">
					<?php comment_form($custom_comment_form); ?>
				</div>
			
			<?php else : ?>
			
				<h3>Please turn on comments from your page settings for this page.</h3>
			
			<?php endif; ?>
			
		</div>
	</div><!--end of row-->
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'stack_comments', 'ebor_comments_shortcode' );

/**
 * The VC Functions
 */
function ebor_comments_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("WP Comments", 'stackwordpresstheme'),
			"base" => "stack_comments",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'show_settings_on_create' => false,
			"params" => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_comments_shortcode_vc' );