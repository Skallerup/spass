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
$type_terms                  = get_terms($type_taxonomies, $type_args);
$reales_general_settings     = get_option('reales_general_settings');
$reales_filter_settings      = get_option('reales_filter_settings');
$reales_prop_fields_settings = get_option('reales_prop_fields_settings');
$p_city_t                    = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
$search_id                   = isset($_GET['search_id']) ? sanitize_text_field($_GET['search_id']) : '';
$search_keywords             = isset($_GET['search_keywords']) ? sanitize_text_field($_GET['search_keywords']) : '';
$search_country              = isset($_GET['search_country']) ? sanitize_text_field($_GET['search_country']) : '';
$search_state                = isset($_GET['search_state']) ? sanitize_text_field($_GET['search_state']) : '';
$search_city                 = isset($_GET['search_city']) ? stripslashes(sanitize_text_field($_GET['search_city'])) : '';
$search_lat                  = isset($_GET['search_lat']) ? sanitize_text_field($_GET['search_lat']) : '';
$search_lng                  = isset($_GET['search_lng']) ? sanitize_text_field($_GET['search_lng']) : '';
$search_neighborhood         = isset($_GET['search_neighborhood']) ? sanitize_text_field($_GET['search_neighborhood']) : '';
$search_category             = isset($_GET['search_category']) ? sanitize_text_field($_GET['search_category']) : 0;
$search_type                 = isset($_GET['search_type']) ? sanitize_text_field($_GET['search_type']) : 0;
$search_min_price            = isset($_GET['search_min_price']) ? sanitize_text_field($_GET['search_min_price']) : '';
$search_max_price            = isset($_GET['search_max_price']) ? sanitize_text_field($_GET['search_max_price']) : '';
$search_min_area             = isset($_GET['search_min_area']) ? sanitize_text_field($_GET['search_min_area']) : '';
$search_max_area             = isset($_GET['search_max_area']) ? sanitize_text_field($_GET['search_max_area']) : '';
$search_bedrooms_data        = isset($_GET['search_bedrooms']) ? sanitize_text_field($_GET['search_bedrooms']) : '';
$search_bedrooms             = ($search_bedrooms_data == '') ? 0 : $search_bedrooms_data;
$search_bathrooms_data       = isset($_GET['search_bathrooms']) ? sanitize_text_field($_GET['search_bathrooms']) : '';
$search_bathrooms            = ($search_bathrooms_data == '') ? 0 : $search_bathrooms_data;
$f_id_field                  = isset($reales_filter_settings['reales_f_id_field']) ? $reales_filter_settings['reales_f_id_field'] : '';
$f_keywords_field            = isset($reales_filter_settings['reales_f_keywords_field']) ? $reales_filter_settings['reales_f_keywords_field'] : '';
$f_country_field             = isset($reales_filter_settings['reales_f_country_field']) ? $reales_filter_settings['reales_f_country_field'] : '';
$f_state_field               = isset($reales_filter_settings['reales_f_state_field']) ? $reales_filter_settings['reales_f_state_field'] : '';
$f_city_field                = isset($reales_filter_settings['reales_f_city_field']) ? $reales_filter_settings['reales_f_city_field'] : '';
$h_city_field                = isset($reales_filter_settings['reales_h_city_field']) ? $reales_filter_settings['reales_h_city_field'] : '';
$f_category_field            = isset($reales_filter_settings['reales_f_category_field']) ? $reales_filter_settings['reales_f_category_field'] : '';
$f_type_field                = isset($reales_filter_settings['reales_f_type_field']) ? $reales_filter_settings['reales_f_type_field'] : '';
$f_price_field               = isset($reales_filter_settings['reales_f_price_field']) ? $reales_filter_settings['reales_f_price_field'] : '';
$f_neighborhood_field        = isset($reales_filter_settings['reales_f_neighborhood_field']) ? $reales_filter_settings['reales_f_neighborhood_field'] : '';
$f_area_field                = isset($reales_filter_settings['reales_f_area_field']) ? $reales_filter_settings['reales_f_area_field'] : '';
$f_bedrooms_field            = isset($reales_filter_settings['reales_f_bedrooms_field']) ? $reales_filter_settings['reales_f_bedrooms_field'] : '';
$f_bathrooms_field           = isset($reales_filter_settings['reales_f_bathrooms_field']) ? $reales_filter_settings['reales_f_bathrooms_field'] : '';
$f_amenities_field           = isset($reales_filter_settings['reales_f_amenities_field']) ? $reales_filter_settings['reales_f_amenities_field'] : '';
$sort                        = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest';
?>

