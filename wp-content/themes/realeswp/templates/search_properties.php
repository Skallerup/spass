<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$search_submit = reales_get_search_link();
$cat_taxonomies = array( 
    'property_category'
);
$cat_args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => false
); 
$cat_terms = get_terms($cat_taxonomies, $cat_args);
$type_taxonomies = array( 
    'property_type_category'
);
$type_args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => false
); 
$type_terms              = get_terms($type_taxonomies, $type_args);
$reales_general_settings = get_option('reales_general_settings');
$reales_search_settings  = get_option('reales_search_settings');
$currency_symbol         = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
$area_unit               = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
$s_id_field              = isset($reales_search_settings['reales_s_id_field']) ? $reales_search_settings['reales_s_id_field'] : '';
$s_keywords_field        = isset($reales_search_settings['reales_s_keywords_field']) ? $reales_search_settings['reales_s_keywords_field'] : '';
$s_country_field         = isset($reales_search_settings['reales_s_country_field']) ? $reales_search_settings['reales_s_country_field'] : '';
$s_state_field           = isset($reales_search_settings['reales_s_state_field']) ? $reales_search_settings['reales_s_state_field'] : '';
$s_city_field            = isset($reales_search_settings['reales_s_city_field']) ? $reales_search_settings['reales_s_city_field'] : '';
$s_category_field        = isset($reales_search_settings['reales_s_category_field']) ? $reales_search_settings['reales_s_category_field'] : '';
$s_type_field            = isset($reales_search_settings['reales_s_type_field']) ? $reales_search_settings['reales_s_type_field'] : '';
$s_price_field           = isset($reales_search_settings['reales_s_price_field']) ? $reales_search_settings['reales_s_price_field'] : '';
$s_neighborhood_field    = isset($reales_search_settings['reales_s_neighborhood_field']) ? $reales_search_settings['reales_s_neighborhood_field'] : '';
$s_area_field            = isset($reales_search_settings['reales_s_area_field']) ? $reales_search_settings['reales_s_area_field'] : '';
$s_bedrooms_field        = isset($reales_search_settings['reales_s_bedrooms_field']) ? $reales_search_settings['reales_s_bedrooms_field'] : '';
$s_bathrooms_field       = isset($reales_search_settings['reales_s_bathrooms_field']) ? $reales_search_settings['reales_s_bathrooms_field'] : '';
?>

