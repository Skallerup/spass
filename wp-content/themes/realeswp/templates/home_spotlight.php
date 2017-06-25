<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_appearance_settings = get_option('reales_appearance_settings','');
$home_spotlight_title = isset($reales_appearance_settings['reales_home_spotlight_title_field']) ? $reales_appearance_settings['reales_home_spotlight_title_field']: '';
$home_spotlight_text = isset($reales_appearance_settings['reales_home_spotlight_text_field']) ? $reales_appearance_settings['reales_home_spotlight_text_field'] : '';
?>

<div class="spotlight">
    <div class="s-title osLight"><?php echo esc_html($home_spotlight_title); ?></div>
    <div class="s-text osLight"><?php echo esc_html($home_spotlight_text); ?></div>
</div>