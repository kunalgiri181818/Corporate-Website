<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PortfolioKitFields {
    /**
	 * Output admin fields.
	 *
	 * Loops though the user registration options array and outputs each field.
	 *
	 * @param array[] $options Opens array to output.
	 */
	public function output_fields( $options, $post_id = 0 ) {
        foreach ( $options as $opt_k => $value ) {
			if ( ! isset( $value['type'] ) ) {
				continue;
            }

            // Set vals
            if ( ! isset( $value['id'] ) ) {
				$value['id'] = '';
			}
            if ( ! isset( $value['class'] ) ) {
				$value['class'] = '';
			}
            if ( ! isset( $value['default'] ) ) {
				$value['default'] = '';
			}
            if ( ! isset( $value['title'] ) ) {
				$value['title'] = '';
			}
            if ( ! isset( $value['desc'] ) ) {
				$value['desc'] = '';
			}
			if ( ! isset( $value['placeholder'] ) ) {
				$value['placeholder'] = '';
            }
            if ( ! isset( $value['dependency'] ) ) {
				$value['dependency'] = array();
            }

            $conditional = '';
            $conditional_data = '';
            if( !empty($value['dependency']) ){
                foreach( $value['dependency'] as $cond_key => $cond_val ){
                    $option_cond_val = $this->get_option( $post_id, $cond_key, $cond_val );
                    if( $option_cond_val != $cond_val ){
                        $conditional = 'pk-option-hide';
                    }
                    $conditional_data .= $cond_key . '|' . $cond_val . ';';
                }
            }

            if( $conditional_data != '' ){
                $conditional_data = rtrim($conditional_data, ";");
                $conditional_data = 'data-pkcond="'.$conditional_data.'"';
            }

            // Fields
            switch ( $value['type'] ) {
                // Text boxes.
				case 'text':
                case 'number':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    $value['class'] .= ' pk-text-field';
                    ?>
                    <div class="pk-meta-option <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <input
                                name="<?php echo $value['id'] ?>"
                                id="<?php echo $value['id']; ?>"
                                type="<?php echo esc_attr( $value['type'] ); ?>"
                                value="<?php echo esc_attr( $option_value ); ?>"
                                class="<?php echo esc_attr( $value['class'] ); ?>"
                                placeholder="<?php echo esc_attr( $value['placeholder'] ); ?>"
                            />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'select':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <?php if( !empty($value['options']) ){ ?>
                            <select name="<?php echo $value['id']; ?>" class="<?php echo esc_attr( $value['class'] ); ?>">
                                <?php foreach($value['options'] as $opt_k => $option){ ?>
                                    <option value="<?php echo esc_attr($opt_k); ?>" <?php selected( $option_value, esc_attr($opt_k) ); ?>><?php echo esc_html($option); ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'smart_select':
                    $query_select = ( isset($value['select_set']) ) ? $value['select_set'] : '';
                    $select_arr = array();
                    if( $query_select == 'pages' ){
                        $query = new WP_Query( 
                            array(
                                'post_type' => 'page',
                                'posts_per_page' => -1,
                            )
                        );
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $select_arr[get_post()->ID] = get_the_title();
                            }
                        }
                    }
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset pk-select2">
                            <?php if( !empty($select_arr) ){ ?>
                            <select name="<?php echo $value['id']; ?>" class="<?php echo esc_attr( $value['class'] ); ?>">
                                <?php foreach($select_arr as $opt_k => $option){ ?>
                                    <option value="<?php echo esc_attr($opt_k); ?>" <?php selected( $option_value, esc_attr($opt_k) ); ?>><?php echo esc_html($option); ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'wysiwyg':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option pk-meta-wp-editor <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <?php if( $value['title'] != '' ){ ?>
                        <h4><?php echo esc_html( $value['title'] ); ?></h4>
                        <?php } ?>
                        <?php if( $value['desc'] != '' ){ ?>
                        <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                        <?php } ?>
                        <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="30" rows="10"><?php echo wpautop($option_value); ?></textarea>
                    </div>
                    <?php
                break;
                case 'checkbox':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <input type="checkbox" name="<?php echo esc_attr($value['id']); ?>" value="1" <?php checked( $option_value, 'yes' ); ?> />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'checkboxes':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option pk-not-inline-opt <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <?php
                            if( !empty($value['options']) ){
                                foreach ( $value['options'] as $key => $val ) {
                                    ?>
                                    <div class="pk-checkbox-option">
                                        <input type="checkbox" id="check<?php echo esc_attr($value['id'] . $key); ?>" name="<?php echo esc_attr($value['id']); ?>[]" value="<?php echo esc_attr($key); ?>" <?php if(in_array($key, $option_value)){echo 'checked';} ?> />
                                        <label for="check<?php echo esc_attr($value['id'] . $key); ?>"><?php echo esc_html($val); ?></label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'radiobutton':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <?php if( $value['title'] != '' ){ ?>
                        <h4><?php echo esc_html( $value['title'] ); ?></h4>
                        <?php } ?>
                        <?php if( $value['desc'] != '' ){ ?>
                        <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                        <?php } ?>

                        <div class="pk-radio-options">
                        <?php
                            if( !empty($value['options']) ){
                                $count = 1;
                                foreach ( $value['options'] as $key => $val ) {
                                    ?>
									<input id="<?php echo $value['id'] . $count; ?>" name="<?php echo $value['id']; ?>" type="radio" value="<?php echo esc_attr( $key ); ?>" <?php if($option_value == $key ) echo 'checked'; ?> >
                                    <label for="<?php echo $value['id'] . $count; ?>"><?php echo esc_html($val); ?></label>
									<?php
                                    $count++;
                                }
                            }
                        ?>
                        </div>
                    </div>
                    <?php
                break;
                case 'color':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    ?>
                    <div class="pk-meta-option <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <input class="pk-meta-color-field" id="<?php echo esc_attr($value['id']); ?>" type="text" name="<?php echo esc_attr($value['id']); ?>" value="<?php echo esc_attr( $option_value ); ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'gallery':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    if($option_value != ''){
                        $meta_array = explode(',', $option_value);
                    }
                    ?>
                    <div class="pk-meta-option">
                        <div class="pk-meta-gallery-images-cont">
                            <?php if( !empty($meta_array) && count($meta_array) ){ ?>
                            <div class="pk-meta-gallery-images">
                                <?php foreach ($meta_array as $meta_gall_item) { 
                                $image_url = wp_get_attachment_thumb_url($meta_gall_item);
                                ?>
                                <div class="pk-meta-gallery-image">
                                    <img data-im="<?php echo esc_attr($meta_gall_item); ?>" src="<?php echo esc_url($image_url); ?>" />
                                    <span class="pk-remove-img">+</span>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <input class="pk-meta-gallery-field" id="<?php echo esc_attr($value['id']); ?>" type="hidden" name="<?php echo esc_attr($value['id']); ?>" value="<?php echo esc_attr( $option_value ); ?>" />
                        <a class="pk-select-gallery" href="#"><?php echo esc_html__( 'Select images', 'portfolio-kit' ); ?></a>
                    </div>
                    <?php
                break;
                case 'image':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    $image_url = '';
                    if( wp_get_attachment_url($option_value) ) {
                        $image_url = wp_get_attachment_image_url($option_value, 'thumbnail');
                    }
                    ?>
                    <div class="pk-meta-option pk-meta-option-image-select">
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <?php if($image_url != ''){ ?>
                            <div class="pk-meta-gallery-images">
                                <div class="pk-meta-gallery-image">
                                    <img src="<?php echo esc_url($image_url); ?>" />
                                    <span class="pk-remove-img">+</span>
                                </div>
                            </div>
                            <?php } ?>

                            <input class="pk-meta-image-field" id="<?php echo esc_attr($value['id']); ?>" type="hidden" name="<?php echo esc_attr($value['id']); ?>" value="<?php echo esc_attr( $option_value ); ?>" />
                            <a class="pk-select-image" href="#"><?php echo esc_html__( 'Select image', 'portfolio-kit' ); ?></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php
                break;
                case 'video':
                    $option_value = $this->get_option( $post_id, $value['id'], $value['default'] );
                    $value['class'] .= ' pk-text-field pk-video-link-field';
                    ?>
                    <div class="pk-meta-option pk-not-inline-opt <?php echo $conditional; ?>" <?php echo $conditional_data; ?>>
                        <div class="pk-meta-option-title">
                            <?php if( $value['title'] != '' ){ ?>
                            <h4><?php echo esc_html( $value['title'] ); ?></h4>
                            <?php } ?>
                            <?php if( $value['desc'] != '' ){ ?>
                            <p class="pk-meta-option-descr"><?php echo esc_html( $value['desc'] ); ?></p>
                            <?php } ?>
                        </div>
                        <div class="pk-meta-option-fieldset">
                            <input class="<?php echo esc_attr( $value['class'] ); ?> id="<?php echo esc_attr($value['id']); ?>" type="text" name="<?php echo esc_attr($value['id']); ?>" value="<?php echo esc_attr( $option_value ); ?>" />
                            <a href="#" class="button button-secondary pk-warning-primary pk-video-remove <?php if($option_value != ''){echo 'active';} ?>"><?php echo esc_html__( 'Remove', 'portfolio-kit' ); ?></a>
                            <a href="#" class="button button-primary pk-video-select"><?php echo esc_html__( 'Select', 'portfolio-kit' ); ?></a>
                        </div>
                    </div>
                    <?php
                break;
            }
        }
    }

    public function get_option( $post_id = 0, $option_name, $default = '' ) {
        if( $post_id == 0 ){
            $option_value = get_option( $option_name, null );
        } else {    
            $option_value = get_post_meta( $post_id, $option_name, true );
        }
        return (null == $option_value) ? $default : $option_value;
    }


}