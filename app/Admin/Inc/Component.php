<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\Component;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Component.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Component {

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
     * Return the logo.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement
     */
    public static function get_logo() {
        return '<img class="hd-logo" src="'. Helper::get_asset_src( 'images/logo.svg' ) .'" alt="Handy Variation Swatches" title="Handy Variation Swatches">';
    }

    /**
     * Return the header component.
     *
     * @since 1.0.0
     * 
     * @param  string  $page_title  The page title.
     * @return HTMLElement
     */
    public static function get_header( $page_title = '' ) {
        return Helper::render_view( 'header', [
            'page_title' => $page_title
        ]);
    }

    /**
     * Return the footer component.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement
     */
    public static function get_footer() {
        return Helper::render_view( 'footer' );
    }

    /**
     * Return the navigation list component.
     *
     * @since 1.0.0
     * 
     * @param  array  $data  Contains all data for creating navigation list.
     * $args = [
     *     'label' => (string) The label of the link.
     *     'slug'  => (string) The url slug.
     *     'icon'  => (string) The name of icon.
     * ]
     * @return HTMLElement
     */
    public static function get_navigation( $args = [] ) {
        if ( empty( $args ) ) {
            return;
        }

        foreach ( $args as $key => $value ) {
            // Set complete url.
            if ( ! empty( $value['slug'] ) ) {
                $args[$key]['url'] = Helper::get_root_url() .'&tab='. $value['slug'];
            }

            // Set state based on $_GET['tag'] & slug.
            $args[$key]['state'] = 'default';
            if ( isset( $_GET['tab'] ) ) {
                $args[$key]['state'] = ( $_GET['tab'] == $value['slug'] ? 'active' : 'default' );
            }

            // Set icon.
            if ( ! empty( $value['icon'] ) ) {
                $args[$key]['icon'] = Helper::get_icon( $value['icon'], 'hd-svg' );
            }
        }
        return Helper::render_view( 'component/navigation', $args );
    }

    /**
     * Return the message component.
     *
     * @since 1.0.0
     * 
     * @param  array  $data  Contains all data for creating message component.
     * $args = [
     *     'title'   => (string) The title of the message.
     *     'content' => (string) The content of the message.
     *     'button'  => (array)  Contains the buttn [ 'label', 'url' ].
     *     'image'   => (string) The image source url.
     * ]
     * @return HTMLElement
     */
    public static function get_message( $args = [] ) {
        return Helper::render_view( 'component/message', $args );
    }

    /**
     * Return the tab component.
     *
     * @since 1.0.0
     *
     * @param  array  $data  Contains all data for creating tab component.
     * $args = [
     *     'class' => (string) Additional class.   
     *     'tabs'  => (array)  Contains the title and panel.
     * ]
     * @return HTMLElement
     **/
    public static function get_tab_navigation( $args = [] ) {
        if ( ! isset( $args['tabs'] ) ) {
            return;
        }
        return Helper::render_view( 'component/tab', $args );
    }

    /**
     * Return the tab opening component.
     *
     * @since 1.0.0
     * 
     * @param  array  $data  Contains all data for creating tab panel component.
     * $args = [
     *     'id'    => (string) The id of tab panel.
     *     'class' => (string) Additional class.
     *     'state' => (string) The state of the tab panel |default|active.
     * ]
     * @return HTMLElement
     */
    public static function get_tab_panel_opening( $args = [] ) {
        if ( ! isset( $args['id'] ) ) {
            return;
        }

        if ( ! isset( $args['state'] ) ) {
            $args['state'] = 'default';
        }

        return '<div id="'. esc_attr( $args['id'] ) .'" class="hd-tab__panel" data-state="'. esc_attr( $args['state'] ) .'">';
    }

    /**
     * Return tab panel closing component.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement
     */
    public static function get_tab_panel_closing() {
        return '</div>';
    }

    /**
     * Return the button component.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Contains all data for creating button.
     * $args = [
     *     'type'         => (string) The type of button normal | circle.
     *     'id'           => (string) The id of the button.
     *     'class'        => (string) Additional class.
     *     'attributes'   => (array) Contains the additional attributes.
     *     'label'        => (string) The label of the button. In cirle label will be used in aria-label
     *     'icon'         => (string) The name of svg icon. This is only applicable in circle type. 
     *     'url'          => (string) The url to be used in link tag.
     * ]
     * @return HTMLElement
     */
    public static function get_button( $args = [] ) {
        return Helper::render_view( 'component/button', $args );
    }

    /**
     * Return the card opening component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating button.
     * $args = [
     *     'title' => (string) The title of the card.
     *     'class' => (string) Additional class.
     * ]
     * @return HTMLElement
    **/
    public static function get_card_opening( $args = [] ) {
        $args['part']        = 'opening';
        $args['button_icon'] = Helper::get_icon( 'caret-down-filled', 'hd-svg' );
        return Helper::render_view( 'component/card', $args );
    }

    /**
     * Return the card closing component.
     *
     * @since 1.0.0
     * \
     * @return HTMLElement
     */
    public static function get_card_closing() {
        return Helper::render_view( 'component/card', [
            'part' => 'closing'
        ]);
    }

    /**
     * Return the screen loader component.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement
     */
    public static function get_prompt_loader() {
        return Helper::render_view( 'component/prompt-loader' );
    }
    
    /**
     * Reurn the prompt dialog component.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement
     */
    public static function get_prompt_dialog() {
        return Helper::render_view( 'component/prompt-dialog' );
    }

    /**
     * Return the plugin error message. Only use this error
     * message if _hvsfw_main_settings or _hvsfw_main_settings
     * has been deleted in wp_options table.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement.
     */
    public static function get_plugin_error_message() {
        $output  = '<div class="hd-app">';
        $output .= self::get_message([
            'title'   => 'Service Unavailable',
            'image'   => Helper::get_asset_src( 'images/astronaut-sitting.webp' ),
            'button'  => [
                'label' => 'Deactivate Now',
                'url'   => admin_url( 'plugins.php' )
            ],
            'class'   => 'hd-container hd-mt-50',
            'content' => 'The plugin has found an error due to deleting or modifying the wp_options table in the database that caused deleting the options fields that are required in running this plugin. In order to fix this problem, you just need to deactivate and activate the plugin again.'
        ]);
        $output .= '</div>';
        return $output;
    }
}