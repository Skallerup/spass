<?php
/**
 * Register agent custom post type
 */
if( !function_exists('reales_register_agent_type_init') ): 
    function reales_register_agent_type_init() {
        wp_enqueue_style('reales_plugin_style', PLUGIN_PATH . '/css/style.css', false, '1.0', 'all');
        wp_enqueue_script('agent', PLUGIN_PATH . '/js/agent.js', false, '1.0', true);

        wp_localize_script('agent', 'agent_vars', 
            array('admin_url' => get_admin_url(),
                  'theme_url' => get_template_directory_uri(),
                  'browse_text' => __('Browse...', 'reales')
            )
        );
    }
endif;
add_action('init', 'reales_register_agent_type_init');

if( !function_exists('reales_register_agent_type') ): 
    function reales_register_agent_type() {
        register_post_type('agent', array(
            'labels' => array(
                'name'                  => __('Agents','reales'),
                'singular_name'         => __('Agent','reales'),
                'add_new'               => __('Add New Agent','reales'),
                'add_new_item'          => __('Add Agent','reales'),
                'edit'                  => __('Edit','reales'),
                'edit_item'             => __('Edit Agent','reales'),
                'new_item'              => __('New Agent','reales'),
                'view'                  => __('View','reales'),
                'view_item'             => __('View Agent','reales'),
                'search_items'          => __('Search Agents','reales'),
                'not_found'             => __('No Agents found','reales'),
                'not_found_in_trash'    => __('No Agents found in Trash','reales'),
                'parent'                => __('Parent Agent', 'reales'),
            ),
            'public'                => true,
            'exclude_from_search '  => true,
            'has_archive'           => true,
            // 'rewrite'               => array('slug' => 'agents'),
            'rewrite'               => array('slug' => _x('agents', 'URL SLUG', 'reales')),
            'supports'              => array('title', 'editor', 'thumbnail', 'comments'),
            'can_export'            => true,
            'register_meta_box_cb'  => 'reales_add_agent_metaboxes',
            'menu_icon'             => PLUGIN_PATH . '/images/agent-icon.png'
        ));
    }
endif;
add_action('init', 'reales_register_agent_type');

function reales_add_agent_metaboxes() {
    add_meta_box('agent-details-section', __('Details', 'reales'), 'reales_agent_details_render', 'agent', 'normal', 'default');
    add_meta_box('agent-payment-section', __('Membership and Payment', 'reales'), 'reales_agent_payment_render', 'agent', 'normal', 'default');
    add_meta_box('agent-avatar-section', __('Avatar', 'reales'), 'reales_agent_avatar_render', 'agent', 'normal', 'default');
    add_meta_box('agent-user-section', __('User', 'reales'), 'reales_agent_user_render', 'agent', 'normal', 'default');
    add_meta_box('agent-featured-section', __('Featured', 'reales'), 'reales_agent_featured_render', 'agent', 'side', 'default');
}

if( !function_exists('reales_agent_details_render') ): 
    function reales_agent_details_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'agent_noncename');

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_agency">' . __('Agency', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_agency" name="agent_agency" placeholder="' . __('Enter the agency name', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_agency', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_specs">' . __('Specialities', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_specs" name="agent_specs" placeholder="' . __('Enter specialities', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_specs', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_email">' . __('Email', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_email" name="agent_email" placeholder="' . __('Enter email', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_email', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_phone">' . __('Phone', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_phone" name="agent_phone" placeholder="' . __('Enter phone', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_phone', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_mobile">' . __('Mobile', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_mobile" name="agent_mobile" placeholder="' . __('Enter phone', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_mobile', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_skype">' . __('Skype', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_skype" name="agent_skype" placeholder="' . __('Enter Skype ID', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_skype', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_facebook">' . __('Facebook', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_facebook" name="agent_facebook" placeholder="' . __('Enter Facebook profile URL', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_facebook', true)) . '" />
                        </div>
                    </td>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_twitter">' . __('Twitter', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_twitter" name="agent_twitter" placeholder="' . __('Enter Twitter profile URL', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_twitter', true)) . '" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_google">' . __('Google+', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_google" name="agent_google" placeholder="' . __('Enter Google+ profile URL', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_google', true)) . '" />
                        </div>
                    </td>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_linkedin">' . __('LinkedIn', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="agent_linkedin" name="agent_linkedin" placeholder="' . __('Enter LinkedIn profile URL', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'agent_linkedin', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_agent_payment_render') ): 
    function reales_agent_payment_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'agent_noncename');

        $reales_membership_settings = get_option('reales_membership_settings');
        $pay_type                   = isset($reales_membership_settings['reales_paid_field']) ? $reales_membership_settings['reales_paid_field'] : '';

        if($pay_type == 'listing' || $pay_type == 'membership') {

            print '<input type="hidden" name="agent_payment" value="">
                   <input type="checkbox" name="agent_payment" value="1" ';
            if (esc_html(get_post_meta($post->ID, 'agent_payment', true)) == 1) {
                print ' checked ';
            }
            print ' /> <label for="agent_payment">' . __('Allow the agent to post properties regardless of payment method', 'reales') . '</label>';
        } else {
            print '<i>' . __('Payment type is disabled.', 'reales') . '</i>';
        }
    }
