<ul class="filter-icons reaction-toggle-parent reactions-count-used-<?php echo $postID; ?>"
    data-post="<?php echo $postID; ?>"
    data-nonce="<?php echo wp_create_nonce( $nonce ) ?>">
        <?php
        foreach ( $availableReactions as $reaction ) {
            $type = (isset($reaction['reaction_type'])) ? $reaction['reaction_type'] : $reaction['ico'];
            if ( !isset( $reactions[ $type ] ) ) {
                continue;
            }
            $icon_image_type = ( isset($reaction['image_type']) ) ? $reaction['image_type'] : 'predefined';
            $icon_image = $img_path . '/'. $type . '.png';
            if( $icon_image_type == 'custom' ){
                $icon_image = ( isset($reaction['icon']['custom']['ico_file']['url']) ) ? $reaction['icon']['custom']['ico_file']['url'] : $img_path . '/'. $type . '.png';
            }
            ?>

        <li>
            <a href="#" data-type="<?php echo $type; ?>" class="post-add-icon inline-items reaction-toggle-icon disabled">
                <img src="<?php echo esc_url($icon_image); ?>"  width="24" height="24" loading="lazy" alt="icon">
                <span><?php echo $reactions[ $type ][ 'count' ]; ?></span>
            </a>
        </li>
        <?php
    }
    ?>
</ul>