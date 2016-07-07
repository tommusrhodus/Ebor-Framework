<?php 

/**
 * The Shortcode
 */
function ebor_menu_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'filter' => 'all'
			), $atts 
		) 
	);
	
	ob_start();
	
	$children = get_term_children( $filter, 'menu_category' );
	
	if( 'all' == $filter ){
		$cats = get_categories('taxonomy=menu_category');
	} elseif( !empty( $children ) && !is_wp_error( $children ) ) {
		$filter = $filter . ',' . implode($children, ',');
		$cats = get_categories('taxonomy=menu_category&include=' . $filter);
	} else {
		$cats = get_categories('taxonomy=menu_category&include=' . $filter);
	}
?>
	
	<div class="tabbed-content text-tabs">
	    <ul class="tabs mb64 mb-xs-24">
	    	
	    	<?php  
	    		$i = 0;
	    		
	    		if( is_array($cats) ){
	    			foreach( $cats as $cat ){
	    				$i++;
	    				
	    				$active = ( $i == 1 ) ? 'active' : '';
	    				
	    				/**
	    				 * Initial query args
	    				 */
	    				$query_args = array(
	    					'post_type' => 'menu',
	    					'posts_per_page' => -1
	    				);
	    				
	    				$filter = $cat->term_id;
	    				
    					if( function_exists( 'icl_object_id' ) ){
    						$filter = (int)icl_object_id( $cat->term_id, 'menu_category', true);
    					}
    					$query_args['tax_query'] = array(
    						array(
    							'taxonomy' => 'menu_category',
    							'field' => 'id',
    							'terms' => $filter,
    							'include_children' => false
    						)
    					);
	    				
	    				/**
	    				 * Finally, here's the query.
	    				 */
	    				$cat_query = new WP_Query( $query_args );
	    				
	    				if(!( 0 == $cat_query->found_posts )){
	    				
		    				echo '
		    					<li class="'. $active .'">
						            <div class="tab-title">
						                <span>'. $cat->name .'</span>
						            </div>
						            <div class="tab-content">
						    ';
	 
			            		if ( $cat_query->have_posts() ) : while ( $cat_query->have_posts() ) : $cat_query->the_post(); 
			            		
			            			get_template_part('loop/content', 'menu');
			            		
			            		endwhile;
			            		else : 
			            			
			            			get_template_part('loop/content', 'none');
			            					
			            		endif;
							
							echo '</div></li>';
						
	    				}
	    				
	    			}	
	    		}
	    	?>
	        
	    </ul>
	</div>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'hive_menu', 'ebor_menu_shortcode' );

/**
 * The VC Functions
 */
function ebor_menu_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'hive-vc-block',
			"name" => esc_html__("Menu", 'hive'),
			"base" => "hive_menu",
			"category" => esc_html__('hive WP Theme', 'hive'),
			"params" => array()
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_menu_shortcode_vc');