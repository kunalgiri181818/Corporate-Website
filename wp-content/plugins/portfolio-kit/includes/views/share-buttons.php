<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gen_single_share = get_theme_mod( 'pk_settings_single_share', '1' );
if ( $gen_single_share ) {
	$gen_single_share_bttns = get_theme_mod( 'pk_settings_single_share_bttns', array(
		'facebook',
		'twitter',
		'linkedin',
		'pinterest'
	) );

	$link = get_permalink( get_the_ID() );

	?>
    <div class="pk-socials-panel">
		<?php
		if ( ! empty( $gen_single_share_bttns ) ) {
			foreach ( $gen_single_share_bttns as $social_button ) {
				$label = ucfirst( $social_button );
				if ( $social_button == 'vk' ) {
					$label = esc_html( 'Vkontakte', 'portfolio-kit' );
				}
				?>
                <div class="pk-socials-panel-item pk-<?php echo esc_attr( $social_button ); ?>-bg-color sharer"
                     data-sharer="<?php echo esc_attr( $social_button ); ?>" data-url="<?php echo esc_attr( $link ) ?>">
                    <div class="pk-social__item">
                        <i class="fa fa-<?php echo esc_attr( $social_button ); ?>"></i>
                        <span class="pk-social__item-text"><?php echo esc_html( $label ); ?></span>
                    </div>
                </div>
			<?php }
		} ?>
    </div>
	<?php
}