<?php
/**
 * Featured blog posts shortcode
 */
if( !function_exists('reales_featured_posts_shortcode') ): 
    function reales_featured_posts_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Featured Listed Properties'
        ), $attrs));

        if(isset($attrs['show']) && is_numeric($attrs['show'])) {
            $show = $attrs['show'];
        } else {
            $show = '4';
        }

        $args = array(
            'numberposts'      => $show,
            'post_type'        => 'post',
            'orderby'          => 'post_date',
            'meta_key'         => 'post_featured',
            'meta_value'       => '1',
            'order'            => 'DESC',
            'suppress_filters' => false,
            'post_status'      => 'publish');
        $posts = wp_get_recent_posts($args, OBJECT);

        $return_string = '';

        if($posts) {
            $return_string .= '<h2 class="centered osLight">' . esc_html($title) . '</h2>';
            $return_string .= '<div class="row pb40">';

            foreach($posts as $post) : 
                if(intval($show) % 3 == 0) {
                    $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
                } else {
                    $return_string .= '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
                }
                $return_string .= '<div class="article bg-w">';

                $post_link = get_permalink($post->ID);
                $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

                $return_string .= '<a href="' . esc_url($post_link) . '" class="image">';
                $return_string .= '<div class="img" style="background-image: url(' . esc_url($post_image[0]) . ')"></div>';
                $return_string .= '</a>';
                $return_string .= '<div class="article-category">';

                $categories = get_the_category($post->ID);
                $separator = ' ';
                $output = '';
                if($categories) {
                    foreach($categories as $category) {
                        $output .= '<a class="text-green" href="' . esc_url(get_category_link( $category->term_id )) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'reales' ), $category->name ) ) . '">' . esc_html($category->cat_name) . '</a>' . esc_html($separator);
                    }
                    $return_string .= trim($output, $separator);
                }

                $return_string .= '</div>';
                $return_string .= '<h3><a href="' . esc_url($post_link) . '">' . esc_html($post->post_title) . '</a></h3>';

                $post_author = get_the_author_meta( 'display_name' , $post->post_author );
                $post_date = get_the_date('F j, Y',$post->ID);

                $return_string .= '<div class="footer">' . esc_html($post_author) . ', ' . esc_html($post_date) . '</div>';
                $return_string .= '</div>';
                $return_string .= '</div>';
            endforeach;

            $return_string .= '</div>';
        }

        

        wp_reset_postdata();
        wp_reset_query();
        return $return_string;
    }
endif;
?>