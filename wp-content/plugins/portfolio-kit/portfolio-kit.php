<?php
/*
* Plugin Name: Portfolio Kit
* Description: Simple plugin for Portfolio with different blocks and designs.
* Plugin URI:  https://crumina.net/
* Version: 1.0
* Author:      Crumina Team
* Author URI:  https://crumina.net/
* Text Domain: portfolio-kit
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'PortfolioKit' ) ) :
	/**
	 * Main PortfolioKit Class.
	 *
	 * @class   PortfolioKit
	 * @version 1.0.0
	 */
	class PortfolioKit {
		public $pk_slug = 'project';
		public $pk_taxonomy_slug = 'portfolio';
		public $pk_taxonomy_tag_slug = 'portfolio-tag';
		public $pk_fields_set;
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $_instance = null;

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function instance() {
			// If the single instance hasn't been set, set it now.
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * PortfolioKit Constructor.
		 */
		public function __construct() {

			add_action( 'activated_plugin', array( $this, 'pk_activate' ) );

			$this->define_constants();
			$this->includes();

			register_activation_hook( __FILE__, array($this, 'flush_rewrite_rules' ) );
			register_deactivation_hook( __FILE__, array($this, 'flush_rewrite_rules' ) );

			add_action( 'plugins_loaded', array( $this, 'i18n' ) );
		}

		/**
		 * Flush rewrite rules.
		 */
		public static function flush_rewrite_rules() {
			flush_rewrite_rules();
			update_option( 'rewrite_rules', '' );
		}

		/**
		 * Define FT Constants.
		 */
		private function define_constants() {
			$this->define( 'PK_PLUGIN_FILE', __FILE__ );
			$this->define( 'PK_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'PK_PLUGIN_URL', plugins_url( '', __FILE__ ) );
			$this->define( 'PK_DS', DIRECTORY_SEPARATOR );
			$this->define( 'PK_ABSPATH', dirname( __FILE__ ) . PK_DS );
			$this->define( 'PK_VERSION', '1.0.0' );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param string $name
		 * @param string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public function define_slugs() {
			$option_slug              = get_option( 'portfolio_kit_project_slug', $this->pk_slug );
			$option_taxonomy_slug     = get_option( 'portfolio_kit_portfolio_slug', $this->pk_taxonomy_slug );
			$option_taxonomy_tag_slug = get_option( 'portfolio_kit_portfolio_tag_slug', $this->pk_taxonomy_tag_slug );
			if ( $option_slug != '' ) {
				$this->pk_slug = $option_slug;
			}
			if ( $option_taxonomy_slug != '' ) {
				$this->pk_taxonomy_slug = $option_taxonomy_slug;
			}
			if ( $option_taxonomy_tag_slug != '' ) {
				$this->pk_taxonomy_tag_slug = $option_taxonomy_tag_slug;
			}
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * Fired by `init` action hook.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'portfolio-kit', false, plugin_basename( dirname( PK_PLUGIN_FILE ) ) . '/languages' );
		}

		/**
		 * Includes.
		 */
		private function includes() {
			// Notification
			add_action( 'admin_init', array( $this, 'pk_unyson_notice_check' ) );

			if ( is_admin() ) {
				// Settings fields
				include_once PK_ABSPATH . 'includes/classes/class-pk-fields.php';

				// Main admin class
				include_once PK_ABSPATH . 'includes/classes/class-pk-admin.php';
			}

			// Main frontend class
			include_once PK_ABSPATH . 'includes/classes/class-pk-frontend.php';

			// Elementor
			if ( did_action( 'elementor/loaded' ) ) {
				if ( version_compare( ELEMENTOR_VERSION, '2.0.0', '>=' ) ) {
					include_once PK_ABSPATH . 'includes/classes/class-pk-elementor.php';
				}
			}
		}

		public function pk_unyson_notice_check() {
			global $kc;
			if ( isset( $kc ) ) {
				$kc->add_content_type( 'portfolio-kit' );
			}
			add_action( 'admin_notices', array( $this, 'pk_unyson_notice' ) );
		}

		public function pk_unyson_notice() {
			$pk_main_post = get_option( 'pk_main_post_type', '' );
			if ( $pk_main_post == '' && function_exists( 'fw' ) ) {
				if ( fw_ext( 'portfolio' ) ) {
					?>
                    <div class="notice pk-unyson-notification is-dismissible">
						<?php
						echo wp_sprintf( __( '%s', 'portfolio-kit' ), '<a href="' . admin_url( 'admin.php?page=pk-settings-page' ) . '"><b>Transfer post type from Unyson extension</b></a> ' );
						?>
                    </div>
					<?php
				}
			}
		}

		/**
		 * On plugin activate.
		 */
		public function pk_activate( $plugin ) {
			if ( $plugin == plugin_basename( __FILE__ ) ) {
				//if exists, assign to $cpt_support var
				$cpt_support = get_option( 'elementor_cpt_support' );

				//check if option DOESN'T exist in db
				if ( ! $cpt_support ) {
					$cpt_support = [ 'page', 'post', 'portfolio-kit' ]; //create array of our default supported post types
					update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
				} //if it DOES exist, but portfolio is NOT defined
				else if ( ! in_array( 'portfolio-kit', $cpt_support ) ) {
					$cpt_support[] = 'portfolio-kit'; //append to array
					update_option( 'elementor_cpt_support', $cpt_support ); //update database
				}

				$query = new WP_Query( array(
					'post_type'      => 'fw-portfolio',
					'posts_per_page' => - 1
				) );

				$portfolio_posts = $query->get_posts();
				if ( ! empty( $portfolio_posts ) ) {
					exit( wp_redirect( admin_url( 'admin.php?page=pk-settings-page' ) ) );
				}
			}
		}

		public function get_option( $post_id = 0, $option_name, $default = '' ) {
			if ( $post_id == 0 ) {
				$option_value = get_option( $option_name, null );
			} else {
				$option_value = get_post_meta( $post_id, $option_name, true );
			}

			return ( null == $option_value ) ? $default : $option_value;
		}

		public function get_customizer_option( $option_name, $default = '' ) {
			$option      = '';
			$all_options = get_option( 'seosight_customize_options' );
			if ( ! empty( $all_options ) && $option_name != '' ) {
				if ( isset( $all_options[ $option_name ] ) ) {
					$option = $all_options[ $option_name ];
				}
			}

			return ( '' == $option ) ? $default : $option;
		}

		public function get_template_dir( $filename ) {
			$path_output = PK_ABSPATH . 'includes/views/' . $filename;

			$theme_path = get_template_directory() . '/portfolio-kit/';
			if ( file_exists( $theme_path . $filename ) ) {
				$path_output = $theme_path . $filename;
			}
			if ( is_child_theme() ) {
				$child_theme_path = get_stylesheet_directory() . '/portfolio-kit/';
				if ( file_exists( $child_theme_path . $filename ) ) {
					$path_output = $child_theme_path . $filename;
				}
			}

			return $path_output;
		}
	}

	/**
	 * Returns one instance
	 *
	 * @since 1.0.0
	 * @return object
	 */
	function PortfolioKitMainFunc() {
		return PortfolioKit::instance();
	}

	PortfolioKitMainFunc();
endif;