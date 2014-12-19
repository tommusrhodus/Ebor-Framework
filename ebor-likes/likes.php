<?php

class eborLikes {

    function __construct() {	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        add_action('publish_post', array(&$this, 'setup_likes'));
        add_action('wp_ajax_ebor-likes', array(&$this, 'ajax_callback'));
		add_action('wp_ajax_nopriv_ebor-likes', array(&$this, 'ajax_callback'));
        add_shortcode('ebor_likes', array(&$this, 'shortcode'));
	}
	
	function enqueue_scripts(){
	    $options = get_option( 'ebor_likes_settings' );
		if( !isset($options['disable_css']) ) $options['disable_css'] = '0';
		
		if(!$options['disable_css']) wp_enqueue_style( 'ebor-likes', plugins_url( '/styles/ebor-likes.css', __FILE__ ) );
		
		wp_enqueue_script( 'ebor-likes', plugins_url( '/scripts/ebor-likes.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'jquery' );
		
		wp_localize_script('ebor-likes', 'ebor', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
        
		wp_localize_script( 'ebor-likes', 'ebor_likes', array('ajaxurl' => admin_url('admin-ajax.php')) );
	}
	
	function setup_likes( $post_id ) {
		if(!is_numeric($post_id)) return;
	
		add_post_meta($post_id, '_ebor_likes', '0', true);
	}
	
	function ajax_callback($post_id){

		$options = get_option( 'ebor_likes_settings' );
		if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '0';
		if( !isset($options['add_to_pages']) ) $options['add_to_pages'] = '0';
		if( !isset($options['add_to_other']) ) $options['add_to_other'] = '0';
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';

		if( isset($_POST['likes_id']) ) {
		    // Click event. Get and Update Count
			$post_id = str_replace('ebor-likes-', '', $_POST['likes_id']);
			echo $this->like_this($post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'update');
		} else {
		    // AJAXing data in. Get Count
			$post_id = str_replace('ebor-likes-', '', $_POST['post_id']);
			echo $this->like_this($post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'get');
		}
		
		exit;
	}
	
	function like_this($post_id, $zero_postfix = false, $one_postfix = false, $more_postfix = false, $action = 'get'){
		if(!is_numeric($post_id)) return;
		$zero_postfix = strip_tags($zero_postfix);
		$one_postfix = strip_tags($one_postfix);
		$more_postfix = strip_tags($more_postfix);		
		
		switch($action) {
		
			case 'get':
				$likes = get_post_meta($post_id, '_ebor_likes', true);
				if( !$likes ){
					$likes = 0;
					add_post_meta($post_id, '_ebor_likes', $likes, true);
				}
				
				if( $likes == 0 ) { $postfix = $zero_postfix; }
				elseif( $likes == 1 ) { $postfix = $one_postfix; }
				else { $postfix = $more_postfix; }
				
				return '<span class="ebor-likes-count">'. $likes .'</span> <span class="ebor-likes-postfix">'. $postfix .'</span>';
				break;
				
			case 'update':
				$likes = get_post_meta($post_id, '_ebor_likes', true);
				if( isset($_COOKIE['ebor_likes_'. $post_id]) ) return $likes;
				
				$likes++;
				update_post_meta($post_id, '_ebor_likes', $likes);
				setcookie('ebor_likes_'. $post_id, $post_id, time()*20, '/');
				
				if( $likes == 0 ) { $postfix = $zero_postfix; }
				elseif( $likes == 1 ) { $postfix = $one_postfix; }
				else { $postfix = $more_postfix; }
				
				return '<span class="ebor-likes-count">'. $likes .'</span> <span class="ebor-likes-postfix">'. $postfix .'</span>';
				break;
		
		}
	}
	
	function shortcode( $atts ){
		extract( shortcode_atts( array(
		), $atts ) );
		
		return $this->do_likes();
	}
	
	function do_likes(){
		global $post;

        $options = get_option( 'ebor_likes_settings' );
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';
		
		$output = $this->like_this($post->ID, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix']);
  
  		$class = 'ebor-likes';
  		$title = __('Like this', 'ebor');
		if( isset($_COOKIE['ebor_likes_'. $post->ID]) ){
			$class = 'ebor-likes active';
			$title = __('You already like this', 'ebor');
		}
		
		return '<a href="#" class="'. $class .'" id="ebor-likes-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}
	
}
global $ebor_likes;
$ebor_likes = new eborLikes();

/**
 * Template Tag
 */
function ebor_likes(){
	global $ebor_likes;
    echo $ebor_likes->do_likes(); 
}