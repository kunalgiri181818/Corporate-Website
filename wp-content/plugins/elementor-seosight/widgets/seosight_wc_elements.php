<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_WC_Elements extends \Elementor\Widget_Base {

    public function get_name() {
        return 'seosight_wc_elements';
    }

    public function get_title() {
        return esc_html__( 'WooCommerce Pages', 'elementor-seosight' );
    }

    public function get_icon() {
        return 'fa fa-code';
    }

    public function get_categories() {
        return [ 'elementor-seosight-wc' ];
    }

    protected function _register_controls() {

        $product_ids = [];
        $products = get_posts( [
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
            'seosight_wc_elements',
            [
                'label' => esc_html__( 'WooCommerce Pages', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'element',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Page', 'elementor-seosight' ),
                'options' => [
                    'woocommerce_cart'           => esc_html__( 'Cart Page', 'elementor-seosight' ),
                    'woocommerce_checkout'       => esc_html__( 'Checkout Page', 'elementor-seosight' ),
                    'woocommerce_order_tracking' => esc_html__( 'Order Tracking Form', 'elementor-seosight' ),
                    'woocommerce_my_account'     => esc_html__( 'My Account', 'elementor-seosight' ),
                    'product_page'               => esc_html__( 'Single Product Page', 'elementor-seosight' ),
                ],
                'default' => 'woocommerce_cart'
            ]
        );

        $this->add_control(
            'product_id',
            [
                'type'      => \Elementor\Controls_Manager::SELECT2,
                'label'     => esc_html__( 'Product', 'elementor-seosight' ),
                'options'   => $product_ids,
                'condition' => [
                    'element' => 'product_page'
                ],
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();
    }

    private function get_shortcode() {
        $shortcode = '';
        $settings  = $this->get_settings();

        if ( ! empty( $settings['element'] ) ) {
            switch ( $settings['element'] ) {
                case 'product_page':
                    if ( ! empty( $settings['product_id'] ) ) {
                        $product_data = get_post( $settings['product_id'] );
                        $product = ! empty( $product_data ) && in_array( $product_data->post_type, [ 'product', 'product_variation' ] ) ? wc_setup_product_data( $product_data ) : false;
                        
                        if ( empty( $product ) && current_user_can( 'manage_options' ) ) {
                            return esc_html__( 'Please set a valid product', 'elementor-seosight' );
                        }

                        $this->add_render_attribute( 'shortcode', 'id', $settings['product_id'] );
                    }
                break;
            }

            $shortcode = sprintf( '[%s %s]', $settings['element'], $this->get_render_attribute_string( 'shortcode' ) );
        }

        return $shortcode;
    }

    public function add_product_post_class( $classes ) {
        $classes[] = 'product';

        return $classes;
    }

    protected function render() {
        $shortcode = $this->get_shortcode();

        if ( empty( $shortcode ) ) {
            return;
        }

        add_filter( 'post_class', [ $this, 'add_product_post_class' ] );

        $html = do_shortcode( $shortcode );

        if ( 'woocommerce_checkout' === $this->get_settings( 'element' ) && '<div class="woocommerce"></div>' === $html ) {
            $html = '<div class="woocommerce">' . esc_html__( 'Your cart is currently empty.', 'elementor-seosight' ) . '</div>';
        }

        echo $html;

        remove_filter( 'post_class', [ $this, 'add_product_post_class' ] );
    }
}