<?php
/**
* Plugin Name: Elementor Seosight Widgets
* Description: Seosight widgets for Elemetor
* Plugin URI:  https://crumina.net/
* Version:     2.8.1
* Author:      Crumina Team
* Author URI:  https://crumina.net/
* Text Domain: elementor-seosight
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'ES_PLUGIN_FILE' ) ) {
	define( 'ES_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'ES_PLUGIN_URL' ) ) {
	define( 'ES_PLUGIN_URL', untrailingslashit( plugins_url( '/', ES_PLUGIN_FILE ) ) );
}

if ( ! defined( 'ES_ABSPATH' ) ) {
	define( 'ES_ABSPATH', dirname( ES_PLUGIN_FILE ) . '/' );
}

/**
 * Main Elementor Seosight Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Elementor_Seosight {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Seosight The single instance of the class.
	 */
	private static $_instance = null;

	private $_is_wc_active = false;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Seosight An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
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
		if ( function_exists( 'determine_locale' ) ) {
			$locale = determine_locale();
		} else {
			// @todo Remove when start supporting WP 5.0 or later.
			$locale = is_admin() ? get_user_locale() : get_locale();
		}

		load_textdomain( 'elementor-seosight', WP_LANG_DIR . '/elementor-seosight/elementor-seosight-' . $locale . '.mo' );
		load_plugin_textdomain( 'elementor-seosight', false, plugin_basename( dirname( ES_PLUGIN_FILE ) ) . '/languages' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add widget icons
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_widget_icons']);

		// Add SeoSight Theme Icon pack
		add_filter( 'elementor/icons_manager/native', [ $this, 'add_theme_to_icon_manager']);

		// Add styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'add_widget_styles' ] );

		// Checks if WooCommerce is enabled
		/*if ( true === in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$this->_is_wc_active = true;
		}*/

		// Add Plugin actions
		add_action( 'elementor/elements/categories_registered', [ $this, 'init_categories' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

		// Resize
		require ES_ABSPATH . 'includes/class-es-resize.php';
		
		// Include functions (available in both admin and frontend).
		require ES_ABSPATH . 'includes/conditional-functions.php';

		// Enable support for Post Thumbnails.
		add_image_size( 'seosight-thumbnail-large', 230, 230, true );
		add_image_size( 'seosight-team-slider', 380, 380, true );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-seosight' ),
			'<strong>' . esc_html__( 'Elementor Seosight', 'elementor-seosight' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-seosight' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-seosight' ),
			'<strong>' . esc_html__( 'Elementor Seosight', 'elementor-seosight' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-seosight' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-seosight' ),
			'<strong>' . esc_html__( 'Elementor Seosight', 'elementor-seosight' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-seosight' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Add element category.
	 *
	 * Register new category for the element.
	 *
	 * @since 1.7.12
	 * @access public
	 *
	 * @param string $category_name       Category name.
	 * @param array  $category_properties Category properties.
	 */
	function init_categories( $elements_manager ) {
	    $elements_manager->add_category(
	        'elementor-seosight',
	        [
				'title' => esc_html__( 'Seosight', 'elementor-seosight' ),
	        ]
	    );

	    if ( $this->_is_wc_active ) {
		    $elements_manager->add_category(
		        'elementor-seosight-wc',
		        [
					'title' => esc_html__( 'Seosight WooCommerce', 'elementor-seosight' ),
		        ]
		    );
		}
	}


	/**
	 * Enqueue icons
	 *
	 * Load icons stylesheet for use it in our widgets
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function enqueue_widget_icons() {
		wp_enqueue_style(
			'crum-el-widget-icons',
			ES_PLUGIN_URL . '/assets/css/widget-icons.css',
			array(),
			Elementor_Seosight::VERSION
		);
	}

	public function add_theme_to_icon_manager( $settings ) {
		$json_url = ES_PLUGIN_URL . '/assets/seotheme.json';

		$settings['seotheme'] = [
			'name'          => 'seotheme',
			'label'         => esc_html__( 'SeoSight', 'elementor-seosight' ),
			'url'           => ES_PLUGIN_URL . '/assets/css/seotheme.css',
			'enqueue'       => false,
			'prefix'        => 'seotheme-',
			'displayPrefix' => '',
			'labelIcon'     => 'seotheme-tags',
			'ver'           => '1',
			'fetchJson'     => $json_url,
			'native'        => true,
		];

		return $settings;
	}

	public function add_widget_styles(){
		wp_enqueue_style( 'elementor-seosight', ES_PLUGIN_URL . '/assets/css/styles.css', array(), Elementor_Seosight::VERSION );

		wp_enqueue_script(
			'elementor-seosight-matchheight',
			ES_PLUGIN_URL . '/assets/js/jquery.matchHeight.js',
			array('jquery'),
			Elementor_Seosight::VERSION,
			true
		);

		wp_enqueue_script(
			'elementor-seosight-js',
			ES_PLUGIN_URL . '/assets/js/main.js',
			array('jquery'),
			Elementor_Seosight::VERSION,
			true
		);
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		$widgets_names = [
			'seosight_accordion',
			'seosight_button',
			'seosight_call_to_action',
			'seosight_chartjs',
			'seosight_clients_slider',
			'seosight_contacts',
			'seosight_counter',
			'seosight_dropcaps',
			'seosight_icon',
			'seosight_info_box',
			'seosight_info_box_slider',
			'seosight_info_boxes',
			'seosight_maps',
			'seosight_pie_chart',
			'seosight_portfolio_grid',
			'seosight_post_slider',
			'seosight_posts_block',
			'seosight_pricing_table',
			'seosight_progress_bar',
			'seosight_progress_bars',
			'seosight_promo_block',
			'seosight_share',
			'seosight_social_links',
			'seosight_shifted_image',
			'seosight_single_image',
			'seosight_svg',
			'seosight_team',
			'seosight_team_slider',
			'seosight_testimonial',
			'seosight_testimonial_slider',
			'seosight_timeline_slider',
			'seosight_title',
			'seosight_triple_image',
			'seosight_ul_style',
			'seosight_video',
			'seosight_fw_form',
			'seosight_form',
			'seosight_fw_slider',
			'seosight_pricing_box',
			'seosight_steps'
		];

		if ( $this->_is_wc_active ) {
			array_push( $widgets_names,
				'seosight_wc_add_to_cart',
				'seosight_wc_elements',
				'seosight_wc_product',
				'seosight_wc_product_categories',
				'seosight_wc_product_category',
				'seosight_wc_products'
			);
		}

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		foreach ( $widgets_names as $widget_id ) {
			$file = ES_ABSPATH . 'widgets/' . $widget_id . '.php';
			
			$class_name = 'Elementor_' . str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $widget_id ) ) );

			if ( file_exists( $file ) && ! class_exists( $class_name ) ) {
				// Include Widget file
				require_once( $file );
				
				// Register widget
				if ( class_exists( $class_name ) ) {
					$widgets_manager->register_widget_type( new $class_name() );
				}
			}
		}
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {
		$controls_names = [
		];
		
		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		foreach ( $controls_names as $control_id ) {
			$file = ES_ABSPATH . 'controls/' . $control_id . '.php';
			
			$class_name = 'Control_' . str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $control_id ) ) );

			if ( file_exists( $file ) && ! class_exists( $class_name ) ) {
				// Include Control file
				require_once( $file );
				
				// Register control
				if ( class_exists( $class_name ) ) {
					$controls_manager->register_control( $control_id, new $class_name() );
				}
			}
		}
	}

}

Elementor_Seosight::instance();