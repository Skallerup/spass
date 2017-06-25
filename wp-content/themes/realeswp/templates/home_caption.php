<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_appearance_settings = get_option('reales_appearance_settings','');
$home_caption_title = isset($reales_appearance_settings['reales_home_caption_title_field']) ? $reales_appearance_settings['reales_home_caption_title_field'] : '';
$home_caption_subtitle = isset($reales_appearance_settings['reales_home_caption_subtitle_field']) ? $reales_appearance_settings['reales_home_caption_subtitle_field'] : '';
$home_caption_cta = isset($reales_appearance_settings['reales_home_caption_cta_field']) ? $reales_appearance_settings['reales_home_caption_cta_field'] : '';
$home_caption_cta_text = isset($reales_appearance_settings['reales_home_caption_cta_text_field']) ? $reales_appearance_settings['reales_home_caption_cta_text_field'] : '';
$home_caption_cta_link = isset($reales_appearance_settings['reales_home_caption_cta_link_field']) ? $reales_appearance_settings['reales_home_caption_cta_link_field'] : '';
?>
<div class="home-caption">
    <?php if($home_caption_title && $home_caption_title != '') { ?>
    <h1 class="home-title"><?php echo esc_html($home_caption_title); ?></h1>
    <?php } ?>
    <?php if($home_caption_subtitle && $home_caption_subtitle != '') { ?>
    <div class="home-subtitle"><?php echo esc_html($home_caption_subtitle); ?></div>
    <?php } ?>
    <?php if($home_caption_cta && $home_caption_cta_text && $home_caption_cta_link) { ?>
    <a href="<?php echo esc_url($home_caption_cta_link); ?>" class="btn btn-lg btn-black"><?php echo esc_html($home_caption_cta_text); ?></a>
    <?php } ?>
</div>