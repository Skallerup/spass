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
                <?php while(have_posts()) : the_post(); 
                    $author = get_the_author();
                    $author_avatar = get_the_author_meta('avatar');
                    if($author_avatar != '') {
                        $author_avatar_src = $author_avatar;
                    } else {
                        $author_avatar_src = get_template_directory_uri().'/images/avatar.png';
                    }
                    $post_date = get_the_date();
                    $post_id = get_the_ID();
                    $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
                    $post_excerpt = get_the_excerpt();
                    ?>

                    <?php if($show_bc != '') {
                        reales_breadcrumbs();
                    } ?>

                    <div class="post-top">
                        <div class="post-author">
                            <img src="<?php echo esc_url($author_avatar_src); ?>" alt="<?php echo esc_attr($author); ?>">
                            <div class="pa-user">
                                <div class="pa-name"><?php echo esc_html($author); ?></div>
                                <div class="pa-title"><?php echo esc_html($post_date); ?></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="post-share">
                            <div class="ps-social">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" title="<?php esc_html_e('Share on Facebook', 'reales'); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-facebook">
                                    <span class="fa fa-facebook"></span>
                                </a>
                                <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" title="<?php esc_html_e('Share on Twitter', 'reales'); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-twitter">
                                    <span class="fa fa-twitter"></span>
                                </a>
                                <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=480');return false;"
                                    target="_blank" title="<?php esc_html_e('Share on Google+', 'reales'); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-google">
                                    <span class="fa fa-google-plus"></span>
                                </a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                    target="_blank" title="<?php esc_html_e('Share on LinkedIn', 'reales'); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-linkedin">
                                    <span class="fa fa-linkedin"></span>
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

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

                    <?php $prev_post = get_previous_post();
                    $next_post = get_next_post(); ?>

                    <div class="f-pn-articles">
                        <a href="<?php if (!empty( $prev_post )): echo esc_url(get_permalink( $prev_post->ID )); endif; ?>" class="f-p-article">
                            <?php if (!empty( $prev_post )): ?>
                            <div class="fpna-title"><?php esc_html_e('Previous article', 'reales') ?></div>
                            <span class="fpna-header"><?php echo esc_html($prev_post->post_title); ?></span>
                            <span class="fa fa-angle-left pull-left pn-icon"></span>
                            <?php endif; ?>
                        </a>
                        <a href="<?php if (!empty( $next_post )): echo esc_url(get_permalink( $next_post->ID )); endif; ?>" class="f-n-article">
                            <?php if (!empty( $next_post )): ?>
                            <div class="fpna-title"><?php esc_html_e('Next article', 'reales') ?></div>
                            <span class="fpna-header"><?php echo esc_html($next_post->post_title); ?></span>
                            <span class="fa fa-angle-right pull-right pn-icon"></span>
                            <?php endif; ?>
                        </a>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                        $related = isset($reales_appearance_settings['reales_related_field']) ? $reales_appearance_settings['reales_related_field'] : false;
                        if($related) {
                            get_template_part('templates/related_posts');
                        }
                    ?>

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