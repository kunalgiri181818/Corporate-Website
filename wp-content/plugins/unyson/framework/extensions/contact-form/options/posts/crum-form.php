<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'type'    => 'box',
		'title'   => '',
		'options' => array(

			'id'       => array(
				'type' => 'unique',
			),
			'builder'  => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Form Fields', 'crum-ext-contact-form' ),
				'options' => array(
					'form' => array(
						'label'        => false,
						'type'         => 'form-builder',
						'value'        => array(
							'json' => apply_filters( 'fw:ext:forms:builder:load-item:form-header-title', true )
								? json_encode( array(
									array(
										'type'      => 'form-header-title',
										'shortcode' => 'form_header_title',
										'width'     => '',
										'options'   => array(
											'title'    => '',
											'subtitle' => '',
										)
									)
								) )
								: '[]'
						),
						'fixed_header' => true,
					),
				),
			),
			'settings' => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Settings', 'crum-ext-contact-form' ),
				'options' => array(
					'settings-options' => array(
						'title'   => esc_html__( 'Options', 'crum-ext-contact-form' ),
						'type'    => 'tab',
						'options' => array(
							'form_text_settings'  => array(
								'type'    => 'group',
								'options' => array(
									'subject-group'       => array(
										'type'    => 'group',
										'options' => array(
											'subject_message' => array(
												'type'  => 'text',
												'label' => esc_html__( 'Subject Message', 'crum-ext-contact-form' ),
												'desc'  => esc_html__( 'This text will be used as subject message for the email', 'crum-ext-contact-form' ),
												'value' => esc_html__( 'New message', 'crum-ext-contact-form' ),
											),
										)
									),
									'submit-button-group' => array(
										'type'    => 'group',
										'options' => array(
											'submit_button_text' => array(
												'type'  => 'text',
												'label' => esc_html__( 'Submit Button', 'crum-ext-contact-form' ),
												'desc'  => esc_html__( 'This text will appear in submit button', 'crum-ext-contact-form' ),
												'value' => esc_html__( 'Send', 'crum-ext-contact-form' ),
											),
										)
									),
									'success-group'       => array(
										'type'    => 'group',
										'options' => array(
											'success_message' => array(
												'type'  => 'text',
												'label' => esc_html__( 'Success Message', 'crum-ext-contact-form' ),
												'desc'  => esc_html__( 'This text will be displayed when the form will successfully send', 'crum-ext-contact-form' ),
												'value' => esc_html__( 'Message sent!', 'crum-ext-contact-form' ),
											),
										)
									),
									'failure_message'     => array(
										'type'  => 'text',
										'label' => esc_html__( 'Failure Message', 'crum-ext-contact-form' ),
										'desc'  => esc_html__( 'This text will be displayed when the form will fail to be sent', 'crum-ext-contact-form' ),
										'value' => esc_html__( 'Oops something went wrong.', 'crum-ext-contact-form' ),
									),
								),
							),
							'form_email_settings' => array(
								'type'    => 'group',
								'options' => array(
									'email_to' => array(
										'type'  => 'text',
										'label' => esc_html__( 'Email To', 'crum-ext-contact-form' ),
										'help'  => esc_html__( 'We recommend you to use an email that you verify often', 'crum-ext-contact-form' ),
										'desc'  => esc_html__( 'The form will be sent to this email address.', 'crum-ext-contact-form' ),
									),
								),
							),


						)
					),
					'mailer-options'   => array(
						'title'   => esc_html__( 'Mailer', 'crum-ext-contact-form' ),
						'type'    => 'tab',
						'options' => array(
							'mailer' => array(
								'label' => false,
								'type'  => 'mailer'
							)
						)
					)
				),
			)
		)
	)
);