<?php 

/**
 * Ebor Options Class
 * 
 * A quick and easy way of building theme options.
 * The WordPress Customization API is really simple to use, but if you have a lot of options, it can create a bit of a mess.
 * This class aims to fix that by allowing you to add sections and settings with just 1 function call from your themes functions.php file.
 * 
 * @author TommusRhodus
 * @since 1.0.0
 */
class Ebor_Options {
	
	/**
	 * Define the arrays we'll use for building our options
	 */
	public $panels = array();
	public $sections = array();
	public $settings = array();
	
	/**
	 * Define functions called as this class is initialised.
	 * additional_classes are the custom controls we use in the customiser
	 * build_options runs through all of our added options and turns them into proper customization API options
	 */
	public function __construct(){
		add_action('customize_register', 'ebor_additional_classes', 10 );
		add_action('customize_register', array( $this, 'build_options' ), 15 );
	}
	
	public function add_panel($title, $priority, $description = ''){
		$this->panels[] = array(
			'title' => $title,
			'priority' => $priority,
			'description' => $description
		);	
	}
	
	/**
	 * This function adds customizations sections
	 */
	public function add_section($name, $title, $priority, $panel = '', $description = ''){
		global $wp_version;
		
		if( $wp_version >= 4.0 ){
			$this->sections[] = array(
				'name' => $name,
				'title' => $title,
				'priority' => $priority,
				'description'=> $description,
				'panel' => $panel
			);
		} else {
			$this->sections[] = array(
				'name' => $name,
				'title' => $title,
				'priority' => $priority,
				'description'=> $description
			);
		}
	}
	
	/**
	 * This function adds customization settings
	 */
	public function add_setting($type, $name, $title, $section, $default = '', $priority = '', $options = array()){
		$this->settings[] = array(
			'type' => $type,
			'name' => $name,
			'title' => $title,
			'section' => $section,
			'default' => $default,
			'priority' => $priority,
			'options' => $options
		);
	}
	
	/**
	 * Finally, run through our array and build theme options!
	 */
	public function build_options($wp_customize){
		
		global $wp_version;
		
		/**
		 * Build Panels
		 */
		if( is_array($this->panels) && $wp_version >= 4.0 ){
			foreach( $this->panels as $panel ){
				
				extract($panel);
				
				$wp_customize->add_panel( 
					$title, array(
						'title'          => $title,
						'description'    => $description,
						'priority'       => $priority
					) 
				);
				
			}
		}
		
		/**
		 * Build Sections
		 */
		if( is_array($this->sections) ){
			foreach( $this->sections as $section ){
				
				extract( $section );
				
				$wp_customize->add_section( 
					$name, array(
						'title'          => $title,
						'description'    => $description,
						'priority'       => $priority,
						'panel'          => $panel
					) 
				);
				
			}
		}
		
		/**
		 * Build Settings
		 */
		if( is_array($this->settings) ){
			foreach( $this->settings as $setting ){
				
				extract( $setting );
				
				$wp_customize->add_setting(
					$name, array(
						'default'  => $default,
						'type' => 'option'
					)
				);
				
				if( 'image' == $type ){
					
					$wp_customize->add_control( 
						new WP_Customize_Image_Control(
							$wp_customize, $name, array(
					    		'label'    => $title,
					    		'section'  => $section,
					    		'priority' => $priority
							)
						)
					);
					
				} elseif( 'color' == $type || 'colour' == $type ){
					
					$wp_customize->add_control( 
						new WP_Customize_Color_Control(
							$wp_customize, $name, array(
					    		'label'    => $title,
					    		'section'  => $section,
					    		'priority' => $priority
							)
						)
					);
					
				} elseif( 'checkbox' == $type ){
					
					$wp_customize->add_control( 
						$name, array(
							'type'     => 'checkbox',
				    		'label'    => $title,
				    		'section'  => $section,
				    		'priority' => $priority
						)
					);
					
				} elseif( 'number' == $type ){
					
					$wp_customize->add_control( 
						new Ebor_Customizer_Number_Control(
							$wp_customize, $name, array(
					    		'label'    => $title,
					    		'section'  => $section,
					    		'priority' => $priority
							)
						)
					);
					
				} elseif( 'textarea' == $type ){
					
					$wp_customize->add_control( 
						new Ebor_Customizer_Textarea_Control(
							$wp_customize, $name, array(
					    		'label'    => $title,
					    		'section'  => $section,
					    		'priority' => $priority
							)
						)
					);
					
				} elseif( 'select' == $type ){
					
					$wp_customize->add_control( 
						$name, array(
							'type'     => 'select',
				    		'label'    => $title,
				    		'section'  => $section,
				    		'priority' => $priority,
				    		'choices' => $options
						)
					);
					
				} elseif( 'range' == $type ){
					
					$wp_customize->add_control( 
						new Ebor_Customizer_Range_Control(
							$wp_customize, $name, array(
					    		'label'    => $title,
					    		'section'  => $section,
					    		'priority' => $priority,
					    		'choices' => $options
							)
						)
					);
					
				} elseif( 'demo_import' == $type ){
					
					$wp_customize->add_control( 
						new Ebor_Customizer_Demo_Import_control( 
							$wp_customize, $name, array(
							    'label'    => $title,
							    'section'  => $section,
							    'priority' => $priority
							) 
						) 
					);
					
				} else {
					
					$wp_customize->add_control( 
						$name, array(
						    'type' => 'text',
						    'label'    => $title,
						    'section'  => $section,
						    'priority' => $priority
						) 
					);
					
				}
				
			}
		}
		
	}
	
}//end Ebor_Options

if(!( function_exists('ebor_additional_classes') )){
	function ebor_additional_classes(){
		
		class Ebor_Customizer_Range_Control extends WP_Customize_Control {
		    public $type = 'range';
		    public function render_content() {
		    ?>
		        <label>
		        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		        	<input <?php $this->link(); ?> name="<?php echo esc_html( ebor_sanitize_title($this->label) ); ?>" type="range" min="<?php echo $this->choices['min']; ?>" max="<?php echo $this->choices['max']; ?>" step="<?php echo $this->choices['step']; ?>" value="<?php echo intval( $this->value() ); ?>" class="ebor-range" onchange="printValue('<?php echo esc_html( ebor_sanitize_title($this->label) ); ?>')" />
		        	<input type="text" name="<?php echo esc_html( ebor_sanitize_title($this->label) ); ?>" class="ebor-range-output" value="<?php echo intval( $this->value() ); ?>" disabled/>
		        </label>
		    <?php
		    }
		}
		
		class Ebor_Customizer_Textarea_Control extends WP_Customize_Control {
		    public $type = 'textarea';
		    public function render_content() {
		    ?>
		        <label>
		        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		        	<textarea rows="3" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		        </label>
		    <?php
		    }
		}
		
		class Ebor_Customizer_Number_Control extends WP_Customize_Control {
			public $type = 'number';
			public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
				</label>
			<?php
			}
		}
		
		class Ebor_Customizer_Demo_Import_control extends WP_Customize_Control {
			public $type = 'demo-import';
			public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<a href="#" id="demo-import" class="btn button button-primary">Import Demo Data</a>
				</label>
			<?php
			}
		}
		
	}
}