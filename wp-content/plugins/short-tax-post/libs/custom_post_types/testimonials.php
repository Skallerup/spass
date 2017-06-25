<?php
/**
 * Register testimonials custom post type
 */
if( !function_exists('reales_register_testimonials_type_init') ): 
    function reales_register_testimonials_type_init() {
        wp_enqueue_style('reales_plugin_style', PLUGIN_PATH . '/css/style.css', false, '1.0', 'all');
        wp_enqueue_script('testimonials', PLUGIN_PATH . '/js/testimonials.js', false, '1.0', true);

        wp_localize_script('testimonials', 'testimonials_vars', 
            array('admin_url' => get_admin_url(),
                  'theme_url' => get_template_directory_uri(),
                  'browse_text' => __('Browse...', 'reales')
            )
        );
    }
endif;
add_action('init', 'reales_register_testimonials_type_init');

if( !function_exists('reales_register_testimonials_type') ): 
    function reales_register_testimonials_type() {
        register_post_type('testimonials', array(
            'labels' => array(
                'name'                  => __('Testimonials','reales'),
                'singular_name'         => __('Testimonial','reales'),
                'add_new'               => __('Add New Testimonial','reales'),
                'add_new_item'          => __('Add Testimonial','reales'),
                'edit'                  => __('Edit','reales'),
                'edit_item'             => __('Edit Testimonial','reales'),
                'new_item'              => __('New Testimonial','reales'),
                'view'                  => __('View','reales'),
                'view_item'             => __('View Testimonial','reales'),
                'search_items'          => __('Search Testimonials','reales'),
                'not_found'             => __('No Testimonials found','reales'),
                'not_found_in_trash'    => __('No Testimonials found in Trash','reales'),
                'parent'                => __('Parent Testimonial', 'reales'),
            ),
            'public'                => true,
            'exclude_from_search '  => true,
            'has_archive'           => true,
            // 'rewrite'               => array('slug' => 'testimonials'),
            'rewrite'               => array('slug' => _x('testimonials', 'URL SLUG', 'reales')),
            'supports'              => array('title', 'thumbnail'),
            'can_export'            => true,
            'register_meta_box_cb'  => 'reales_add_testimonials_metaboxes',
            'menu_icon'             => PLUGIN_PATH . '/images/testimonials-icon.png'
        ));
    }
endif;
add_action('init', 'reales_register_testimonials_type');

if( !function_exists('reales_add_testimonials_metaboxes') ): 
    function reales_add_testimonials_metaboxes() {
        add_meta_box('testimonials-text-section', __('What the customer says', 'reales'), 'reales_testimonials_text_render', 'testimonials', 'normal', 'default');
        add_meta_box('testimonials-section', __('Avatar', 'reales'), 'reales_testimonials_avatar_render', 'testimonials', 'normal', 'default');
    }
endif;

if( !function_exists('reales_testimonials_text_render') ): 
    function reales_testimonials_text_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'testimonilas_noncename');

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" valign="top" align="left">
                        <p class="meta-options">
                            <textarea class="agentAbout" id="testimonials_text" name="testimonials_text" placeholder="' . __('Enter what the customer says here', 'reales') . '">' . esc_html(get_post_meta($post->ID, 'testimonials_text', true)) . '</textarea>
                        </p>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_testimonials_avatar_render') ): 
    function reales_testimonials_avatar_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'testimonilas_noncename');

        print '
            <input id="testimonials_avatar" name="testimonials_avatar" type="text" size="60" value="' . esc_attr(get_post_meta($post->ID, 'testimonials_avatar', true)) . '" />
            <input id="testimonialsAvatarBtn" type="button"  class="button" value="' . __('Browse...','reales') . '" />';
    }
endif;

if( !function_exists('reales_testimonials_meta_save') ): 
    function reales_testimonials_meta_save($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['testimonilas_noncename']) && wp_verify_nonce($_POST['testimonilas_noncename'], PLUGIN_BASENAME)) ? 'true' : 'false';

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        if(isset($_POST['testimonials_text'])) {
            update_post_meta($post_id, 'testimonials_text', sanitize_text_field($_POST['testimonials_text']));
        }
        if(isset($_POST['testimonials_avatar'])) {
            update_post_meta($post_id, 'testimonials_avatar', sanitize_text_field($_POST['testimonials_avatar']));
        }
    }
endif;
add_action('save_post', 'reales_testimonials_meta_save');

if( !function_exists('reales_change_testimonials_default_title') ): 
    function reales_change_testimonials_default_title($title) {
        $screen = get_current_screen();
        if ('testimonials' == $screen->post_type) {
            $title = __('Enter customer name here', 'reales');
        }
        return $title;
    }
endif;
add_filter('enter_title_here', 'reales_change_testimonials_default_title');
?>