<div class="search-panel">

    <?php if(($s_id_field != '' && $s_id_field == 'enabled') || 
            ($s_keywords_field != '' && $s_keywords_field == 'enabled') || 
            ($s_country_field != '' && $s_country_field == 'enabled') || 
            ($s_state_field != '' && $s_state_field == 'enabled') || 
            ($s_city_field != '' && $s_city_field == 'enabled') || 
            ($s_neighborhood_field != '' && $s_neighborhood_field == 'enabled') || 
            ($s_category_field != '' && $s_category_field == 'enabled') || 
            ($s_type_field != '' && $s_type_field == 'enabled') || 
            ($s_price_field != '' && $s_price_field == 'enabled') || 
            ($s_area_field != '' && $s_area_field == 'enabled') || 
            ($s_bedrooms_field != '' && $s_bedrooms_field == 'enabled') || 
            ($s_bathrooms_field != '' && $s_bathrooms_field == 'enabled')) { ?>

        <form class="form-inline" id="searchPropertyForm" role="search" method="get" action="<?php echo esc_url($search_submit); ?>">
            <input type="hidden" name="sort" id="sort" value="newest" />
            <?php if($s_id_field != '' && $s_id_field == 'enabled') { ?> 
                <div class="form-group">
                    <input type="text" class="form-control" id="search_id" name="search_id" placeholder="<?php esc_html_e('Property ID', 'reales'); ?>" style="width: 100px;">
                </div>
            <?php } ?>
            <?php if($s_keywords_field != '' && $s_keywords_field == 'enabled') { ?> 
                <div class="form-group">
                    <input type="text" class="form-control" id="search_keywords" name="search_keywords" placeholder="<?php esc_html_e('Keywords', 'reales'); ?>">
                </div>
            <?php } ?>
            <?php if($s_country_field != '' && $s_country_field == 'enabled') { ?> 
                <div class="form-group">
                    <?php
                    $country_default = isset($reales_general_settings['reales_country_field']) ? $reales_general_settings['reales_country_field'] : '';
                    print reales_search_country_list($country_default);
                    ?>
                </div>
            <?php } ?>
            <?php if($s_state_field != '' && $s_state_field == 'enabled') { ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="search_state" name="search_state" placeholder="<?php esc_html_e('State/County', 'reales'); ?>">
                </div>
            <?php } ?>
            <?php 
            if($s_city_field != '' && $s_city_field == 'enabled') { 
                $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
                $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            ?>
                <div class="form-group">
                    <?php
                    if($p_city_t == 'list') {
                        $reales_cities_settings = get_option('reales_cities_settings');

                        print '<select id="search_city" name="search_city" class="form-control">
                                        <option value="">' . __('Select a city', 'reales') . '</option>';
                        if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                            uasort($reales_cities_settings, "reales_compare_position");
                            foreach ($reales_cities_settings as $key => $value) {
                                print '<option value="' . $key . '">' . $value['name'] . '</option>';
                            }
                        }
                        print '</select>';
                    } else {
                    ?>
                        <input type="text" class="form-control auto" id="search_city" name="search_city" placeholder="<?php esc_html_e('City', 'reales'); ?>" autocomplete="off">
                    <?php } ?>
                    <input type="hidden" name="search_lat" id="search_lat" />
                    <input type="hidden" name="search_lng" id="search_lng" />
                </div>
            <?php } ?>
            <?php if($s_neighborhood_field != '' && $s_neighborhood_field == 'enabled') { ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="search_neighborhood" name="search_neighborhood" placeholder="<?php esc_html_e('Neighborhood', 'reales'); ?>" autocomplete="off">
                </div>
            <?php } ?>
            <?php if($s_category_field != '' && $s_category_field == 'enabled') { ?>
                <div class="form-group hidden-xs adv">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                        <span class="dropdown-label"><?php esc_html_e('Category', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-select">
                        <li class="active"><input type="radio" name="search_category" value="0" checked="checked"><a href="javascript:void(0);"><?php esc_html_e('Category', 'reales'); ?></a></li>
                        <?php foreach($cat_terms as $cat_term) { ?>
                        <li><input type="radio" name="search_category" value="<?php echo esc_attr($cat_term->term_id); ?>"><a href="javascript:void(0);"><?php echo esc_html($cat_term->name); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if($s_type_field != '' && $s_type_field == 'enabled') { ?>
                <div class="form-group hidden-xs adv">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                        <span class="dropdown-label"><?php esc_html_e('Type', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-select">
                        <li class="active"><input type="radio" name="search_type" value="0" checked="checked"><a href="javascript:void(0);"><?php esc_html_e('Type', 'reales'); ?></a></li>
                        <?php foreach($type_terms as $type_term) { ?>
                        <li><input type="radio" name="search_type" value="<?php echo esc_attr($type_term->term_id); ?>"><a href="javascript:void(0);"><?php echo esc_html($type_term->name); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if($s_price_field != '' && $s_price_field == 'enabled') { ?>
                <div class="form-group hidden-xs adv">
                    <div class="input-group">
                        <div class="input-group-addon"><?php echo esc_html($currency_symbol); ?></div>
                        <input class="form-control price" type="text" name="search_min_price" id="search_min_price" placeholder="<?php esc_html_e('Min price', 'reales'); ?>">
                    </div>
                </div>
                <div class="form-group hidden-xs adv">
                    <div class="input-group">
                        <div class="input-group-addon"><?php echo esc_html($currency_symbol); ?></div>
                        <input class="form-control price" type="text" name="search_max_price" id="search_max_price" placeholder="<?php esc_html_e('Max price', 'reales'); ?>">
                    </div>
                </div>
            <?php } ?>
            <?php if($s_area_field != '' && $s_area_field == 'enabled') { ?>
                <div class="form-group hidden-xs adv">
                    <div class="input-group">
                        <input class="form-control price" type="text" name="search_min_area" id="search_min_area" placeholder="<?php esc_html_e('Min area', 'reales'); ?>">
                        <div class="input-group-addon"><?php echo esc_html($area_unit); ?></div>
                    </div>
                </div>
                <div class="form-group hidden-xs adv">
                    <div class="input-group">
                        <input class="form-control price" type="text" name="search_max_area" id="search_max_area" placeholder="<?php esc_html_e('Max area', 'reales'); ?>">
                        <div class="input-group-addon"><?php echo esc_html($area_unit); ?></div>
                    </div>
                </div>
            <?php } ?>
            <?php if($s_bedrooms_field != '' && $s_bedrooms_field == 'enabled') { ?>
                <div class="form-group hidden-xs adv">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                        <span class="dropdown-label"><?php esc_html_e('Bedrooms', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-select">
                        <li class="active"><input type="radio" name="search_bedrooms" value="0" checked="checked"><a href="javascript:void(0);"><?php esc_html_e('Bedrooms', 'reales'); ?></a></li>
                        <li><input type="radio" name="search_bedrooms" value="1"><a href="javascript:void(0);">1+</a></li>
                        <li><input type="radio" name="search_bedrooms" value="2"><a href="javascript:void(0);">2+</a></li>
                        <li><input type="radio" name="search_bedrooms" value="3"><a href="javascript:void(0);">3+</a></li>
                        <li><input type="radio" name="search_bedrooms" value="4"><a href="javascript:void(0);">4+</a></li>
                        <li><input type="radio" name="search_bedrooms" value="5"><a href="javascript:void(0);">5+</a></li>
                    </ul>
                </div>
            <?php } ?>
            <?php if($s_bathrooms_field != '' && $s_bathrooms_field == 'enabled') { ?>
                <div class="form-group hidden-xs adv">
                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                        <span class="dropdown-label"><?php esc_html_e('Bathrooms', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-select">
                        <li class="active"><input type="radio" name="search_bathrooms" value="0" checked="checked"><a href="javascript:void(0);"><?php esc_html_e('Bathrooms', 'reales'); ?></a></li>
                        <li><input type="radio" name="search_bathrooms" value="1"><a href="javascript:void(0);">1+</a></li>
                        <li><input type="radio" name="search_bathrooms" value="2"><a href="javascript:void(0);">2+</a></li>
                        <li><input type="radio" name="search_bathrooms" value="3"><a href="javascript:void(0);">3+</a></li>
                        <li><input type="radio" name="search_bathrooms" value="4"><a href="javascript:void(0);">4+</a></li>
                        <li><input type="radio" name="search_bathrooms" value="5"><a href="javascript:void(0);">5+</a></li>
                    </ul>
                </div>
            <?php } ?>
            <?php
            // Get property custom fields
            $reales_fields_settings = get_option('reales_fields_settings');
            if(is_array($reales_fields_settings)) {
                uasort($reales_fields_settings, "reales_compare_position");
                foreach ($reales_fields_settings as $key => $value) {
                    if ($value['search'] == 'yes') {
                        print '<div class="form-group hidden-xs adv">';
                        switch ($value['type']) {
                            case 'date_field':
                                print '<input type="text" name="' . $key . '" id="' . $key . '" class="form-control datePicker" placeholder="' . $value['label'] . '" />';
                                break;
                            case 'list_field':
                                $list = explode(',', $value['list']);
                                print '<a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">';
                                print '<span class="dropdown-label">' . $value['label'] . '</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>';
                                print '</a>';
                                print '<ul class="dropdown-menu dropdown-select">';
                                print '<li class="active"><input type="radio" name="' . $key . '" value="" checked="checked"><a href="javascript:void(0);">' . $value['label'] . '</a></li>';
                                for($i = 0; $i < count($list); $i++) {
                                    print '<li><input type="radio" name="' . $key . '" value="' . $i . '"><a href="javascript:void(0);">' . $list[$i] . '</a></li>';
                                }
                                print '</ul>';
                                break;
                            default:
                                print '<input type="text" name="' . $key . '" id="' . $key . '" class="form-control" placeholder="' . $value['label'] . '" />';
                                break;
                        }
                        print '<input type="hidden" name="' . $key . '_comparison" id="' . $key . '_comparison" value="' . $value['comparison'] . '" />';
                        print '</div>';
                    }
                }
            }
            ?>
            <div class="form-group">
                <input type="submit" id="searchPropertySubmit" class="btn btn-green" value="<?php esc_attr_e('Search', 'reales'); ?>">
                <a href="javascript:void(0);" class="btn btn-o btn-white pull-right visible-xs" id="advanced"><?php esc_html_e('Advanced Search', 'reales'); ?> <span class="fa fa-angle-up"></span></a>
            </div>
        </form>
    <?php } ?>

    <?php dynamic_sidebar('idx-homepage-search-widget-area'); ?>

</div>