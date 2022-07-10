<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Pk_Meta extends \Elementor\Widget_Base {
    public function get_name() {
		return 'pk-meta';
	}

    public function get_title() {
		return esc_html__( 'Portfolio meta', 'portfolio-kit' );
	}

	public function get_icon() {
		return 'dashicons dashicons-layout';
	}

    public function get_script_depends() {
        return [ 'pk-el-main' ];
    }

	public function get_categories() {
		return [ 'elementor-portfolio-kit' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'pk_meta_block',
			[
				'label' => esc_html__( 'Portfolio meta', 'portfolio-kit' )
			]
		);

        $this->add_control(
            'meta_date', 
            [
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label'     => esc_html__( 'Show Date?', 'portfolio-kit' ),
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'meta_categories', 
            [
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label'     => esc_html__( 'Show Categories?', 'portfolio-kit' ),
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'meta_services', 
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => esc_html__( 'Services', 'portfolio-kit' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'meta_client', 
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Client name', 'portfolio-kit' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'meta_client_link', 
            [
                'type'      => \Elementor\Controls_Manager::URL,
                'label'     => esc_html__( 'Client link', 'portfolio-kit' ),
                'condition'   => [
                    'meta_client!' => ''
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra class', 'portfolio-kit' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'portfolio-kit' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Title', 'elementor-websight' ),
            ]
        );

        $this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'elementor-websight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pk-el-post-meta .pk-el-post-meta-item-tit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .pk-el-post-meta .pk-el-post-meta-item-tit',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'text_css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Text', 'elementor-websight' ),
            ]
        );

        $this->add_control(
			'text_color',
			[
				'label'     => __( 'Text color', 'elementor-websight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pk-el-post-meta p' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'link_color',
			[
				'label'     => __( 'Link color', 'elementor-websight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pk-el-post-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .pk-el-post-meta p',
			]
		);

        $this->end_controls_section();
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
        $el_class = new PortfolioKitElementor();

        $meta_date = (isset($settings['meta_date'])) ? $settings['meta_date'] : 'yes';
        $meta_categories = (isset($settings['meta_categories'])) ? $settings['meta_categories'] : 'yes';
        $meta_services = (isset($settings['meta_services'])) ? $settings['meta_services'] : '';
        $meta_client = (isset($settings['meta_client'])) ? $settings['meta_client'] : '';
        $meta_client_link = (isset($settings['meta_client_link'])) ? $settings['meta_client_link'] : '';
        $post_id = get_the_ID();
        
        $post_categories = wp_get_post_terms($post_id, 'portfolio-kit-cat');

        $wrap_class = [ 'pk-el-post-meta' ];
        if ( ! empty( $settings['class'] ) ) {
			$wrap_class[] = $settings['class'];
		}
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
            <!-- Date -->
            <?php if($meta_date == 'yes'){ ?>
            <div class="pk-el-post-meta-item">
                <p class="pk-el-post-meta-item-tit"><?php echo esc_html__( 'Date', 'portfolio-kit' ); ?></p>
                <p><?php echo get_the_date( '', $post_id ); ?></p>
            </div>
            <?php } ?>
            <!-- Categories -->
            <?php if($meta_categories == 'yes' && !empty($meta_categories)){ ?>
            <div class="pk-el-post-meta-item">
                <p class="pk-el-post-meta-item-tit"><?php echo esc_html__( 'Category', 'portfolio-kit' ); ?></p>
                <?php
                    foreach( $post_categories as $post_category ) {
                    $post_category_link = get_term_link($post_category->term_id, 'portfolio-kit-cat');
                ?>
                    <a href="<?php echo esc_url($post_category_link); ?>"><?php echo esc_html($post_category->name); ?></a>
                <?php } ?>
            </div>
            <?php } ?>
            <!-- Services -->
            <?php
            if( $meta_services != '' ){
            $meta_services_arr = explode("\n", str_replace("\r", "", $meta_services));
            ?>
            <div class="pk-el-post-meta-item">
                <p class="pk-el-post-meta-item-tit"><?php echo esc_html__( 'Services', 'portfolio-kit' ); ?></p>
                <?php foreach( $meta_services_arr as $meta_service ) { ?>
                <p><?php echo esc_html($meta_service); ?></p>
                <?php } ?>
            </div>
            <?php } ?>
            <!-- Client -->
            <?php if( $meta_client != '' ){ ?>
            <div class="pk-el-post-meta-item">
                <p class="pk-el-post-meta-item-tit"><?php echo esc_html__( 'Client', 'portfolio-kit' ); ?></p>
                <p><?php echo esc_html($meta_client); ?></p>
                <?php
                if( !empty($meta_client_link) && !empty($meta_client_link['url']) ){
                    echo $el_class->pk_render_link_field($meta_client_link);
                }
                ?>
            </div>
            <?php } ?>
        </div>
        <?php
    }
}