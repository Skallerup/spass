<?php
/**
 * Register membership custom post type
 */

if( !function_exists('reales_register_membership_type_init') ): 
    function reales_register_membership_type_init() {
        wp_enqueue_style('reales_plugin_style', PLUGIN_PATH . 'css/style.css', false, '1.0', 'all');
    }
endif;
add_action('init', 'reales_register_membership_type_init');

if( !function_exists('reales_register_membership_type') ): 
    function reales_register_membership_type() {
        register_post_type('membership', array(
            'labels' => array(
                'name'                  => __('Membership Plans','reales'),
                'singular_name'         => __('Membership Plan','reales'),
                'add_new'               => __('Add New Membership Plan','reales'),
                'add_new_item'          => __('Add Membership Plan','reales'),
                'edit'                  => __('Edit','reales'),
                'edit_item'             => __('Edit Membership Plan','reales'),
                'new_item'              => __('New Membership Plan','reales'),
                'view'                  => __('View','reales'),
                'view_item'             => __('View Membership Plan','reales'),
                'search_items'          => __('Search Membership Plans','reales'),
                'not_found'             => __('No Membership Plans found','reales'),
                'not_found_in_trash'    => __('No Membership Plans found in Trash','reales'),
                'parent'                => __('Parent Membership Plan', 'reales'),
            ),
            'public'                => true,
            'exclude_from_search '  => true,
            'has_archive'           => true,
            // 'rewrite'               => array('slug' => 'membership_plans'),
            'rewrite'               => array('slug' => _x('membership_plans', 'URL SLUG', 'reales')),
            'supports'              => array('title'),
            'can_export'            => true,
            'register_meta_box_cb'  => 'reales_add_membership_metaboxes',
            'menu_icon'             => PLUGIN_PATH . '/images/packages-icon.png'
        ));
    }
endif;
add_action('init', 'reales_register_membership_type');

/**
 * Add membership post type metaboxes
 */
if( !function_exists('reales_add_membership_metaboxes') ): 
    function reales_add_membership_metaboxes() {
        add_meta_box('membership-plan-features-section', __('Membership Plan Features', 'reales'), 'reales_membership_plan_features_render', 'membership', 'normal', 'default');
    }
endif;

if( !function_exists('reales_membership_plan_features_render') ): 
    function reales_membership_plan_features_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'membership_noncename');

        $selected_unit = get_post_meta($post->ID, 'membership_billing_time_unit', true);
        $reales_membership_settings = get_option('reales_membership_settings');
        $currency = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="membership_period">' . __('Membership Plan Period', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="membership_period" name="membership_period" placeholder="' . __('Enter number of...', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'membership_period', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="membership_billing_time_unit">&nbsp;</label><br />
                            <select id="membership_billing_time_unit" name="membership_billing_time_unit">
                                <option value="day" ';
                                selected( $selected_unit, 'day' );
                                print '>' . __('Days', 'reales') . '</option>
                                <option value="week" ';
                                selected( $selected_unit, 'week' );
                                print '>' . __('Weeks', 'reales') . '</option>
                                <option value="month" ';
                                selected( $selected_unit, 'month' );
                                print '>' . __('Months', 'reales') . '</option>
                                <option value="year" ';
                                selected( $selected_unit, 'year' );
                                print '>' . __('Years', 'reales') . '</option>
                            </select>
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="membership_submissions_no">' . __('Number of Submissions', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="membership_submissions_no" name="membership_submissions_no" placeholder="' . __('Enter the number of submissions', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'membership_submissions_no', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <p class="meta-options" style="padding-top: 15px;"> 
                            <input type="hidden" name="membership_unlim_submissions" value="">
                            <input type="checkbox" name="membership_unlim_submissions" value="1" ';
                            if (get_post_meta($post->ID, 'membership_unlim_submissions', true) == 1) {
                                print ' checked ';
                            }
                            print ' />
                            <label for="membership_unlim_submissions">' . __('Unlimited Submissions', 'reales') . '</label>
                        </p>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="membership_featured_submissions_no">' . __('Number of Featured Submissions', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="membership_featured_submissions_no" name="membership_featured_submissions_no" placeholder="' . __('Enter the number of featured submissions', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'membership_featured_submissions_no', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="membership_plan_price">' . __('Plan Price', 'reales') . ' (' . esc_html($currency) . ')</label><br />
                            <input type="text" class="formInput" id="membership_plan_price" name="membership_plan_price" placeholder="' . __('Enter the plan price', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'membership_plan_price', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <p class="meta-options" style="padding-top: 15px;"> 
                            <input type="hidden" name="membership_free_plan" value="">
                            <input type="checkbox" name="membership_free_plan" value="1" ';
                            if (get_post_meta($post->ID, 'membership_free_plan', true) == 1) {
                                print ' checked ';
                            }
                            print ' />
                            <label for="membership_free_plan">' . __('Free Plan', 'reales') . '</label>
                        </p>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_membership_meta_save') ): 
    function reales_membership_meta_save($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['membership_noncename']) && wp_verify_nonce($_POST['membership_noncename'], PLUGIN_BASENAME)) ? 'true' : 'false';

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        if(isset($_POST['membership_billing_time_unit'])) {
            update_post_meta($post_id, 'membership_billing_time_unit', sanitize_text_field($_POST['membership_billing_time_unit']));
        }
        if(isset($_POST['membership_period'])) {
            update_post_meta($post_id, 'membership_period', sanitize_text_field($_POST['membership_period']));
        }
        if(isset($_POST['membership_submissions_no'])) {
            update_post_meta($post_id, 'membership_submissions_no', sanitize_text_field($_POST['membership_submissions_no']));
        }
        if(isset($_POST['membership_unlim_submissions'])) {
            update_post_meta($post_id, 'membership_unlim_submissions', sanitize_text_field($_POST['membership_unlim_submissions']));
        }
        if(isset($_POST['membership_featured_submissions_no'])) {
            update_post_meta($post_id, 'membership_featured_submissions_no', sanitize_text_field($_POST['membership_featured_submissions_no']));
        }
        if(isset($_POST['membership_plan_price'])) {
            update_post_meta($post_id, 'membership_plan_price', sanitize_text_field($_POST['membership_plan_price']));
        }
        if(isset($_POST['membership_free_plan'])) {
            update_post_meta($post_id, 'membership_free_plan', sanitize_text_field($_POST['membership_free_plan']));
        }
    }
endif;
add_action('save_post', 'reales_membership_meta_save');

if( !function_exists('reales_change_membership_default_title') ): 
    function reales_change_membership_default_title($title){
        $screen = get_current_screen();
        if ('membership' == $screen->post_type) {
            $title = __('Enter membership plan title here', 'reales');
        }
        return $title;
    }
endif;
add_filter('enter_title_here', 'reales_change_membership_default_title');
?>