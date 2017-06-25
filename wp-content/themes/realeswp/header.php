<?php
/**
 * @package WordPress
 * @subpackage Reales
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php 
    $reales_general_settings = get_option('reales_general_settings');
    $favicon = isset($reales_general_settings['reales_favicon_field']) ? $reales_general_settings['reales_favicon_field'] : '';
    if($favicon != '') {
        echo '<link rel="shortcut icon" href="' . esc_url($favicon) . '" type="image/x-icon" />';
    } else {
        echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/images/favicon.png" type="image/x-icon" />';
    }
    ?>
    <?php get_template_part('templates/social_meta'); ?>
    <?php wp_head(); ?>
</head>

<?php
$body_classes = 'no-transition';
$reales_appearance_settings = get_option('reales_appearance_settings','');
$home_header = isset($reales_appearance_settings['reales_home_header_field']) ? $reales_appearance_settings['reales_home_header_field'] : '';
$home_caption = isset($reales_appearance_settings['reales_home_caption_field']) ? $reales_appearance_settings['reales_home_caption_field'] : '';
$home_spotlight = isset($reales_appearance_settings['reales_home_spotlight_field']) ? $reales_appearance_settings['reales_home_spotlight_field'] : '';
$nomap = isset($reales_appearance_settings['reales_nomap_field']) ? $reales_appearance_settings['reales_nomap_field'] : '';
?>

<body <?php body_class($body_classes); ?>>

    <?php 
    if(is_front_page()) {
        get_template_part('templates/front_hero');
    } else if(is_home() || is_archive() || is_search()) { 
        get_template_part('templates/blog_carousel');
    } else if(is_single() && !is_singular('property') && !is_singular('agent')) { 
        get_template_part('templates/post_hero');
    } else if(!is_page_template('property-search-results.php') && 
                !is_singular('ds-idx-listings-page') && 
                !is_page_template('idx-listings.php') && 
                !(defined("IS_OPTIMA") && IS_OPTIMA) && 
                !is_page_template('submit-property.php') && 
                !is_page_template('my-properties.php') && 
                !is_page_template('favourite-properties.php') && 
                !is_singular('property') &&
                !is_singular('agent') ||
                (is_page_template('property-search-results.php') && $nomap == '1') || 
                (is_singular('property') && $nomap == '1') || 
                (is_singular('agent') && $nomap == '1')) { 
        get_template_part('templates/page_hero');
    }

    if((is_page_template('property-search-results.php') && $nomap != '1') || 
            is_singular('ds-idx-listings-page') || 
            is_page_template('idx-listings.php') || 
            (defined("IS_OPTIMA") && IS_OPTIMA) || 
            (is_singular('property') && $nomap != '1') || 
            (is_singular('agent') && $nomap != '1') || 
            is_page_template('submit-property.php') || 
            is_page_template('my-properties.php') || 
            is_page_template('favourite-properties.php')) { 
        get_template_part('templates/home_header');
    } else {
        get_template_part('templates/home_header');
    }

    if(is_front_page() && ($home_header == 'slideshow' || $home_header == 'video') && $home_caption) {
        get_template_part('templates/home_caption');
    }

    if(!is_front_page() && 
            !is_home() && 
            !is_archive() && 
            !is_search() && 
            !is_single() && 
            !is_404() && 
            !is_page_template('property-search-results.php') && 
            !is_singular('ds-idx-listings-page') && 
            !is_page_template('idx-listings.php') && 
            !(defined("IS_OPTIMA") && IS_OPTIMA) && 
            !is_page_template('submit-property.php') && 
            !is_page_template('my-properties.php') && 
            !is_page_template('favourite-properties.php') || 
            (is_page_template('property-search-results.php') && $nomap == '1') || 
            (is_singular('agent') && $nomap == '1')) {
        get_template_part('templates/page_caption');
    }

    if(is_front_page()) {
        get_template_part('templates/search_properties');
    }

    if(is_404()) {
        get_template_part('templates/page_error_caption');
    }
    ?>

    </div>

    <?php
    if(is_front_page() && $home_spotlight) {
        get_template_part('templates/home_spotlight');
    }
    ?>
