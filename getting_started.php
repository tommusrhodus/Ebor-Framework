<?php

if(!( function_exists('ebor_getting_started_add_page') )){
	function ebor_getting_started_add_page(){
		add_theme_page(
			esc_html__('Getting Started', 'ebor_framework'),
			esc_html__('Getting Started', 'ebor_framework'),
			'manage_options',
			'ebor_framework-getting-started',
			'ebor_getting_started_page'
		);
	}
	add_action('admin_menu', 'ebor_getting_started_add_page');
}

if(!( function_exists('ebor_start_load_admin_scripts') )){
	function ebor_start_load_admin_scripts() {
	
		// Load styles only on our page
		global $pagenow;
		if( 'themes.php' != $pagenow )
			return;
	
		/**
		 * Getting Started scripts and styles
		 *
		 * @since 1.0
		 */
		wp_enqueue_style('ebor_framework-getting-started', plugins_url( '/css/getting-started-page.css' , __FILE__ ) );
		wp_enqueue_script('ebor_framework-getting-started', plugins_url( '/js/getting-started-page.js' , __FILE__ ) );
	}
	add_action( 'admin_enqueue_scripts', 'ebor_start_load_admin_scripts' );
}

/**
 * Outputs the markup used on the theme license page.
 *
 * since 1.0.0
 */
