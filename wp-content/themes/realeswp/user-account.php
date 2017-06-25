<?php
/*
Template Name: User Account
*/

/**
 * @package WordPress
 * @subpackage Reales
 */

global $current_user;
$current_user = wp_get_current_user();
if (!is_user_logged_in()) {
    wp_redirect(home_url());
}
$user_account_link = reales_get_user_account_link();
global $agent_id;
$agent_id = reales_get_agent_by_userid($current_user->ID);

/**
 * Check PayPal Memberhip Plans Payment
 */

if(isset($_GET['token'])) {
    $token = sanitize_text_field($_GET['token']);

    $save_data = get_option('paypal_plan_transfer');
    $payment_execute_url = $save_data[$current_user->ID]['paypal_execute'];
    $token = $save_data[$current_user->ID ]['paypal_token'];
    $plan_id = $save_data[$current_user->ID ]['plan_id'];

    if(isset($_GET['PayerID'])) {
        $payerId = sanitize_text_field($_GET['PayerID']);

        $payment_execute = array(
            'payer_id' => $payerId
        );

        $json = json_encode($payment_execute);
        $json_resp = reales_make_post_call($payment_execute_url, $json, $token);

        $save_data[$current_user->ID ] = array();
        update_option('paypal_plan_transfer', $save_data);

        if($json_resp['state'] == 'approved') {
            reales_update_agent_membership($agent_id, $plan_id);
            wp_redirect($user_account_link);
        }
    }
}

global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$reales_auth_settings       = get_option('reales_auth_settings','');
$sidebar_position           = isset($reales_appearance_settings['reales_sidebar_field']) ? $reales_appearance_settings['reales_sidebar_field'] : '';
$show_bc                    = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
$register_as_agent          = isset($reales_auth_settings['reales_register_agent_field']) ? $reales_auth_settings['reales_register_agent_field'] : false;

$user_meta      = get_user_meta($current_user->ID);
$up_email       = $current_user->user_email;
$up_nickname    = $user_meta['nickname'];
$up_first_name  = $user_meta['first_name'];
$up_last_name   = $user_meta['last_name'];
$avatar_default = get_template_directory_uri().'/images/avatar.png';
$up_avatar      = isset($user_meta['avatar']) ? $user_meta['avatar'] : $avatar_default;

if($agent_id && $agent_id != '') {
    $agent          = get_post($agent_id);
    $agent_about    = $agent->post_content;
    $agent_specs    = get_post_meta($agent_id, 'agent_specs', true);
    $agent_agency   = get_post_meta($agent_id, 'agent_agency', true);
    $agent_phone    = get_post_meta($agent_id, 'agent_phone', true);
    $agent_mobile   = get_post_meta($agent_id, 'agent_mobile', true);
    $agent_skype    = get_post_meta($agent_id, 'agent_skype', true);
    $agent_facebook = get_post_meta($agent_id, 'agent_facebook', true);
    $agent_twitter  = get_post_meta($agent_id, 'agent_twitter', true);
    $agent_google   = get_post_meta($agent_id, 'agent_google', true);
    $agent_linkedin = get_post_meta($agent_id, 'agent_linkedin', true);
    $agent_payment  = get_post_meta($agent_id, 'agent_payment', true);
}

?>

