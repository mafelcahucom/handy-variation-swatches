<?php
/**
 * Views > Admin > Component > Breadcrumb.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 

$tab   = ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ? $_GET['tab'] : 'setting' );
$tabs  = [
    'setting'       => __( 'Setting', HVSFW_PLUGIN_DOMAIN ),
    'import-export' => __( 'Import & Export', HVSFW_PLUGIN_DOMAIN ),
];
$title = ( isset( $tabs[ $tab ] ) ? $tabs[ $tab ] : __( 'Setting', HVSFW_PLUGIN_DOMAIN ) ); 
?>

<ul class="hd-breadcrumb">
    <li class="hd-breadcrumb__item" data-type="home">
        <?php echo Helper::get_icon( 'house', 'hd-house' ); ?>
    </li>
    <li class="hd-breadcrumb__item" data-type="page">
        <?php echo esc_html( $title ); ?>
    </li>
    <?php if ( $title === 'Setting' ): ?>
        <li class="hd-breadcrumb__item" data-type="tab">
            <?php echo __( 'General', HVSFW_PLUGIN_DOMAIN ); ?>
        </li>
    <?php endif; ?>
</ul>