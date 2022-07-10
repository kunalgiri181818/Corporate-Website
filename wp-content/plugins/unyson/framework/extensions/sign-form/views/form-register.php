<?php
/**
 * @var int    $rand
 * @var string $redirect_to
 * @var string $redirect
 * @var string $forms
 * @var string $login_descr
 * @var string $enable_captcha
 * @var string $captcha_site_key
 * @var string $register_fields_type
 */
$ext = fw_ext( 'sign-form' );

$classes   = array( 'content' );
$classes[] = $ext->get_config( 'selectors/formRegister' );
$classes[] = $ext->get_config( 'selectors/form' );
?>
<div class="title h6"><?php esc_html_e( 'Register in', 'crum-ext-sign-form' ); ?>&nbsp;<?php echo get_bloginfo( 'name' ); ?></div>
<form data-handler="<?php echo esc_attr( $ext->get_config( 'actions/signUp' ) ); ?>" name="registerform" class="<?php echo implode( ' ', $classes ); ?>" action="<?php echo esc_url( site_url( 'wp-login.php?action=register&type=internal', 'login_post' ) ); ?>" method="post">
    <div class="ext-sign-form-success-email-message">
        <lottie-player src="<?php echo $ext->locate_URI( '/static/img/mail.json' ); ?>" background="transparent" speed="1"  style="width: 200px; height: 200px;"  loop  autoplay></lottie-player>
        <span class="h3"><?php esc_html_e( 'Thanks for registration!', 'crum-ext-sign-form' ); ?></span>
        <p><?php echo sprintf( __( 'We just send you an Email. %s Please Open it up to activate your account.', 'crum-ext-sign-form' ), '<br />' ); ?></p>
    </div>
    
    <?php if($enable_captcha){ ?>
        <input class="olympus-captcha-token-register simple-input" type="hidden" name="token">
    <?php } ?>
    
    <input class="simple-input" type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
    <input class="simple-input" type="hidden" name="redirect" value="<?php echo esc_attr( $redirect ); ?>" />

    <input class="simple-input" type="hidden" value="<?php echo wp_create_nonce( 'crumina-sign-form' ); ?>" name="_ajax_nonce" />
    
    <div class="ext-sign-form-register-fields">
        <?php
        if(function_exists('youzify_get_social_login_box')){
            youzify_get_social_login_box();
        }
        ?>

        <ul class="crumina-sign-form-messages"></ul>

        <div class="row">
            <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php if($register_fields_type == 'simple'){ ?>
                <div class="form-group label-floating">
                    <label class="control-label"><?php esc_html_e( 'First Name', 'crum-ext-sign-form' ); ?></label>
                    <input class="form-control simple-input" name="first_name" type="text">
                </div>

                <div class="form-group label-floating">
                    <label class="control-label"><?php esc_html_e( 'Last Name', 'crum-ext-sign-form' ); ?></label>
                    <input class="form-control simple-input" name="last_name" type="text">
                </div>
                <?php } ?>

                <div class="form-group label-floating">
                    <label class="control-label"><?php esc_html_e( 'Username', 'crum-ext-sign-form' ); ?></label>
                    <input type="text" name="user_login" class="form-control simple-input" size="20" />
                </div>
                
                <div class="form-group label-floating">
                    <label class="control-label"><?php esc_html_e( 'Your Email', 'crum-ext-sign-form' ); ?></label>
                    <input type="email" name="user_email" class="form-control simple-input" size="25" />
                </div>

                <?php 
                if($register_fields_type != 'simple'){
                    if ( function_exists( 'bp_core_get_user_domain' ) && function_exists( 'bp_activity_get_user_mentionname' ) && function_exists( 'bp_attachments_get_attachment' ) && function_exists( 'bp_loggedin_user_domain' ) && function_exists( 'bp_is_active' ) && function_exists( 'bp_get_activity_slug' ) && function_exists( 'bp_is_active' ) && function_exists( 'bp_get_notifications_unread_permalink' ) && function_exists( 'bp_loggedin_user_domain' ) && function_exists( 'bp_get_settings_slug' ) ) {
                        if ( bp_is_active( 'xprofile' ) && !function_exists('bp_nouveau_has_signup_xprofile_fields') ) : 
                        if ( bp_has_profile( array( 'profile_group_id' => 1, 'fetch_field_data' => false ) ) ) : 
                            fw_ext( 'sign-form' )->bp_fields($register_fields_type);
                        endif;
                        elseif ( bp_is_active( 'xprofile' ) && bp_nouveau_has_signup_xprofile_fields( true ) ) :
                            fw_ext( 'sign-form' )->bp_fields($register_fields_type);
                        endif;
                    }
                }
                ?>

                <?php if($register_fields_type != 'extensional'){ ?>
                <div class="form-group label-floating password-eye-wrap">
                    <label class="control-label"><?php esc_html_e( 'Your Password', 'crum-ext-sign-form' ); ?></label>
                    <a href="#" class="fa fa-fw fa-eye password-eye" tabindex="-1"></a>
                    <input type="password" name="user_password" class="form-control simple-input sign-form-password-verify" size="25" />
                    <div class="sign-form-pass-strength-result"></div>
                </div>

                <div class="form-group label-floating password-eye-wrap">
                    <label class="control-label"><?php esc_html_e( 'Confirm Password', 'crum-ext-sign-form' ); ?></label>
                    <a href="#" class="fa fa-fw fa-eye password-eye" tabindex="-1"></a>
                    <input type="password" name="user_password_confirm" class="form-control sign-form-password-verify-confirm" size="25" />
                </div>
                <?php } ?>

                <?php echo $ext::getPrivacyLinkHTML(); ?>

                <button type="submit" class="btn btn-purple btn-lg full-width">
                    <span><?php esc_html_e( 'Complete Registration!', 'crum-ext-sign-form' ); ?></span>
                    <span><?php esc_html_e( 'Login', 'crum-ext-sign-form' ); ?></span>
                    <span class="icon-loader"></span>
                </button>
            </div>
        </div>
    </div>
</form>

<style>
    .form-group.label-floating legend,
    .form-group.label-floating .description{
        display: none;
    }
    .ext-sign-form-success-email-message{
        z-index: 30;
    }
    .ext-sign-form-success-email-message lottie-player{
        display: block;
        margin: 0 auto 10px;
    }
    .ext-sign-form-success-email-message .h3{
        display: block;
        margin-bottom: 20px;
    }
</style>