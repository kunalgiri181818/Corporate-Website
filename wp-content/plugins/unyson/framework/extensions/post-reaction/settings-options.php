<?php

$extension = fw()->extensions->get( 'post-reaction' );
$img_path  = $extension->locate_URI( '/static/img' );

$options = array(
    'general' => array(
        'title'   => __( 'General', 'fw' ),
        'type'    => 'box',
        'options' => array(
            'show-reactions'      => array(
                'type'  => 'checkbox',
                'label' => __( 'Show Reactions', 'fw' ),
                'value' => true,
            ),
            'available-reactions' => array(
                'type'            => 'addable-box',
                'label'           => __( 'Available reactions', 'fw' ),
                'value'           => array(
                    array(
                        'title' => __( 'Amazed', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-amazed',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-amazed',
                            )
                        )
                    ),
                    array(
                        'title' => __( 'Anger', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-anger',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-anger',
                            )
                        )
                    ),
                    array(
                        'title' => __( 'Bad', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-bad',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-bad',
                            )
                        )
                    ),
                    array(
                        'title' => __( 'Cool', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-cool',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-cool',
                            )
                        )
                    ),
                    array(
                        'title' => __( 'Joy', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-joy',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-joy',
                            )
                        )
                    ),
                    array(
                        'title' => __( 'Like', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-like',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-like',
                            )
                        )
                    ),
                    array(
                        'title' => __( 'Lol', 'crum-ext-post-reaction' ),
                        'reaction_type' => 'crumina-reaction-lol',
                        'icon' => array(
                            'predefined' => array(
                                'ico'   => 'crumina-reaction-lol',
                            )
                        )
                    ),
                ),
                'box-options'     => array(
                    'title' => array( 'type' => 'text' ),
                    'reaction_type' => array(
                        'title' => __( 'Reaction type', 'crum-ext-post-reaction' ),
                        'type'    => 'select',
                        'choices' => array(
                            'crumina-reaction-amazed' => __( 'Amazed', 'crum-ext-post-reaction' ),
                            'crumina-reaction-anger' => __( 'Anger', 'crum-ext-post-reaction' ),
                            'crumina-reaction-bad' => __( 'Bad', 'crum-ext-post-reaction' ),
                            'crumina-reaction-cool' => __( 'Cool', 'crum-ext-post-reaction' ),
                            'crumina-reaction-joy' => __( 'Joy', 'crum-ext-post-reaction' ),
                            'crumina-reaction-like' => __( 'Like', 'crum-ext-post-reaction' ),
                            'crumina-reaction-lol' => __( 'Lol', 'crum-ext-post-reaction' ),
                        ),
                    ),
                    'image_type' => array(
                        'title' => __( 'Icon', 'crum-ext-post-reaction' ),
                        'type'    => 'radio',
                        'value'   => 'predefined',
                        'choices' => array(
                            'predefined' => __( 'Predefined icons', 'crum-ext-post-reaction' ),
                            'custom'     => __( 'Custom icon', 'crum-ext-post-reaction' ),
                        ),
                    ),
                    'icon'   => array(
                        'type'    => 'multi-picker',
						'label'   => false,
						'desc'    => false,
						'picker'  => 'image_type',
                        'choices' => array(
							'predefined' => array(
                                'ico'   => array(
                                    'type'    => 'image-picker',
                                    'blank'   => true,
                                    'choices' => array(
                                        'crumina-reaction-amazed' => "{$img_path}/crumina-reaction-amazed.png",
                                        'crumina-reaction-anger'  => "{$img_path}/crumina-reaction-anger.png",
                                        'crumina-reaction-bad'    => "{$img_path}/crumina-reaction-bad.png",
                                        'crumina-reaction-cool'   => "{$img_path}/crumina-reaction-cool.png",
                                        'crumina-reaction-joy'    => "{$img_path}/crumina-reaction-joy.png",
                                        'crumina-reaction-like'   => "{$img_path}/crumina-reaction-like.png",
                                        'crumina-reaction-lol'    => "{$img_path}/crumina-reaction-lol.png",
                                    ),
                                ),
                            ),
                            'custom' => array(
                                'ico_file' => array(
                                    'type'  => 'upload',
                                    'label' => __('Icon', 'crum-ext-post-reaction'),
                                    'images_only' => true,
                                )
                            )
                        )
                    ),
                ),
                'template'        => '{{- title }}',
                'limit'           => 0,
                'add-button-text' => __( 'Add', 'fw' ),
                'sortable'        => true,
            )
        ),
    ),
);
