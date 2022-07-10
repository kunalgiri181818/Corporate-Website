<div class="crum-reaction-list inline-items reactions-count-compact-<?php echo $postID; ?>">

	<?php if ( ! empty( $reactions['total'] ) ) { ?>
        <ul class="crum-reaction-ext friends-harmonic reaction-toggle-parent"
            data-post="<?php echo $postID; ?>"
            data-nonce="<?php echo wp_create_nonce( $nonce ) ?>">
			<?php foreach ( $availableReactions as $reaction ) {
				$type = (isset($reaction['reaction_type'])) ? $reaction['reaction_type'] : $reaction['ico'];
				if ( ! isset( $reactions[ $type ] ) ) {
					continue;
				}
                $icon_image_type = ( isset($reaction['image_type']) ) ? $reaction['image_type'] : 'predefined';
                $icon_image = $img_path . '/'. $type . '.png';
                if( $icon_image_type == 'custom' ){
                    $icon_image = ( isset($reaction['icon']['custom']['ico_file']['url']) ) ? $reaction['icon']['custom']['ico_file']['url'] : $img_path . '/'. $type . '.png';
                }
				?>
                <li>
                    <a href="#" data-type="<?php echo $type; ?>" class="reaction-toggle-icon disabled">
                        <img src="<?php echo esc_url($icon_image); ?>" width="24" height="24" loading="lazy" alt="icon">
                    </a>
                </li>
			<?php } ?>
        </ul>

		<?php if ( isset( $reactions['total'] ) ) { ?>
            <div class="names-people-likes">
				<?php echo $reactions['total']; ?>
            </div>
		<?php } ?>
	<?php } else { ?>
    <ul class="crum-reaction-ext friends-harmonic">
        <li><img src="<?php echo "{$img_path}/crumina-reaction-empty.png"; ?>" alt="no reactions"></li>
    </ul>
        <div class="names-people-likes">0</div>

	<?php } ?>
</div>