<div class="filter">
    <h3><?php esc_html_e('Filter your results', 'reales'); ?></h3>
    <a href="javascript:void(0);" class="handleFilter"><span class="icon-equalizer"></span></a>
    <div class="clearfix"></div>
    <form class="filterForm" id="filterPropertyForm" role="search" method="get" action="<?php echo esc_url($search_submit); ?>">
        <input type="hidden" name="search_lat" id="search_lat" value="<?php echo esc_attr($search_lat); ?>" autocomplete="off" />
        <input type="hidden" name="search_lng" id="search_lng" value="<?php echo esc_attr($search_lng); ?>" autocomplete="off" />
        <input type="hidden" name="sort" id="sort" value="<?php echo esc_attr($sort); ?>" autocomplete="off" />

        <?php if($f_id_field != '' && $f_id_field == 'enabled') { ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label><?php esc_html_e('Property ID', 'reales'); ?></label>
                        <input type="text" class="form-control" name="search_id" id="search_id" value="<?php echo esc_attr($search_id); ?>" placeholder="<?php esc_html_e('Enter property ID', 'reales'); ?>" />
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if($f_keywords_field != '' && $f_keywords_field == 'enabled') { ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label><?php esc_html_e('Keywords', 'reales'); ?></label>
                        <input type="text" class="form-control" name="search_keywords" id="search_keywords" value="<?php echo esc_attr($search_keywords); ?>" placeholder="<?php esc_html_e('Enter keywords', 'reales'); ?>" />
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <?php if($f_country_field != '' && $f_country_field == 'enabled') { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label><?php esc_html_e('Country', 'reales'); ?></label>
                        <?php
                        $country_default = isset($reales_general_settings['reales_country_field']) ? $reales_general_settings['reales_country_field'] : '';
                        if($search_country != '') {
                            print reales_search_country_list($search_country);
                        } else {
                            print reales_search_country_list($country_default);
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
            <?php if($f_state_field != '' && $f_state_field == 'enabled') { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label><?php esc_html_e('State/County', 'reales'); ?></label>
                        <input type="text" class="form-control" name="search_state" id="search_state" value="<?php echo esc_attr($search_state); ?>" placeholder="<?php esc_html_e('Enter state/county', 'reales'); ?>" />
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if($f_city_field != '' && $f_city_field == 'enabled') { ?>
            <div class="row" id="filterCity" style="<?php if($h_city_field != '' && $p_city_t != 'list') { echo esc_attr('display: none;'); } ?>">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label><?php esc_html_e('City', 'reales'); ?></label>
                        <?php
                        if($p_city_t == 'list') {
                            $reales_cities_settings = get_option('reales_cities_settings');

                            print '<select id="search_city" name="search_city" class="form-control">
                                            <option value="">' . __('Select a city', 'reales') . '</option>';
                            if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                                uasort($reales_cities_settings, "reales_compare_position");
                                foreach ($reales_cities_settings as $key => $value) {
                                    print '<option value="' . $key . '"';
                                    if ($search_city == $key) {
                                        print ' selected ';
                                    }
                                    print '>' . $value['name'] . '</option>';
                                }
                            }
                            print '</select>';
                        } else {
                        ?>
                        <input type="text" class="form-control auto" name="search_city" id="search_city" value="<?php echo esc_attr($search_city); ?>" placeholder="<?php esc_html_e('Enter city', 'reales'); ?>" autocomplete="off" />
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <?php if($f_price_field != '' && $f_price_field == 'enabled') { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                    <div class="formField">
                        <label><?php esc_html_e('Price Range', 'reales'); ?></label>
                        <input type="hidden" name="search_min_price" id="search_min_price" value="<?php echo esc_attr($search_min_price); ?>" />
                        <input type="hidden" name="search_max_price" id="search_max_price" value="<?php echo esc_attr($search_max_price); ?>" />
                        <div class="slider priceSlider">
                            <div class="sliderTooltip">
                                <div class="stArrow"></div>
                                <div class="stLabel"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(($f_category_field != '' && $f_category_field == 'enabled') || ($f_type_field != '' && $f_type_field == 'enabled')) { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                    <?php if($f_category_field != '' && $f_category_field == 'enabled') { ?>
                        <div class="form-group fg-inline">
                            <label for="search_category"><?php esc_html_e('Category', 'reales'); ?></label>
                            <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                <span class="dropdown-label"><?php esc_html_e('Category', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-select">
                                <li class="active"><input type="radio" name="search_category" value="0" <?php if(!$search_category || $search_category == '' || $search_category == 0) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Category', 'reales'); ?></a></li>
                                <?php foreach($cat_terms as $cat_term) { ?>
                                <li><input type="radio" name="search_category" value="<?php echo esc_attr($cat_term->term_id); ?>" <?php if($search_category == $cat_term->term_id) { echo 'checked="checked"'; } ?>><a href="javascript:void(0);"><?php echo esc_html($cat_term->name); ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php if($f_type_field != '' && $f_type_field == 'enabled') { ?>
                        <div class="form-group fg-inline">
                            <label for="search_type"><?php esc_html_e('Type', 'reales'); ?></label>
                            <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                <span class="dropdown-label"><?php esc_html_e('Type', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-select">
                                <li class="active"><input type="radio" name="search_type" value="0" <?php if(!$search_type || $search_type == '' || $search_type == 0) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Type', 'reales'); ?></a></li>
                                <?php foreach($type_terms as $type_term) { ?>
                                <li><input type="radio" name="search_type" value="<?php echo esc_attr($type_term->term_id); ?>" <?php if($search_type == $type_term->term_id) { echo 'checked="checked"'; } ?>><a href="javascript:void(0);"><?php echo esc_html($type_term->name); ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <div id="advancedFilter">
            <div class="row">
            <?php if(($f_bedrooms_field != '' && $f_bedrooms_field == 'enabled') || ($f_bathrooms_field != '' && $f_bathrooms_field == 'enabled')) { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                    <?php if($f_bedrooms_field != '' && $f_bedrooms_field == 'enabled') { ?>
                        <div class="form-group fg-inline">
                            <label><?php esc_html_e('Bedrooms', 'reales'); ?></label>
                            <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                <span class="dropdown-label"><?php esc_html_e('Bedrooms', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-select">
                                <li class="active"><input type="radio" name="search_bedrooms" value="0" <?php if(!$search_bedrooms || $search_bedrooms == '' || $search_bedrooms == 0) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Bedrooms', 'reales'); ?></a></li>
                                <li><input type="radio" name="search_bedrooms" value="1" <?php if($search_bedrooms && $search_bedrooms != '' && $search_bedrooms == 1) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">1+</a></li>
                                <li><input type="radio" name="search_bedrooms" value="2" <?php if($search_bedrooms && $search_bedrooms != '' && $search_bedrooms == 2) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">2+</a></li>
                                <li><input type="radio" name="search_bedrooms" value="3" <?php if($search_bedrooms && $search_bedrooms != '' && $search_bedrooms == 3) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">3+</a></li>
                                <li><input type="radio" name="search_bedrooms" value="4" <?php if($search_bedrooms && $search_bedrooms != '' && $search_bedrooms == 4) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">4+</a></li>
                                <li><input type="radio" name="search_bedrooms" value="5" <?php if($search_bedrooms && $search_bedrooms != '' && $search_bedrooms == 5) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">5+</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php if($f_bathrooms_field != '' && $f_bathrooms_field == 'enabled') { ?>
                        <div class="form-group fg-inline">
                            <label><?php esc_html_e('Bathrooms', 'reales'); ?></label>
                            <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                <span class="dropdown-label"><?php esc_html_e('Bathrooms', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-select">
                                <li class="active"><input type="radio" name="search_bathrooms" value="0" checked="checked"><a href="javascript:void(0);"><?php esc_html_e('Bathrooms', 'reales'); ?></a></li>
                                <li><input type="radio" name="search_bathrooms" value="1" <?php if($search_bathrooms && $search_bathrooms != '' && $search_bathrooms == 1) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">1+</a></li>
                                <li><input type="radio" name="search_bathrooms" value="2" <?php if($search_bathrooms && $search_bathrooms != '' && $search_bathrooms == 2) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">2+</a></li>
                                <li><input type="radio" name="search_bathrooms" value="3" <?php if($search_bathrooms && $search_bathrooms != '' && $search_bathrooms == 3) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">3+</a></li>
                                <li><input type="radio" name="search_bathrooms" value="4" <?php if($search_bathrooms && $search_bathrooms != '' && $search_bathrooms == 4) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">4+</a></li>
                                <li><input type="radio" name="search_bathrooms" value="5" <?php if($search_bathrooms && $search_bathrooms != '' && $search_bathrooms == 5) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);">5+</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>
            <div class="row">
                <?php if($f_area_field != '' && $f_area_field == 'enabled') { ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                        <div class="formField">
                            <label><?php esc_html_e('Area Range', 'reales'); ?></label>
                            <input type="hidden" name="search_min_area" id="search_min_area" value="<?php echo esc_attr($search_min_area); ?>" />
                            <input type="hidden" name="search_max_area" id="search_max_area" value="<?php echo esc_attr($search_max_area); ?>" />
                            <div class="slider areaSlider">
                                <div class="sliderTooltip">
                                    <div class="stArrow"></div>
                                    <div class="stLabel"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($f_neighborhood_field != '' && $f_neighborhood_field == 'enabled') { ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                        <div class="form-group">
                            <label for="search_neighborhood"><?php esc_html_e('Neighborhood', 'reales'); ?></label>
                            <input type="text" class="form-control" name="search_neighborhood" id="search_neighborhood" value="<?php echo esc_attr($search_neighborhood); ?>" placeholder="<?php esc_html_e('Enter neighborhood', 'reales'); ?>" />
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
            // Get property custom fields
            $reales_fields_settings = get_option('reales_fields_settings');
            if(is_array($reales_fields_settings)) {
                print '<div class="row">';
                uasort($reales_fields_settings, "reales_compare_position");
                foreach ($reales_fields_settings as $key => $value) {
                    if ($value['search'] == 'yes') {
                        $field_value = isset($_GET[$key]) ? sanitize_text_field($_GET[$key]) : '';

                        print '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem"><div class="form-group">';
                        print '<label for="' . $key . '">' . $value['label'] . '</label>';
                        switch ($value['type']) {
                            case 'date_field':
                                print '<input type="text" name="' . $key . '" id="' . $key . '" class="form-control datePicker" placeholder="' . $value['label'] . '" value="' . $field_value . '" />';
                                break;
                            case 'list_field':
                                $list = explode(',', $value['list']);
                                print '<a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">';
                                print '<span class="dropdown-label">' . $value['label'] . '</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>';
                                print '</a>';
                                print '<ul class="dropdown-menu dropdown-select">';
                                print '<li class="active"><input type="radio" name="' . $key . '" value=""';
                                if($field_value == '') {
                                    print ' checked="checked"';
                                }
                                print '><a href="javascript:void(0);">' . $value['label'] . '</a></li>';
                                for($i = 0; $i < count($list); $i++) {
                                    print '<li><input type="radio" name="' . $key . '" value="' . $i . '"';
                                    if($field_value != '' && $field_value == $i) {
                                        print ' checked="checked"';
                                    }
                                    print '><a href="javascript:void(0);">' . $list[$i] . '</a></li>';
                                }
                                print '</ul>';
                                break;
                            default:
                                print '<input type="text" name="' . $key . '" id="' . $key . '" class="form-control" placeholder="' . $value['label'] . '" value="' . $field_value . '" />';
                                break;
                        }
                        print '<input type="hidden" name="' . $key . '_comparison" id="' . $key . '_comparison" value="' . $value['comparison'] . '" />';
                        print '</div></div>';
                    }
                }
                print '</div>';
            }
            ?>

            <?php 
            if($f_amenities_field != '' && $f_amenities_field == 'enabled') {
                $reales_amenity_settings = get_option('reales_amenity_settings');

                if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
                    uasort($reales_amenity_settings, "reales_compare_position");
                    print '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 formItem"><div class="form-group"><label>'. __('Amenities', 'reales') .'</label>';
                    print '<div class="row">';
                    foreach ($reales_amenity_settings as $key => $value) {
                        $am_label = $value['label'];
                        if(function_exists('icl_translate')) {
                            $am_label = icl_translate('reales', 'reales_property_amenity_' . $value['label'], $value['label']);
                        }
                        print '
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                <div class="checkbox custom-checkbox">
                                    <label><input type="checkbox" name="' . esc_attr($key) . '" value="1" ';
                        if (isset($_GET[$key]) && $_GET[$key] == 1) {
                            print ' checked="checked" ';
                        }
                        print ' />
                                    <span class="fa fa-check"></span> ' . esc_html($am_label) . '</label>
                                </div>
                            </div>';
                    }
                    print '</div>';
                    print '</div></div></div>';
                }
            }
            ?>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <a href="javascript:void(0);" class="btn btn-green mb-10" id="filterPropertySubmit"><?php esc_html_e('Apply Filter', 'reales'); ?></a>
                    <a href="javascript:void(0);" class="btn btn-gray display mb-10" id="showAdvancedFilter"><?php esc_html_e('Show Advanced Filter Options', 'reales'); ?></a>
                    <a href="javascript:void(0);" class="btn btn-gray mb-10" id="hideAdvancedFilter"><?php esc_html_e('Hide Advanced Filter Options', 'reales'); ?></a>
                </div>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
</div>