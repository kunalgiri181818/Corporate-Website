(function (wpI18n, wpBlocks, wpElement, wpBlockEditor, wpComponents, serverSideRender) {
    const { registerBlockType } = wp.blocks;
    const { InspectorControls, useBlockProps, MediaUpload, MediaUploadCheck } = wp.blockEditor;
    const { useState } = wp.element;
    const ServerSideRender = serverSideRender;
    const { PanelBody, PanelRow, Button, Spinner, ResponsiveWrapper, CheckboxControl, TextControl, IconButton, TextareaControl, SelectControl, RangeControl } = wp.components;
    const { __ } = wpI18n;

    registerBlockType('pk/portfoliokit', {
        title: 'Portfolio Kit',
        apiVersion: 2,
        category: 'pk_blocks',
        keywords: ['portfolio'],
        attributes: {
            template: {
                type: 'string',
                default: pk_global_settings.pk_settings_loop_template != '' ? pk_global_settings.pk_settings_loop_template : 'classic'
            },
            sort_panel_p: {
                type: 'boolean',
                default: true
            },
            order: {
                type: 'string',
                default: 'DESC'
            },
            posts_per_page: {
                type: 'number',
                default: pk_global_settings.pk_settings_loop_posts_per_page != '' ? parseInt(pk_global_settings.pk_settings_loop_posts_per_page) : 6
            },
            cols: {
                type: 'string',
                default: pk_global_settings.pk_settings_loop_cols != '' ? pk_global_settings.pk_settings_loop_cols : '2'
            },
            pagination: {
                type: 'string',
                default: pk_global_settings.pk_settings_loop_pagination != '' ? pk_global_settings.pk_settings_loop_pagination : 'numbers'
            },
        },
        edit: (props) => {
            const { attributes, setAttributes } = props;

            const blockProps = useBlockProps();
            return (
                <div>
                    <InspectorControls>
                        <PanelBody
                            title={__('Portfolio Kit', 'portfolio-kit')}
                            initialOpen={true}
                        >
                            <PanelRow>
                                <SelectControl
                                    label={__('Template', 'portfolio-kit')}
                                    value={attributes.template}
                                    options={[
                                        { label: __('Classic', 'portfolio-kit'), value: 'classic' },
                                        { label: __('Modern', 'portfolio-kit'), value: 'modern' },
                                        { label: __('Modern button', 'portfolio-kit'), value: 'modern-button' },
                                    ]}
                                    onChange={(newval) => setAttributes({ template: newval })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <CheckboxControl
                                    label={__('Sort panel', 'portfolio-kit')}
                                    checked={attributes.sort_panel_p}
                                    onChange={(newval) => setAttributes({ sort_panel_p: newval })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <SelectControl
                                    label={__('Order', 'portfolio-kit')}
                                    value={attributes.order}
                                    options={[
                                        { label: __('Descending', 'portfolio-kit'), value: 'DESC' },
                                        { label: __('Ascending', 'portfolio-kit'), value: 'ASC' },
                                    ]}
                                    onChange={(newval) => setAttributes({ order: newval })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <RangeControl
                                    label={__('Items per page', 'portfolio-kit')}
                                    value={attributes.posts_per_page}
                                    onChange={(val) => setAttributes({ posts_per_page: val })}
                                    min={1}
                                    max={40}
                                />
                            </PanelRow>
                            <PanelRow>
                                <SelectControl
                                    label={__('Columns number', 'portfolio-kit')}
                                    value={attributes.cols}
                                    options={[
                                        { label: __('1', 'portfolio-kit'), value: '1' },
                                        { label: __('2', 'portfolio-kit'), value: '2' },
                                        { label: __('3', 'portfolio-kit'), value: '3' },
                                        { label: __('4', 'portfolio-kit'), value: '4' },
                                        { label: __('5', 'portfolio-kit'), value: '5' },
                                    ]}
                                    onChange={(newval) => setAttributes({ cols: newval })}
                                />
                            </PanelRow>
                            <PanelRow>
                                <SelectControl
                                    label={__('Type of pages pagination', 'portfolio-kit')}
                                    value={attributes.pagination}
                                    options={[
                                        { label: __('Numbers', 'portfolio-kit'), value: 'numbers' },
                                        { label: __('Load more ajax', 'portfolio-kit'), value: 'ajax' },
                                    ]}
                                    onChange={(newval) => setAttributes({ pagination: newval })}
                                />
                            </PanelRow>
                        </PanelBody>
                    </InspectorControls>
                    <div { ...blockProps }>
                        <ServerSideRender
                            block="pk/portfoliokit"
                            attributes={ attributes }
                        />
                    </div>
                </div>
            );
        },
        save: (props) => {
            return null
        }
    });

})(wp.i18n, wp.blocks, wp.element, wp.blockEditor, wp.components, wp.serverSideRender);