<div id="" class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <?php while(have_posts()) : the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php if($show_bc != '') {
                            reales_breadcrumbs();
                        } ?>
                        <h2 class="pageHeader"><?php esc_html_e('Manage Profile Information and Password', 'reales'); ?></h2>

                        <form class="profileForm">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="up_first_name"><?php esc_html_e('First Name', 'reales'); ?> <span class="text-red">*</span></label>
                                        <input type="text" id="up_first_name" name="up_first_name" placeholder="<?php esc_html_e('Enter your first name', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($up_first_name[0]); ?>">
                                    </div>
                                 </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="up_last_name"><?php esc_html_e('Last Name', 'reales'); ?> <span class="text-red">*</span></label>
                                        <input type="text" id="up_last_name" name="up_last_name" placeholder="<?php esc_html_e('Enter your last name', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($up_last_name[0]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="up_nickname"><?php esc_html_e('Nickname', 'reales'); ?> <span class="text-red">*</span></label>
                                        <input type="text" id="up_nickname" name="up_nickname" placeholder="<?php esc_html_e('Enter your nickname', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($up_nickname[0]); ?>">
                                    </div>
                                 </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="up_email"><?php esc_html_e('E-mail', 'reales'); ?> <span class="text-red">*</span></label>
                                        <input type="text" id="up_email" name="up_email" placeholder="<?php esc_html_e('Enter your e-mail address', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($up_email); ?>">
                                    </div>
                                </div>
                            </div>

                            <?php get_template_part('templates/avatar_upload'); ?>
                            <input type="hidden" name="up_avatar" id="up_avatar" value="<?php if(isset($user_meta['avatar'])) { echo esc_url($up_avatar[0]); } else { echo esc_url($avatar_default); } ?>">

                            <div class="row pb20">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="up_password"><?php esc_html_e('New Password', 'reales'); ?></label>
                                        <input type="password" id="up_password" name="up_password" placeholder="<?php esc_html_e('Enter your new password', 'reales'); ?>" class="form-control">
                                    </div>
                                 </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="up_re_password"><?php esc_html_e('Repeat New Password', 'reales'); ?></label>
                                        <input type="password" id="up_re_password" name="up_re_password" placeholder="<?php esc_html_e('Repeat your new password', 'reales'); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <?php if($agent_id && $agent_id != '') { ?>
                                <h2 class="pageHeader"><?php esc_html_e('Manage Agent Profile Information', 'reales'); ?></h2>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group agentEditor" id="isDesc">
                                            <label for="agent_about"><?php esc_html_e('About', 'reales'); ?></label>
                                            <?php 
                                            $html_content = isset($agent_about) ? $agent_about : '';
                                            $settings = array(
                                                'teeny' => true
                                            );
                                            wp_editor($html_content, 'agent_about', $settings);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="agent_agency"><?php esc_html_e('Agency', 'reales'); ?></label>
                                            <input type="text" id="agent_agency" name="agent_agency" placeholder="<?php esc_html_e('Enter the agency name', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_agency); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="agent_specs"><?php esc_html_e('Specialities', 'reales'); ?></label>
                                            <input type="text" id="agent_specs" name="agent_specs" placeholder="<?php esc_html_e('Enter your specialities', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_specs); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="agent_phone"><?php esc_html_e('Phone', 'reales'); ?></label>
                                            <input type="text" id="agent_phone" name="agent_phone" placeholder="<?php esc_html_e('Enter your phone number', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_phone); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="agent_mobile"><?php esc_html_e('Mobile', 'reales'); ?></label>
                                            <input type="text" id="agent_mobile" name="agent_mobile" placeholder="<?php esc_html_e('Enter your mobile number', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_mobile); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="agent_skype"><?php esc_html_e('Skype', 'reales'); ?></label>
                                            <input type="text" id="agent_skype" name="agent_skype" placeholder="<?php esc_html_e('Enter your Skype ID', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_skype); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="agent_facebook"><?php esc_html_e('Facebook', 'reales'); ?></label>
                                            <input type="text" id="agent_facebook" name="agent_facebook" placeholder="<?php esc_html_e('Enter your Facebook profile URL', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_facebook); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="agent_twitter"><?php esc_html_e('Twitter', 'reales'); ?></label>
                                            <input type="text" id="agent_twitter" name="agent_twitter" placeholder="<?php esc_html_e('Enter your Twitter profile URL', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_twitter); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="agent_google"><?php esc_html_e('Google+', 'reales'); ?></label>
                                            <input type="text" id="agent_google" name="agent_google" placeholder="<?php esc_html_e('Enter your Google+ profile URL', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_google); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="agent_linkedin"><?php esc_html_e('LinkedIn', 'reales'); ?></label>
                                            <input type="text" id="agent_linkedin" name="agent_linkedin" placeholder="<?php esc_html_e('Enter your LinkedIn profile URL', 'reales'); ?>" class="form-control" value="<?php echo esc_attr($agent_linkedin); ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="agent_id" id="agent_id" value="<?php echo esc_attr($agent_id); ?>">
                            <?php } ?>

                            <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" class="btn btn-green" id="updateProfileBtn"><?php esc_html_e('Update Profile', 'reales'); ?></a>
                                        <?php if($register_as_agent && $agent_id === false) { ?>
                                            <a href="javascript:void(0);" class="btn btn-green btn-o" id="becomeAgentBtn"><?php esc_html_e('Become an Agent', 'reales'); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php wp_nonce_field('user_profile_ajax_nonce', 'securityUserProfile', true); ?>
                        </form>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
            <?php if($agent_id && $agent_id != '') {
                $reales_membership_settings = get_option('reales_membership_settings','');
                $payment_type = isset($reales_membership_settings['reales_paid_field']) ? $reales_membership_settings['reales_paid_field'] : '';
                if($payment_type == 'membership' && $agent_payment != '1') {
                    get_template_part('templates/membership_plans');
                }
            } ?>
        </div>
    </div>
</div>

<div class="modal fade" id="accountModal" role="dialog" aria-labelledby="accountLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div id="up_response"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>