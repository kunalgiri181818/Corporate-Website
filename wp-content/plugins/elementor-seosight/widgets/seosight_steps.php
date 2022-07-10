<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Steps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_steps';
	}

	public function get_title() {
		return esc_html__( 'Steps', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-form';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'seosight_steps',
			[
				'label' => esc_html__( 'Steps', 'elementor-seosight' ),
			]
		);

        $this->add_control(
            'title',
            [
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Title', 'elementor-seosight'),
                'default'   => 'Title',
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
                'separator'   => 'before'
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
				],
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( 'items_content' );

        $repeater->start_controls_tab(
			'item_content',
			[
				'label' => __( 'Сontent', 'elementor-seosight' ),
			]
		);

        $repeater->add_control(
			'item_title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Title', 'elementor-seosight' ),
			]
		);

        $repeater->add_control(
			'item_text',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'text', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
			'item_style',
			[
				'label' => __( 'Style', 'elementor-seosight' ),
			]
		);

        $repeater->add_control(
			'number-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Number Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .crumina-steps-block-item-number' => 'background: {{SCHEME}};'
				],
                'separator' => 'before'
			]
		);

        $repeater->end_controls_tab();

        $this->add_control(
			'items',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Items', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'item_title' => 'Title',
                        'item_text' => 'Text',
                    ),
                    array(
                        'item_title' => 'Title',
                        'item_text' => 'Text',
                    ),
                    array(
                        'item_title' => 'Title',
                        'item_text' => 'Text',
                    ),
                    array(
                        'item_title' => 'Title',
                        'item_text' => 'Text',
                    ),
                ),
                'title_field' => '{{{ item_title }}}',
                'separator'   => 'before',
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
					'{{WRAPPER}} .crumina-steps-block-title' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .crumina-steps-block-title'
			]
		);

        $this->add_control(
			'title-margin',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Margin', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .crumina-steps-block-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
		global $allowedposttags;
		$settings = $this->get_settings_for_display();

        $wrap_classes = [ 'crumina-module', 'crumina-steps-block' ];
        if ( ! empty( $settings['wrap_class'] ) ) {
            $wrap_classes[] = $settings['wrap_class'];
        }

		$title = ! empty( $settings['title'] ) ? $settings['title'] : '';

        $items_left = array();
        $items_right = array();
        if( !empty($settings['items']) ){
            foreach($settings['items'] as $item_k => $item_v){
                $item_v['number'] = (($item_k + 1) < 10) ? '0' . ($item_k + 1) : ($item_k + 1);
                if(($item_k + 1) % 2 == 0){
                    array_push($items_right, $item_v);
                } else {
                    array_push($items_left, $item_v);
                }
            }
        }

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
        <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
            <div class="crumina-steps-block-wrap">
                <div class="crumina-steps-block-col">
                    <?php
                    if(!empty($items_left)){
                    foreach($items_left as $item_l){
                    ?>
                    <div class="crumina-steps-block-item block-item-left <?php echo 'elementor-repeater-item-' . $item_l['_id']; ?>">
                        <div class="crumina-steps-block-item-info">
                            <p class="crumina-steps-block-item-title"><?php echo esc_html($item_l['item_title']); ?></p>
                            <p class="crumina-steps-block-item-descr"><?php echo esc_html($item_l['item_text']); ?></p>
                        </div>
                        <div class="crumina-steps-block-item-number">
                            <p><?php echo esc_html($item_l['number']); ?></p>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <div class="crumina-steps-block-col crumina-steps-block-col-tit">
                    <?php if( $title != '' ){ ?>
                        <h2 class="crumina-steps-block-title"><?php echo html_entity_decode( wp_kses( $title, $allowedposttags ) ); ?></h2>
                    <?php } ?>
                    <?php if ( ! empty( $settings['title_delim'] ) && $settings['title_delim'] == 'yes' ) {
                        echo '<div class="heading-decoration">'.$delim_html.'</div>';
                    } ?>
                </div>
                <div class="crumina-steps-block-col">
                    <?php
                    if(!empty($items_right)){
                    foreach($items_right as $item_r){
                    ?>
                    <div class="crumina-steps-block-item block-item-right <?php echo 'elementor-repeater-item-' . $item_r['_id']; ?>">
                        <div class="crumina-steps-block-item-number">
                            <p><?php echo esc_html($item_r['number']); ?></p>
                        </div>
                        <div class="crumina-steps-block-item-info">
                            <p class="crumina-steps-block-item-title"><?php echo esc_html($item_r['item_title']); ?></p>
                            <p class="crumina-steps-block-item-descr"><?php echo esc_html($item_r['item_text']); ?></p>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
        <?php
    }
}