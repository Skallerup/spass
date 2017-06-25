<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_colors_settings = get_option('reales_colors_settings');
$reales_appearance_settings = get_option('reales_appearance_settings');

$main_color = isset($reales_colors_settings['reales_main_color_field']) ? $reales_colors_settings['reales_main_color_field'] : '';
$main_color_dark = isset($reales_colors_settings['reales_main_color_dark_field']) ? $reales_colors_settings['reales_main_color_dark_field'] : '';
$side_bg = isset($reales_colors_settings['reales_app_side_bg_field']) ? $reales_colors_settings['reales_app_side_bg_field'] : '';
$side_item_active_bg = isset($reales_colors_settings['reales_app_side_item_active_bg_field']) ? $reales_colors_settings['reales_app_side_item_active_bg_field'] : '';
$side_sub_bg = isset($reales_colors_settings['reales_app_side_sub_bg_field']) ? $reales_colors_settings['reales_app_side_sub_bg_field'] : '';
$side_sub_item_active_bg = isset($reales_colors_settings['reales_app_side_sub_item_active_bg_field']) ? $reales_colors_settings['reales_app_side_sub_item_active_bg_field'] : '';
$side_text = isset($reales_colors_settings['reales_app_side_text_color_field']) ? $reales_colors_settings['reales_app_side_text_color_field'] : '';
$side_sub_text = isset($reales_colors_settings['reales_app_side_sub_text_color_field']) ? $reales_colors_settings['reales_app_side_sub_text_color_field'] : '';
$top_item_active = isset($reales_colors_settings['reales_app_top_item_active_color_field']) ? $reales_colors_settings['reales_app_top_item_active_color_field'] : '';
$footer_bg = isset($reales_colors_settings['reales_footer_bg_field']) ? $reales_colors_settings['reales_footer_bg_field'] : '';
$footer_header = isset($reales_colors_settings['reales_footer_header_color_field']) ? $reales_colors_settings['reales_footer_header_color_field'] : '';
$prop_type_badge_bg = isset($reales_colors_settings['reales_prop_type_badge_bg_field']) ? $reales_colors_settings['reales_prop_type_badge_bg_field'] : '';
$prop_featured_badge_bg = isset($reales_colors_settings['reales_prop_featured_badge_bg_field']) ? $reales_colors_settings['reales_prop_featured_badge_bg_field'] : '';
$fav_icon = isset($reales_colors_settings['reales_fav_icon_color_field']) ? $reales_colors_settings['reales_fav_icon_color_field'] : '';
$prop_pending_label_bg = isset($reales_colors_settings['reales_prop_pending_label_bg_field']) ? $reales_colors_settings['reales_prop_pending_label_bg_field'] : '';
$shadow_opacity = isset($reales_appearance_settings['reales_shadow_opacity_field']) ? $reales_appearance_settings['reales_shadow_opacity_field'] : '0';

print '
    .slideshowShadow {
        background-color: rgba(0,0,0,0.' . esc_html($shadow_opacity) . ') !important;
    }
';

