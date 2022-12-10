<?php
namespace HVSFW\Admin\Tab\Setting;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting API.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SettingApi {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Set of rules for setting fields. This can be use
     * for checking settings fields validity.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_field_rules() {
        $rules = [

            // gn.
            'gn_enable'                     => [
                'type'    => 'switch',
                'default' => 1
            ],

            // ad_stg.
            'ad_stg_additional_css'         => [
                'type'     => 'textarea',
                'default'  => ''
            ]
        ];

        return $rules;
    }

    /**
     * Returns the default value of each fields based in get_field_rules().
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_fields_default_values() {
        $fields = [];
        foreach ( self::get_field_rules() as $key => $value ) {
            $fields[ $key ] = $value['default'];
        }

        return $fields;
    }

    /**
     * Returns the settings value from _hvsfw_main_settings but
     * if _hvsfw_main_settings is empty it will get the default value
     * from self::get_fields_default_values().
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_settings() {
        $settings = get_option( '_hvsfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = self::get_fields_default_values();
        }

        return $settings;
    }

    /**
     * Check if the settings has a missing field.
     *
     * @since 1.0.0
     * 
     * @param  array  $settings  Containing all the settings field.
     * @return boolean
     */
    public static function has_missing_fields( $settings ) {
        if ( empty( $settings ) ) {
            return true;
        }

        $field_rules = self::get_field_rules();
        foreach ( $field_rules as $key => $value ) {
            if ( ! array_key_exists( $key, $settings ) ) {
                return true;
            }
        }
        return false;
    }
}