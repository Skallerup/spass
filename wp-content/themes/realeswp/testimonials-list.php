<?php
/*
Template Name: Testimonials List
*/

/**
 * @package WordPress
 * @subpackage Reales
 */


global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$sidebar_position           = isset($reales_appearance_settings['reales_sidebar_field']) ?  $reales_appearance_settings['reales_sidebar_field'] : '';
$show_bc                    = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
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

                <div class="testimonials">
                    <?php
                    global $paged;
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $args = array(
                        'posts_per_page' => 10,
                        'paged'          => $paged,
                        'post_type'      => 'testimonials',
                        'post_status'    => array('publish')
                    );

                    $testimonials = new WP_Query($args);

                    while ($testimonials->have_posts()): $testimonials->the_post();
                        $testimonial_id = get_the_ID();
                        $title          = get_the_title();
                        $text           = get_post_meta($testimonial_id, 'testimonials_text', true);
                        $avatar         = get_post_meta($testimonial_id, 'testimonials_avatar', true);

                        if($avatar != '') {
                            $avatar_src = $avatar;
                        } else {
                            $avatar_src = get_template_directory_uri().'/images/avatar.png';
                        }
                        ?>

                        <div class="testimonialsItem">
                            <div class="testimonialsItemAvatar">
                                <img src="<?php echo esc_url($avatar_src); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="testimonialsItemText"><?php echo esc_html($text); ?></div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                            </div>
                            <div class="testimonialsItemName"><?php echo esc_html($title); ?></div>
                            <div class="testimonialsItemDelimiter"><span></span></div>
                        </div>

                    <?php endwhile;

                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>

                <div class="blog-pagination">
                    <div class="pull-left"><?php next_posts_link( '<span class="fa fa-angle-left"></span> ' . __('Older Testimonials', 'reales'), esc_html($testimonials->max_num_pages) ); ?></div>
                    <div class="pull-right"><?php previous_posts_link( __('Newer Testimonials', 'reales') . ' <span class="fa fa-angle-right"></span>' ); ?></div>
                    <div class="clearfix"></div>
                </div>
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