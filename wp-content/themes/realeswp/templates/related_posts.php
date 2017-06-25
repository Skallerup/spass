<?php
/**
 * @package WordPress
 * @subpackage Reales
 */
?>

<h2><?php esc_html_e('Related Articles', 'reales'); ?></h2>
<div class="row">
<?php
$orig_post = $post;
$tags = wp_get_post_tags($post->ID);

    if ($tags) {
        $tag_ids = array();
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
        $args = array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3,
            'ignore_sticky_posts' => false
        );

        $my_query = new wp_query($args);

        while( $my_query->have_posts() ) {
            $my_query->the_post();
            $r_id = get_the_ID();
            $r_link = get_permalink($r_id);
            $r_title = get_the_title($r_id);
            $r_image = wp_get_attachment_image_src( get_post_thumbnail_id( $r_id ), 'single-post-thumbnail' );
            $r_excerpt = get_the_excerpt();
            $r_author = get_the_author();
            $r_date = get_the_date();
?>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="article bg-w">
                    <a href="<?php echo esc_url($r_link); ?>" class="image">
                        <div class="img" style="background-image: url(<?php echo esc_url($r_image[0]); ?>);"></div>
                    </a>
                    <div class="article-category">
                        <?php
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if($categories) {
                            foreach($categories as $category) {
                                $output .= '<a class="text-green" href="' . esc_url(get_category_link( $category->term_id )) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'reales' ), $category->name ) ) . '">' . esc_html($category->cat_name) . '</a>' . esc_html($separator);
                            }
                            echo trim($output, $separator);
                        }
                        ?>
                    </div>
                    <h3><a href="<?php echo esc_url($r_link); ?>"><?php echo esc_html($r_title); ?></a></h3>
                    <div class="footer"><?php echo esc_html($r_author); ?>, <?php echo esc_html($r_date); ?></div>
                </div>
            </div>
<?php }
}
$post = $orig_post;
wp_reset_query();
?>
</div>
