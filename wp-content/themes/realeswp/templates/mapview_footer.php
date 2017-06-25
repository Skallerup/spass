<?php
/**
 * @package WordPress
 * @subpackage Reales
 */
?>

<div class="home-footer">
    <div class="mapview-wrapper">
        <div class="row">
            <?php get_sidebar('mapviewfooter'); ?>
        </div>
        <?php
        $reales_appearance_settings = get_option('reales_appearance_settings');
        $copyright = isset($reales_appearance_settings['reales_copyright_field']) ? $reales_appearance_settings['reales_copyright_field'] : '';
        ?>
        <?php if($copyright && $copyright != '') { ?>
            <div class="copyright"><?php echo esc_html($copyright); ?></div>
        <?php } ?>
    </div>
</div>