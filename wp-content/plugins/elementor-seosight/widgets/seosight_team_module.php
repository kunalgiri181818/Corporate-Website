<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Team_Module extends \Elementor\Widget_Base {
    public function get_name() {
		return 'seosight_team_module';
	}

	public function get_title() {
		return esc_html__( 'Team member module', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-team-member';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
		$button_colors = es_button_colors();

        $this->start_controls_section(
			'seosight_team_module',
			[
				'label' => esc_html__( 'Team Member Module', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'main_title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Block Title', 'elementor-seosight' ),
				'default'   => 'Text Title',
				'separator' => 'before'
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
			]
		);

		$this->add_control(
			'title_delim_type_position',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Title decoration position', 'elementor-seosight' ),
				'options' => [
					'top' => esc_html__( 'Top', 'elementor-seosight' ),
					'bottom' => esc_html__( 'Bottom', 'elementor-seosight' ),
				],
				'default' => 'bottom',
                'separator'   => 'before',
			]
		);

        $this->add_control(
			'subtitle',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Subtitle',  'elementor-seosight' ),
				'separator' => 'before'
			]
		);

        $this->add_control(
			'show_link',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Display Button', 'elementor-seosight' ),
				'default'   => 'no',
				'separator' => 'before'
			]
		);

        $this->add_control(
			'link_name',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Button Name', 'elementor-seosight' ),
				'condition' => [
					'show_link' => 'yes'
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'link',
			[
				'type'      => \Elementor\Controls_Manager::URL,
				'label'     => esc_html__( 'Button Url', 'elementor-seosight' ),
				'condition' => [
					'show_link' => 'yes'
				]
			]
		);

        $this->add_control(
			'btn_color',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'options'   => $button_colors,
				'default'   => key( $button_colors ),
				'condition' => [
					'show_link'   => 'yes',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'btn_size',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button size', 'elementor-seosight' ),
				'options'   => [
					'small'  => esc_html__( 'Small', 'elementor-seosight' ),
					'medium' => esc_html__( 'Medium', 'elementor-seosight' ),
					'large'  => esc_html__( 'Large', 'elementor-seosight' ),
				],
				'default'   => 'small',
				'condition' => [
					'show_link'   => 'yes',
				],
				'separator' => 'before'
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
			'items',
			[
				'label' => esc_html__( 'Items', 'elementor-seosight' ),
			]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( 'items_content' );

		$repeater->start_controls_tab(
			'box_content',
			[
				'label' => __( 'Сontent', 'elementor-seosight' ),
			]
		);

        $repeater->add_control(
			'image',
			[
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Avatar Image', 'elementor-seosight' ),
				'separator' => 'before'
			]

		);

        $repeater->add_control(
			'img_size',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Image Size', 'elementor-seosight' ),
				'description' => esc_html__( 'Set the image size: "full", "thumbnail", "medium", "large" or other size ', 'elementor-seosight' ),
				'options'     => [
					'full'      => esc_html__( 'Full Size', 'elementor-seosight' ),
					'thumbnail' => esc_html__( 'Thumbnail', 'elementor-seosight' ),
					'seosight-thumbnail-large' => esc_html__( 'Thumbnail Large', 'elementor-seosight' ),
					'medium'    => esc_html__( 'Medium', 'elementor-seosight' ),
					'large'     => esc_html__( 'Large', 'elementor-seosight' ),
				],
                'default'     => 'full',
                'separator'   => 'before'
			]
		);

        $repeater->add_control(
			'title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Name', 'elementor-seosight' ),
                'default'   => 'Your Name',
                'separator' => 'before'
			]
        );

        $repeater->add_control(
            'subtitle',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Subtitle', 'elementor-seosight' ),
                'default'   => 'Manager',
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'link_name',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Custom link Name', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'link',
            [
                'type'  => \Elementor\Controls_Manager::URL,
                'label' => esc_html__( 'Custom link', 'elementor-seosight' ),
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
			'options',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Items', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $wrap_class = [ 'seosight-team-module-wrap row' ];
		if ( ! empty( $settings['wrap_class'] ) ) {
			$wrap_class[] = $settings['wrap_class'];
		}

        $main_title = ( isset($settings['main_title'])) ? $settings['main_title'] : '';
        ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
            <?php
            if ( ! empty( $settings['options'] ) ) {
                foreach ( $settings['options'] as $option ) {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <?php
                        $wrap_elem_class = [
                            'elementor-repeater-item-' . $option['_id'],
                            'crumina-module',
                            'crumina-teammembers-item'
                        ];
                    ?>
                    <div class="<?php echo implode( ' ', $wrap_elem_class ); ?>">
                        123
                    </div>
                </div>
                <?php
                }
            }
            ?>
        </div>
        <?php
    }
}