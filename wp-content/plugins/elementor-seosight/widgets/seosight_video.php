<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Video extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_video';
	}

	public function get_title() {
		return esc_html__( 'Video Player', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-video-player';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_video',
			[
				'label' => esc_html__( 'Video Player', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'type', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Type of player', 'elementor-seosight' ),
                'description' => esc_html__( 'Select format of displayed video', 'elementor-seosight' ),
                'options'     => [
                    'button' => esc_html__( 'Video Button', 'elementor-seosight' ),
                    'player' => esc_html__( 'Video Player', 'elementor-seosight' ),
                ],
                'default'     => 'button',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Placeholder Image', 'elementor-seosight' ),
                'description' => esc_html__( 'Please select placeholder image', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'button_image',
            [
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Button Image', 'elementor-seosight' ),
                'description' => esc_html__( 'Please select button image', 'elementor-seosight' ),
                'condition'   => [
                    'type' => 'button',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'source', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Source', 'elementor-seosight' ),
                'description' => esc_html__( 'Choose source of video', 'elementor-seosight' ),
                'options'     => [
                    'oembed' => esc_html__( 'Youtube / Vimeo', 'elementor-seosight' ),
                    'self'   => esc_html__( 'Self hosted', 'elementor-seosight' ),
                ],
                'default'     => 'oembed',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'video_link',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Video Link', 'elementor-seosight' ),
                'description' => esc_html__( 'Insert Video URL to embed this video', 'elementor-seosight' ),
                'default'     => 'https://www.youtube.com/watch?v=iNJdPyoqt8U',
                'condition'   => [
                    'source' => 'oembed',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'mp4',
            [
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Link to mp4 video', 'elementor-seosight' ),
                'description' => esc_html__( 'Source of uploaded video', 'elementor-seosight' ),
                'media_type'  => 'video',
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        \Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
                    ],
                ],
                'condition'   => [
                    'source' => 'self',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'webm',
            [
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Link to webm video', 'elementor-seosight' ),
                'description' => esc_html__( 'Source of uploaded video', 'elementor-seosight' ),
                'media_type'  => 'video',
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        \Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
                    ],
                ],
                'condition'   => [
                    'source' => 'self',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'ogg',
            [
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Link to ogg video', 'elementor-seosight' ),
                'description' => esc_html__( 'Source of uploaded video', 'elementor-seosight' ),
                'dynamic'     => [
                    'active'     => true,
                    'categories' => [
                        \Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
                    ],
                ],
                'media_type'  => 'video',
                'condition'   => [
                    'source' => 'self',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'full_bg', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Background size', 'elementor-seosight' ),
                'options'   => [
                    'full'  => esc_html__( 'Same as parent column', 'elementor-seosight' ),
                    'image' => esc_html__( 'Same as placeholder image', 'elementor-seosight' ),
                ],
                'default'   => 'full',
                'condition' => [
                    'type' => 'button',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'full_width',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Video Fullwidth', 'elementor-seosight' ),
                'description' => esc_html__( 'Stretch the video to fit the content width.', 'elementor-seosight' ),
                'default'     => 'no',
                'condition' => [
                    'type!' => 'button',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'video_width',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Video Width', 'elementor-seosight' ),
                'description' => esc_html__( 'Set the width of the video. the height will be prorated = width*1.77', 'elementor-seosight' ),
                'default'     => 600,
                'condition' => [
                    'type!'       => 'button',
                    'full_width!' => 'yes',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'auto_play',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Auto Play', 'elementor-seosight' ),
                'description' => esc_html__( 'The video automatically plays when site loaded.', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );
        
        $this->add_control(
            'wrap_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra class', 'elementor-seosight' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'video-background-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Background', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'video-background-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .video-thumb' => 'background-color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

        $this->add_control(
            'video-overlay',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Enable overlay', 'elementor-seosight' ),
                'default'     => 'yes',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $video_box_id = uniqid( 'video' );
        $block_style = $data_options = '';
        
        $settings = $this->get_settings_for_display();
        
        $type        = ! empty( $settings['type'] ) ? $settings['type'] : '';
        $source      = ! empty( $settings['source'] ) ? $settings['source'] : '';
        $full_bg     = ! empty( $settings['full_bg'] ) ? $settings['full_bg'] : '';
        $full_width  = ! empty( $settings['full_width'] ) ? $settings['full_width'] : '';
		$placeholder = ! empty( $settings['placeholder'] ) ? $settings['placeholder'] : array(
			'url' => '',
			'id'  => ''
		);
        $button_img = ! empty( $settings['button_image']['url'] ) ? $settings['button_image'] : array(
			'url' => ES_PLUGIN_URL . '/assets/images/video-control.svg',
			'id'  => ''
		);

        $video_width = ! empty( $settings['video_width'] ) ? $settings['video_width'] : '';
        $el_class    = $type == 'button' ? 'plyr-module' : 'plyr';

        $run_js = 'document.addEventListener("DOMContentLoaded", function(){ setTimeout( function(){ CRUMINA.initVideo(); }, 600); });';

        wp_enqueue_script( 'plyr-js' );
        wp_add_inline_script( 'plyr-js', $run_js );

        $block_classes = [ 'crumina-module', 'crumina-our-video' ];
        if ( ! empty( $settings['wrap_class'] ) ) {
            $block_classes[] = $settings['wrap_class'];
        }
        if ( $full_bg !== 'full' ) {
            $block_classes[] = 'height-image';
        }

        if ( ! empty( $settings['auto_play'] ) && $settings['auto_play'] == 'yes' ) {
            $data_options = '"autoplay": true';
            $el_class.= ' hide-controls';
        }

        if ( $full_bg == 'full' ) {
            $thumb_class = 'video-thumb full-block';
            $thumb_style = 'style="background-image:url(' . esc_url( $placeholder['url'] ) . ')"';
        } else {
            $thumb_class = 'video-thumb';
            $thumb_style = '';
        }

        if ( $full_width != 'yes' && $type == 'player' && $video_width ) {
            $video_height = intval( $video_width ) / 1.77;
            $block_style  = 'style="width:' . esc_attr( $video_width ) . 'px; height:' . esc_attr( $video_height ) . 'px"';
        }

        // Generate video player.
        ob_start(); ?>
            <div class="<?php echo esc_attr( $el_class ) ?>" data-source="<?php echo esc_attr( $source ); ?>" <?php es_render( $block_style ); ?> data-plyr='{<?php echo esc_attr( $data_options ); ?>}'>
                <?php
                    if ( $source == 'oembed' ) {
                        $video_link = ! empty( $settings['video_link'] ) ? $settings['video_link'] : '';
                        es_show_oembed( $video_link );
                    } else { ?>
                        <video poster="<?php echo esc_url( $placeholder['url'] ); ?>" controls>
                            <?php
                                $webm = ! empty( $settings['webm']['url'] ) ? $settings['webm']['url'] : '';
                                $ogg  = ! empty( $settings['ogg']['url'] ) ? $settings['ogg']['url'] : '';
                                $mp4_link = $mp4 = ! empty( $settings['mp4']['url'] ) ? $settings['mp4']['url'] : '';
                                if ( $mp4 ) {
                                    echo '<source src="' . esc_url( $mp4 ) . '" type="video/mp4">';
                                }
                                if ( $webm ) {
                                    echo '<source src="' . esc_url( $webm ) . '" type="video/webm">';
                                }
                                if ( $ogg ) {
                                    echo '<source src="' . esc_url( $ogg ) . '" type="video/ogg">';
                                }
                                if ( $mp4_link ) { ?>
                                    <a href="<?php echo esc_url( $mp4_link ); ?>"><?php esc_html_e( 'Download', 'elementor-seosight' ); ?></a>
                            <?php } ?>
                        </video>
                <?php } ?>
            </div>
        <?php $video_player_html = ob_get_clean(); ?>
        <div class="<?php echo esc_attr( implode( ' ', $block_classes ) ) ?>">
            <?php
                if ( $type == 'button' ) {
                    if ( $placeholder ) { ?>
                        <div class="<?php echo esc_attr( $thumb_class ) ?>" <?php es_render( $thumb_style ) ?>>
                            <?php if(isset($settings['video-overlay']) && $settings['video-overlay'] == 'yes'){ ?>
                            <div class="overlay"></div>
                            <?php } ?>
                            <?php
                                if ( $full_bg == 'image' ) {
                                    echo wp_get_attachment_image($settings['placeholder']['id'], 'full');
                                }
                            ?>
                            <a href="#<?php echo esc_attr( $video_box_id ); ?>" class="video-control js-open-video">
                                <img src="<?php echo esc_url($button_img['url']); ?>" alt="play" loading="lazy" />
                            </a>
                        </div>
                <?php } else { ?>
                    <a href="#<?php echo esc_attr( $video_box_id ); ?>" class="video-control js-open-video">
                        <img src="<?php echo esc_url($button_img['url']); ?>" alt="play" loading="lazy" />
                    </a>
                <?php } ?>
                <div id="<?php echo esc_attr( $video_box_id ); ?>" class="popup-video-holder mfp-hide">
                    <?php es_render( $video_player_html ); ?>
                </div>
            <?php } else {
                    es_render( $video_player_html );
                }
            ?>
        </div>
        <?php
    }
}