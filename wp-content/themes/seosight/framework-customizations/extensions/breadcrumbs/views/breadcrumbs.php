<?php 
//if ( ! defined( 'FW' ) ) {
	//die( 'Forbidden' );
//} ?>

<?php if ( ! empty( $items ) ) : ?>
    <ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
		<?php for ( $i = 0; $i < count( $items ); $i ++ ) : ?>
			<?php if ( $i == ( count( $items ) - 1 ) ) : ?>
                <li class="breadcrumbs-item active" itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem">
	                <?php seosight_render( $separator ) ?>
                    <a href="<?php echo esc_url( $items[ $i ]['url'] ) ?>" itemprop="item"><meta itemprop="position" content="<?php echo esc_attr( $i ) ?>"/><span itemprop="name" content="<?php echo esc_html( $items[ $i ]['name'] ) ?>"></span></a>
	                <span class="breadcrumb-item-name"><?php echo esc_html( $items[ $i ]['name'] ) ?></span>
                </li>
			<?php elseif ( $i == 0 ) : ?>
                <li class="breadcrumbs-item first-item" itemprop="itemListElement" itemscope
                    itemtype="http://schema.org/ListItem">
				<?php if ( isset( $items[ $i ]['url'] ) ) : ?>
                    <a href="<?php echo esc_url( $items[ $i ]['url'] ) ?>" itemprop="item"><span
                                itemprop="name"><?php echo esc_html( $items[ $i ]['name'] ) ?></span></a>
                    <meta itemprop="position" content="<?php echo esc_attr( $i ) ?>"/>
                    </li>
				<?php else : echo esc_html( $items[ $i ]['name'] ); endif ?>
			<?php else : ?>
				<?php
				$show_page = false;
				$page_id = '';
				if ( isset( $items[ $i ]['taxonomy'] ) && ( $items[ $i ]['taxonomy'] === 'fw-portfolio-category' || $items[ $i ]['taxonomy'] === 'category' ) ) {
				    if ($items[ $i ]['taxonomy'] === 'fw-portfolio-category'){
					    $main_project_page = seosight_get_option_value( 'portfolio-page', '', array('name' => 'portfolio-page/0') );
					    $main_project_page = '';
					    if ($main_project_page){
						    $page_id = $main_project_page;
						    $show_page = true;
                        }
                    }
				    if ($items[ $i ]['taxonomy'] === 'category'){
					    $main_project_page = seosight_get_option_value( 'blog-primary-page', '', array('name' => 'blog-primary-page/0') );
					    if ($main_project_page){
						    $page_id = $main_project_page;
						    $show_page = true;
					    }
                    }
				}

                 if (true === $show_page){
                    ?>
                    <li class="breadcrumbs-item <?php seosight_render( $i - 1 ) ?>-item" itemprop="itemListElement"
                        itemscope
                        itemtype="http://schema.org/ListItem">
		                <?php seosight_render( $separator ) ?>
                        <a href="<?php echo get_permalink( $page_id ) ?>" itemprop="item">
                            <span itemprop="name"><?php echo get_the_title( $page_id ) ?></span>
                        </a>
                        <meta itemprop="position" content="<?php echo esc_attr( $i ) ?>"/>

                    </li>
				<?php } else { ?>
                    <li class="breadcrumbs-item <?php seosight_render( $i - 1 ) ?>-item" itemprop="itemListElement"
                        itemscope
                        itemtype="http://schema.org/ListItem">
		                <?php seosight_render( $separator ) ?>
		                <?php if ( isset( $items[ $i ]['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $items[ $i ]['url'] ) ?>" itemprop="item">
                                <span itemprop="name"><?php echo esc_html( $items[ $i ]['name'] ) ?></span></a>
                            <meta itemprop="position" content="<?php echo esc_attr( $i ) ?>"/>
		                <?php else : echo esc_html( $items[ $i ]['name'] ); endif ?>
                    </li>
                <?php }
			endif ?>
		<?php endfor ?>
    </ul>
<?php endif ?>