<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_filter_settings = get_option('reales_filter_settings');
$f_city_field           = isset($reales_filter_settings['reales_f_city_field']) ? $reales_filter_settings['reales_f_city_field'] : '';
$h_city_field           = isset($reales_filter_settings['reales_h_city_field']) ? $reales_filter_settings['reales_h_city_field'] : '';
$search_submit          = reales_get_search_link();

if($f_city_field != '' && $f_city_field == 'enabled' && $h_city_field != '') { ?>
    <form class="filterForm" id="filterPropertyForm" role="search" method="get" action="<?php echo esc_url($search_submit); ?>">
        <input type="hidden" name="search_lat" id="search_lat" autocomplete="off" />
        <input type="hidden" name="search_lng" id="search_lng" autocomplete="off" />
        <input type="hidden" name="search_city" id="search_city" autocomplete="off" />
        <input type="hidden" name="sort" id="sort" value="newest" autocomplete="off" />
    </form>
<?php }
?>