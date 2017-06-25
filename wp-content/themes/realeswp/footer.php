<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_appearance_settings = get_option('reales_appearance_settings');
$copyright = isset($reales_appearance_settings['reales_copyright_field']) ? $reales_appearance_settings['reales_copyright_field'] : '';
?>

    <div class="home-footer">
        <div class="page-wrapper">
            <div class="row">
                <?php get_sidebar('footer'); ?>
            </div>
            <?php if($copyright && $copyright != '') { ?>
                <div class="copyright"><?php echo esc_html($copyright); ?></div>
            <?php } ?>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>