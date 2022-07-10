<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_WC_Products extends \Elementor\Widget_Base {

    public function get_name() {
        return 'seosight_wc_products';
    }

    public function get_title() {
        return esc_html__( 'Products', 'elementor-seosight' );
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

        $order_by_values  = es_orderby();
        $order_way_values = es_order();

        $this->start_controls_section(
            'seosight_wc_products',
            [
                'label' => esc_html__( 'Products', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'source',
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Source', 'elementor-seosight' ),
                'options' => [
                    'products'              => esc_html__( 'Products', 'elementor-seosight' ),
                    'recent_products'       => esc_html__( 'Recent products', 'elementor-seosight' ),
                    'featured_products'     => esc_html__( 'Featured products', 'elementor-seosight' ),
                    'sale_products'         => esc_html__( 'Sale products', 'elementor-seosight' ),
                    'best_selling_products' => esc_html__( 'Best Selling Products', 'elementor-seosight' ),
                    'top_rated_products'    => esc_html__( 'Top Rated Products', 'elementor-seosight' ),
                    'related_products'      => esc_html__( 'Related Products', 'elementor-seosight' )
                ],
                'default' => 'products'
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
                'condition'   => [
                    'source!' => 'best_selling_products'
                ],
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
                'condition'   => [
                    'source!' => 'best_selling_products'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'ids',
            [
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label'       => esc_html__( 'Products', 'elementor-seosight' ),
                'description' => esc_html__( 'Input product title to see suggestions', 'elementor-seosight' ),
                'options'     => $product_ids,
                'multiple'    => true,
                'condition'   => [
                    'source' => 'products'
                ],
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();
    }

    private function get_shortcode() {
        $shortcode = '';
        $settings  = $this->get_settings();

        if ( ! empty( $settings['source'] ) ) {
            $ids      = ! empty( $settings['ids'] ) ? implode( ',', (array) $settings['ids'] ) : '';
            $per_page = ! empty( $settings['per_page'] ) ? $settings['per_page'] : 12;
            $columns  = ! empty( $settings['columns'] ) ? $settings['columns'] : 4;
            $orderby  = ! empty( $settings['orderby'] ) ? $settings['orderby'] : 'date';
            $order    = ! empty( $settings['order'] ) ? $settings['order'] : 'DESC';

            switch ( $settings['source'] ) {
                case 'products':
                    $this->add_render_attribute( 'shortcode', [ 'ids' => $ids, 'per_page' => $per_page, 'columns' => $columns, 'orderby' => $orderby, 'order' => $order ] );
                break;
                case 'recent_products':
                case 'featured_products':
                case 'sale_products':
                case 'top_rated_products':
                    $this->add_render_attribute( 'shortcode', [ 'per_page' => $per_page, 'columns' => $columns, 'orderby' => $orderby, 'order' => $order ] );
                break;
                case 'best_selling_products':
                    $this->add_render_attribute( 'shortcode', [ 'per_page' => $per_page, 'columns' => $columns ] );
                break;
            }

            $shortcode = sprintf( '[%s %s]', $settings['source'], $this->get_render_attribute_string( 'shortcode' ) );
        }

        return $shortcode;
    }

    protected function render() {
        $settings = $this->get_settings();

        if ( ! empty( $settings['source'] ) && $settings['source'] == 'related_products' ) {
            global $product;

            $product = wc_get_product();

            if ( ! $product ) {
                return;
            }

            $args = [
                'posts_per_page' => 12,
                'columns'        => 4,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ];

            if ( ! empty( $settings['per_page'] ) ) {
                $args['posts_per_page'] = $settings['per_page'];
            }

            if ( ! empty( $settings['columns'] ) ) {
                $args['columns'] = $settings['columns'];
            }

            if ( ! empty( $settings['orderby'] ) ) {
                $args['orderby'] = $settings['orderby'];
            }

            if ( ! empty( $settings['order'] ) ) {
                $args['order'] = $settings['order'];
            }

            // Get visible related products then sort them at random.
            $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

            // Handle orderby.
            $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

            wc_get_template( 'single-product/related.php', $args );
        } else {
            $shortcode = $this->get_shortcode();

            if ( empty( $shortcode ) ) {
                return;
            }

            echo do_shortcode( $shortcode );
        }
    }
}