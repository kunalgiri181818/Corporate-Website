<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_WC_Product extends \Elementor\Widget_Base {

    public function get_name() {
        return 'seosight_wc_product';
    }

    public function get_title() {
        return esc_html__( 'Product', 'elementor-seosight' );
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
            'seosight_wc_product',
            [
                'label' => esc_html__( 'Product', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'id',
            [
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label'       => esc_html__( 'Product', 'elementor-seosight' ),
                'description' => esc_html__( 'Input product title to see suggestions', 'elementor-seosight' ),
                'options'     => $product_ids,
                'default'     => key( $product_ids )
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $id = ! empty( $settings['id'] ) ? $settings['id'] : '';
        if ( ! $id ) {
            return;
        }

        $this->add_render_attribute( 'shortcode', 'id', $id );

        $shortcode = sprintf( '[%s %s]', 'product', $this->get_render_attribute_string( 'shortcode' ) );

        echo do_shortcode( $shortcode );
    }
}