<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_WC_Product_Category extends \Elementor\Widget_Base {

    public function get_name() {
        return 'seosight_wc_product_category';
    }

    public function get_title() {
        return esc_html__( 'Product category', 'elementor-seosight' );
    }

    public function get_icon() {
        return 'fa fa-code';
    }

    public function get_categories() {
        return [ 'elementor-seosight-wc' ];
    }

    protected function _register_controls() {
        
        $product_categories = [];
        $categories         = get_categories( array(
            'type'         => 'post',
            'child_of'     => 0,
            'parent'       => '',
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => false,
            'hierarchical' => 1,
            'exclude'      => '',
            'include'      => '',
            'number'       => '',
            'taxonomy'     => 'product_cat',
            'pad_counts'   => false,
        ) );

        es_get_category_childs_full( 0, $categories, 0, $product_categories, 'slug' );

        $order_by_values  = es_orderby();
        $order_way_values = es_order();

        $this->start_controls_section(
            'seosight_wc_product_category',
            [
                'label' => esc_html__( 'Product category', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'category',
            [
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label'       => esc_html__( 'Category', 'elementor-seosight' ),
                'description' => esc_html__( 'Product category list', 'elementor-seosight' ),
                'options'     => $product_categories,
                'default'     => key( $product_categories )
            ]
        );

        $this->add_control(
            'per_page',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => esc_html__( 'Per page', 'elementor-seosight' ),
                'default'     => 12,
                'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'columns',
            [
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label'       => esc_html__( 'Columns', 'elementor-seosight' ),
                'default'     => 4,
                'description' => esc_html__( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'orderby',
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Order by', 'elementor-seosight' ),
                'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'elementor-seosight' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
                'options'     => $order_by_values,
                'default'     => key( $order_by_values ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'order',
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Sort order', 'elementor-seosight' ),
                'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'elementor-seosight' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
                'options'     => $order_way_values,
                'default'     => key( $order_way_values ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $category = ! empty( $settings['category'] ) ? $settings['category'] : '';
        $per_page = ! empty( $settings['per_page'] ) ? $settings['per_page'] : 12;
        $columns  = ! empty( $settings['columns'] ) ? $settings['columns'] : 4;
        $orderby  = ! empty( $settings['orderby'] ) ? $settings['orderby'] : 'date';
        $order    = ! empty( $settings['order'] ) ? $settings['order'] : 'DESC';

        $this->add_render_attribute( 'shortcode', [ 'category' => $category, 'per_page' => $per_page, 'columns' => $columns, 'orderby' => $orderby, 'order' => $order ] );

        $shortcode = sprintf( '[%s %s]', 'product_category', $this->get_render_attribute_string( 'shortcode' ) );

        echo do_shortcode( $shortcode );
    }
}