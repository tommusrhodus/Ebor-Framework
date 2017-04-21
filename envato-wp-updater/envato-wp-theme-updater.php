<?php
/**
 * WP Theme Updater based on the Envato WordPress Toolkit Library and Pixelentity class from ThemeForest forums
 *
 * @package WordPress
 * @author Pixelentity
 * @author Primož Cigler <primoz@proteusnet.com>
 * @since 1.0
 */

if ( ! class_exists( "Envato_WP_Theme_Updater" ) ) {
	class Envato_WP_Theme_Updater {

		protected $username;
		protected $apiKey;
		protected $authors;

		/**
		 * Set the protected properties
		 * @param String $username Envato marketplace username
		 * @param String $apiKey   Generated API key
		 * @param String $authors  Author of the theme, as in the style.css
		 */
		public function __construct( $username, $apiKey, $authors ) {
			// to debug
			// set_site_transient( 'update_themes', null );

			$this->username = $username;
			$this->apiKey   = $apiKey;
			$this->authors  = $authors;

			add_filter( "pre_set_site_transient_update_themes", array( &$this, "check" ) );
		}

		/**
		 * Check for the updates
		 */
		public function check( $updates ) {
			$this->username = apply_filters( "pixelentity_theme_update_username", $this->username );
			$this->apiKey   = apply_filters( "pixelentity_theme_update_apiKey", $this->apiKey );
			$this->authors  = apply_filters( "pixelentity_theme_update_authors", $this->authors );

			if ( $this->authors && ! is_array( $this->authors ) ) {
				$this->authors = array($this->authors);
			}

			if ( !$this->username || ! $this->apiKey || ! isset( $updates->checked ) )
				return $updates;

			if ( ! class_exists( "Envato_Protected_API" ) ) {
				require_once( "class-envato-protected-api.php" );
			}


			$api = new Envato_Protected_API( $this->username,$this->apiKey );
			add_filter( "http_request_args", array( &$this, "http_timeout" ), 10, 1 );
			$purchased = $api->wp_list_themes( true );

			$installed = wp_get_themes();
			$filtered = array();

			foreach ( $installed as $theme ) {
				if ( $this->authors && ! in_array( $theme->{'Author Name'}, $this->authors ) )
					continue;
				$filtered[$theme->Name] = $theme;
			}

			foreach ( $purchased as $theme ) {
				if ( isset( $filtered[$theme->theme_name] ) ) {
					// gotcha, compare version now
					$current = $filtered[$theme->theme_name];
					if ( version_compare( $current->Version, $theme->version, '<' ) ) {
						// bingo, inject the update
						if ( $url = $api->wp_download( $theme->item_id ) ) {
							$update = array(
								"url"         => "http://themeforest.net/item/theme/{$theme->item_id}",
								"new_version" => $theme->version,
								"package"     => $url
							);

							$updates->response[$current->Stylesheet] = $update;
						}
					}
				}
			}

			remove_filter( "http_request_args", array( &$this, "http_timeout" ) );

			return $updates;
		}

		/**
		 * Increase timeout for api request
		 * @param  Array $req
		 * @return Array
		 */
		public function http_timeout( $req ) {
			$req["timeout"] = 300;
			return $req;
		}

		/**
		 * Init the class
		 */
		public static function init( $username = null, $apiKey = null, $authors = null ) {
			new Envato_WP_Theme_Updater( $username, $apiKey, $authors );
		}
	}
}
