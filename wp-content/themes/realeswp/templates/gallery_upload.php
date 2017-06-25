<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_general_settings = get_option('reales_general_settings');
$max_files               = isset($reales_general_settings['reales_max_files_field']) ? $reales_general_settings['reales_max_files_field'] : 10;
?>

<div class="submit_container">
    <div class="submit_container_header"><?php esc_html_e('Image Gallery', 'reales');?> <span class="text-red">*</span></div>
    <div id="upload-container">
        <div id="aaiu-upload-container">
            <div id="aaiu-upload-imagelist"></div>
            <div id="imagelist"></div>
            <div class="clearfix"></div>
            <a href="javascript:void(0);" id="aaiu-uploader" class="btn btn-o btn-default"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;&nbsp;<?php _e('Browse Images', 'reales');?></a>
            <input type="hidden" name="new_gallery" id="new_gallery">
        </div>
    </div>
    <p class="help-block"><?php esc_html_e('Maximum number of files:', 'reales'); ?> <strong><?php echo esc_html($max_files); ?></strong></p>
</div>