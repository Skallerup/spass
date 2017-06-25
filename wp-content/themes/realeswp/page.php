<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$sidebar_position = isset($reales_appearance_settings['reales_sidebar_field']) ? $reales_appearance_settings['reales_sidebar_field'] : '';
$show_bc = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
?>

<div id="" class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <?php if($sidebar_position == 'left') { ?>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
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
            <?php if($sidebar_position == 'right') { ?>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>