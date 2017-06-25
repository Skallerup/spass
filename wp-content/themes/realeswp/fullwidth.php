<?php
/*
Template Name: Fullwidth
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

<div id="" class="page-wrapper">
    <div class="page-content">
        <?php while(have_posts()) : the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if($show_bc != '') {
                reales_breadcrumbs();
            } ?>
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
</div>

<?php get_footer(); ?>