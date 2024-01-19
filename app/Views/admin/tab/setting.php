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
use HVSFW\Admin\Tab\Setting\SettingApi;

defined( 'ABSPATH' ) || exit;

// Get the setting current value.
$settings = SettingApi::get_settings();

/**
 * Header
 */
echo Component::get_header();

/**
 * Tab Navigation.
 */
echo Component::get_tab_navigation([
    'class' => 'hd-mb-30',
    'tabs'  => [
        [
            'title' => __( 'General', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#general'
        ],
        [
            'title' => __( 'Global Style', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#global-style'
        ],
        [
            'title' => __( 'Button Swatch', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#button-swatch'
        ],
        [
            'title' => __( 'Color Swatch', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#color-swatch'
        ],
        [
            'title' => __( 'Image Swatch', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#image-swatch'
        ],
        [
            'title' => __( 'Tooltip', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#tooltip'
        ],
        [
            'title' => __( 'Advanced', HVSFW_PLUGIN_DOMAIN ),
            'panel' => '#advanced'
        ]
    ]
]);

/**
 * General Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'general',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'General', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Variation Swatches', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable'],
                            'description' => __( 'Enable this option to activate handy variation swatches functionalities in the front-end.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Advanced', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Tooltip', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_enable_tooltip',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable_tooltip'],
                            'description' => __( 'Enable this option to show tooltip on each term.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Disable Out Of Stock Term', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_disable_item_oos',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_disable_item_oos'],
                            'description' => __( 'Enable this option to disable an out of stock variation term.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Disabled Term Style', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'gn_disable_item_style',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_disable_item_style'],
                            'description' => __( 'Select your preferred style indicator of disabled term.', HVSFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'hidden',
                                    'label' => __( 'Hidden', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'blurred',
                                    'label' => __( 'Blurred', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'crossed-out',
                                    'label' => __( 'Crossed Out', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'blurred-crossed',
                                    'label' => __( 'Blurred + Crossed Out', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Product Single Page', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Product Single Page.', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable on Product Single Page', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_pp_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_pp_enable'],
                            'description' => __( 'Enable this option to use variation swatch in the product single page.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Shop Page', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Shop Page (Archive Page).', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable on Shop Page (Archive Page)', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_sp_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_sp_enable'],
                            'description' => __( 'Enable this option to use variation swatch in the shop page (archive page).', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Attributes Limit', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_number_field([
                            'name'  => 'gn_sp_attribute_limit',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_sp_attribute_limit'],
                            'description' => __( 'Set the number of attributes to be displayed. For no limit retain the value 0.', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Attributes Limit', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Variation Filter', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Variation filter is a list of product attributes presented as a series of swatches on the shop page to filter the products.', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Classic Widget Version', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_vf_enable_widget',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_vf_enable_widget'],
                            'description' => __( 'Enable this option to use variation filter in classic widget version.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Gutenberg Block Version', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_vf_enable_block',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_vf_enable_block'],
                            'description' => __( 'Enable this option to use variation filter in gutenberg block version.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Notice', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable WooCommerce Notice', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_nc_enable_notice',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_nc_enable_notice'],
                            'description' => __( 'Enable this option to use the default woocommerce notice. Note this setting is only applicable in this plugin only, other plugin that are using woocommerce notice will not be affected.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Auto Hide', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'gn_nc_auto_hide',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_nc_auto_hide'],
                            'description' => __( 'Enable this option to hide the notice automatically.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Duration', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_number_field([
                            'name'  => 'gn_nc_duration',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_nc_duration'],
                            'description' => __( 'Set the total milliseconds before the notice will automatically hide. Note this will only be applied if you enable auto hide.', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Duration', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'general_setting_group'
            ]
        ])
    ]
]);

/**
 * Global Style Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'global-style',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'global_style_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Product Single Page', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Product Single Page.', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Label', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Set the style of the swatch label.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'gs_pp_sw_label_position',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_position'],
                            'label' => 'Position',
                            'options' => [
                                [
                                    'value' => 'hidden',
                                    'label' => __( 'Hidden', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'inline',
                                    'label' => __( 'Inline', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'block',
                                    'label' => __( 'Block', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_pp_sw_label_fs',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_fs'],
                            'label' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'gs_pp_sw_label_fw',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_fw'],
                            'label' => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_pp_sw_label_ln',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_ln'],
                            'label' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_pp_sw_label_m',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_m'],
                            'label' => __( 'Margin', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Margin', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'gs_pp_sw_label_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Term Gap', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Set the row gap and column gap in each swatch term or attributes.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'gs_pp_sw_item_gap_row',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_item_gap_row'],
                            'label' => __( 'Row', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Row', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_pp_sw_item_gap_col',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_item_gap_col'],
                            'label' => __( 'Column', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Column', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Shop Page', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Shop Page (Archive Page).', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Alignment', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'gs_sp_sw_alignment',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_alignment'],
                            'description' => __( 'Select the swatch alignment.', HVSFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'left',
                                    'label' => __( 'Left', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'center',
                                    'label' => __( 'Center', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'right',
                                    'label' => __( 'Right', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Label', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Set the style of the swatch label.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'gs_sp_sw_label_position',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_position'],
                            'label' => __( 'Position', HVSFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'hidden',
                                    'label' => __( 'Hidden', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'inline',
                                    'label' => __( 'Inline', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'block',
                                    'label' => __( 'Block', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_sp_sw_label_fs',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_fs'],
                            'label' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'gs_sp_sw_label_fw',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_fw'],
                            'label' => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_sp_sw_label_ln',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_ln'],
                            'label' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_sp_sw_label_m',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_m'],
                            'label' => __( 'Margin', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Margin', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'gs_sp_sw_label_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Term Gap', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Set the row gap and column gap in each swatch term or attributes.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'gs_sp_sw_item_gap_row',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_item_gap_row'],
                            'label' => __( 'Row', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Row', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_sp_sw_item_gap_col',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_item_gap_col'],
                            'label' => __( 'Column', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Column', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'More Link', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note more link will be only be displayed on shop page if the attribute limit value is greater than 0.', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Format', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'gs_ml_format',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_format'],
                            'options' => [
                                [
                                    'value' => 'label',
                                    'label' => __( 'Label', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'number',
                                    'label' => __( 'Number', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'label-number',
                                    'label' => __( 'Label & Number', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Label', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'gs_ml_label',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_label'],
                            'placeholder' => __( 'Label', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Font', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'gs_ml_fs',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_fs'],
                            'label' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'gs_ml_fw',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_fw'],
                            'label' => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'gs_ml_ln',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_ln'],
                            'label' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Text Color', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'gs_ml_txt_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_txt_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'gs_ml_txt_hv_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_txt_hv_clr'],
                            'label' => __( 'Hover & Active Color', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'global_style_setting_group'
            ]
        ])
    ]
]);

/**
 * Button Swatch Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'button-swatch',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'button_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Default Style', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Shape', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'bn_shape',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_shape'],
                            'description' => __( 'Select your preferred shape for swatch button.', HVSFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'square',
                                    'label' => __( 'Square', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'circle',
                                    'label' => __( 'Circle', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'custom',
                                    'label' => __( 'Custom', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'bn_wd',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_wd'],
                            'label' => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'bn_ht',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_ht'],
                            'label' => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Font', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'bn_fs',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_fs'],
                            'label' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'bn_fw',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_fw'],
                            'label' => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Text Color', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'bn_txt_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_txt_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'bn_txt_hv_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_txt_hv_clr'],
                            'label' => __( 'Hover & Active Color', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'bn_bg_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bg_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'bn_bg_hv_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bg_hv_clr'],
                            'label' => __( 'Hover & Active Color', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Padding', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'bn_pt',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pt'],
                            'label' => __( 'Top', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Top', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'bn_pb',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pb'],
                            'label' => __( 'Bottom', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Bottom', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'bn_pl',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pl'],
                            'label' => __( 'Left', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Left', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'bn_pr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pr'],
                            'label' => __( 'Right', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Right', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Note this custom border radius will be only be applied if the shape is set to custom.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'bn_bs',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bs'],
                            'label' => __( 'Style', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_border_style_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'bn_bw',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bw'],
                            'label' => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'bn_b_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_b_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'bn_b_hv_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_b_hv_clr'],
                            'label' => __( 'Hover & Active Color', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'bn_br',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_br'],
                            'label' => __( 'Radius', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Radius', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'button_setting_group'
            ]
        ])
    ]
]);

/**
 * Color Swatch Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'color-swatch',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'color_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Default Style', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Shape', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'cr_shape',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_shape'],
                            'description' => __( 'Select your preferred shape for swatch color.', HVSFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'square',
                                    'label' => __( 'Square', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'circle',
                                    'label' => __( 'Circle', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'custom',
                                    'label' => __( 'Custom', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Dimension', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'cr_size',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_size'],
                            'description' => __( 'Note this will be applicable in square and circle shape only.', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Dimension', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Note this will be applicable in custom shape only.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'cr_wd',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_wd'],
                            'label' => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'cr_ht',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_ht'],
                            'label' => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Note this custom border radius will be only be applied if the shape is set to custom.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'cr_bs',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_bs'],
                            'label' => __( 'Style', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_border_style_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'cr_bw',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_bw'],
                            'label' => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'cr_b_clr',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_b_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'cr_b_hv_clr',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_b_hv_clr'],
                            'label' => __( 'Hover & Active Color', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'cr_br',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_br'],
                            'label' => __( 'Radius', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Radius', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'color_setting_group'
            ]
        ])
    ]
]);

/**
 * Image Swatch Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'image-swatch',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'image_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Default Style', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Shape', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'im_shape',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_shape'],
                            'description' => __( 'Select your preferred shape for swatch image.', HVSFW_PLUGIN_DOMAIN ),
                            'options' => [
                                [
                                    'value' => 'square',
                                    'label' => __( 'Square', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'circle',
                                    'label' => __( 'Circle', HVSFW_PLUGIN_DOMAIN )
                                ],
                                [
                                    'value' => 'custom',
                                    'label' => __( 'Custom', HVSFW_PLUGIN_DOMAIN )
                                ]
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Dimension', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'im_size',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_size'],
                            'description' => __( 'Note this will be applicable in square and circle shape only.', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Dimension', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Note this will be applicable in custom shape only.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'im_wd',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_wd'],
                            'label' => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'im_ht',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_ht'],
                            'label' => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Note this custom border radius will be only be applied if the shape is set to custom.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'im_bs',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_bs'],
                            'label' => __( 'Style', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_border_style_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'im_bw',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_bw'],
                            'label' => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'im_b_clr',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_b_clr'],
                            'label' => __( 'Color', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'im_b_hv_clr',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_b_hv_clr'],
                            'label' => __( 'Hover & Active Color', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'im_br',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_br'],
                            'label' => __( 'Radius', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Radius', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'image_setting_group'
            ]
        ])
    ]
]);

/**
 * Tooltip Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'tooltip',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'tooltip_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Default Style', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Size', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'tl_mn_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mn_wd'],
                            'label' => __( 'Minimum Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Minimum Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_mx_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mx_wd'],
                            'label' => __( 'Maximum Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Maximum Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_mn_ht',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mn_ht'],
                            'label' => __( 'Minimum Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Minimum Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_mx_ht',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mx_ht'],
                            'label' => __( 'Maximum Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Maximum Height', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Font', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'tl_fs',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_fs'],
                            'label' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Font Size', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_select_field([
                            'name'  => 'tl_fw',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_fw'],
                            'label' => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_font_weight_choices()
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_ln',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_ln'],
                            'label' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Line Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_color_picker_field([
                            'name'  => 'tl_txt_clr',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_txt_clr'],
                            'label' => __( 'Text Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        Field::get_color_picker_field([
                            'name'  => 'tl_bg_clr',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_bg_clr'],
                            'label' => __( 'Background Color', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Image Properties', HVSFW_PLUGIN_DOMAIN ),
                    'description' => __( 'Set the image size, width, height and radius for tooltip image.', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_select_field([
                            'name'  => 'tl_image_src_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_src_wd'],
                            'label' => __( 'Image Size', HVSFW_PLUGIN_DOMAIN ),
                            'options' => Helper::get_image_sizes()
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_image_mx_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_mx_wd'],
                            'label' => __( 'Maximum Width', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Maximum Width', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_image_mx_ht',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_mx_ht'],
                            'label' => __( 'Maximum Height', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Maximum Height', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_image_br',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_br'],
                            'label' => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Padding', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'tl_pt',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pt'],
                            'label' => __( 'Top', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Top', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_pb',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pb'],
                            'label' => __( 'Bottom', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Bottom', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_pl',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pl'],
                            'label' => __( 'Left', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Left', HVSFW_PLUGIN_DOMAIN )
                        ]),
                        Field::get_text_field([
                            'name'  => 'tl_pr',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pr'],
                            'label' => __( 'Right', HVSFW_PLUGIN_DOMAIN ),
                            'placeholder' => __( 'Right', HVSFW_PLUGIN_DOMAIN )
                        ]),
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_text_field([
                            'name'  => 'tl_br',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_br'],
                            'placeholder' => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'tooltip_setting_group'
            ]
        ])
    ]
]);

/**
 * Advanced Tab Panel
 */
echo Component::get_tab_panel([
    'id'         => 'advanced',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => [
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Optimization', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'block',
                    'fields' => [
                        Field::get_note_field([
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', HVSFW_PLUGIN_DOMAIN ),
                            'content' => __( 'Note that all settings here are used to enhance the performance of this plugin on the front-end side. This can improve your speed score in services like Pingdom, GTmetrix and PageSpeed.', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Caching', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'ad_opt_enable_cache',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_cache'],
                            'description' => __( 'Enable this to cache the external styles and scripts.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable CSS & JS Minification', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'ad_opt_enable_minify',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_minify'],
                            'description' => __( 'Enable this to minify the internal and external styles and scripts.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Enable Deffered JS', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_switch_field([
                            'name'  => 'ad_opt_enable_defer',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_defer'],
                            'description' => __( 'Enable this to load external scripts in deffered way.', HVSFW_PLUGIN_DOMAIN ),
                            'choices' => [
                                'on'  => __( 'Enabled', HVSFW_PLUGIN_DOMAIN ),
                                'off' => __( 'Disabled', HVSFW_PLUGIN_DOMAIN )
                            ]
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_card([
            'title'      => __( 'Additional', HVSFW_PLUGIN_DOMAIN ),
            'class'      => 'hd-mb-30',
            'components' => [
                Component::get_row([
                    'type'   => 'grid',
                    'label'  => __( 'Custom CSS', HVSFW_PLUGIN_DOMAIN ),
                    'fields' => [
                        Field::get_textarea_field([
                            'name'  => 'ad_add_custom_css',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_add_custom_css'],
                            'description' => __( 'Add your own CSS code here to customize the appearance of variation swatches components at the front-end.', HVSFW_PLUGIN_DOMAIN )
                        ])
                    ]
                ]),
            ]
        ]),
        Component::get_button([
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', HVSFW_PLUGIN_DOMAIN ),
            'attr'  => [
                'data-group-target' => 'advanced_setting_group'
            ]
        ]),
    ]
]);

/**
 * Placeholder.
 */
echo Component::get_placeholder();

/**
 * Footer.
 */
echo Component::get_footer(); 