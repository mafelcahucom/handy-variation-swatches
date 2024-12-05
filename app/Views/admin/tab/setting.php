<?php
/**
 * App > Views > Admin > Tab > Setting.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\Component;
use HVSFW\Admin\Inc\Field;
use HVSFW\Api\SettingApi;

defined( 'ABSPATH' ) || exit;

// Get the setting current value.
$settings = SettingApi::get_current_settings();

/**
 * Header
 */
echo Component::get_header();

/**
 * Tab Navigation.
 */
echo Component::get_tab_navigation(array(
    'class' => 'hd-mb-30',
    'tabs'  => array(
        array(
            'title' => __( 'General', 'handy-variation-swatches' ),
            'panel' => '#general',
        ),
        array(
            'title' => __( 'Global Style', 'handy-variation-swatches' ),
            'panel' => '#global-style',
        ),
        array(
            'title' => __( 'Button Swatch', 'handy-variation-swatches' ),
            'panel' => '#button-swatch',
        ),
        array(
            'title' => __( 'Color Swatch', 'handy-variation-swatches' ),
            'panel' => '#color-swatch',
        ),
        array(
            'title' => __( 'Image Swatch', 'handy-variation-swatches' ),
            'panel' => '#image-swatch',
        ),
        array(
            'title' => __( 'Tooltip', 'handy-variation-swatches' ),
            'panel' => '#tooltip',
        ),
        array(
            'title' => __( 'Advanced', 'handy-variation-swatches' ),
            'panel' => '#advanced',
        ),
    ),
));

