<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_FW_Form extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_fw_form';
	}

	public function get_title() {
		return esc_html__( 'Form', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-form';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		if ( function_exists( 'seosight_button_colors' ) ) {
			$button_colors = seosight_button_colors();
		} else {
			$button_colors = array();
		}


		$forms   = get_posts(
			array(
				'post_type'   => 'crum-form',
				'numberposts' => - 1
			)
		);
		$choices = [];
		if ( ! empty( $forms ) ) {
			foreach ( $forms as $form ) {
				$choices[ $form->ID ] = empty( $form->post_title ) ? esc_html__( '(no title)', 'elementor-seosight' ) : $form->post_title;
			}
		}

		$this->start_controls_section(
			'seosight_fw_form_main',
			[
				'label' => esc_html__( 'Form', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'form',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Select Form', 'elementor-seosight' ),
				'description' => esc_html__( 'You can edit forms in admin interface only.', 'elementor-seosight' ),
				'options'     => $choices
			]
		);

		$this->add_control(
			'redirect_url',
			[
				'type'        => \Elementor\Controls_Manager::URL,
				'label'       => esc_html__( 'Redirect On Submit', 'elementor-seosight' ),
				'description' => esc_html__( 'Users will be redirected after form submit to that URL', 'elementor-seosight' ),
			]
		);
		$this->add_control(
			'el_class',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Module additional class', 'elementor-seosight' ),
				'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style-form',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Style', 'elementor-seosight' ),
			]
		);
		$this->add_control(
			'color_scheme',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Color Scheme', 'elementor-seosight' ),
				'default' => '',
				'options' => [
					'white' => esc_html__( 'White', 'elementor-seosight' ),
					'dark'  => esc_html__( 'Dark', 'elementor-seosight' ),
				],
			]
		);
		$this->add_control(
			'submit_color',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Submit Color', 'elementor-seosight' ),
				'default' => '',
				'options' => $button_colors
			]
		);
		$this->add_control(
			'align',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Align', 'elementor-seosight' ),
				'description' => esc_html__( 'The alignment of elements', 'elementor-seosight' ),
				'options'     => [
					''        => esc_html__( 'None', 'elementor-seosight' ),
					'left'    => esc_html__( 'Left', 'elementor-seosight' ),
					'center'  => esc_html__( 'Centered', 'elementor-seosight' ),
					'right'   => esc_html__( 'Right', 'elementor-seosight' ),
					'justify' => esc_html__( 'Justify', 'elementor-seosight' ),
				],
				'default'     => '',
				'separator'   => 'before',
				'selectors'   => [ '{{WRAPPER}}' => 'text-align: {{VALUE}}' ]
			]
		);
		$this->add_control(
			'input',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Input', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'input-typography',
				'label'    => esc_html__( 'Font', 'elementor-seosight' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .field-text input, {{WRAPPER}} textarea',
			]
		);


		$this->add_control(
			'input_text_color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
				'selectors' => [ '{{WRAPPER}} .field-text input, {{WRAPPER}} textarea' => 'color: {{VALUE}}' ]
			]
		);
		$this->add_control(
			'input_bg_color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
				'selectors' => [ '{{WRAPPER}} .field-text input, {{WRAPPER}} textarea' => 'background-color: {{VALUE}}' ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'input_border',
				'label'    => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .field-text input, {{WRAPPER}} textarea',
			]
		);
		$this->add_control(
			'button',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Button', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button-typography',
				'label'    => esc_html__( 'Font', 'elementor-seosight' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} button, {{WRAPPER}} input[type=submit], {{WRAPPER}} input[type=button]',
			]
		);


		$this->add_control(
			'button_text_color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
				'selectors' => [ '{{WRAPPER}} button, {{WRAPPER}} input[type=submit], {{WRAPPER}} input[type=button]' => 'color: {{VALUE}}' ]
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
				'selectors' => [ '{{WRAPPER}} button, {{WRAPPER}} input[type=submit], {{WRAPPER}} input[type=button]' => 'background-color: {{VALUE}}' ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} button, {{WRAPPER}} input[type=submit], {{WRAPPER}} input[type=button]',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$form_id   = $color_form = $color_btn = $button_class = '';
		$form_tags = $submit_atts = $form_attr = array();

		/** @var array $atts */
//custom class element
		$wrap_class[] = 'crumina-module';
		$wrap_class[] = 'contact-form';
		$wrap_class[] = $settings['el_class'];
		$link         = $settings['redirect_url'];
		$form_id      = $settings['form'];
		$color_btn    = $settings['submit_color'];
		$color_form   = $settings['color_scheme'];
		$a_target     = '';
		if ( strlen( $link['url'] ) > 0 ) {
			$a_href   = $link['url'];
			$a_target = $link['is_external'] == 'on' ? '_blank' : '';
		}


		if ( ! empty( $a_href ) ) {
			$form_attr[] = 'data-redirect-page="' . esc_attr( $a_href ) . '"';
			$form_attr[] = 'data-redirect-target="' . esc_attr( $a_target ) . '"';
		}

		if ( isset( $form_id ) && $form_id > 0 && defined( 'FW' ) ){ ?>
            <div class="<?php echo implode( ' ', $wrap_class ); ?>" <?php echo implode( ' ', $form_attr ); ?>>

				<?php
				$form_options = get_post_meta( $form_id, 'fw_options', true );
				if ( ! empty( $form_options ) ) {

					$form_html = fw()->extensions->get( 'forms' )->render_form( $form_id, $form_options['form'], 'contact-forms', '' );

					if ( 'dark' === $color_form ) {
						$form_html = str_replace( 'form-builder-item-recaptcha"', 'form-builder-item-recaptcha" data-theme="dark"', $form_html );
						$form_html = str_replace( 'form-builder-item"', 'form-builder-item input-dark"', $form_html );
						$form_html = str_replace( 'form-builder-item ', 'form-builder-item input-dark ', $form_html );
					} else {
						$form_html = str_replace( 'form-builder-item"', 'form-builder-item input-standard-grey"', $form_html );
						$form_html = str_replace( 'form-builder-item ', 'form-builder-item input-standard-grey ', $form_html );
					}

					preg_match_all( '/<input[^>]+>/i', $form_html, $result );
					$result = array_shift( $result );
					foreach ( $result as $input ) {
						preg_match_all( '/(class|value|type)=("[^"]*")/i', $input, $form_tags[ $input ] );
					}
					$submit_input = array_slice( $result, - 1, 1, true );
					$submit_input = array_shift( $submit_input );

					foreach ( $form_tags as $tag ) {
						if ( '"submit"' === $tag[2][0] ) {
							$submit_atts = $tag[2];
						}
					}
					if ( isset( $submit_atts[2] ) ) {
						$button_class = $submit_atts[2];
					}

					$button_html = '<div class="col-xs-12 submit-wrap"><button type="submit" class="btn-hover-shadow btn btn-medium btn--' . esc_attr( $color_btn . ' ' . $button_class ) . '"><span class="text">' . esc_html( $form_options['submit_button_text'] ) . '</span><span class="semicircle"></span></button></div></form>';
					$form_html   = str_replace( '</form>', $button_html, $form_html );

					$form_html .= seosight_html_tag( 'div', array( 'class' => 'screen-reader-text form-message-field' ), $form_options['success_message'] );

					seosight_render( $form_html );
				} else {
					esc_html_e( 'Please create new and select contact form.', 'elementor-seosight' );
				}
				?>
            </div>
		<?php } else { ?>
			<?php esc_html_e( 'Please create new and select contact form.', 'elementor-seosight' ); ?>
		<?php }

	}
}