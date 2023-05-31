<?php
/**
 * Views > Admin > Tab > Setting.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\Component;
use HVSFW\Admin\Inc\Field;

defined( 'ABSPATH' ) || exit;

$settings = get_option( '_hvsfw_main_settings' );

/**
 * Header
 */
echo Component::get_header( $args['page_title'] ); ?>

<div class="hd-container">

    <?php
        /**
         * Tab Navigation.
         */
        echo Component::get_tab_navigation([
            'class' => 'hd-mb-30',
            'tabs'  => [
                [
                    'title' => 'General',
                    'panel' => '#general'
                ],
                [
                    'title' => 'Global Style',
                    'panel' => '#global-style'
                ],
                [
                    'title' => 'Button Swatch',
                    'panel' => '#button-swatch'
                ],
                [
                    'title' => 'Color Swatch',
                    'panel' => '#color-swatch'
                ],
                [
                    'title' => 'Image Swatch',
                    'panel' => '#image-swatch'
                ],
                [
                    'title' => 'Tooltip',
                    'panel' => '#tooltip'
                ],
                [
                    'title' => 'Advanced',
                    'panel' => '#advanced'
                ]
            ]
        ]);
    ?>

    <?php

        /**
         * General - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'general',
            'state' => 'active'
        ]);

        /**
         * Save button settings - general_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ]);

        /**
         * General - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'General',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_enable',
            'group' => 'general_setting_group',
            'value' => $settings['gn_enable'],
            'label' => 'Enable Variation Swatch',
            'description' => 'Enable this to use variation swatch in the front-end.',
        ]);

        /**
         * General - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Advanced - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Advanced',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_enable_tooltip',
            'group' => 'general_setting_group',
            'value' => $settings['gn_enable_tooltip'],
            'label' => 'Enable Tooltip',
            'description' => 'Enable this to show tooltip on each term.',
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_disable_item_oos',
            'group' => 'general_setting_group',
            'value' => $settings['gn_disable_item_oos'],
            'label' => 'Disable Out Of Stock Term',
            'description' => 'Enable this to disable an out of stock variation term.',
        ]);

        echo Field::get_select_field([
            'name'  => 'gn_disable_item_style',
            'group' => 'general_setting_group',
            'value' => $settings['gn_disable_item_style'],
            'label' => 'Disabled Term Style',
            'description' => 'Select the style indicator of disabled term.',
            'options' => [
                [
                    'value' => 'hidden',
                    'label' => 'Hidden'
                ],
                [
                    'value' => 'blurred',
                    'label' => 'Blurred'
                ],
                [
                    'value' => 'crossed-out',
                    'label' => 'Crossed Out'
                ],
                [
                    'value' => 'blurred-crossed',
                    'label' => 'Blurred + Crossed Out'
                ]
            ]
        ]);

        /**
         * Advanced - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Product Single Page - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Product Page',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_note_field([
            'title' => 'Instruction',
            'message' => 'Note all the setting modified in here will be only applied in Product Single Page.'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_pp_enable',
            'group' => 'general_setting_group',
            'value' => $settings['gn_pp_enable'],
            'label' => 'Enable on Product Single Page',
            'description' => 'Enable this to use variation swatch in the product single page.',
        ]);

        /**
         * Product Single Page - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Shop Page - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Shop Page',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_note_field([
            'title'   => 'Instruction',
            'message' => 'Note all the setting modified in here will be only applied in Shop Page (Archive Page).'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_sp_enable',
            'group' => 'general_setting_group',
            'value' => $settings['gn_sp_enable'],
            'label' => 'Enable on Shop Page (Archive Page)',
            'description' => 'Enable this to use variation swatch in the shop page (archive page).',
        ]);

        echo Field::get_number_field([
            'name'  => 'gn_sp_attribute_limit',
            'group' => 'general_setting_group',
            'value' => $settings['gn_sp_attribute_limit'],
            'label' => 'Attributes Limit',
            'description' => 'Set the number of attributes to be displayed. For no limit retain the value 0.',
            'placeholder' => 'Attributes Limit'
        ]);

        /**
         * Shop Page - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Variation Filter - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Variation Filter',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_note_field([
            'title'   => 'Instruction',
            'message' => 'Variation filter is a list of product attributes presented as a series of swatches on the shop page to filter the products.'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_vf_enable_widget',
            'group' => 'general_setting_group',
            'value' => $settings['gn_vf_enable_widget'],
            'label' => 'Enable Classic Widget Version',
            'description' => 'Enable this to use variation filter in classic widget version.',
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_vf_enable_block',
            'group' => 'general_setting_group',
            'value' => $settings['gn_vf_enable_block'],
            'label' => 'Enable Gutenberg Block Version',
            'description' => 'Enable this to use variation filter in gutenberg block version.',
        ]);

        /**
         * Variation Filter - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Notice - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Notice',
            'class' => 'hd-mb-50'
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_nc_enable_notice',
            'group' => 'general_setting_group',
            'value' => $settings['gn_nc_enable_notice'],
            'label' => 'Enable WooCommerce Notice',
            'description' => 'Enable this to use the default woocommerce notice. Note this setting is only applicable in this plugin only, other plugin that are using woocommerce notice will not be affected.',
        ]);

        echo Field::get_switch_field([
            'name'  => 'gn_nc_auto_hide',
            'group' => 'general_setting_group',
            'value' => $settings['gn_nc_auto_hide'],
            'label' => 'Enable Auto Hide',
            'description' => 'Enable this to hide the notice automatically.',
        ]);

        echo Field::get_number_field([
            'name'  => 'gn_nc_duration',
            'group' => 'general_setting_group',
            'value' => $settings['gn_nc_duration'],
            'label' => 'Duration',
            'description' => 'Set the total milliseconds before the notice will automatically hide. Note this will only be applied if you enable auto hide.',
            'placeholder' => 'Duration'
        ]);

        /**
         * Notice - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Save button settings - general_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ]);

        /**
         * General - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php
        /**
         * Global Style - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'global-style',
            'state' => 'active'
        ]);

        /**
         * Save button settings - global_style_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'global_style_setting_group'
            ]
        ]);

        /**
         * Product Single Page - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Product Page',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_note_field([
            'title' => 'Instruction',
            'message' => 'Note all the setting modified in here will be only applied in Product Single Page.'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Swatch Label',
            'description' => 'Set the style of the swatch label.',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'gs_pp_sw_label_position',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_label_position'],
                    'label' => 'Position',
                    'options' => [
                        [
                            'value' => 'hidden',
                            'label' => 'Hidden'
                        ],
                        [
                            'value' => 'inline',
                            'label' => 'Inline'
                        ],
                        [
                            'value' => 'block',
                            'label' => 'Block'
                        ]
                    ]
                ]),
                Field::get_text_field([
                    'name'  => 'gs_pp_sw_label_fs',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_label_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'gs_pp_sw_label_fw',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_label_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'gs_pp_sw_label_ln',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_label_ln'],
                    'label' => 'Line Height',
                    'placeholder' => 'Line Height'
                ]),
                Field::get_text_field([
                    'name'  => 'gs_pp_sw_label_m',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_label_m'],
                    'label' => 'Margin',
                    'placeholder' => 'Margin'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'gs_pp_sw_label_clr',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_label_clr'],
                    'label' => 'Color',
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Swatch Term Gap',
            'description' => 'Set the row gap and column gap in each swatch term or attributes.',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'gs_pp_sw_item_gap_row',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_item_gap_row'],
                    'label' => 'Row',
                    'placeholder' => 'Row'
                ]),
                Field::get_text_field([
                    'name'  => 'gs_pp_sw_item_gap_col',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_pp_sw_item_gap_col'],
                    'label' => 'Column',
                    'placeholder' => 'Column'
                ])
            ]
        ]);

        /**
         * Product Page - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Shop Page - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Shop Page',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_note_field([
            'title' => 'Instruction',
            'message' => 'Note all the setting modified in here will be only applied in Shop Page (Archive Page).'
        ]);

        echo Field::get_select_field([
            'name'  => 'gs_sp_sw_alignment',
            'group' => 'global_style_setting_group',
            'value' => $settings['gs_sp_sw_alignment'],
            'label' => 'Swatch Alignment',
            'description' => 'Select the swatch alignment.',
            'options' => [
                [
                    'value' => 'left',
                    'label' => 'Left'
                ],
                [
                    'value' => 'center',
                    'label' => 'Center'
                ],
                [
                    'value' => 'right',
                    'label' => 'Right'
                ]
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Swatch Label',
            'description' => 'Set the style of the swatch label.',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'gs_sp_sw_label_position',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_label_position'],
                    'label' => 'Position',
                    'options' => [
                        [
                            'value' => 'hidden',
                            'label' => 'Hidden'
                        ],
                        [
                            'value' => 'inline',
                            'label' => 'Inline'
                        ],
                        [
                            'value' => 'block',
                            'label' => 'Block'
                        ]
                    ]
                ]),
                Field::get_text_field([
                    'name'  => 'gs_sp_sw_label_fs',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_label_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'gs_sp_sw_label_fw',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_label_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'gs_sp_sw_label_ln',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_label_ln'],
                    'label' => 'Line Height',
                    'placeholder' => 'Line Height'
                ]),
                Field::get_text_field([
                    'name'  => 'gs_sp_sw_label_m',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_label_m'],
                    'label' => 'Margin',
                    'placeholder' => 'Margin'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'gs_sp_sw_label_clr',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_label_clr'],
                    'label' => 'Color',
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Swatch Term Gap',
            'description' => 'Set the row gap and column gap in each swatch term or attributes.',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'gs_sp_sw_item_gap_row',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_item_gap_row'],
                    'label' => 'Row',
                    'placeholder' => 'Row'
                ]),
                Field::get_text_field([
                    'name'  => 'gs_sp_sw_item_gap_col',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_sp_sw_item_gap_col'],
                    'label' => 'Column',
                    'placeholder' => 'Column'
                ])
            ]
        ]);

        /**
         * Shop Page - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * More Link - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'More Link',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_note_field([
            'title' => 'Instruction',
            'message' => 'Note more link will be only be displayed on shop page if the attribute limit value is greater than 0.'
        ]);

        echo Field::get_select_field([
            'name'  => 'gs_ml_format',
            'group' => 'global_style_setting_group',
            'value' => $settings['gs_ml_format'],
            'label' => 'Format',
            'options' => [
                [
                    'value' => 'label',
                    'label' => 'Label'
                ],
                [
                    'value' => 'number',
                    'label' => 'Number'
                ],
                [
                    'value' => 'label-number',
                    'label' => 'Label & Number'
                ]
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'gs_ml_label',
            'group' => 'global_style_setting_group',
            'value' => $settings['gs_ml_label'],
            'label' => 'Label',
            'placeholder' => 'Label'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Font',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'gs_ml_fs',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_ml_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'gs_ml_fw',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_ml_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'gs_ml_ln',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_ml_ln'],
                    'label' => 'Line Height',
                    'placeholder' => 'Line Height'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Text Color',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'gs_ml_txt_clr',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_ml_txt_clr'],
                    'label' => 'Color',
                ]),
                Field::get_color_picker_field([
                    'name'  => 'gs_ml_txt_hv_clr',
                    'group' => 'global_style_setting_group',
                    'value' => $settings['gs_ml_txt_hv_clr'],
                    'label' => 'Hover & Active Color',
                ])
            ]
        ]);

        /**
         * More Link - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Save button settings - global_style_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'global_style_setting_group'
            ]
        ]);

        /**
         * Global Style - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php
        /**
         * Button Swatch - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'button-swatch',
            'state' => 'default'
        ]);
        
        /**
         * Save button settings - general_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'button_setting_group'
            ]
        ]);
        
        /**
         * Default Style - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Default Style',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_select_field([
            'name'  => 'bn_shape',
            'group' => 'button_setting_group',
            'value' => $settings['bn_shape'],
            'label' => 'Shape',
            'description' => 'Select your preferred shape for swatch button.',
            'options' => [
                [
                    'value' => 'square',
                    'label' => 'Square'
                ],
                [
                    'value' => 'circle',
                    'label' => 'Circle'
                ],
                [
                    'value' => 'custom',
                    'label' => 'Custom'
                ]
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Size',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'bn_wd',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_wd'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_text_field([
                    'name'  => 'bn_ht',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_ht'],
                    'label' => 'Height',
                    'placeholder' => 'Height'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Font',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'bn_fs',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'bn_fw',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Text Color',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'bn_txt_clr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_txt_clr'],
                    'label' => 'Color',
                ]),
                Field::get_color_picker_field([
                    'name'  => 'bn_txt_hv_clr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_txt_hv_clr'],
                    'label' => 'Hover & Active Color',
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Background Color',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'bn_bg_clr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_bg_clr'],
                    'label' => 'Color',
                ]),
                Field::get_color_picker_field([
                    'name'  => 'bn_bg_hv_clr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_bg_hv_clr'],
                    'label' => 'Hover & Active Color',
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Padding',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'bn_pt',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_pt'],
                    'label' => 'Top',
                    'placeholder' => 'Top'
                ]),
                Field::get_text_field([
                    'name'  => 'bn_pb',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_pb'],
                    'label' => 'Bottom',
                    'placeholder' => 'Bottom'
                ]),
                Field::get_text_field([
                    'name'  => 'bn_pl',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_pl'],
                    'label' => 'Left',
                    'placeholder' => 'Left'
                ]),
                Field::get_text_field([
                    'name'  => 'bn_pr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_pr'],
                    'label' => 'Right',
                    'placeholder' => 'Right'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Border',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'bn_bs',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_bs'],
                    'label' => 'Style',
                    'options' => Helper::get_border_style_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'bn_bw',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_bw'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'bn_b_clr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_b_clr'],
                    'label' => 'Color'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'bn_b_hv_clr',
                    'group' => 'button_setting_group',
                    'value' => $settings['bn_b_hv_clr'],
                    'label' => 'Hover & Active Color'
                ])
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'bn_br',
            'group' => 'button_setting_group',
            'value' => $settings['bn_br'],
            'label' => 'Border Radius',
            'description' => 'Note this custom border radius will be only be applied if the shape is set to custom.',
            'placeholder' => 'Border Radius'
        ]);

        /**
         * Default Style - Card Closing.
         */
        echo Component::get_card_closing();
        
        /**
         * Save button settings - button_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'button_setting_group'
            ]
        ]);
        
        /**
         * Button Swatch - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php
        /**
         * Color Swatch - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'color-swatch',
            'state' => 'default'
        ]);
        
        /**
         * Save button settings - color_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'color_setting_group'
            ]
        ]);

        /**
         * Default Style - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Default Style',
            'class' => 'hd-mb-30'
        ]);
        
        echo Field::get_select_field([
            'name'  => 'cr_shape',
            'group' => 'color_setting_group',
            'value' => $settings['cr_shape'],
            'label' => 'Shape',
            'description' => 'Select your preferred shape for swatch color.',
            'options' => [
                [
                    'value' => 'square',
                    'label' => 'Square'
                ],
                [
                    'value' => 'circle',
                    'label' => 'Circle'
                ],
                [
                    'value' => 'custom',
                    'label' => 'Custom'
                ]
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'cr_size',
            'group' => 'color_setting_group',
            'value' => $settings['cr_size'],
            'label' => 'Dimension',
            'description' => 'Note this will be applicable in square and circle shape only.',
            'placeholder' => 'Dimension'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Size',
            'description' => 'Note this will be applicable in custom shape only.',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'cr_wd',
                    'group' => 'color_setting_group',
                    'value' => $settings['cr_wd'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_text_field([
                    'name'  => 'cr_ht',
                    'group' => 'color_setting_group',
                    'value' => $settings['cr_ht'],
                    'label' => 'Height',
                    'placeholder' => 'Height'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Border',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'cr_bs',
                    'group' => 'color_setting_group',
                    'value' => $settings['cr_bs'],
                    'label' => 'Style',
                    'options' => Helper::get_border_style_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'cr_bw',
                    'group' => 'color_setting_group',
                    'value' => $settings['cr_bw'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'cr_b_clr',
                    'group' => 'color_setting_group',
                    'value' => $settings['cr_b_clr'],
                    'label' => 'Color'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'cr_b_hv_clr',
                    'group' => 'color_setting_group',
                    'value' => $settings['cr_b_hv_clr'],
                    'label' => 'Hover & Active Color'
                ])
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'cr_br',
            'group' => 'color_setting_group',
            'value' => $settings['cr_br'],
            'label' => 'Border Radius',
            'description' => 'Note this custom border radius will be only be applied if the shape is set to custom.',
            'placeholder' => 'Border Radius'
        ]);

        /**
         * Default Style - Card Closing.
         */
        echo Component::get_card_closing();
        
        /**
         * Save button settings - color_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'color_setting_group'
            ]
        ]);
        
        /**
         * Color Swatch - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php
        /**
         * Image Swatch - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'image-swatch',
            'state' => 'default'
        ]);
        
        /**
         * Save button settings - image_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'image_setting_group'
            ]
        ]);

        /**
         * Default Style - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Default Style',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_select_field([
            'name'  => 'im_shape',
            'group' => 'image_setting_group',
            'value' => $settings['im_shape'],
            'label' => 'Shape',
            'description' => 'Select your preferred shape for swatch image.',
            'options' => [
                [
                    'value' => 'square',
                    'label' => 'Square'
                ],
                [
                    'value' => 'circle',
                    'label' => 'Circle'
                ],
                [
                    'value' => 'custom',
                    'label' => 'Custom'
                ]
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'im_size',
            'group' => 'image_setting_group',
            'value' => $settings['im_size'],
            'label' => 'Dimension',
            'description' => 'Note this will be applicable in square and circle image only.',
            'placeholder' => 'Dimension'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Size',
            'description' => 'Note this will be applicable in custom image only.',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'im_wd',
                    'group' => 'image_setting_group',
                    'value' => $settings['im_wd'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_text_field([
                    'name'  => 'im_ht',
                    'group' => 'image_setting_group',
                    'value' => $settings['im_ht'],
                    'label' => 'Height',
                    'placeholder' => 'Height'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Border',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'im_bs',
                    'group' => 'image_setting_group',
                    'value' => $settings['im_bs'],
                    'label' => 'Style',
                    'options' => Helper::get_border_style_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'im_bw',
                    'group' => 'image_setting_group',
                    'value' => $settings['im_bw'],
                    'label' => 'Width',
                    'placeholder' => 'Width'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'im_b_clr',
                    'group' => 'image_setting_group',
                    'value' => $settings['im_b_clr'],
                    'label' => 'Color'
                ]),
                Field::get_color_picker_field([
                    'name'  => 'im_b_hv_clr',
                    'group' => 'image_setting_group',
                    'value' => $settings['im_b_hv_clr'],
                    'label' => 'Hover & Active Color'
                ])
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'im_br',
            'group' => 'image_setting_group',
            'value' => $settings['im_br'],
            'label' => 'Border Radius',
            'description' => 'Note this custom border radius will be only be applied if the shape is set to custom.',
            'placeholder' => 'Border Radius'
        ]);

        /**
         * Default Style - Card Closing.
         */
        echo Component::get_card_closing();
        
        /**
         * Save button settings - image_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'image_setting_group'
            ]
        ]);
        
        /**
         * Image Swatch - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

    <?php
        /**
         * Tooltip - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'tooltip',
            'state' => 'default'
        ]);
        
        /**
         * Save button settings - tooltip_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'tooltip_setting_group'
            ]
        ]);

        /**
         * Default Style - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Default Style',
            'class' => 'hd-mb-30'
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Size',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'tl_mn_wd',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_mn_wd'],
                    'label' => 'Min Width',
                    'placeholder' => 'Min Width'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_mx_wd',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_mx_wd'],
                    'label' => 'Max Width',
                    'placeholder' => 'Max Width'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_mn_ht',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_mn_ht'],
                    'label' => 'Min Height',
                    'placeholder' => 'Min Height'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_mx_ht',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_mx_ht'],
                    'label' => 'Max Height',
                    'placeholder' => 'Max Height'
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Font',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'tl_fs',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_fs'],
                    'label' => 'Font Size',
                    'placeholder' => 'Font Size'
                ]),
                Field::get_select_field([
                    'name'  => 'tl_fw',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_fw'],
                    'label' => 'Font Weight',
                    'options' => Helper::get_font_weight_choices()
                ]),
                Field::get_text_field([
                    'name'  => 'tl_ln',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_ln'],
                    'label' => 'Line Height',
                    'placeholder' => 'Line Height'
                ]),
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Color',
            'fields' => [
                Field::get_color_picker_field([
                    'name'  => 'tl_txt_clr',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_txt_clr'],
                    'label' => 'Text Color',
                ]),
                Field::get_color_picker_field([
                    'name'  => 'tl_bg_clr',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_bg_clr'],
                    'label' => 'Background Color',
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Image Size & Radius',
            'description' => 'Set the image size, width, height and radius for tooltip image.',
            'fields' => [
                Field::get_select_field([
                    'name'  => 'tl_image_src_wd',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_image_src_wd'],
                    'label' => 'Image Size',
                    'options' => Helper::get_image_sizes()
                ]),
                Field::get_text_field([
                    'name'  => 'tl_image_mx_wd',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_image_mx_wd'],
                    'label' => 'Max Width',
                    'placeholder' => 'Max Width'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_image_mx_ht',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_image_mx_ht'],
                    'label' => 'Max Height',
                    'placeholder' => 'Max Height'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_image_br',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_image_br'],
                    'label' => 'Border Radius',
                    'placeholder' => 'Border Radius'
                ])
            ]
        ]);

        echo Field::get_multiple_field([
            'label'  => 'Padding',
            'fields' => [
                Field::get_text_field([
                    'name'  => 'tl_pt',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_pt'],
                    'label' => 'Top',
                    'placeholder' => 'Top'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_pb',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_pb'],
                    'label' => 'Bottom',
                    'placeholder' => 'Bottom'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_pl',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_pl'],
                    'label' => 'Left',
                    'placeholder' => 'Left'
                ]),
                Field::get_text_field([
                    'name'  => 'tl_pr',
                    'group' => 'tooltip_setting_group',
                    'value' => $settings['tl_pr'],
                    'label' => 'Right',
                    'placeholder' => 'Right'
                ]),
            ]
        ]);

        echo Field::get_text_field([
            'name'  => 'tl_br',
            'group' => 'tooltip_setting_group',
            'value' => $settings['tl_br'],
            'label' => 'Border Radius',
            'placeholder' => 'Border Radius'
        ]);

        /**
         * Default Style - Card Closing.
         */
        echo Component::get_card_closing();
        
        /**
         * Save button settings - tooltip_setting_group.
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'tooltip_setting_group'
            ]
        ]);
        
        /**
         * Tooltip - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>
    
    <?php
        /**
         * Advanced - Tab Opening.
         */
        echo Component::get_tab_panel_opening([
            'id'    => 'advanced',
            'state' => 'active'
        ]);

        /**
         * Save button settings - advanced_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-mb-30 hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]);

        /**
         * Optimization - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Optimization',
            'class' => 'hd-mb-50'
        ]);

        echo Field::get_note_field([
            'title' => 'Instruction',
            'message' => 'Note that all settings here are used to enhance the performance of this plugin on the front-end side. This can improve your speed score in services like Pingdom, GTmetrix and PageSpeed.'
        ]);

        echo Field::get_switch_field([
            'name'  => 'ad_opt_enable_cache',
            'group' => 'advanced_setting_group',
            'value' => $settings['ad_opt_enable_cache'],
            'label' => 'Enable Caching',
            'description' => 'Enable this to cache the external styles and scripts.',
        ]);

        echo Field::get_switch_field([
            'name'  => 'ad_opt_enable_minify',
            'group' => 'advanced_setting_group',
            'value' => $settings['ad_opt_enable_minify'],
            'label' => 'Enable CSS & JS Minification',
            'description' => 'Enable this to minify the internal and external styles and scripts.',
        ]);

        echo Field::get_switch_field([
            'name'  => 'ad_opt_enable_defer',
            'group' => 'advanced_setting_group',
            'value' => $settings['ad_opt_enable_defer'],
            'label' => 'Enable Deffered JS',
            'description' => 'Enable this to load external scripts in deffered way.',
        ]);

        /**
         * Optimization - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Additional - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Additional',
            'class' => 'hd-mb-50'
        ]);

        echo Field::get_textarea_field([
            'name'  => 'ad_add_custom_css',
            'group' => 'advanced_setting_group',
            'value' => $settings['ad_add_custom_css'],
            'label' => 'Custom CSS',
            'description' => 'Add your own CSS code here to customize the appearance of variation swatches components at the front-end.'
        ]);

        /**
         * Additional - Card Closing.
         */
        echo Component::get_card_closing();

        /**
         * Save button settings - advanced_setting_group
         */
        echo Component::get_button([
            'type'  => 'normal',
            'class' => 'hvsfw-js-save-setting-btn hd-ds-block hd-ml-auto',
            'label' => 'Save Changes',
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]);

        /**
         * Advanced - Tab Closing.
         */
        echo Component::get_tab_panel_closing();
    ?>

</div>

<?php 
    /**
     * Footer.
     */
    echo Component::get_footer(); 
?>