/**
 * General Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'general',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'general_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'General', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Variation Swatches', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable'],
                            'description' => __( 'Enable this option to activate handy variation swatches functionalities in the front-end.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Advanced', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Tooltip', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_enable_tooltip',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_enable_tooltip'],
                            'description' => __( 'Enable this option to show tooltip on each term.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Disable Out Of Stock Term', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_disable_item_oos',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_disable_item_oos'],
                            'description' => __( 'Enable this option to disable an out of stock variation term.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Disabled Term Style', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'gn_disable_item_style',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_disable_item_style'],
                            'description' => __( 'Select your preferred style indicator of disabled term.', 'handy-variation-swatches' ),
                            'options' => array(
                                array(
                                    'value' => 'hidden',
                                    'label' => __( 'Hidden', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'blurred',
                                    'label' => __( 'Blurred', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'crossed-out',
                                    'label' => __( 'Crossed Out', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'blurred-crossed',
                                    'label' => __( 'Blurred + Crossed Out', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Product Single Page', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Product Single Page.', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable on Product Single Page', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_pp_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_pp_enable'],
                            'description' => __( 'Enable this option to use variation swatch in the product single page.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Shop Page', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Shop Page (Archive Page).', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable on Shop Page (Archive Page)', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_sp_enable',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_sp_enable'],
                            'description' => __( 'Enable this option to use variation swatch in the shop page (archive page).', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Attributes Limit', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_number_field(array(
                            'name'  => 'gn_sp_attribute_limit',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_sp_attribute_limit'],
                            'description' => __( 'Set the number of attributes to be displayed. For no limit retain the value 0.', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Attributes Limit', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Variation Filter', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Variation filter is a list of product attributes presented as a series of swatches on the shop page to filter the products.', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Classic Widget Version', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_vf_enable_widget',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_vf_enable_widget'],
                            'description' => __( 'Enable this option to use variation filter in classic widget version.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Gutenberg Block Version', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_vf_enable_block',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_vf_enable_block'],
                            'description' => __( 'Enable this option to use variation filter in gutenberg block version.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Notice', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable WooCommerce Notice', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_nc_enable_notice',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_nc_enable_notice'],
                            'description' => __( 'Enable this option to use the default woocommerce notice. Note this setting is only applicable in this plugin only, other plugin that are using woocommerce notice will not be affected.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Auto Hide', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'gn_nc_auto_hide',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_nc_auto_hide'],
                            'description' => __( 'Enable this option to hide the notice automatically.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Duration', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_number_field(array(
                            'name'  => 'gn_nc_duration',
                            'group' => 'general_setting_group',
                            'value' => $settings['gn_nc_duration'],
                            'description' => __( 'Set the total milliseconds before the notice will automatically hide. Note this will only be applied if you enable auto hide.', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Duration', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'general_setting_group',
            ),
        )),
    ),
));

/**
 * Global Style Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'global-style',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'global_style_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Product Single Page', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Product Single Page.', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Label', 'handy-variation-swatches' ),
                    'description' => __( 'Set the style of the swatch label.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'gs_pp_sw_label_position',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_position'],
                            'label' => 'Position',
                            'options' => array(
                                array(
                                    'value' => 'hidden',
                                    'label' => __( 'Hidden', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'inline',
                                    'label' => __( 'Inline', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'block',
                                    'label' => __( 'Block', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_pp_sw_label_fs',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_fs'],
                            'label' => __( 'Font Size', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'gs_pp_sw_label_fw',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_fw'],
                            'label' => __( 'Font Weight', 'handy-variation-swatches' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_pp_sw_label_ln',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_ln'],
                            'label' => __( 'Line Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Line Height', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_pp_sw_label_m',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_m'],
                            'label' => __( 'Margin', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Margin', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'gs_pp_sw_label_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_label_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Term Gap', 'handy-variation-swatches' ),
                    'description' => __( 'Set the row gap and column gap in each swatch term or attributes.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'gs_pp_sw_item_gap_row',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_item_gap_row'],
                            'label' => __( 'Row', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Row', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_pp_sw_item_gap_col',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_pp_sw_item_gap_col'],
                            'label' => __( 'Column', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Column', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Shop Page', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Note all the setting modified in here will be only applied in Shop Page (Archive Page).', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Alignment', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'gs_sp_sw_alignment',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_alignment'],
                            'description' => __( 'Select the swatch alignment.', 'handy-variation-swatches' ),
                            'options' => array(
                                array(
                                    'value' => 'left',
                                    'label' => __( 'Left', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'center',
                                    'label' => __( 'Center', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'right',
                                    'label' => __( 'Right', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Label', 'handy-variation-swatches' ),
                    'description' => __( 'Set the style of the swatch label.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'gs_sp_sw_label_position',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_position'],
                            'label' => __( 'Position', 'handy-variation-swatches' ),
                            'options' => array(
                                array(
                                    'value' => 'hidden',
                                    'label' => __( 'Hidden', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'inline',
                                    'label' => __( 'Inline', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'block',
                                    'label' => __( 'Block', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_sp_sw_label_fs',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_fs'],
                            'label' => __( 'Font Size', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'gs_sp_sw_label_fw',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_fw'],
                            'label' => __( 'Font Weight', 'handy-variation-swatches' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_sp_sw_label_ln',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_ln'],
                            'label' => __( 'Line Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Line Height', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_sp_sw_label_m',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_m'],
                            'label' => __( 'Margin', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Margin', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'gs_sp_sw_label_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_label_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Swatch Term Gap', 'handy-variation-swatches' ),
                    'description' => __( 'Set the row gap and column gap in each swatch term or attributes.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'gs_sp_sw_item_gap_row',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_item_gap_row'],
                            'label' => __( 'Row', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Row', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_sp_sw_item_gap_col',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_sp_sw_item_gap_col'],
                            'label' => __( 'Column', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Column', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'More Link', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Note more link will be only be displayed on shop page if the attribute limit value is greater than 0.', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Format', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'gs_ml_format',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_format'],
                            'options' => array(
                                array(
                                    'value' => 'label',
                                    'label' => __( 'Label', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'number',
                                    'label' => __( 'Number', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'label-number',
                                    'label' => __( 'Label & Number', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Label', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'gs_ml_label',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_label'],
                            'placeholder' => __( 'Label', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Font', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'gs_ml_fs',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_fs'],
                            'label' => __( 'Font Size', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'gs_ml_fw',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_fw'],
                            'label' => __( 'Font Weight', 'handy-variation-swatches' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'gs_ml_ln',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_ln'],
                            'label' => __( 'Line Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Line Height', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Text Color', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'gs_ml_txt_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_txt_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'gs_ml_txt_hv_clr',
                            'group' => 'global_style_setting_group',
                            'value' => $settings['gs_ml_txt_hv_clr'],
                            'label' => __( 'Hover & Active Color', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'global_style_setting_group',
            ),
        )),
    ),
));

/**
 * Button Swatch Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'button-swatch',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'button_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Default Style', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Shape', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'bn_shape',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_shape'],
                            'description' => __( 'Select your preferred shape for swatch button.', 'handy-variation-swatches' ),
                            'options' => array(
                                array(
                                    'value' => 'square',
                                    'label' => __( 'Square', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'circle',
                                    'label' => __( 'Circle', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'custom',
                                    'label' => __( 'Custom', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'bn_wd',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_wd'],
                            'label' => __( 'Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'bn_ht',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_ht'],
                            'label' => __( 'Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Font', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'bn_fs',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_fs'],
                            'label' => __( 'Font Size', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'bn_fw',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_fw'],
                            'label' => __( 'Font Weight', 'handy-variation-swatches' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Text Color', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'bn_txt_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_txt_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'bn_txt_hv_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_txt_hv_clr'],
                            'label' => __( 'Hover & Active Color', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Background Color', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'bn_bg_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bg_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'bn_bg_hv_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bg_hv_clr'],
                            'label' => __( 'Hover & Active Color', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Padding', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'bn_pt',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pt'],
                            'label' => __( 'Top', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Top', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'bn_pb',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pb'],
                            'label' => __( 'Bottom', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Bottom', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'bn_pl',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pl'],
                            'label' => __( 'Left', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Left', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'bn_pr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_pr'],
                            'label' => __( 'Right', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Right', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border', 'handy-variation-swatches' ),
                    'description' => __( 'Note this custom border radius will be only be applied if the shape is set to custom.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'bn_bs',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bs'],
                            'label' => __( 'Style', 'handy-variation-swatches' ),
                            'options' => Helper::get_border_style_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'bn_bw',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_bw'],
                            'label' => __( 'Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'bn_b_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_b_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'bn_b_hv_clr',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_b_hv_clr'],
                            'label' => __( 'Hover & Active Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'bn_br',
                            'group' => 'button_setting_group',
                            'value' => $settings['bn_br'],
                            'label' => __( 'Border Radius', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Border Radius', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'button_setting_group',
            ),
        )),
    ),
));

/**
 * Color Swatch Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'color-swatch',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'color_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Default Style', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Shape', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'cr_shape',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_shape'],
                            'description' => __( 'Select your preferred shape for swatch color.', 'handy-variation-swatches' ),
                            'options' => array(
                                array(
                                    'value' => 'square',
                                    'label' => __( 'Square', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'circle',
                                    'label' => __( 'Circle', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'custom',
                                    'label' => __( 'Custom', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Dimension', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'cr_size',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_size'],
                            'description' => __( 'Note this will be applicable in square and circle shape only.', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Dimension', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-variation-swatches' ),
                    'description' => __( 'Note this will be applicable in custom shape only.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'cr_wd',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_wd'],
                            'label' => __( 'Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'cr_ht',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_ht'],
                            'label' => __( 'Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border', 'handy-variation-swatches' ),
                    'description' => __( 'Note this custom border radius will be only be applied if the shape is set to custom.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'cr_bs',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_bs'],
                            'label' => __( 'Style', 'handy-variation-swatches' ),
                            'options' => Helper::get_border_style_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'cr_bw',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_bw'],
                            'label' => __( 'Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'cr_b_clr',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_b_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'cr_b_hv_clr',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_b_hv_clr'],
                            'label' => __( 'Hover & Active Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'cr_br',
                            'group' => 'color_setting_group',
                            'value' => $settings['cr_br'],
                            'label' => __( 'Border Radius', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Border Radius', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'color_setting_group',
            ),
        )),
    ),
));

/**
 * Image Swatch Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'image-swatch',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'image_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Default Style', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Shape', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'im_shape',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_shape'],
                            'description' => __( 'Select your preferred shape for swatch image.', 'handy-variation-swatches' ),
                            'options' => array(
                                array(
                                    'value' => 'square',
                                    'label' => __( 'Square', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'circle',
                                    'label' => __( 'Circle', 'handy-variation-swatches' ),
                                ),
                                array(
                                    'value' => 'custom',
                                    'label' => __( 'Custom', 'handy-variation-swatches' ),
                                ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Dimension', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'im_size',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_size'],
                            'description' => __( 'Note this will be applicable in square and circle shape only.', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Dimension', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-variation-swatches' ),
                    'description' => __( 'Note this will be applicable in custom shape only.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'im_wd',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_wd'],
                            'label' => __( 'Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'im_ht',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_ht'],
                            'label' => __( 'Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border', 'handy-variation-swatches' ),
                    'description' => __( 'Note this custom border radius will be only be applied if the shape is set to custom.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'im_bs',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_bs'],
                            'label' => __( 'Style', 'handy-variation-swatches' ),
                            'options' => Helper::get_border_style_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'im_bw',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_bw'],
                            'label' => __( 'Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'im_b_clr',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_b_clr'],
                            'label' => __( 'Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'im_b_hv_clr',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_b_hv_clr'],
                            'label' => __( 'Hover & Active Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'im_br',
                            'group' => 'image_setting_group',
                            'value' => $settings['im_br'],
                            'label' => __( 'Border Radius', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Border Radius', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'image_setting_group',
            ),
        )),
    ),
));

/**
 * Tooltip Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'tooltip',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'tooltip_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Default Style', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Size', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'tl_mn_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mn_wd'],
                            'label' => __( 'Minimum Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Minimum Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_mx_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mx_wd'],
                            'label' => __( 'Maximum Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Maximum Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_mn_ht',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mn_ht'],
                            'label' => __( 'Minimum Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Minimum Height', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_mx_ht',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_mx_ht'],
                            'label' => __( 'Maximum Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Maximum Height', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Font', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'tl_fs',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_fs'],
                            'label' => __( 'Font Size', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        Field::get_select_field(array(
                            'name'  => 'tl_fw',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_fw'],
                            'label' => __( 'Font Weight', 'handy-variation-swatches' ),
                            'options' => Helper::get_font_weight_choices(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_ln',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_ln'],
                            'label' => __( 'Line Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Line Height', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Color', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_color_picker_field(array(
                            'name'  => 'tl_txt_clr',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_txt_clr'],
                            'label' => __( 'Text Color', 'handy-variation-swatches' ),
                        )),
                        Field::get_color_picker_field(array(
                            'name'  => 'tl_bg_clr',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_bg_clr'],
                            'label' => __( 'Background Color', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Image Properties', 'handy-variation-swatches' ),
                    'description' => __( 'Set the image size, width, height and radius for tooltip image.', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_select_field(array(
                            'name'  => 'tl_image_src_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_src_wd'],
                            'label' => __( 'Image Size', 'handy-variation-swatches' ),
                            'options' => Helper::get_image_sizes(),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_image_mx_wd',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_mx_wd'],
                            'label' => __( 'Maximum Width', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Maximum Width', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_image_mx_ht',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_mx_ht'],
                            'label' => __( 'Maximum Height', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Maximum Height', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_image_br',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_image_br'],
                            'label' => __( 'Border Radius', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Border Radius', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Padding', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'tl_pt',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pt'],
                            'label' => __( 'Top', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Top', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_pb',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pb'],
                            'label' => __( 'Bottom', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Bottom', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_pl',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pl'],
                            'label' => __( 'Left', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Left', 'handy-variation-swatches' ),
                        )),
                        Field::get_text_field(array(
                            'name'  => 'tl_pr',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_pr'],
                            'label' => __( 'Right', 'handy-variation-swatches' ),
                            'placeholder' => __( 'Right', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Border Radius', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_text_field(array(
                            'name'  => 'tl_br',
                            'group' => 'tooltip_setting_group',
                            'value' => $settings['tl_br'],
                            'placeholder' => __( 'Border Radius', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'tooltip_setting_group',
            ),
        )),
    ),
));

/**
 * Advanced Tab Panel
 */
