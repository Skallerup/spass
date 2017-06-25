<?php
/*
Template Name: IDX Listings
*/

/**
 * @package WordPress
 * @subpackage Reales
 */

global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$show_bc = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
?>

<div id="wrapper">

    <div id="mapIdxView">
        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
    </div>

    <div id="content">
        <div class="filter">
            <?php dynamic_sidebar('idx-properties-search-widget-area'); ?>
        </div>
        <div class="resultsList">
            <div class="idx-property-top">
                <?php if($show_bc != '') {
                    reales_breadcrumbs();
                } ?>
                <h1 id="idx-title"><?php echo esc_html($post->post_title); ?></h1>
            </div>
            <?php while(have_posts()) : the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <div class="clearfix"></div>
                        <?php wp_link_pages( array(
                            'before'      => '<div class="page-links">',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '%',
                            'separator'   => '',
                        ) ); ?>
                    </div>
                </div>

                <?php if(comments_open() || get_comments_number()) {
                    comments_template();
                }

            endwhile; ?>

        </div>

        <?php get_template_part('templates/mapview_footer'); ?>
    </div>

</div>

<?php
get_template_part('templates/app_footer');
?>