if($main_color != '') {
    print '
        .btn-green {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .btn-o.btn-green {
            background-color: transparent !important;
            color: ' . esc_html($main_color) . ' !important;
            border-color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .btn-o.btn-green:hover,
        .btn-o.btn-green:focus,
        .btn-o.btn-green:active,
        .btn-o.btn-green.active,
        .open > .dropdown-toggle.btn-o.btn-green {
            background-color: ' . esc_html($main_color) . ' !important;
            color: #fff !important;
        }
        .text-green {
            color: ' . esc_html($main_color) . ' !important;
        }
        .logo {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .userMenu ul > li > a:hover > span, .no-touch .userMenu ul > li > a:focus > span {
            color: ' . esc_html($main_color) . ' !important;
        }
        .stLabel {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .stArrow {
            border-top-color: ' . esc_html($main_color) . ' !important;
        }
        .ui-slider .ui-slider-range {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch a.card:hover h2, .no-touch div.card:hover h2 {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .similar a.similarProp:hover .info .name {
            color: ' . esc_html($main_color) . ' !important;
        }
        .amItem.active span {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .propsWidget ul.propList li a:hover .info .name {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .agentsWidget ul.agentsList li a:hover .info .name {
            color: ' . esc_html($main_color) . ' !important;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .no-touch .pagination > .active > a:hover,
        .no-touch .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            background-color: ' . esc_html($main_color) . ' !important;
            border-color: ' . esc_html($main_color) . ' !important;
        }
        .page-links > span {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .progress-bar-green {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .spotlight {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .s-icon {
            color: ' . esc_html($main_color) . ' !important;
        }
        .label-green {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        h2.s-main {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .s-menu-item:hover .s-icon {
            color: #fff !important;
        }
        .no-touch .s-menu-item:hover .s-main {
            color: #fff !important;
        }
        .no-touch .s-menu-item:hover {
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .article h3 a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .blog-pagination a {
            border: 1px solid ' . esc_html($main_color) . ' !important;
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .blog-pagination a:hover {
            color: #fff !important;;
            background-color: ' . esc_html($main_color) . ' !important;
        }
        blockquote {
            border-left: 2px solid ' . esc_html($main_color) . ' !important;
        }
        .no-touch .f-p-article:hover .fpna-header, .no-touch .f-n-article:hover .fpna-header {
            color: ' . esc_html($main_color) . ' !important;
        }
        .comment-navigation a {
            border: 1px solid ' . esc_html($main_color) . ' !important;
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .comment-navigation a:hover {
            background-color: ' . esc_html($main_color) . ' !important;
            color: #fff !important;
        }.comment-form input[type="submit"] {
            border: 1px solid ' . esc_html($main_color) . ' !important;
            background-color: ' . esc_html($main_color) . ' !important;
        }
        #wp-calendar tbody tr td a {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .content-sidebar .agentsWidget ul.agentsList li a:hover .info .name {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .content-sidebar .propsWidget ul.propList li a:hover .info .name {
            color: ' . esc_html($main_color) . ' !important;
        }
        .datepicker td.day:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .datepicker td.active,
        .datepicker td.active:hover {
            color: #ffffff !important;
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .datepicker td span.active {
            color: #ffffff !important;
            background-color: ' . esc_html($main_color) . ' !important;
        }
        .datepicker thead tr:first-child th:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        @media screen and (max-width: 767px) {  
            #header {
                background-color: ' . esc_html($main_color) . ' !important;
            }
            .logo {
                background-color: transparent !important;
            }
        }
        .no-touch #dsidx-listings .dsidx-primary-data .dsidx-address a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch ul.dsidx-list.dsidx-panel li a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch div.dsidx-results-widget .dsidx-slideshow-control:hover {
            background-color: ' . esc_html($main_color) . ' !important;
            color: #fff !important;
        }
        .no-touch div.dsidx-results-widget h4 a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .dsidx-widget-single-listing h3.widget-title a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .dsidx-prop-summary .dsidx-prop-title a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch h4.dsidx-address a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .no-touch .properties-list-item-details h2 a:hover {
            color: ' . esc_html($main_color) . ' !important;
        }
        .content-sidebar .price-plan-title.active {
            background-color: ' . esc_html($main_color) . ' !important;
        }
    ';
}

if($main_color_dark != '') {
    print '
        .no-touch .btn-green:hover,
        .btn-green:focus,
        .btn-green:active,
        .btn-green.active,
        .open > .dropdown-toggle.btn-green {
            background-color: ' . esc_html($main_color_dark) . ' !important;
            color: #fff !important;
        }
        .no-touch a.text-green:hover {
            color: ' . esc_html($main_color_dark) . ' !important;
        }
        .no-touch a.bg-green:hover {
            background-color: ' . esc_html($main_color_dark) . ' !important;
        }
        .comment-form input[type="submit"]:hover {
            background-color: ' . esc_html($main_color_dark) . ' !important;
            border: 1px solid ' . esc_html($main_color_dark) . ' !important;
        }
        .footer-nav .searchform input[type="submit"] {
            background-color: ' . esc_html($main_color_dark) . ' !important;
        }
        .content-sidebar .searchform input[type="submit"] {
            background-color: ' . esc_html($main_color_dark) . ' !important;
        }
        .datepicker td.active:hover,
        .datepicker td.active:hover:hover,
        .datepicker td.active:focus,
        .datepicker td.active:hover:focus,
        .datepicker td.active:active,
        .datepicker td.active:hover:active,
        .datepicker td.active.active,
        .datepicker td.active:hover.active,
        .datepicker td.active.disabled,
        .datepicker td.active:hover.disabled,
        .datepicker td.active[disabled],
        .datepicker td.active:hover[disabled] {
            color: #ffffff !important;
            background-color: ' . esc_html($main_color_dark) . ' !important;
        }
        .datepicker td.active:active,
        .datepicker td.active:hover:active,
        .datepicker td.active.active,
        .datepicker td.active:hover.active {
            background-color: ' . esc_html($main_color_dark) . ' \9 !important;
        }
        .datepicker td span.active:hover,
        .datepicker td span.active:focus,
        .datepicker td span.active:active,
        .datepicker td span.active.active,
        .datepicker td span.active.disabled,
        .datepicker td span.active[disabled] {
            color: #ffffff !important;
            background-color: ' . esc_html($main_color_dark) . ' !important;
        }
        .datepicker td span.active:active,
        .datepicker td span.active.active {
            background-color: ' . esc_html($main_color_dark) . ' \9 !important;
        }
    ';
}

if($side_bg != '') {
    print '
        #leftSide {
            background-color: ' . esc_html($side_bg) . ' !important;
        }
    ';
}

if($side_text != '') {
    print '
        .leftNav > div > ul > li > a {
            color: ' . esc_html($side_text) . ' !important;
        }
        .expanded .leftNav > ul > li.onTap > a {
            color: ' . esc_html($side_text) . ' !important;
        }
        @media screen and (max-width: 767px) {  
            .searchIcon {
                color: ' . esc_html($side_text) . ' !important;
            }
            .search input::-webkit-input-placeholder {
                color: ' . esc_html($side_text) . ' !important;
            }
            .search input:-moz-placeholder {
                color: ' . esc_html($side_text) . ' !important;
            }
            .search input::-moz-placeholder {
                color: ' . esc_html($side_text) . ' !important;
            }
            .search input:-ms-input-placeholder {
                color: ' . esc_html($side_text) . ' !important;
            }
        }
    ';
}

if($side_sub_text != '') {
    print '
        .leftNav > div > ul > li > ul > li > a {
            color: ' . esc_html($side_sub_text) . ' !important;
        }
        .no-touch .leftNav > div > ul > li:hover > ul > li > a, .leftNav > div > ul > li.onTap > ul > li > a {
            color: ' . esc_html($side_sub_text) . ' !important;
            /* background-color: #132120; */
        }
    ';
}

if($side_item_active_bg != '') {
    print '
        .no-touch .leftNav > div > ul > li:hover > a, .leftNav > div > ul > li.onTap > a {
            background-color: ' . esc_html($side_item_active_bg) . ' !important;
            color: #fff !important;
        }
        .expanded .leftNav > ul > li.active > a {
            background-color: ' . esc_html($side_item_active_bg) . ' !important;
            color: #fff !important;
        }
    ';
}

if($side_sub_bg != '') {
    print '
        .leftNav > div > ul > li > ul {
            background-color: ' . esc_html($side_sub_bg) . ' !important;
        }
        .no-touch .leftNav > div > ul > li > ul {
            background-color: ' . esc_html($side_sub_bg) . ' !important;
        }
        .no-touch .leftNav > div > ul > li:hover > ul > li > a, .leftNav > div > ul > li.onTap > ul > li > a {
            /* color: #96adac; */
            background-color: ' . esc_html($side_sub_bg) . ' !important;
        }
        @media screen and (max-width: 767px) {  
            .leftNav .search {
                background-color: ' . esc_html($side_sub_bg) . ' !important;
            }
            .search input {
                background-color: ' . esc_html($side_sub_bg) . ' !important;
                color: #fff !important;
            }
        }
    ';
}

if($side_sub_item_active_bg != '') {
    print '
        .no-touch .leftNav > div > ul > li > ul > li > a:hover {
            color: #fff !important;
            background-color: ' . esc_html($side_sub_item_active_bg) . ' !important;
        }
    ';
}

if($top_item_active != '') {
    print '
        @media screen and (max-width: 767px) {
            .no-touch a.mapHandler:hover {
                color: ' . esc_html($top_item_active) . ' !important;
            }
            .no-touch #header a.userHandler:hover {
                color: ' . esc_html($top_item_active) . ' !important;
            }
            .no-touch #header a.navHandler:hover {
                color: ' . esc_html($top_item_active) . ' !important;
            }
        }
    ';
}

if($footer_bg != '') {
    print '
        .home-footer {
            background-color: ' . esc_html($footer_bg) . ' !important;
        }
    ';
}

if($footer_header != '') {
    print '
        .footer-header {
            color: ' . esc_html($footer_header) . ' !important;
        }
    ';
}

if($prop_type_badge_bg != '') {
    print '
        .propType {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .figType {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .similar a.similarProp .info .price .badge {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .propWidget-1 .fig .figType {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .propWidget-2 .fig .figType {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .propWidget-3 .priceCap .type {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .propsWidget ul.propList li a .info .price .badge {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
        .label-yellow {
            background-color: ' . esc_html($prop_type_badge_bg) . ' !important;
        }
    ';
}

if($prop_featured_badge_bg != '') {
    print '
        .propWidget-2 .fig .featured-label .featured-label-content {
            background-color: ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .propWidget-2 .fig .featured-label .featured-label-left {
            border-color: transparent transparent ' . esc_html($prop_featured_badge_bg) . ' transparent !important;
        }
        .propWidget-2 .fig .featured-label .featured-label-right {
            border-color: transparent transparent transparent ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .figure .featured-label .featured-label-content {
            background-color: ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .figure .featured-label .featured-label-left {
            border-color: transparent transparent ' . esc_html($prop_featured_badge_bg) . ' transparent !important;
        }
        .figure .featured-label .featured-label-right {
            border-color: transparent transparent transparent ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .propImg .featured-label .featured-label-content {
            background-color: ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .propImg .featured-label .featured-label-left {
            border-color: transparent transparent ' . esc_html($prop_featured_badge_bg) . ' transparent !important;
        }
        .propImg .featured-label .featured-label-right {
            border-color: transparent transparent transparent ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .propsWidget ul.propList li a .image .featured-label .featured-label-content {
            background-color: ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .propsWidget ul.propList li a .image .featured-label .featured-label-left {
            border-color: transparent transparent ' . esc_html($prop_featured_badge_bg) . ' transparent !important;
        }
        .propsWidget ul.propList li a .image .featured-label .featured-label-right {
            border-color: transparent transparent transparent ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .propImg .featured-label .featured-label-right {
            border-color: transparent transparent transparent ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .similar a.similarProp .featured-label .featured-label-content {
            background-color: ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .similar a.similarProp .featured-label .featured-label-left {
            border-color: transparent transparent ' . esc_html($prop_featured_badge_bg) . ' transparent !important;
        }
        .similar a.similarProp .featured-label .featured-label-right {
            border-color: transparent transparent transparent ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
        .single-featured {
            background-color: ' . esc_html($prop_featured_badge_bg) . ' !important;
        }
    ';
}

if($fav_icon != '') {
    print '
        .favLink .addFav, .favLink .addedFav, .favLink .noSigned {
            color: ' . esc_html($fav_icon) . ' !important;
        }
        .no-touch .favLink a.addFav:hover span, .no-touch .favLink a.noSigned:hover span {
            color: ' . esc_html($fav_icon) . ' !important;
        }
    ';
}

if($prop_pending_label_bg != '') {
    print '
        .figStatus {
            background-color: ' . esc_html($prop_pending_label_bg) . ' !important;
        }
    ';
}

?>