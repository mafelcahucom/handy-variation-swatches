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
            'label' => 'Enable Itemized Variation',
            'description' => 'Enable this to use itemized variation in the front-end.',
        ]);

        /**
         * General - Card Closing.
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
         * Advance - Card Opening.
         */
        echo Component::get_card_opening([
            'title' => 'Advanced Settings',
            'class' => 'hd-mb-50'
        ]);

        echo Field::get_textarea_field([
            'name'  => 'ad_stg_additional_css',
            'group' => 'advanced_setting_group',
            'value' => $settings['ad_stg_additional_css'],
            'label' => 'Addtional CSS',
            'description' => 'Add your own CSS code here to customize the appearance of popup components at the front-end.'
        ]);

        /**
         * Advance - Card Closing.
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