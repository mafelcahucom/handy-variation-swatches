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

defined( 'ABSPATH' ) || exit;

/**
 * Header
 */
echo Component::get_header(); 
?>

<!-- Importer Component -->
<div class="hd-card hd-mb-30" data-state="opened">
    <div class="hd-card__header" data-type="collapsible">
        <span class="hd-card__title">
            <?php echo __( 'Import / Restore Settings', HVSFW_PLUGIN_DOMAIN ); ?>
        </span>
        <div class="hd-card__chevron">
            <?php echo Helper::get_icon( 'chevron-up', 'hd-svg' ); ?>
        </div>
    </div>
    <div class="hd-card__body">
        <div class="hd-card__content">
            <div class="hd-row hd-row--block">
                <div class="hd-row__content hd-row__content--single">
                    <div class="hd-row__field">
                        <p class="hd-mb-10">
                            <?php echo __( 'Imported settings will overwrite existing settings. Note <b>.txt</b> file type are only allowed.', HVSFW_PLUGIN_DOMAIN ); ?>
                        </p>
                        <label class="hd-file-field">
                            <div class="hd-file-field__icon">
                                <?php echo Helper::get_icon( 'plus', 'hd-svg' ); ?>
                            </div>
                            <span class="hd-file-field__label">
                                <?php echo __( 'Choose a file', HVSFW_PLUGIN_DOMAIN ); ?>
                            </span>
                            <input type="file" class="hd-file-field__input" accept=".txt">
                        </label>
                        <?php
                            echo Component::get_button([
                                'id'    => 'hd-import-setting-file-btn',
                                'icon'  => 'download',
                                'state' => 'disabled',
                                'label' => __( 'Import Settings', HVSFW_PLUGIN_DOMAIN )
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: Importer Component -->

<!-- Exporter Component -->
<div class="hd-card hd-mb-30" data-state="opened">
    <div class="hd-card__header" data-type="collapsible">
        <span class="hd-card__title">
            <?php echo __( 'Export / Duplicate Settings', HVSFW_PLUGIN_DOMAIN ); ?>
        </span>
        <div class="hd-card__chevron">
            <?php echo Helper::get_icon( 'chevron-up', 'hd-svg' ); ?>
        </div>
    </div>
    <div class="hd-card__body">
        <div class="hd-card__content">
            <div class="hd-row hd-row--block">
                <div class="hd-row__content hd-row__content--single">
                    <div class="hd-row__field">
                        <p class="hd-mb-10">
                            <?php echo __( 'Download a copy of the settings configuration. Note in order to avoid the corruption of the settings configuration <b>.txt</b> file, do not edit it.', HVSFW_PLUGIN_DOMAIN ); ?>
                        </p>
                        <div class="hd-export-field">
                            <div class="hd-export-field__row--1">
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="ALL">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Export All', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hd-export-field__row--2">
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="GEN">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'General', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="GST">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Global Style', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="BTS">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Button Swatch', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="CRS">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Color Swatch', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="IMS">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Image Swatch', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="TOT">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Tooltip', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                                <label class="hd-checkbox-field" data-state="default">
                                    <input type="checkbox" class="hd-export-setting-checkbox hd-checkbox-field__input" value="ADV">
                                    <span class="hd-checkbox-field__label">
                                        <?php echo __( 'Advanced', HVSFW_PLUGIN_DOMAIN ); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="hd-row__field">
                        <?php
                            echo Component::get_button([
                                'id'    => 'hd-export-setting-file-btn',
                                'icon'  => 'upload',
                                'state' => 'disabled',
                                'label' => __( 'Export Settings', HVSFW_PLUGIN_DOMAIN )
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: Exporter Component -->

<?php
/**
 * Prompt Loader.
 */
echo Component::get_prompt_loader();

/**
 * Prompt Dialog.
 */
echo Component::get_prompt_dialog();

/**
 * Footer
 */
echo Component::get_footer(); 