<?php
/*
Template Name: Testimonials Page
*/

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
                        
                    </div>
                </div>
                <?php endwhile; ?>
                <?php 
                $args = array(
                    'posts_per_page'   => -1,
                    'post_type'        => 'testimonials',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'post_status'      => 'publish' );
                $posts = get_posts($args);

                foreach($posts as $post) : setup_postdata($post);
                    $avatar = get_post_meta($post->ID, 'testimonials_avatar', true);
                    if($avatar != '') {
                        $avatar_src = $avatar;
                    } else {
                        $avatar_src = get_template_directory_uri().'/images/avatar.png';
                    }
                    $text = get_post_meta($post->ID, 'testimonials_text', true);
                    print '<div class="row pb40">';
                    print '<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">';
                    print '<img src="' . esc_url($avatar_src) . '" class="testim-avatar" alt="' . esc_attr($post->post_title) . '" style="width:100px;height:100px;">';
                    print '</div>';
                    print '<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">';
                    print '<div class="home-testim-text">' . esc_html($text) . '</div>';
                    print '<div class="home-testim-name">' . esc_html($post->post_title) . '</div>';
                    print '</div>';
                    print '</div>';
                endforeach;

                wp_reset_postdata();
                wp_reset_query();
                ?>
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