echo Component::get_tab_panel(array(
    'id'         => 'advanced',
    'class'      => 'hd-mb-50',
    'state'      => 'default',
    'components' => array(
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'advanced_setting_group',
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Optimization', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'block',
                    'fields' => array(
                        Field::get_note_field(array(
                            'icon'    => true,
                            'type'    => 'message',
                            'title'   => __( 'Instruction', 'handy-variation-swatches' ),
                            'content' => __( 'Note that all settings here are used to enhance the performance of this plugin on the front-end side. This can improve your speed score in services like Pingdom, GTmetrix and PageSpeed.', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Caching', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'ad_opt_enable_cache',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_cache'],
                            'description' => __( 'Enable this option to cache the external style and script files so that they can be accessed more quickly.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable CSS & JS Minification', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'ad_opt_enable_minify',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_minify'],
                            'description' => __( 'Enable this option to minify the internal and external style and script files to reduce load times and bandwidth.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Enable Deffered JS', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_switch_field(array(
                            'name'  => 'ad_opt_enable_defer',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_opt_enable_defer'],
                            'description' => __( 'Enable this option to defer external scripts so they will be downloaded in parallel to the parsing page and executed after page is finished parsing.', 'handy-variation-swatches' ),
                            'choices' => array(
                                'on'  => __( 'Enabled', 'handy-variation-swatches' ),
                                'off' => __( 'Disabled', 'handy-variation-swatches' ),
                            ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_card(array(
            'title'      => __( 'Additional', 'handy-variation-swatches' ),
            'class'      => 'hd-mb-30',
            'components' => array(
                Component::get_row(array(
                    'type'   => 'grid',
                    'label'  => __( 'Custom CSS', 'handy-variation-swatches' ),
                    'fields' => array(
                        Field::get_textarea_field(array(
                            'name'  => 'ad_add_custom_css',
                            'group' => 'advanced_setting_group',
                            'value' => $settings['ad_add_custom_css'],
                            'description' => __( 'Add your own CSS code here to customize the appearance of variation swatches components at the front-end.', 'handy-variation-swatches' ),
                        )),
                    ),
                )),
            ),
        )),
        Component::get_button(array(
            'class' => 'hd-save-setting-btn',
            'label' => __( 'Save Changes', 'handy-variation-swatches' ),
            'attr'  => array(
                'data-group-target' => 'advanced_setting_group',
            ),
        )),
    ),
));

/**
 * Placeholder.
 */
echo Component::get_placeholder();

/**
 * Footer.
 */
echo Component::get_footer();