endif;

if( !function_exists('reales_agent_user_render') ): 
    function reales_agent_user_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'agent_noncename');

        $mypost = $post->ID;
        $originalpost = $post;
        $selected_user = esc_html(get_post_meta($mypost, 'agent_user', true));
        $users_list = '';
        $args = array('role' => '');

        $user_query = new WP_User_Query($args);

        foreach($user_query->results as $user) {
            $users_list .= '<option value="' . $user->ID . '"';
            if ($user->ID == $selected_user) {
                $users_list .= ' selected';
            }
            $users_list .= '>' . $user->user_login . ' - ' . $user->first_name . ' ' . $user->last_name . '</option>';
        }
        wp_reset_query();
        $post = $originalpost;

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="agent_user">' . __('Assign a User', 'reales') . '</label><br />
                            <select id="agent_user" name="agent_user">
                                <option value="">none</option>
                                ' . $users_list . '
                            </select>
                        </div>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_agent_avatar_render') ): 
    function reales_agent_avatar_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'agent_noncename');

        print '
            <input id="agent_avatar" name="agent_avatar" type="text" size="60" value="' . esc_attr(get_post_meta($post->ID, 'agent_avatar', true)) . '" />
            <input id="agentAvatarBtn" type="button"  class="button" value="' . __('Browse...','reales') . '" />';
    }
endif;

if( !function_exists('reales_agent_featured_render') ): 
    function reales_agent_featured_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'agent_noncename');

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" valign="top" align="left">
                        <p class="meta-options">
                            <input type="hidden" name="agent_featured" value="">
                            <input type="checkbox" name="agent_featured" value="1" ';
                            if (esc_html(get_post_meta($post->ID, 'agent_featured', true)) == 1) {
                                print ' checked ';
                            }
                            print ' />
                            <label for="agent_featured">' . __('Set as Featured', 'reales') . '</label>
                        </p>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_agent_meta_save') ): 
    function reales_agent_meta_save($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['agent_noncename']) && wp_verify_nonce($_POST['agent_noncename'], PLUGIN_BASENAME)) ? 'true' : 'false';

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        if(isset($_POST['agent_agency'])) {
            update_post_meta($post_id, 'agent_agency', sanitize_text_field($_POST['agent_agency']));
        }
        if(isset($_POST['agent_specs'])) {
            update_post_meta($post_id, 'agent_specs', sanitize_text_field($_POST['agent_specs']));
        }
        if(isset($_POST['agent_email'])) {
            update_post_meta($post_id, 'agent_email', sanitize_text_field($_POST['agent_email']));
        }
        if(isset($_POST['agent_phone'])) {
            update_post_meta($post_id, 'agent_phone', sanitize_text_field($_POST['agent_phone']));
        }
        if(isset($_POST['agent_mobile'])) {
            update_post_meta($post_id, 'agent_mobile', sanitize_text_field($_POST['agent_mobile']));
        }
        if(isset($_POST['agent_skype'])) {
            update_post_meta($post_id, 'agent_skype', sanitize_text_field($_POST['agent_skype']));
        }
        if(isset($_POST['agent_facebook'])) {
            update_post_meta($post_id, 'agent_facebook', sanitize_text_field($_POST['agent_facebook']));
        }
        if(isset($_POST['agent_twitter'])) {
            update_post_meta($post_id, 'agent_twitter', sanitize_text_field($_POST['agent_twitter']));
        }
        if(isset($_POST['agent_google'])) {
            update_post_meta($post_id, 'agent_google', sanitize_text_field($_POST['agent_google']));
        }
        if(isset($_POST['agent_linkedin'])) {
            update_post_meta($post_id, 'agent_linkedin', sanitize_text_field($_POST['agent_linkedin']));
        }
        if(isset($_POST['agent_user'])) {
            update_post_meta($post_id, 'agent_user', sanitize_text_field($_POST['agent_user']));
        }
        if(isset($_POST['agent_avatar'])) {
            update_post_meta($post_id, 'agent_avatar', sanitize_text_field($_POST['agent_avatar']));
        }
        if(isset($_POST['agent_featured'])) {
            update_post_meta($post_id, 'agent_featured', sanitize_text_field($_POST['agent_featured']));
        }
        if(isset($_POST['agent_payment'])) {
            update_post_meta($post_id, 'agent_payment', sanitize_text_field($_POST['agent_payment']));
        }
    }
endif;
add_action('save_post', 'reales_agent_meta_save');

if( !function_exists('reales_change_agent_default_title') ): 
    function reales_change_agent_default_title($title) {
        $screen = get_current_screen();
        if ('agent' == $screen->post_type) {
            $title = __('Enter agent name here', 'reales');
        }
        return $title;
    }
endif;
add_filter('enter_title_here', 'reales_change_agent_default_title');
?>