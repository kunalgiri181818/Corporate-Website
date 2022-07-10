<ul class="crum-reaction-ext reactions-btns-<?php echo $postID; ?> reaction-toggle-parent"
    data-post="<?php echo $postID; ?>"
    data-nonce="<?php echo wp_create_nonce( $nonce ) ?>">
        <?php
        foreach ( $availableReactions as $reaction ) {
            $type    = (isset($reaction['reaction_type'])) ? $reaction['reaction_type'] : $reaction['ico'];
            $tooltip = $reaction[ 'title' ];
            $classes = '';

            if ( isset( $reactions[ $type ] ) ) {
                if ( $reactions[ $type ][ 'reacted' ] === true ) {
                    $tooltip = sprintf( __( 'Remove my %s reaction', 'crum-ext-post-reaction' ), $reaction[ 'title' ] );
                    $classes = 'reacted';
                }
            }
            $icon_image_type = ( isset($reaction['image_type']) ) ? $reaction['image_type'] : 'predefined';
            $icon_image = $img_path . '/'. $type . '.png';
            if( $icon_image_type == 'custom' ){
                $icon_image = ( isset($reaction['icon']['custom']['ico_file']['url']) ) ? $reaction['icon']['custom']['ico_file']['url'] : $img_path . '/'. $type . '.png';
            }
            ?>
        <li class="<?php echo $classes; ?>">
            <a href="#" data-type="<?php echo $type; ?>" class="reaction-toggle-icon">
                <img src="<?php echo esc_url($icon_image); ?>" alt="icon"  width="24" height="24" loading="lazy" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo esc_attr( $tooltip ); ?>">
            </a>
        </li>
    <?php } ?>
</ul>
