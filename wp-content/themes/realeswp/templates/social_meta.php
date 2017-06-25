<?php
/**
 * @package WordPress
 * @subpackage Reales
 */


$reales_auth_settings = get_option('reales_auth_settings','');
$google_login = isset($reales_auth_settings['reales_google_login_field']) ? $reales_auth_settings['reales_google_login_field'] : false;
$google_client_id = isset($reales_auth_settings['reales_google_id_field']) ? $reales_auth_settings['reales_google_id_field'] : false;
$google_client_secret = isset($reales_auth_settings['reales_google_secret_field']) ? $reales_auth_settings['reales_google_secret_field'] : false;
?>

<?php if($google_login && $google_client_id) { ?>
    <meta name="google-signin-clientid" content="<?php echo esc_attr($google_client_id); ?>" />
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.login" />
    <meta name="google-signin-requestvisibleactions" content="http://schema.org/AddAction" />
    <meta name="google-signin-cookiepolicy" content="single_host_origin" />
<?php } ?>

<?php if(is_single() && !is_singular('property') && have_posts()) { 
    $fb_post_id = get_the_ID();
    $fb_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $fb_post_id ), 'single-post-thumbnail' );
    $fb_post_excerpt = reales_get_excerpt_by_id($fb_post_id);
    $fb_post_title = get_the_title(); ?>
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:title" content="<?php echo esc_attr($fb_post_title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($fb_post_excerpt); ?>" />
    <meta property="og:image" content="<?php echo esc_url($fb_post_image[0]); ?>" />
<?php } else if(is_singular('property') && have_posts()) {
    $fb_post_id = get_the_ID();
    $fb_post_title = get_the_title();
    $fb_gallery = get_post_meta($fb_post_id, 'property_gallery', true);
    $fb_images = explode("~~~", $fb_gallery);
    ?>
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:title" content="<?php echo esc_attr($fb_post_title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($fb_post_title); ?>" />
    <meta property="og:image" content="<?php echo esc_url($fb_images[1]); ?>" />
<?php } else { 
    $bloginfo = get_bloginfo('description');
    ?>
    <meta property="og:description" content="<?php echo esc_attr($bloginfo); ?>" />
<?php } 

?>