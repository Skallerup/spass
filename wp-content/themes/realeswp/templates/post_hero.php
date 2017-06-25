<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$page_hero = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$post_title = get_the_title($post->ID);
$prev_post = get_previous_post();
$next_post = get_next_post(); ?>
<div id="carouselBlog" class="carousel slide featured" data-ride="carousel">
    <div class="carousel-inner">
        <div class="item active" style="background-image: url(<?php echo esc_url($page_hero[0]); ?>)">
            <div class="container">
                <div class="carousel-caption">
                    <div class="carousel-title">
                        <?php
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if($categories) {
                            foreach($categories as $category) {
                                $output .= $category->cat_name . $separator;
                            }
                            echo trim($output, $separator);
                        }
                        ?>
                    </div>
                    <div class="caption-title"><?php echo esc_html($post_title); ?></div>
                    <div class="p-n-articles row">
                        <div class="p-article col-xs-6">
                            <?php if (!empty( $prev_post )): ?>
                            <div class="pna-title"><?php esc_html_e('Previous article', 'reales') ?></div>
                            <a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><?php echo esc_html($prev_post->post_title); ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="n-article col-xs-6">
                            <?php if (!empty( $next_post )): ?>
                            <div class="pna-title"><?php esc_html_e('Next article', 'reales') ?></div>
                            <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo esc_html($next_post->post_title); ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>