<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$args = array(
    'posts_per_page'   => 4,
    'post_type'        => 'post',
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'meta_key'         => 'post_featured',
    'meta_value'       => '1',
    'post_status'      => 'publish'
);

$posts = new wp_query($args);
$t_posts = $posts->found_posts;


$display = '<div id="carouselBlog" class="carousel slide featured" data-ride="carousel">';
$display .= '<ol class="carousel-indicators">';
for($i = 0; $i < $t_posts; $i++) {
    $display .= '<li data-target="#carouselBlog" data-slide-to="' . esc_attr($i) . '"';
    if($i == 0) $display .= 'class="active"';
    $display .= ' ></li>';
}
$display .= '</ol>';
$display .= '<div class="carousel-inner">';

$counter = 0;
while( $posts->have_posts() ) {
    $posts->the_post();

    $post_id = get_the_ID();
    $post_title = get_the_title($post_id);
    $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
    $post_excerpt = get_the_excerpt();
    $author = get_the_author();
    $author_avatar = get_the_author_meta('avatar');
    if($author_avatar != '') {
        $author_avatar_src = $author_avatar;
    } else {
        $author_avatar_src = get_template_directory_uri().'/images/avatar.png';
    }
    $post_date = get_the_date();

    $display .= '<div class="item';
    if ($counter == 0) $display .= ' active';
    $display .= '" style="background-image: url(' . esc_url($post_image[0]) . ')">';
    $display .= '<div class="container">';
    $display .= '<div class="carousel-caption">';
    $display .= '<div class="carousel-title">' . __('Featured on Blog', 'reales') . '</div>';
    $display .= '<div class="caption-title">' . esc_html($post_title) . '</div>';
    $display .= '<div class="caption-subtitle">' . esc_html($post_excerpt) . '</div>';
    $display .= '<a href="' . esc_url(get_permalink($post_id)) . '" class="btn btn-lg btn-o btn-white">' . __('Read More', 'reales') . '</a>';
    $display .= '</div>';
    $display .= '<div class="avatar-caption">';
    $display .= '<img src="' . esc_url($author_avatar_src) . '" alt="' . esc_attr($author) . '">';
    $display .= '<div class="ac-user">';
    $display .= '<div class="ac-name">' . esc_html($author) . '</div>';
    $display .= '<div class="ac-title">' . esc_html($post_date) . '</div>';
    $display .= '</div>';
    $display .= '<div class="clearfix"></div>';
    $display .= '</div>';
    $display .= '</div>';
    $display .= '</div>';
    $counter++;
}

wp_reset_postdata();
wp_reset_query();

$display .= '</div>';
$display .= '<a class="left carousel-control" href="#carouselBlog" role="button" data-slide="prev"><span class="fa fa-chevron-left"></span></a>';
$display .= '<a class="right carousel-control" href="#carouselBlog" role="button" data-slide="next"><span class="fa fa-chevron-right"></span></a>';
$display .= '</div>';

print $display;

?>