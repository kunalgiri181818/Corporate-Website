<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Portfolio_Grid extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_portfolio_grid';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Grid', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-portfolio-grid';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

        $post_taxonomy = [];
        $all_post_taxonomy = es_post_taxonomy();
        if ( $all_post_taxonomy ) {
            foreach ( $all_post_taxonomy as $post_type => $terms ){
                $post_taxonomy[ $post_type ] = ucwords( str_replace( [ '-', '_' ], ' ', $post_type ) );
            }
        }

        $portfolio_post_type = get_option( 'pk_main_post_type', 'fw-portfolio' );

		$this->start_controls_section(
			'seosight_portfolio_grid',
			[
				'label' => esc_html__( 'Portfolio Grid', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'layout',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Layout', 'elementor-seosight' ),
                'default'   => 'post',
                'options'   => array(
                    'post'      => esc_html__( 'Post', 'elementor-seosight' ),
                    'portfolio' => esc_html__( 'Portfolio', 'elementor-seosight' ),
                    'business' => esc_html__( 'Business', 'elementor-seosight' ),
                    'company' => esc_html__( 'Company', 'elementor-seosight' ),
                ),

            ]   
        );

        $this->add_control(
            'title',
            [
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Title', 'elementor-seosight'),
                'condition'   => [
                    'layout' => 'company'
                ],
                'separator' => 'before'
            ]
		);

        $this->add_control(
			'title_delim',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Title decoration', 'elementor-seosight' ),
				'description' => esc_html__( 'Visual decoration lines below title text', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before',
				'condition' => [
					'layout' => 'company',
				],
			]
		);

		$this->add_control(
			'title_delim_type',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Title decoration type', 'elementor-seosight' ),
				'options' => [
					'lines' => esc_html__( 'Lines', 'elementor-seosight' ),
					'sm_lines' => esc_html__( 'Small Lines', 'elementor-seosight' ),
					'diagonal_lines' => esc_html__( 'Diagonal Lines', 'elementor-seosight' ),
					'color_dots' => esc_html__( 'Color dots', 'elementor-seosight' ),
					'wave_1' => esc_html__( 'Wave 1', 'elementor-seosight' ),
					'wave_2' => esc_html__( 'Wave 2', 'elementor-seosight' ),
					'shapes' => esc_html__( 'Shapes', 'elementor-seosight' ),
					'dots_lines' => esc_html__( 'Dots & Lines', 'elementor-seosight' ),
					'zigzag' => esc_html__( 'Zigzag', 'elementor-seosight' ),
				],
				'default' => 'lines',
                'separator'   => 'before',
				'condition' => [
					'title_delim' => 'yes',
					'layout' => 'company',
				],
			]
		);

        $this->add_control(
            'post_taxonomy', 
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Content Type', 'elementor-seosight' ),
                'default' => $portfolio_post_type,
                'options' => $post_taxonomy,
                'separator' => 'before'
            ]
        );

        if ( $all_post_taxonomy ) {
            foreach ( $all_post_taxonomy as $post_type => $terms ){
                $this->add_control(
                    'post_taxonomy_' . $post_type, 
                    [
                        'type'        => \Elementor\Controls_Manager::SELECT2,
                        'label'       => esc_html__( 'Select Content Type', 'elementor-seosight' ),
                        'description' => esc_html__( 'Choose supported content type such as post, custom post type, etc.', 'elementor-seosight' ),
                        'options'     => $terms,
                        'multiple'    => true,
                        'condition'   => [
                            'post_taxonomy' => $post_type
                        ],
                        'separator'   => 'before'
                    ]
                );
            }
        }

        $this->add_control(
            'order_by', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Order by', 'elementor-seosight' ),
                'default'   => 'ID',
                'options'   => array(
                    'ID'            => esc_html__( 'Post ID', 'elementor-seosight' ),
                    'author'        => esc_html__( 'Author', 'elementor-seosight' ),
                    'title'         => esc_html__( 'Title', 'elementor-seosight' ),
                    'name'          => esc_html__( 'Post name (post slug)', 'elementor-seosight' ),
                    'type'          => esc_html__( 'Post type (available since Version 4.0)', 'elementor-seosight' ),
                    'date'          => esc_html__( 'Date', 'elementor-seosight' ),
                    'modified'      => esc_html__( 'Last modified date', 'elementor-seosight' ),
                    'rand'          => esc_html__( 'Random order', 'elementor-seosight' ),
                    'comment_count' => esc_html__( 'Number of comments', 'elementor-seosight' )
                ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'order_list', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Order', 'elementor-seosight' ),
                'default'   => 'ASC',
                'options'   => array(
                    'ASC'  => esc_html__( 'ASC', 'elementor-seosight' ),
                    'DESC' => esc_html__( 'DESC', 'elementor-seosight' ),
                ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'number_post',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Number of items displayed', 'elementor-seosight' ),
                'description' => esc_html__( 'The number of items you want to show.', 'elementor-seosight' ),
                'default'     => [
                    'size' => 9,
                    'unit' => '%',
                ],
                'range'       => [
                    '%' => [
                        'min' => 1,
                        'max' => 30,
                    ],
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'number_of_items',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Items per row', 'elementor-seosight' ),
                'description' => esc_html__( 'Number of items displayed on one row', 'elementor-seosight' ),
                'default'     => [
                    'size' => 3,
                    'unit' => '%',
                ],
                'range'       => [
                    '%' => [
                        'min' => 1,
                        'max' => 6,
                    ],
                ],
                'condition'   => [
                    'layout!' => 'business',
                    'layout!' => 'company'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra class', 'elementor-seosight' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'main-title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Main Title', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'main_title_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .h2',
            ]
        );

        $this->add_control(
            'main-title-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .h2' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'main-title-decor-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Decoration color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
					'{{WRAPPER}} .heading-decoration' => 'color: {{SCHEME}};',
					'{{WRAPPER}} .heading-decoration svg' => 'fill: {{SCHEME}};'
				],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Title', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .case-item__title',
            ]
        );

        $this->add_control(
            'title-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .case-item__title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color on hover', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .crumina-case-item:hover .case-item__title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Text Align', 'elementor-seosight' ),
                'options'   => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Centered', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-justify',
                    ]
                ],
                'default'   => 'center',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Text', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .crumina-case-item .case-item__cat a',
            ]
        );

        $this->add_control(
            'text-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .crumina-case-item .case-item__cat a' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color on hover', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .crumina-case-item:hover .case-item__cat a' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text_align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Text Align', 'elementor-seosight' ),
                'options'   => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Centered', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-justify',
                    ]
                ],
                'default'   => 'center',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image-box',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Image', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'image-width',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Width', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .case-item__thumb img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'image-height',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Height', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .case-item__thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'image-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => __( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .case-item__thumb' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'image-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .case-item__thumb',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'image-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .case-item__thumb, {{WRAPPER}} .case-item__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'image-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .case-item__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'image-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .case-item__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style-box',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box style', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'style-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => __( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .crumina-case-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'style-background-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => __( 'Background Color on hover', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .crumina-case-item:hover' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'style-align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Text Align', 'elementor-seosight' ),
                'options'   => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Centered', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-justify',
                    ]
                ],
                'default'   => 'center',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'style-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .crumina-case-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'style-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .crumina-case-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $portfolio_post_type = get_option( 'pk_main_post_type', 'fw-portfolio' );

        $orderby         = ! empty( $settings['order_by'] ) ? $settings['order_by'] : 'ID';
        $order           = ! empty( $settings['order_list'] ) ? $settings['order_list'] : 'ASC';
        $post_type       = ! empty( $settings['post_taxonomy'] ) ? $settings['post_taxonomy'] : $portfolio_post_type;
        $terms           = ! empty( $settings['post_taxonomy_'. $post_type ] ) ? $settings['post_taxonomy_'. $post_type ] : [];
        $posts_per_page  = ! empty( $settings['number_post']['size'] ) ? $settings['number_post']['size'] : 9;
        $number_of_items = ! empty( $settings['number_of_items']['size'] ) ? $settings['number_of_items']['size'] : 3;
        $layout         = ! empty( $settings['layout']) ? $settings['layout'] : 'post';

        $taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
        $taxonomy         = key( $taxonomy_objects );

        $args = array(
            'post_type'        => $post_type,
            'posts_per_page'   => $posts_per_page,
            'orderby'          => $orderby,
            'order'            => $order,
            'suppress_filters' => false
        );

        if ( $terms ) {
            $args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $terms,
                )
            );
        }

        $the_query = new WP_Query( $args );

        $wrap_class = [ 'crumina-module', 'portfolio-grid', 'portfolio-grid-' . $layout ];
        if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        // portfolio format settings
        $container_width = 1170;
        $gap_paddings    = 90;
        $grid_size       = intval( 12 / $number_of_items );
        if( $layout == 'business' ) {
            $grid_size = 6;
            $number_of_items = 2;
            $gap_paddings    = 0;
        }
        $img_width       = intval( $container_width / ( 12 / $grid_size ) ) - $gap_paddings;
        $img_height      = intval( $img_width * 0.75 );
        $default_src     = ES_PLUGIN_URL . '/assets/images/get_start.jpg';
        $item_class_add  = $grid_size > 5 ? 'big mb60' : 'mb30';
        $title_tag       = $grid_size > 5 ? 'h5' : 'h6';

        $title_align = ! empty( $settings['title_align'] ) ? es_get_align( $settings['title_align'] ) : '';
        $text_align  = ! empty( $settings['text_align'] ) ? es_get_align( $settings['text_align'] ) : '';
        $style_align = ! empty( $settings['style-align'] ) ? es_get_align( $settings['style-align'] ) : '';

        ob_start();
        $i = 1;
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) { $the_query->the_post();
                    $open_link    = es_get_fw_options( get_the_ID(), 'open-item' );
                    $thumbnail_id = get_post_thumbnail_id();

                    if ( $open_link === 'lightbox' ) {
                        $permalink  = wp_get_attachment_url( $thumbnail_id );
                        $link_class = 'js-zoom-image';

                    } else {
                        $permalink  = get_the_permalink();
                        $link_class = '';
                    }

                    if ( $thumbnail_id ) {
                        $thumbnail       = get_post( $thumbnail_id );
                        $image           = es_resize( $thumbnail->ID, $img_width, $img_height, true );
                        $thumbnail_title = $thumbnail->post_title;
                    } else {
                        $image           = $default_src;
                        $thumbnail_title = get_the_title();
                    }

                    ?>
                    <?php if ( 'post' === $layout ) { ?>
                        <div class="col-lg-<?php echo esc_attr( $grid_size ); ?> col-md-<?php echo esc_attr( $grid_size ); ?> col-sm-6 col-xs-12">
                            <article class="hentry post">
                                <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr( $link_class ) ?>">
                                    <img src="<?php echo esc_url( $image ) ?>" width="<?php echo esc_attr( $img_width ) ?>"
                                        height="<?php echo esc_attr( $img_height ) ?>"
                                        alt="<?php echo esc_attr( $thumbnail_title ) ?>"
                                        loading="lazy"
                                    >
                                </a>
                                <div class="post__content">
                                    <?php the_title( '<h5 class="entry-title"><a class="post__title" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>

                                    <?php if ( ! has_excerpt() ) {
                                        $post_content = get_the_content();
                                    } else {
                                        $post_content = get_the_excerpt();
                                    }
                                    $post_content = strip_shortcodes( $post_content );
                                    ?>
                                    <p class="post__text">
                                        <?php echo wp_trim_words( $post_content, 10, '' ); ?>
                                    </p>
                                </div>

                            </article>
                        </div>
                    <?php 
                        } else if( 'business' === $layout ) {
                        $item_class_add = 'big mb60';
                        $match_h = ' data-mh="recent-folio-grid"';
                        if( $i == 2 || $i == 3 ) {
                            $item_class_add = 'big mb60 small-v';
                            $img_height = intval( $img_width * 0.69 );
                            $match_h = '';
                        } else if( $i == 4 ) {
                            $item_class_add = 'big mb60 small-h';
                            $img_height = intval( $img_width * 0.69 );
                            $match_h = '';
                        }
                    ?>
                        <?php if($i == 1 || $i > 4){ ?>
                        <div class="col-lg-<?php echo esc_attr( $grid_size ); ?> col-md-<?php echo esc_attr( $grid_size ); ?> col-sm-6 col-xs-12">
                        <?php } else if( $i == 2 ){ ?>
                        <div class="col-lg-<?php echo esc_attr( $grid_size ); ?> col-md-<?php echo esc_attr( $grid_size ); ?> col-sm-6 col-xs-12 case-col-grid">
                        <?php } ?>
                            <div class="crumina-case-item <?php echo esc_attr( $item_class_add ); ?>" <?php echo $style_align . $match_h; ?>>
                                <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( $link_class ) ?>">
                                        <img src="<?php echo esc_url( $image ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $thumbnail_title ); ?>" loading="lazy" >
                                    </a>
                                </div>
                                <div class="post__content">
                                    <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat" ' . $text_align . '>', ', ', '</div>' ); ?>
                                    <a href="<?php echo esc_url( $permalink ); ?>"  class="<?php echo esc_attr( $title_tag ); ?> case-item__title" <?php echo $title_align; ?>><?php the_title(); ?></a>
                                </div>
                            </div>
                        <?php if($i == 1 || $i > 3){ ?>
                        </div>
                        <?php } ?>
                    <?php 
                        } else if( 'company' === $layout ) {

                        } else { ?>
                        <div class="col-lg-<?php echo esc_attr( $grid_size ); ?> col-md-<?php echo esc_attr( $grid_size ); ?> col-sm-6 col-xs-12">
                            <div class="crumina-case-item <?php echo esc_attr( $item_class_add ); ?>" data-mh="recent-folio-grid" <?php echo $style_align; ?>>
                                <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( $link_class ) ?>">
                                        <img src="<?php echo esc_url( $image ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $thumbnail_title ); ?>" loading="lazy" >
                                    </a>
                                </div>
                                <a href="<?php echo esc_url( $permalink ); ?>"  class="<?php echo esc_attr( $title_tag ); ?> case-item__title" <?php echo $title_align; ?>><?php the_title(); ?></a>
                                <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat" ' . $text_align . '>', ', ', '</div>' ); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if ( 0 === $i % $number_of_items && $layout != 'business' ) {
                        echo '<div class="clearfix"></div>';
                    }
                    $i ++;
                }
            } else {
                echo '<div class="col-xs-12"><h2>' . esc_html__( ' No posts found', 'elementor-seosight' ) . '</h2></div>';
            }
            wp_reset_postdata();

        $output = ob_get_clean();
    ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
            <?php 
                if( $layout == 'company' ){ 
                $block_title = ! empty( $settings['title'] ) ? $settings['title'] : '';
                $img_width = intval( $container_width / ( 12 / $grid_size ) );
                $img_height = intval( $img_width * 0.75 );
                $delim_html = '';
                ob_start();
                $delim_type = ( ! empty( $settings['title_delim_type'] ) ) ? $settings['title_delim_type'] : 'lines';
                    if( $delim_type == 'lines' ){
                    ?>
                    <span class="first"></span><span class="second"></span>
                    <?php } else if( $delim_type == 'sm_lines' ) { ?>
                    <svg id="seo_title_sm_lines" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 4"><path id="line" d="M2,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H2A2,2,0,0,1,0,2H0A2,2,0,0,1,2,0Z"/><path id="line-2" d="M21,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H21a2,2,0,0,1-2-2h0A2,2,0,0,1,21,0Z"/><path id="line-3" d="M40,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H40a2,2,0,0,1-2-2h0A2,2,0,0,1,40,0Z"/><path id="line-4" d="M59,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H59a2,2,0,0,1-2-2h0A2,2,0,0,1,59,0Z"/></svg>
                    <?php
                    } else if( $delim_type == 'diagonal_lines' ) { ?>
                    <svg id="seo_title_diagonal_lines" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 69.96 5.96"><path id="_1" data-name=" 1" class="cls-1" d="M5.64.53a1.53,1.53,0,0,1-.16,2L2.14,5.65A1.24,1.24,0,0,1,.4,5.6L.29,5.47a1.54,1.54,0,0,1,.17-2L3.8.35A1.24,1.24,0,0,1,5.54.4Z" transform="translate(0.01 -0.02)"/><path id="_2" data-name=" 2" class="cls-1" d="M21.64.53a1.53,1.53,0,0,1-.16,2L18.14,5.65A1.24,1.24,0,0,1,16.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L19.8.35A1.24,1.24,0,0,1,21.54.4Z" transform="translate(0.01 -0.02)"/><path id="_3" data-name=" 3" class="cls-1" d="M37.64.53a1.53,1.53,0,0,1-.16,2L34.14,5.65A1.24,1.24,0,0,1,32.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L35.8.35A1.24,1.24,0,0,1,37.54.4Z" transform="translate(0.01 -0.02)"/><path id="_4" data-name=" 4" class="cls-1" d="M53.64.53a1.53,1.53,0,0,1-.16,2L50.14,5.65A1.24,1.24,0,0,1,48.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L51.8.35A1.24,1.24,0,0,1,53.54.4Z" transform="translate(0.01 -0.02)"/><path id="_5" data-name=" 5" class="cls-1" d="M69.64.53a1.53,1.53,0,0,1-.16,2L66.14,5.65A1.24,1.24,0,0,1,64.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L67.8.35A1.24,1.24,0,0,1,69.54.4Z" transform="translate(0.01 -0.02)"/></svg>
                    <?php
                    } else if( $delim_type == 'wave_1' ) { ?>
                    <svg id="seo_title_wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 6"><path d="M374.06,342.61a7.74,7.74,0,0,1-5.47-2.22,6,6,0,0,0-8.52,0,7.84,7.84,0,0,1-10.93,0,6,6,0,0,0-8.51,0,7.85,7.85,0,0,1-10.94,0,6,6,0,0,0-8.5,0,7.85,7.85,0,0,1-10.94,0,5.89,5.89,0,0,0-4.25-1.78,1,1,0,0,1,0-2,7.76,7.76,0,0,1,5.47,2.22,6,6,0,0,0,8.5,0,7.85,7.85,0,0,1,10.94,0,6,6,0,0,0,8.5,0,7.85,7.85,0,0,1,10.94,0,6,6,0,0,0,8.51,0,7.85,7.85,0,0,1,10.94,0,6,6,0,0,0,4.26,1.78,1,1,0,0,1,0,2Z" transform="translate(-305.03 -336.61)"/></svg>
                    <?php
                    } else if( $delim_type == 'color_dots' ) { ?>
                    <svg id="seo_title_dots" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70.06 6.06"><defs><style>.cls-1{fill:#6c6ff2;}.cls-2{fill:#4cc2c0;}.cls-3{fill:#f15b26;}.cls-4{fill:#fcb03b;}.cls-5{fill:#3cb878;}</style></defs><circle class="cls-1" cx="3.03" cy="3.03" r="3.03"/><circle class="cls-2" cx="19.03" cy="3.03" r="3.03"/><circle class="cls-3" cx="35.03" cy="3.03" r="3.03"/><circle class="cls-4" cx="51.03" cy="3.03" r="3.03"/><circle class="cls-5" cx="67.03" cy="3.03" r="3.03"/></svg>
                    <?php
                    } else if( $delim_type == 'wave_2' ) { ?>
                    <svg id="seo_title_wave_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70.06 6.01"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><path id="line" class="cls-1" d="M69,6A30.33,30.33,0,0,1,57.38,3.94a32.17,32.17,0,0,0-22.06,0A34.08,34.08,0,0,1,12,3.94,28.29,28.29,0,0,0,1,2,1,1,0,0,1,1,0,30.22,30.22,0,0,1,12.64,2.05a32.26,32.26,0,0,0,22,0A34.11,34.11,0,0,1,58,2.05,28.47,28.47,0,0,0,69,4a1,1,0,0,1,0,2Z" transform="translate(0.02 0.02)"/></svg>
                    <?php
                    } else if( $delim_type == 'shapes' ) { ?>
                    <svg id="seo_title_shapes_b" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 10"><rect class="cls-1" x="34" width="2" height="10" rx="1"/><rect class="cls-1" x="34" width="2" height="10" rx="1" transform="translate(40 -30) rotate(90)"/><path class="cls-1" d="M18.5,8.5A.66.66,0,0,1,18,8.31L15.19,5.47a.68.68,0,0,1,0-.94L18,1.69a.68.68,0,0,1,.94,0l2.84,2.84a.68.68,0,0,1,0,.94L19,8.31A.66.66,0,0,1,18.5,8.5ZM16.6,5l1.9,1.9L20.4,5,18.5,3.1Z" transform="translate(0 0)"/><path class="cls-1" d="M51.5,8.5A.66.66,0,0,1,51,8.31L48.19,5.47a.68.68,0,0,1,0-.94L51,1.69a.68.68,0,0,1,.94,0l2.84,2.84a.68.68,0,0,1,0,.94L52,8.31A.66.66,0,0,1,51.5,8.5ZM49.6,5l1.9,1.9L53.4,5,51.5,3.1Z" transform="translate(0 0)"/><circle class="cls-1" cx="2" cy="5" r="2"/><circle class="cls-1" cx="68" cy="5" r="2"/></svg>
                    <?php
                    } else if( $delim_type == 'dots_lines' ) { ?>
                    <svg id="seo_title_dots_lines_b" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 4"><path id="_1" data-name=" 1" d="M2,0H2A2,2,0,0,1,4,2H4A2,2,0,0,1,2,4H2A2,2,0,0,1,0,2H0A2,2,0,0,1,2,0Z"/><path id="_2" data-name=" 2" d="M11,0H26a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H11A2,2,0,0,1,9,2H9A2,2,0,0,1,11,0Z"/><path id="_3" data-name=" 3" d="M35,0h0a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2h0a2,2,0,0,1-2-2h0A2,2,0,0,1,35,0Z"/><path id="_4" data-name=" 4" d="M44,0H59a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H44a2,2,0,0,1-2-2h0A2,2,0,0,1,44,0Z"/><path id="_5" data-name=" 5" d="M68,0h0a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2h0a2,2,0,0,1-2-2h0A2,2,0,0,1,68,0Z"/></svg>
                    <?php
                    } else if( $delim_type == 'zigzag' ) { ?>
                    <svg id="seo_title_zigzag" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 6"><polygon points="8.24 6 0 1.45 1.2 0.33 8.24 4.22 15.88 0 23.52 4.22 31.17 0 38.81 4.22 46.46 0 54.1 4.22 61.75 0 70 4.55 68.8 5.67 61.75 1.78 54.1 6 46.46 1.78 38.81 6 31.17 1.78 23.52 6 15.88 1.78 8.24 6"/></svg>
                    <?php
                    }
                $delim_html = ob_get_clean();
            ?>
                <div class="row m-0">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <?php
                        if( $block_title != '' ){
                            if ( ! empty( $settings['title_delim'] ) && $settings['title_delim'] == 'yes' ) {
                                echo '<div class="heading-decoration top">'.$delim_html.'</div>';
                            }
                            echo '<p class="h2">'.esc_html($block_title).'</p>';
                        }

                        if($terms){
                            $post_terms = $terms;
                        } else {
                            $post_terms = array();
                            $all_post_taxonomy = es_post_taxonomy();
                            if( isset($all_post_taxonomy[$post_type]) && !empty($all_post_taxonomy[$post_type]) ) {
                                foreach( $all_post_taxonomy[$post_type] as $all_post_tax_k => $all_post_tax ) {
                                    array_push($post_terms, $all_post_tax_k);
                                }
                            }
                        }

                        if ( !empty($post_terms) ) {
                            echo '<ul class="portfolio-grid-terms-nav">';
                            $term_count = 0;
                            foreach ( $post_terms as $t_k => $t ){
                                $t_obj = get_term_by( 'slug', $t, $taxonomy );
                                $active_term = ( $term_count == 0 ) ? 'class="active"' : '';
                                echo '<li '.$active_term.' data-target="portfolio_term_'.esc_attr($t_obj->term_id).'">'.esc_html($t_obj->name).'</li>';
                                $term_count++;
                            }
                            echo '</ul>';
                        }
                        ?>

                    </div>
                    <div class="col-lg-offset-1 col-lg-8 col-md-8 col-sm-12">
                        <?php
                        if ( !empty($post_terms) ) {
                        $args_posts = array(
                            'post_type'        => $post_type,
                            'posts_per_page'   => $posts_per_page,
                            'orderby'          => $orderby,
                            'order'            => $order,
                            'suppress_filters' => false
                        );
                    
                            $term_cont_count = 0;
                            foreach ( $post_terms as $t_k => $t ){
                                $t_obj = get_term_by( 'slug', $t, $taxonomy );
                                $t_link = get_term_link( $t_obj, $taxonomy );
                                $args_posts['tax_query'] = array(
                                    'relation' => 'OR',
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'slug',
                                        'terms'    => array($t),
                                    )
                                );
                                $the_query_posts = new WP_Query( $args_posts );
                                ?>
                                <div class="portfolio-grid-posts-cont <?php if( $term_cont_count == 0 ){echo 'active';} ?>" data-nav="portfolio_term_<?php echo esc_attr($t_obj->term_id); ?>">
                                    <?php
                                    if ( $the_query_posts->have_posts() ) {
                                        while ( $the_query_posts->have_posts() ) { $the_query_posts->the_post();
                                            $open_link    = es_get_fw_options( get_the_ID(), 'open-item' );
                                            $thumbnail_id = get_post_thumbnail_id();

                                            if ( $open_link === 'lightbox' ) {
                                                $permalink  = wp_get_attachment_url( $thumbnail_id );
                                                $link_class = 'js-zoom-image';

                                            } else {
                                                $permalink  = get_the_permalink();
                                                $link_class = '';
                                            }

                                            if ( $thumbnail_id ) {
                                                $thumbnail       = get_post( $thumbnail_id );
                                                $image           = es_resize( $thumbnail->ID, $img_width, $img_height, true );
                                                $thumbnail_title = $thumbnail->post_title;
                                            } else {
                                                $image           = $default_src;
                                                $thumbnail_title = get_the_title();
                                            }
                                    ?>
                                        <div class="crumina-case-item" data-mh="recent-folio-grid" <?php echo $style_align; ?>>
                                            <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                                <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( $link_class ) ?>">
                                                    <img src="<?php echo esc_url( $image ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $thumbnail_title ); ?>" loading="lazy" >
                                                </a>
                                            </div>
                                            <div class="post__content">
                                                <a href="<?php echo esc_url( $permalink ); ?>"  class="<?php echo esc_attr( $title_tag ); ?> case-item__title" <?php echo $title_align; ?>><?php the_title(); ?></a>
                                                <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat" ' . $text_align . '>', ', ', '</div>' ); ?>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <a href="<?php echo esc_url($t_link); ?>" class="btn btn-hover-shadow btn-small btn--dark">
                                            <span class="text">View More</span>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                $term_cont_count++;
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row m-0">
                    <?php es_render( $output ); ?>
                </div>
            <?php } ?>
        </div>
    <?php
    }
}