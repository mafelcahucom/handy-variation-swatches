<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Component.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Component {

	/**
	 * Inherit Singleton.
     * 
     * @since 1.0.0
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
        return sprintf(
            '<img src="%s" class="hd-logo" alt="%s" title="%s">',
            Helper::get_asset_src( 'images/logo.svg' ),
            __( 'Handy Variation Swatches', HVSFW_PLUGIN_DOMAIN ),
            __( 'Handy Variation Swatches', HVSFW_PLUGIN_DOMAIN )
        );
    }

    /**
     * Return the header component.
     *
     * @since 1.0.0
     * 
     * @return HTMLElement
     */
    public static function get_header() {
        return Helper::render_view( 'header' );
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
     * @param  array  $data  Contains the necessary parameters for creating navigation list.
     * $args = [
     *     'label' => (string) Contains the label of the link.
     *     'slug'  => (string) Contains the url slug.
     *     'icon'  => (string) Contains the name of icon.
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
     * @param  array  $data  Contains the necessary parameters for creating message component.
     * $args = [
     *     'title'   => (string) Contains the title of the message.
     *     'content' => (string) Contains the content of the message.
     *     'button'  => (array)  Contains the button [ 'label', 'url' ].
     *     'image'   => (string) Contains the image source url.
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
     * @param  array  $data  Contains all the arguments for creating tab component.
     * $args = [
     *     'class' => (string) Contains the additional class.   
     *     'tabs'  => (array)  Contains the title and panel of each tab.
     * ]
     * @return HTMLElement
     **/
    public static function get_tab_navigation( $args = [] ) {
        if ( ! isset( $args['tabs'] ) ) {
            return;
        }

        return Helper::render_view( 'component/tab-navigation', $args );
    }

    /**
     * Return the tab panel with rendered fields.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all the arguments for creating tab panel component.
     * $args = [
     *      'id'         => (string) Contains the id of tab panel.
     *      'class'      => (string) Contains the additional class.
     *      'state'      => (string) Contains the state of the tab panel |default|active.
     *      'components' => (array)  Contains the fields to be rendered inside tab panel. 
     * ]
     * @return HTMLElement
     */
    public static function get_tab_panel( $args = [] ) {
        if ( ! isset( $args['id'] ) || ! isset( $args['components'] ) || empty( $args['components'] ) ) {
            return;
        }

        return Helper::render_view( 'component/tab-panel', $args );
    }

    /**
     * Return the button component.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Contains the necessary parameters for creating button.
     * $args = [
     *     'id'    => (string) Contains the id of the button.
     *     'class' => (string) Contains the additional class.
     *     'attr'  => (array)  Contains the additional attributes.
     *     'state' => (string) Contains the current state of the button.
     *     'label' => (string) Contains the label of the button. In cirle label will be used in aria-label.
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
     * @param  array  $args  Contains the necessary parameters for creating button.
     * $args = [
     *     'title'      => (string) Contains the title of the card.
     *     'class'      => (string) Contains the additional class.
     *     'components' => (array)  Contains the components to be render.
     * ]
     * @return HTMLElement
    **/
    public static function get_card( $args = [] ) {
        return Helper::render_view( 'component/card', $args );
    }

    /**
     * Return the row component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating row.
     * $args = [
     *     'type'        => (string) Contains the type of row |block|grid.
     *     'label'       => (string) Contains the label of the row.
     *     'description' => (string) Contains the description of the row.
     *     'fields'      => (array)  Contains the fields to be rendered inside row.
     * ]
     * @return HTMLElement
     */
    public static function get_row( $args = [] ) {
        return Helper::render_view( 'component/row', $args );
    }

    /**
     * Return the setting placeholder component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    public static function get_placeholder() {
        return Helper::render_view( 'component/placeholder' );
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
}