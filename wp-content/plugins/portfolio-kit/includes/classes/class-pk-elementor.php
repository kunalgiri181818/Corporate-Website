<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PortfolioKitElementor {
    public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'pk_init_widgets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'init_categories' ) );
    }

	/**
	 * Add element category.
	 *
	 * Register new category for the element.
	 */
	public function init_categories( $elements_manager ) {
	    $elements_manager->add_category(
	        'elementor-portfolio-kit',
	        [
				'title' => esc_html__( 'Portfolio Kit', 'portfolio-kit' ),
	        ]
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
	public function pk_init_widgets() {
		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

		$widgets = array(
			'pk-main',	
			'pk-featured-portfolio',
			'pk-meta'
		);
		foreach ( $widgets as $widget_id ) {
			$file = PK_ABSPATH . 'includes/elementor-widgets/'.$widget_id.'.php';
			$class_name = 'Elementor_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $widget_id ) ) );
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
	 * Render link field
	 */
	public function pk_render_link_field( $url_array, $link_text = '' ) {
		$link_html = '';
		if( isset($url_array['url']) ) {
			if( $link_text == '' ) {
				$link_text = $url_array['url'];
			}

			$link_href = $url_array['url'];
			$link_attr = '';
            $link_attr .= !empty( $url_array['is_external'] ) ? 'target="_blank" ' : '';
            $link_attr .= !empty( $url_array['nofollow'] ) ? 'rel="nofollow" ' : '';
			if( !empty($url_array['custom_attributes']) ) {
				$attr_pairs = explode(',', $url_array['custom_attributes']);
				if( !empty($attr_pairs) ) {
					foreach( $attr_pairs as $attr_pair ) {
						$attr = explode('|', $attr_pair);
						if( count($attr) == 2 ) {
							$link_attr .= $attr[0] . '="' . $attr[1] . '" ';
						}
					}
				}
			}

			$link_html = '<a href="'.esc_url($link_href).'" '.$link_attr.'>'.esc_html($link_text).'</a>';
		}

		return $link_html;
	}
}

return new PortfolioKitElementor();