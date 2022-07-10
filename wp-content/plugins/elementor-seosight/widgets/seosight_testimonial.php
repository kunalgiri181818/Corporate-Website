<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Testimonial extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-testimonial';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_testimonial',
			[
				'label' => esc_html__( 'Testimonial', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'layout', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Select Template', 'elementor-seosight' ),
                'options'     => [
                    'arrow'                 => esc_html__( 'Arrow', 'elementor-seosight' ),
                    'author-top'            => esc_html__( 'Author Top', 'elementor-seosight' ),
                    'author-centered'       => esc_html__( 'Author Centered', 'elementor-seosight' ),
                    'author-centered-round' => esc_html__( 'Author Centered Round', 'elementor-seosight' ),
                    'quote-left'            => esc_html__( 'Quote Left', 'elementor-seosight' ),
                    'modern'                => esc_html__( 'Modern', 'elementor-seosight' ),
                    'academy'               => esc_html__( 'Academy', 'elementor-seosight' ),
                    'agency'                => esc_html__( 'Agency', 'elementor-seosight' ),
                    'consultant'            => esc_html__( 'Consultant', 'elementor-seosight' ),
                    'company'               => esc_html__( 'Company', 'elementor-seosight' ),
                    'copywriter'            => esc_html__( 'Copywriter', 'elementor-seosight' ),
                ],
                'default'     => 'arrow'
            ]
        );

        $this->add_control(
            'name',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Name', 'elementor-seosight' ),
                'default'   => 'Jonathan Simpson',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'position',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Position', 'elementor-seosight' ),
                'default'   => 'Lead Manager',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'desc',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => esc_html__( 'Description', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'image',
            [
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Photo of author', 'elementor-seosight' ),
                'condition' => [
                    'layout!' => 'quote-left',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'author',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Author', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'author_link', 
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Author link', 'elementor-seosight' ),
                'description' => esc_html__( 'Link to author blog, page, etc.', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'stars',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Stars', 'elementor-seosight' ),
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0
                ],
                'separator'  => 'before'
            ]
        );
        
        $this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Custom class', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter extra custom class', 'elementor-seosight' ),
                'separator'   => 'before'
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
                'name'     => 'title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .author-name',
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
                    '{{WRAPPER}} .author-name' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sub-title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Sub Title', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'sub-title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .author-company',
            ]
        );

        $this->add_control(
            'sub-title-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .author-company' => 'color: {{SCHEME}};'
                ],
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
                'name'     => 'text-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonial-text',
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
                    '{{WRAPPER}} .testimonial-text' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box style', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box-background-color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}}',
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'box-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}}',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'box-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'box-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Image box', 'elementor-seosight' )
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
                    '{{WRAPPER}} .testimonial-img-author img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-img-author img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'image-background-color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .testimonial-img-author',
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'image-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .testimonial-img-author',
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
                    '{{WRAPPER}} .testimonial-img-author, {{WRAPPER}} .testimonial-img-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'image-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $data_img = $data_author = $data_desc = '';
        
        $settings = $this->get_settings_for_display();

        $layout   = ! empty( $settings['layout'] ) ? $settings['layout'] : 'arrow';
        $name     = ! empty( $settings['name'] ) ? $settings['name'] : '';
        $position = ! empty( $settings['position'] ) ? $settings['position'] : '';
        
        $wrap_class = [ 'crumina-module', 'crumina-testimonial-item testimonial-item-' . $layout ];
        if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        if ( ! empty( $settings['image']['id'] ) ) {
            $data_img.= '<div class="testimonial-img-author">';
	        $data_img .= wp_get_attachment_image( $settings['image']['id'], array('75','75'), '', array( 'alt' =>  $name ) );
            $data_img.= '</div>';
        }

        $data_author.= '<div class="author-info">';
        if ( $name ) {
            $author_title    = ! empty( $settings['author'] ) ? $settings['author'] : $name;
            $author_href     = ! empty( $settings['author_link']['url'] ) ? $settings['author_link']['url'] : '';
            $author_target   = 'target="'. ( ! empty( $settings['author_link']['is_external'] ) ? '_blank' : '_self' ) . '"';
            $author_nofollow = ! empty( $settings['author_link']['nofollow'] ) ? 'rel="nofollow"' : '';

            if ( $author_href ) {
                $data_author.= '<a href="' . esc_url( $author_href ) . '" ' . $author_target . ' ' . $author_nofollow . ' title="' . esc_attr( $author_title ) . '" class="h6 author-name">' . esc_html( $name ) . '</a>';
            } else {
                $data_author.= '<h6 class="author-name">' . esc_html( $name ) . '</h6>';
            }
        }
        if ( $position ) {
            $data_author.= '<div class="author-company">' . esc_html( $position ) . '</div>';
        }
        $data_stars = '';
        if ( ! empty( $settings['stars']['size'] ) ) {
            ob_start();
            ?>
                <ul class="rait-stars">
                    <?php for ( $i = 1; $i <= $settings['stars']['size']; $i ++ ) { ?>
                        <li>
                            <svg class="seosight-icon seosight-icon-star" viewBox="0 0 512 512">
                                <path d="M512 201c0-7-6-12-17-14l-155-23-69-140c-4-8-9-12-15-12s-11 4-15 12l-69 140-155 23c-11 2-17 7-17 14 0 4 3 9 8 15l112 109-27 154v6c0 4 1 8 3 11s5 4 10 4c3 0 7-1 12-3l138-73 138 73c5 2 9 3 13 3s7-1 9-4 3-7 3-11v-6l-27-154 112-109c5-5 8-10 8-15z"/>
                            </svg>
                        </li>
                    <?php } ?>
                    <?php for ( $i = $settings['stars']['size'] + 1; $i <= 5; $i ++ ) { ?>
                        <li>
                            <svg class="seosight-icon seosight-icon-lnr-star" viewBox="0 0 512 512">
                                <path d="m397 486c-2 0-4 0-6-1l-135-74-135 74c-4 2-9 2-13-1-4-3-6-8-5-13l24-147-98-97c-3-4-4-9-3-13 2-5 6-8 10-9l147-25 62-122c2-4 6-7 11-7 5 0 9 3 11 7l62 122 147 25c4 1 8 4 10 9 1 4 0 9-3 13l-98 97 24 147c1 5-1 10-5 13-2 2-5 2-7 2z m-141-102c2 0 4 1 6 2l118 64-21-128c-1-4 0-8 3-11l85-85-129-21c-4-1-8-4-9-7l-53-105-53 105c-1 3-5 6-9 7l-129 21 85 85c3 3 4 7 3 11l-21 128 118-64c2-1 4-2 6-2z"/>
                            </svg>
                        </li>
                    <?php } ?>
                </ul>
                <?php
            $data_stars.= ob_get_clean();
        }
        if( $layout == 'agency' || $layout == 'academy' || $layout == 'copywriter' || $layout == 'company' ){
            $data_author.= '</div>';
        } else {
            $data_author.= $data_stars . '</div>';
        }

        if ( ! empty( $settings['desc'] ) ) {
            $data_desc = '<h5 class="testimonial-text">' . esc_html( $settings['desc'] ) . '</h5>';
        }
        ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
            <?php
                switch ( $layout ) {
                    case 'arrow':
                        echo do_shortcode( $data_desc );
                        echo '<div class="author-info-wrap">';
                        es_render( $data_img );
                        es_render( $data_author );
	                    echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
                        echo '</div>';
                    break;
                    case 'author-top':
                        es_render( $data_img );
                        echo do_shortcode( $data_desc );
                        es_render( $data_author );
                    break;
                    case 'author-centered':
                        echo do_shortcode( $data_desc );
                        echo '<div class="author-info-wrap display-flex content-center">';
                        es_render( $data_img );
                        es_render( $data_author );
                        echo '</div>';
                    break;
                    case 'author-centered-round':
                        echo do_shortcode( $data_desc );
                        echo '<div class="author-info-wrap">';
                        es_render( $data_img );
                        es_render( $data_author );
                        echo '</div>';
                    break;
                    case 'quote-left':
                        echo do_shortcode( $data_desc );
                        echo '<div class="author-info-wrap">';
                        es_render( $data_author );
                        echo '</div>';
                        echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
                    break;
                    case 'modern':
                        echo '<div class="testimonial-content">';
                        echo do_shortcode( $data_desc );
                        echo '<div class="author-info-wrap">';
                        es_render( $data_author );
                        echo '</div>';
                        echo '</div>';
                        es_render( $data_img );
                        echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
                        break;
                    case 'agency':
                        echo '<div class="author-info-wrap">';
                        es_render( $data_img );
                        es_render( $data_author );
                        echo '</div>';
                        echo '<div class="testimonial-content">';
                        echo do_shortcode( $data_desc );
                        echo '</div>';
                        es_render( $data_stars );
                        break;
                    case 'academy':
                        echo '<div class="quote">';
                        echo '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m416 512h-320c-53.023438 0-96-42.976562-96-96v-320c0-53.023438 42.976562-96 96-96h320c53.023438 0 96 42.976562 96 96v320c0 53.023438-42.976562 96-96 96zm0 0" fill="#fafcff"/><path d="m213.328125 170.671875h10.671875c5.886719 0 10.671875 4.785156 10.671875 10.671875s-4.785156 10.65625-10.671875 10.65625h-10.671875c-23.535156 0-42.671875 19.136719-42.671875 42.671875v21.871094c1.726562-.351563 3.519531-.542969 5.34375-.542969h32c14.703125 0 26.671875 11.96875 26.671875 26.671875v32c0 14.703125-11.953125 26.671875-26.671875 26.671875h-32c-14.703125 0-26.671875-11.96875-26.671875-26.671875v-80c0-35.296875 28.71875-64 64-64zm0 0" fill="#d7dfe7"/><path d="m341.328125 170.671875h10.671875c5.886719 0 10.671875 4.785156 10.671875 10.671875s-4.769531 10.65625-10.671875 10.65625h-10.671875c-23.535156 0-42.671875 19.136719-42.671875 42.671875v21.871094c1.726562-.351563 3.519531-.542969 5.34375-.542969h32c14.703125 0 26.671875 11.96875 26.671875 26.671875v32c0 14.703125-11.953125 26.671875-26.671875 26.671875h-32c-14.703125 0-26.671875-11.96875-26.671875-26.671875v-80c0-35.296875 28.71875-64 64-64zm0 0" fill="#d7dfe7"/></svg>';
                        echo '</div>';
                        echo '<div class="testimonial-content">';
                        echo do_shortcode( $data_desc );
                        echo '</div>';
                        echo '<div class="author-info-wrap">';
                        echo '<div class="author-img-wrap">';
                        es_render( $data_img );
                        es_render( $data_author );
                        echo '</div>';
                        es_render( $data_stars );
                        echo '</div>';
                        break;
                    case 'consultant':
						es_render( $data_img );
						echo '<div class="testimonial-content">';
						echo do_shortcode( $data_desc );
						echo '</div>';
						echo '<div class="author-info-wrap">';
						es_render( $data_author );
						echo '</div>';
						break;
                    case 'copywriter':
						echo '<div class="author-img-wrap">';
						es_render( $data_img );
						echo '</div>';
						echo '<div class="author-info-wrap">';
						es_render( $data_stars );
						echo do_shortcode( $data_desc );
						es_render( $data_author );
						echo '</div>';
						break;
					case 'company':
						echo '<div class="author-img-wrap">';
					    es_render( $data_img );
						echo '</div>';
						echo '<div class="author-info-wrap">';
						es_render( $data_author );
						echo do_shortcode( $data_desc );
						echo '</div>';
						es_render( $data_stars );
						break;
                    default:
                        echo do_shortcode( $data_desc );
                        echo '<div class="author-info-wrap">';
                        es_render( $data_img );
                        es_render( $data_author );
                        echo '</div>';
                    break;
                }
            ?>
        </div>
        <?php
    }
}