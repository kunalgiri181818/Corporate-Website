<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Timeline_Slider extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script( 'seosight-timeline', get_template_directory_uri() . '/js/time-line.js', [ 'elementor-frontend' ], '1.0.0', true );

	}

	public function get_name() {
		return 'seosight_timeline_slider';
	}

	public function get_title() {
		return esc_html__( 'Timeline Slider', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-timeline-slider';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	public function get_script_depends() {
		return [ 'seosight-timeline' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_timeline_slider',
			[
				'label' => esc_html__( 'Timeline Slider', 'elementor-seosight' )
			]
		);

		$this->add_control(
            'type', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Timeline position', 'elementor-seosight' ),
                'description' => esc_html__( 'Position of timeline slider', 'elementor-seosight' ),
                'options'     => [
                    'top'    => esc_html__( 'Top', 'elementor-seosight' ),
                    'bottom' => esc_html__( 'Bottom', 'elementor-seosight' ),
                ],
                'default'     => 'top',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter text used as title of the item.', 'elementor-seosight' ),
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'type'      => \Elementor\Controls_Manager::WYSIWYG,
                'label'     => __( 'Text', 'elementor-elementor' ),
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'pointdate',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Date', 'elementor-seosight' ),
                'description' => esc_html__( 'Choose date to display on slider in format (day/month/year). Ex: 16/12/1985', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $repeater->add_control(
            'image', 
            [
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Upload Image', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

		$this->add_control(
            'options',
            [
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'label'       => esc_html__( 'Options', 'elementor-seosight' ),
                'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding timeline element.', 'lementor-seosight' ),
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'wrap_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Wrapper class name', 'elementor-seosight' ),
                'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Title', 'elementor-seosight' ),
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
                    '{{WRAPPER}} .time-line-title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .time-line-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Text', 'elementor-seosight' ),
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
                    '{{WRAPPER}} .time-line-content' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .time-line-text',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();


        $timeline_id  = uniqid( 'timeline' );
        $type       = ! empty( $settings['type'] ) ? $settings['type'] : '';
        $wrap_class = [ 'theme-module' ]; ?>
		
		<div id="<?php echo esc_attr( $timeline_id ); ?>" class="<?php echo implode( ' ', $wrap_class ); ?>">
		    <?php if ( ! empty( $settings['options'] ) ) { ?>
		        <section id="<?php echo esc_attr( $timeline_id ); ?>_line" class="cd-h-timeline js-cd-h-timeline">
				        <?php ob_start(); ?>
                        <div class="cd-h-timeline__container">
                            <div class="cd-h-timeline__dates">
                                <div class="cd-h-timeline__line">
			                        <ol>
			                            <?php
				                            $i = 0;
				                            foreach ( $settings['options'] as $option ) {
				                                $datetime  = ! empty( $option['pointdate'] ) ? $option['pointdate'] : '';
				                                $datetime  = str_replace( '/', '-', $datetime );
				                                $date      = $datetime ? $datetime : date( "D M d Y", strtotime( "+1 week" ) );
				                                $data_date = date( 'd/m/Y', strtotime( $date ) );
				                                $year      = date( 'Y', strtotime( $date ) );
					                            $curent_class = $i == 0 ? 'cd-h-timeline__date--selected' : '';
					                            ?>
                                                <li>
                                                    <a href="#0" data-date="<?php echo esc_attr( $data_date ) ?>"
                                                       class="cd-h-timeline__date <?php echo esc_attr( $curent_class ) ?>"><?php echo esc_html( $year ) ?></a>
                                                </li>
				                                <?php
				                                $i ++;
				                            }
			                            ?>
			                        </ol>
                                    <span class="cd-h-timeline__filling-line" aria-hidden="true"></span>
			                    </div>
			                </div>
                            <ul>
                                <li><a href="#0" class="text-replace cd-h-timeline__navigation cd-h-timeline__navigation--prev cd-h-timeline__navigation--inactive seoicon-play"><?php esc_html_e( 'Prev', 'elementor-seosight' ) ?></a>
                                </li>
                                <li><a href="#0" class="text-replace cd-h-timeline__navigation cd-h-timeline__navigation--next seoicon-play"><?php esc_html_e( 'Next', 'elementor-seosight' ) ?></a></li>
                            </ul> <!-- .cd-timeline-navigation -->
			            </div>
		            <?php
			            $timeline = ob_get_clean();
			            if ( $type != 'bottom' ) {
			                es_render( $timeline );
			            }
		            ?>
                    <div class="cd-h-timeline__events">
		                <ol>
		                    <?php
			                    $i = 0;
			                    foreach ( $settings['options'] as $option ) {
			                        $datetime = ! empty( $option['pointdate'] ) ? $option['pointdate'] : '';
			                        $title    = ! empty( $option['title'] ) ? $option['title'] : '';
			                        $desc     = ! empty( $option['desc'] ) ? $option['desc'] : '';
			                        
			                        $datetime  = str_replace( '/', '-', $datetime );
			                        $date      = $datetime ? $datetime : date( "D M d Y", strtotime( "+1 week" ) );
			                        $data_date = date( 'd/m/Y', strtotime( $date ) );
			                        $year      = date( 'M, Y', strtotime( $date ) ); $curent_class = $i == 0 ? 'cd-h-timeline__event--selected' : '';
				                    ?>
                                    <li class="cd-h-timeline__event <?php echo esc_attr( $curent_class ) ?>"
                                        data-date="<?php echo esc_attr( $data_date ); ?>">
			                            <div class="row">
			                                <?php
				                                if ( ! empty( $option['image']['url'] ) ) {
				                                    $content_class = 'col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-9 col-xs-12 table-cell';
				                                    ?>
				                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 table-cell">
				                                        <div class="time-line-thumb">
					                                        <?php echo wp_get_attachment_image( $option['image']['id'], 'full' ); ?>
				                                        </div>
				                                    </div>
				                                <?php } else {
				                                    $content_class = 'col-sm-12';
				                                }
			                                ?>
			                                <div class="<?php echo esc_attr( $content_class ) ?>">
			                                    <div class="time-line-content">
			                                        <h6 class="time-line-subtitle"><?php echo esc_html( $year ) ?></h6>
			                                        <h5 class="time-line-title"><?php echo esc_html( $title ) ?></h5>
			                                        <div class="time-line-text"><?php echo wpautop( $desc ) ?></div>
			                                    </div>
			                                </div>
			                            </div>
			                        </li>
			                        <?php
			                        $i ++;
			                    }
			                ?>
		                </ol>
		            </div>
		            <?php
		            	if ( $type == 'bottom' ) {
		                	es_render( $timeline );
		            	}
		            ?>
		        </section>
		    <?php } else {
		    	esc_html_e( 'Please create any timeline points', 'elementor-seosight' );
		    	}
		    ?>
		</div>
		<?php if ( is_admin() ) { ?>
            <script>
                jQuery(function ($) {
                    new HorizontalTimeline($('#<?php echo esc_attr( $timeline_id ); ?>_line')[0]);
                });
            </script>
		<?php } ?>
		<?php
    }
}