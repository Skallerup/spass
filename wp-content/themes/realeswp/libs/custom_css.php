<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_css_settings = get_option('reales_css_settings');
$custom_css = isset($reales_css_settings['reales_custom_css_field']) ? $reales_css_settings['reales_custom_css_field'] : '';

print esc_html($custom_css);

?>