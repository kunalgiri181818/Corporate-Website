<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Elementor_Seosight_WC_Add_To_Cart extends \Elementor\Widget_Button {

	public function get_name() {
		return 'seosight_wc_add_to_cart';
	}

	public function get_title() {
		return esc_html__( 'Add To Cart', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'elementor-seosight-wc' ];
	}

	protected function _register_controls() {
		
		$product_ids = [];
        $products    = get_posts( [
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'orderby'        => 'title'
        ] );

        if ( $products ) {
            foreach ( $products as $product ) {
                $product_ids[ $product->ID ] = __( $product->post_title );
            }
        }

		$this->start_controls_section(
			'seosight_wc_add_to_cart',
			[
				'label' => esc_html__( 'Add To Cart', 'elementor-seosight' ),
			]
		);

		$this->add_control(
            'product_id',
            [
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label'       => esc_html__( 'Product', 'elementor-seosight' ),
                'description' => esc_html__( 'Input product title to see suggestions', 'elementor-seosight' ),
                'options'     => $product_ids,
            ]
        );

		$this->add_control(
			'show_quantity',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Show Quantity', 'elementor-seosight' ),
				'description' => esc_html__( 'Please note that switching on this option will disable some of the design controls.', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'quantity',
			[
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Quantity', 'elementor-seosight' ),
				'default'   => 1,
				'condition' => [
					'show_quantity!' => 'yes',
				],
				'separator'  => 'before'
			]
		);

		$this->end_controls_section();

		parent::_register_controls();

		$this->update_control(
			'link',
			[
				'type'    => \Elementor\Controls_Manager::HIDDEN,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->update_control(
			'text',
			[
				'default'     => esc_html__( 'Add to Cart', 'elementor-seosight' ),
				'placeholder' => esc_html__( 'Add to Cart', 'elementor-seosight' ),
			]
		);

		$this->update_control(
			'selected_icon',
			[
				'default' => [
					'value'   => 'fas fa-shopping-cart',
					'library' => 'fa-solid',
				],
			]
		);

		$this->update_control(
			'size',
			[
				'condition' => [
					'show_quantity' => '',
				],
			]
		);
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['product_id'] ) ) {
			$product_id = $settings['product_id'];
		} elseif ( wp_doing_ajax() && ! empty( $_POST['post_id'] ) ) {
			$product_id = $_POST['post_id'];
		} else {
			$product_id = get_queried_object_id();
		}

		global $product;
		$product = wc_get_product( $product_id );

		if ( ! empty( $settings['show_quantity'] ) && $settings['show_quantity'] == 'yes' ) {
			$this->render_form_button( $product );
		} else {
			$this->render_ajax_button( $product );
		}
	}

	public function unescape_html( $safe_text, $text ) {
		return $text;
	}

	private function render_ajax_button( $product ) {
		$settings = $this->get_settings_for_display();

		if ( $product ) {
			$product_type = $product->get_type();

			$class = implode( ' ', array_filter( [
				'product_type_' . $product_type,
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			] ) );

			$this->add_render_attribute( 'button',
				[
					'rel'             => 'nofollow',
					'href'            => $product->add_to_cart_url(),
					'data-quantity'   => ( isset( $settings['quantity'] ) ? $settings['quantity'] : 1 ),
					'data-product_id' => $product->get_id(),
					'class'           => $class,
				]
			);

		} elseif ( current_user_can( 'manage_options' ) ) {
			$settings['text'] = esc_html__( 'Please set a valid product', 'elementor-seosight' );
			$this->set_settings( $settings );
		}

		parent::render();
	}

	private function render_form_button( $product ) {
		if ( ! $product && current_user_can( 'manage_options' ) ) {
			echo esc_html__( 'Please set a valid product', 'elementor-seosight' );
			return;
		}

		$text_callback = function() {
			ob_start();
				$this->render_text();

			return ob_get_clean();
		};

		add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
		add_filter( 'woocommerce_product_single_add_to_cart_text', $text_callback );
		add_filter( 'esc_html', [ $this, 'unescape_html' ], 10, 2 );

		ob_start();
			woocommerce_template_single_add_to_cart();
		$form = ob_get_clean();
		
		$form = str_replace( array( 'single_add_to_cart_button', ' button' ), array( 'single_add_to_cart_button elementor-button', '') , $form );
		echo '<div class="woocommerce"><div class="product"><div class="product-details"><div class="product-details-info">' . $form . '</div></div></div></div>';

		remove_filter( 'woocommerce_product_single_add_to_cart_text', $text_callback );
		remove_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
		remove_filter( 'esc_html', [ $this, 'unescape_html' ] );
	}
}