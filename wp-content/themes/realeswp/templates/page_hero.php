<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if($post) {
    $page_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
    $page_video = get_post_meta($post->ID, 'page_video', true);
} else {
    $page_image = '';
    $page_video = '';
} 

$reales_appearance_settings = get_option('reales_appearance_settings','');
$nomap = isset($reales_appearance_settings['reales_nomap_field']) ? $reales_appearance_settings['reales_nomap_field'] : '';
?>

<div id="page-hero-container" class="<?php if($page_video != '') { echo esc_attr('video'); } ?>">
    <?php if($page_video != '') { ?>
        <div class="page-hero video">
            <video autoplay id="bgvid" loop muted controls>
                <source src="<?php echo esc_url($page_video); ?>" type="video/mp4">
            </video>
            <div class="bgvid-cover" style="background-image:url(<?php echo esc_url($page_image[0]); ?>)"></div>
        </div>
    <?php } else { ?>
        <div class="page-hero" style="background-image:url(<?php echo esc_url($page_image[0]); ?>)"></div>
    <?php } ?>

    <?php if($nomap != '1') { ?>
        <div class="slideshowShadow"></div>
    <?php } ?>