if(!( function_exists('ebor_getting_started_page') )){
	function ebor_getting_started_page(){
	
		/**
		 * Retrieve help file and theme update changelog
		 *
		 * since 1.0.0
		 */
	
		// Theme info
		$theme = wp_get_theme();
		$theme_ids = array_flip(array(
			'Acomb' => '100001621',
			'Gallery' => '100003989',
			'Morello' => '100003158',
			'Partner' => '100002822',
			'Ryla' => '100003026',
			'Peekskill' => '100002335',
			'Fulford' => '100001521',
			'Somnus' => '100001287',
			'Lydia' => '100000857',
			'Padre' => '100000235',
			'Hygge' => '100000091',
			'Foundry' => '10248',
			'Kwoon' => '9490',
			'Union' => '9214',
			'Huntington' => '9128',
			'LaunchKit' => '8951',
			'Logic' => '8864',
			'Lumos' => '8132',
			'Meetup' => '7805',
			'Uber' => '7910',
			'Keepsake' => '7587',
			'Queens' => '7283',
			'Expose' => '7499',
			'Finch' => '7233',
			'Pivot' => '7131',
			'Machine' => '7971',
			'Malory' => '100001673',
			'Hive' => '100003285',
			'Pillar' => '100004468'
		));
		$this_id = array_search($theme['Name'], $theme_ids);
		
		$my_allowed = wp_kses_allowed_html( 'post' );
		$my_allowed['iframe'] = array(
			'src'             => array(),
			'height'          => array(),
			'width'           => array(),
			'frameborder'     => array(),
			'allowfullscreen' => array(),
		);
	?>
	
	<div class="wrap getting-started">
		<h2 class="notices"></h2>
		<div class="intro-wrap">
			<img class="theme-image" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" alt="" />
			<div class="intro">
				<h3><?php printf( esc_html__( 'Getting started with %1$s v%2$s', 'ebor_framework' ), $theme['Name'], $theme['Version'] ); ?></h3>
	
				<h4><?php printf( esc_html__( 'Thanks for purchasing %1$s. You will find everything you need to get started setting up your site below.', 'ebor_framework' ), $theme['Name'] ); ?></h4>
			</div>
		</div>
	
		<div class="panels">
			<ul class="inline-list">
				<li class="current"><a id="help" href="#"><i class="fa fa-check"></i> <?php esc_html_e( 'Help File', 'ebor_framework' ); ?></a></li>
				<li><a id="plugins" href="#"><i class="fa fa-plug"></i> <?php esc_html_e( 'Plugins', 'ebor_framework' ); ?></a></li>
				<li><a id="support" href="#"><i class="fa fa-life-ring"></i> <?php esc_html_e( 'Troubleshooting', 'ebor_framework' ); ?></a></li>
				<li><a id="updates" href="#"><i class="fa fa-question-circle"></i> <?php esc_html_e( 'FAQ &amp; Support', 'ebor_framework' ); ?></a></li>
			</ul>
	
			<div id="panel" class="panel">
	
				<!-- Help file panel -->
				<div id="help-panel" class="panel-left visible">
					<?php
						$rss = wp_remote_get('https://tommusrhodus.ticksy.com/articles/'. $this_id .'/?print');
						if(!( is_wp_error($rss) )){
							echo wp_kses($rss['body'], $my_allowed);
						} else {
							echo 'Help file currently unavailable, <a href="https://tommusrhodus.ticksy.com/articles/">view directly here</a>.';
						}
					?>
				</div>
	
				<!-- Updates panel -->
				<div id="plugins-panel" class="panel-left">
					<h3><?php esc_html_e( 'Required Plugins', 'ebor_framework' ); ?></h3>
	
					<p><?php esc_html_e( 'Your new theme has a list of required and recommended plugins that it may need to run. To install these visit "appearance => install plugins", if this menu option is unavailable then you have already installed the plugins, well done!', 'ebor_framework' ); ?></p>
	
					<hr/>
					
					<h3>Common Plugins We Recommend</h3>

					<h4>Speeding Things Up</h4>
					<p><strong><a href="https://en-gb.wordpress.org/plugins/zencache/">ZenCache</a></strong></p>
					<p>There are no shortage of caching solutions for WordPress, and this can be a real headache for any novice user as getting a good caching solution up and running can be a very daunting task. Although plugins such as W3 Total Cache offer an incredible amount of options, in most cases its just too much for the average user so we recommend the wonderful free plugin, <a href="https://en-gb.wordpress.org/plugins/zencache/">ZenCache</a>.</p>
					<p><a href="https://en-gb.wordpress.org/plugins/zencache/">ZenCache</a>&nbsp;is pretty much plug-and-play in its operation, requiring minimal setup to get going and its effectiveness is incredible given its simplicity, so to ensure your new site is loading nice and quickly for your would-be visitors, this plugin is a must.</p>
					<p><strong><a href="https://en-gb.wordpress.org/plugins/wp-smushit/">WP Smush</a></strong></p>
					<p>Using optimized images on your site is a must these days, and although the best method for keeping image sizes in check is to only upload well-compressed images,&nbsp;there are plguins around which can help reduce your image sizes with minimal effort.</p>
					<p><a href="https://en-gb.wordpress.org/plugins/wp-smushit/">WP Smush</a>&nbsp;is a drop in solution which basically further compresses your sites images without any loss in quality. It important to note that its no substitute for your usual image compression, so dont expect a 2mb jpg to become a 100kb file by running this plugin, always take care to optimize your media.</p>
					<p>For more tips on how to speed up for you WordPress site, please see <a href="http://www.tommusrhodus.com/speeding-up-wordpress/">Speeding Up WordPress</a>.</p>
					<h3>Search Engine Optimization</h3>
					<p><strong><a href="https://wordpress.org/plugins/wordpress-seo/">Yeost SEO</a></strong></p>
					<p>Although WordPress, when partnered with an SEO optimized theme, is a very powerful thing in the eyes of search engines such as Google – however WordPress doesnt really offer any control of such details like page titles and descriptions so a plugin is needed to gain full control of these details.</p>
					<p>This is where the sublime <a href="https://wordpress.org/plugins/wordpress-seo/">Yeost SEO</a>&nbsp;plugin saves the day. The plugin fills in all the areas which WordPress is lacking by handing over the reigns to you, on top of this the plugin is bundled with a handy SEO checker which scans your posts as your write them, scoring them against your chosen keywords and rating your efforts. This allows you to ensure all your content is lazer-targeted without any fuss.</p>
					<p>We have a more in depth view of WordPress SEO over in our article, <a href="http://www.tommusrhodus.com/boost-your-sites-seo/">Boost Your Sites SEO</a>.</p>
					<h3>Extra Functionality</h3>
					<p><strong><a href="https://en-gb.wordpress.org/plugins/contact-form-7/">Contact Form 7</a></strong></p>
					<p>What’s the point of having a website if no one can contact your through it? If thats a sentiment you agree with then having the ability to quick and easily whip up safe and reliable contact forms is going to be essential. For this task, you cant go wrong with the very popular, and totally free plugin&nbsp;<a href="https://en-gb.wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.</p>
					<p><a href="https://en-gb.wordpress.org/plugins/contact-form-7/">Contact Form 7</a>&nbsp;has been our go-to plugin in our <a href="http://themeforest.net/user/tommusrhodus?ref=TommusRhodus">Premium WordPress Themes</a>&nbsp;for a long time, and the reason is it simply works, and works well. Forms are created with a simple to follow interface, and offer full logic control and many input styles so almost every type of form can be handled with ease. Once you have created your ideal form, your provided a shortcode which can be placed almost anywhere on your site so its the most flexible solution with zero cost to yourself, ideal!</p>
					<p><strong><a href="https://wordpress.org/plugins/intuitive-custom-post-order/">Intuitive Custom Post Order</a></strong></p>
					<p>This plugin is something I feel could easily fit into all WordPress installations as it provides something which, once you know about it, becomes an invaluable tool for controlling your content.&nbsp;<a href="https://wordpress.org/plugins/intuitive-custom-post-order/">Intuitive Custom Post Order</a>&nbsp;lets you re-order ALL of your content such as posts and pages into any order you wish, so if your not happy with the default date-based ordering most themes and plugins provide, you can tweak your content exactly as you wish.</p>
					<p>Not only that, the plugin lets you do the same for you categories and taxonomies, which are usually ordered alphabetically.</p>
					<h3>Taking Things Further</h3>
					<p>Once you have the foundations in place provided by the plugins above, you can continue customization your by viewing some of our other blog posts. Perhaps you want to give your Dashboard a personal touch? Then check out <a href="http://www.tommusrhodus.com/spicing-up-your-wordpress-dashboard/">Spicing Up Your WordPress Dashboard</a>.</p>
					<p>And of course all sites should have a backup solution in place, so if you havn’t done so already, you check check out <a href="http://www.tommusrhodus.com/wp-basics-setting-up-a-backuprestore-system/">our post on that too</a>.</p>

				</div><!-- .panel-left -->
	
				<!-- Support panel -->
				<div id="support-panel" class="panel-left">
					<?php
						$rss = wp_remote_get('https://tommusrhodus.ticksy.com/article/7588/?print');
						if(!( is_wp_error($rss) )){
							echo wp_kses($rss['body'], $my_allowed);
						} else {
							esc_html_e( 'Help file currently unavailable.', 'ebor_framework' );
						}
					?>
				</div><!-- .panel-left support -->
	
				<!-- Updates panel -->
				<div id="updates-panel" class="panel-left">
	
					<h3 id="faq-support"><?php esc_html_e( 'Where do I get support for ', 'ebor_framework' ); echo $theme['Name']; ?>?</h3>
					<h4>Please check the following first:</h4>
					<ol>
						<li>You've read the "Help File" tab for this theme</li>
						<li>You've watched the videos in the "Help File" tab</li>
						<li>You've read through the "troubleshooting" tab for any issues that relate to your needs</li>
						<li>Your question does not relate to theme customisation</li>
						<li>Your question does not relate to a 3rd party plugin we <strong>didn't</strong> recommend</li>
					</ol>
	
					<p><?php
						$signIn = 'http://www.tommusrhodus.com/contact/';
						printf( __( 'If you&apos;ve read through the Help File in the first tab, watched the videos, checked the troubleshooting tab, and still have questions or are experiencing issues, we&apos;re happy to help! Simply <a href="%s">contact us</a> and be sure to leave a descriptive ticket of your issue, along with your site URL.', 'ebor_framework' ), esc_url( $signIn ) );
					?></p>
	
					<p><a href="'http://www.tommusrhodus.com/contact/"><?php esc_html_e( 'Support Forum &rarr;', 'ebor_framework' ); ?></a></p>
	
					<hr/>
				</div><!-- .panel-left updates -->
	
				<div class="panel-right">
	
					<!-- Knowledge base -->
					<div class="panel-aside">
						<h4><?php esc_html_e( 'Visit the Knowledge Base', 'ebor_framework' ); ?></h4>
						<p><?php esc_html_e( 'New to the WordPress world? Our Knowledge Base has written & video tutorials, from installing WordPress to working with themes and more.', 'ebor_framework' ); ?></p>
	
						<a class="button button-primary" href="https://tommusrhodus.ticksy.com/articles/"><?php esc_html_e( 'Visit the Knowledge Base', 'ebor_framework' ); ?></a>
					</div><!-- .panel-aside knowledge base -->
				</div><!-- .panel-right -->
			</div><!-- .panel -->
		</div><!-- .panels -->
	</div><!-- .getting-started -->
	
	<?php
	}
}