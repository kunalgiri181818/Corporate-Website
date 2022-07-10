<?php
/**
 * @var object $the_query
 * @var int $found_posts
 * @var string $query
 */
?>

<div class="search-help-result">
	<h3 class="search-help-result-title">
		<span class="count-result"><?php olympus_render( $found_posts, ' ', _n( 'group', 'groups', $found_posts, 'crum-ext-extended-search' ) ); ?></span>
		<?php esc_html_e( 'found', 'crum-ext-extended-search' ); ?>
	</h3>
    <?php if ( !empty($the_query) ) { ?>
	<ul id="youzify-groups-list" class="youzify-card-show-avatar-border youzify-card-avatar-border-circle <?php echo youzify_groups_list_class() ?>" aria-live="assertive" aria-atomic="true" aria-relevant="all">
        <?php foreach ( (array) $the_query as $group ) {
            $image = '<img loading="lazy" src="' . bp_core_fetch_avatar( array( 'item_id' => $group->id, 'object' => 'group', 'width' => 100, 'height' => 100, 'html' => false, 'type' => 'full' ) ) . '" class="olympus-rounded" alt="' . esc_attr( $group->name ) . '">';
			?>
			<li class="youzify-show-cover">
				<div class="youzify-group-data">
					<?php youzify_groups_directory_group_cover( $group->id ); ?>

					<a href="<?php echo esc_url( bp_get_group_permalink( $group ) ); ?>" class="item-avatar">
						<div class="youzify-group-avatar">
							<?php olympus_render( $image ); ?>
						</div>
					</a>

					<div class="item">
						<div class="item-title">
							<a href="<?php echo esc_url( bp_get_group_permalink( $group ) ); ?>" class="bp-group-home-link hiking-route-home-link">
								<?php echo olympus_highlight_searched( $query, $group->name ); ?>
							</a>
							<br />
							<?php
							if(!empty($group->description)){
							echo '<p>'.olympus_highlight_searched( $query, esc_html($group->description) ).'</p>';
							}
							?>
						</div>
					</div>
				</div>
			</li>
        <?php } ?>
    </ul>
    <?php
	} else {
		?>
		<div class="row">
			<?php get_template_part( 'templates/content/content-search-none' ); ?>
		</div>
		<?php
	}
	?>
</div>