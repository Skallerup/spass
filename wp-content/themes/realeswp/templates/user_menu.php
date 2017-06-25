<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

global $current_user;
$current_user = wp_get_current_user();
$user_avatar = get_the_author_meta('avatar' , $current_user->ID);
$username = get_the_author_meta('display_name' , $current_user->ID);
$reales_auth_settings = get_option('reales_auth_settings','');
$fb_login = isset($reales_auth_settings['reales_fb_login_field']) ? $reales_auth_settings['reales_fb_login_field'] : false;
$fb_app_id = isset($reales_auth_settings['reales_fb_id_field']) ? $reales_auth_settings['reales_fb_id_field'] : '';
$google_login = isset($reales_auth_settings['reales_google_login_field']) ? $reales_auth_settings['reales_google_login_field'] : false;
$google_client_id = isset($reales_auth_settings['reales_google_id_field']) ? $reales_auth_settings['reales_google_id_field'] : '';
$google_client_secret = isset($reales_auth_settings['reales_google_secret_field']) ? $reales_auth_settings['reales_google_secret_field'] : '';
$register_as_agent = isset($reales_auth_settings['reales_register_agent_field']) ? $reales_auth_settings['reales_register_agent_field'] : false;
$terms = isset($reales_auth_settings['reales_terms_field']) ? $reales_auth_settings['reales_terms_field'] : false;

if($user_avatar != '') {
    $avatar = $user_avatar;
} else {
    $avatar = get_template_directory_uri().'/images/avatar.png';
}
?>

<?php if(is_user_logged_in()) { ?>
<div class="topUserWraper">
    <a href="#" class="userHandler dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span></a>
    <a href="#" class="topUser dropdown-toggle hidden-xs" data-toggle="dropdown">
        <div class="headerAvatar pull-left">
            <img class="" src="<?php echo esc_url($avatar); ?>" alt="avatar">
        </div>
        <div class="userTop pull-left">
            <span class="headerUserName"><?php echo esc_html($username); ?></span>&nbsp;&nbsp;<span class="fa fa-angle-down"></span>
        </div>
        <div class="clearfix"></div>
    </a>
    <div class="dropdown-menu userMenu" role="menu">
        <div class="mobAvatar">
            <div class="mobHeaderAvatar">
                <img src="<?php echo esc_url($avatar); ?>" alt="avatar">
            </div>
            <div class="mobAvatarName"><?php echo esc_html($username); ?></div>
        </div>
        <ul>
            <?php 
            if(reales_check_user_agent($current_user->ID) === true) { 
                $args = array(
                    'post_type' => 'page',
                    'post_status' => 'publish',
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'submit-property.php'
                );

                $query = new WP_Query($args);

                while($query->have_posts()) {
                    $query->the_post();
                    $page_id = get_the_ID();
                    $page_link = get_permalink($page_id);
                }
                wp_reset_postdata();
                wp_reset_query();
            ?>
            <li><a href="<?php echo esc_url($page_link); ?>"><span class="icon-plus"></span> <?php esc_html_e('Submit New Property', 'reales'); ?></a></li>
            <?php
                $args = array(
                    'post_type' => 'page',
                    'post_status' => 'publish',
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'my-properties.php'
                );

                $query = new WP_Query($args);

                while($query->have_posts()) {
                    $query->the_post();
                    $page_id = get_the_ID();
                    $page_link = get_permalink($page_id);
                }
                wp_reset_postdata();
                wp_reset_query();
            ?>
            <li><a href="<?php echo esc_url($page_link); ?>"><span class="icon-folder"></span> <?php esc_html_e('My Properties', 'reales'); ?></a></li>
            <?php } ?>
            <?php
            $args = array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'meta_key' => '_wp_page_template',
                'meta_value' => 'favourite-properties.php'
            );

            $query = new WP_Query($args);

            while($query->have_posts()) {
                $query->the_post();
                $page_id = get_the_ID();
                $page_link = get_permalink($page_id);
            }
            wp_reset_postdata();
            wp_reset_query();
            ?>
            <li><a href="<?php echo esc_url($page_link); ?>"><span class="fa fa-heart-o"></span> <?php esc_html_e('Favourite Properties', 'reales'); ?></a></li>
            <li><a href="#" data-toggle="modal" data-target="#searches-modal"><span class="icon-grid"></span> <?php esc_html_e('My Searches', 'reales'); ?></a></li>
            <?php
            $args = array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'meta_key' => '_wp_page_template',
                'meta_value' => 'user-account.php'
            );

            $query = new WP_Query($args);

            while($query->have_posts()) {
                $query->the_post();
                $page_id = get_the_ID();
                $page_link = get_permalink($page_id);
            }
            wp_reset_postdata();
            wp_reset_query();
            ?>
            <li><a href="<?php echo esc_url($page_link); ?>"><span class="icon-user"></span> <?php esc_html_e('Account Settings', 'reales'); ?></a></li>
            <li><a href="<?php echo wp_logout_url(home_url()); ?>"><span class="icon-power"></span> <?php esc_html_e('Logout', 'reales'); ?></a></li>
        </ul>
    </div>
</div>
<?php } else { ?>
<div class="topUserWraper">
    <a href="#" class="userNavHandler"><span class="icon-user"></span></a>
    <div class="user-nav">
        <ul>
            <li><a href="#" data-toggle="modal" data-target="#signup"><?php _e('Sign Up', 'reales') ?></a></li>
            <li><a href="#" data-toggle="modal" data-target="#signin"><?php _e('Sign In', 'reales') ?></a></li>
        </ul>
    </div>
</div>
<?php } ?>

<div class="modal fade" id="signin" role="dialog" aria-labelledby="signinLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="signinLabel"><?php _e('Sign In', 'reales') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="userLoginForm" method="post">
                    <div class="signinMessage" id="signinMessage"></div>
                    <?php if($fb_login) { ?>
                    <div id="fb-root"></div>
                    <script>
                        window.fbAsyncInit = function() {
                            FB.init({
                                appId      : <?php echo esc_js($fb_app_id); ?>,
                                status     : true,
                                cookie     : true,
                                xfbml      : true,
                                version    : 'v2.1'
                            });
                        };
                        (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>
                    <div class="form-group">
                        <div class="btn-group-justified">
                            <a href="#" class="btn btn-lg btn-facebook" id="fbLoginBtn"><span class="fa fa-facebook pull-left"></span><span class="signinFBText"><?php _e('Sign In with Facebook', 'reales') ?></span></a>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($google_login) { ?>
                    <div class="form-group">
                        <div class="btn-group-justified">
                            <a href="#" class="btn btn-lg btn-google" id="googleSigninBtn"><span class="fa fa-google-plus pull-left"></span><span class="signinGText"><?php _e('Sign In with Google', 'reales') ?></span></a>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($fb_login || $google_login) { ?>
                    <div class="signOr"><?php _e('OR', 'reales') ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <input type="text" name="usernameSignin" id="usernameSignin" placeholder="<?php _e('Username', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordSignin" id="passwordSignin" placeholder="<?php _e('Password', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="checkbox custom-checkbox"><label><input type="checkbox" id="rememberSignin" name="rememberme" value="forever"><span class="fa fa-check"></span> <?php _e('Remember me', 'reales') ?></label></div>
                            </div>
                            <div class="col-xs-6 align-right">
                                <p class="help-block"><a href="#" class="text-green forgotPass"><?php _e('Forgot password?', 'reales') ?></a></p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="signinRedirect" id="signinRedirect" value="">
                    <?php wp_nonce_field('signin_ajax_nonce', 'securitySignin', true); ?>
                    <div class="form-group">
                        <div class="btn-group-justified">
                            <a href="#" class="btn btn-lg btn-green" id="submitSignin"><?php _e('Sign In', 'reales') ?></a>
                        </div>
                    </div>
                    <p class="help-block"><?php _e('Don\'t have an account?', 'reales') ?> <a href="#" class="modal-su text-green"><?php _e('Sign Up', 'reales') ?></a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signup" role="dialog" aria-labelledby="signupLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="signupLabel"><?php _e('Sign Up', 'reales') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="userSignupForm" method="post">
                    <div class="signinMessage" id="signupMessage"></div>
                    <?php if($register_as_agent) { ?>
                    <div class="form-group">
                        <div class="checkbox custom-checkbox"><label><input type="checkbox" id="register_as_agent" name="register_as_agent" value="1"><span class="fa fa-check"></span> <?php _e('Register me as agent', 'reales') ?></label></div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <input type="text" name="usernameSignup" id="usernameSignup" placeholder="<?php _e('Username', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstnameSignup" id="firstnameSignup" placeholder="<?php _e('First Name', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastnameSignup" id="lastnameSignup" placeholder="<?php _e('Last Name', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="emailSignup" id="emailSignup" placeholder="<?php _e('Email Address', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass1Signup" id="pass1Signup" placeholder="<?php _e('Password', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass2Signup" id="pass2Signup" placeholder="<?php _e('Confirm Password', 'reales') ?>" class="form-control">
                    </div>
                    <?php if($terms && $terms != '') { ?>
                        <div class="form-group">
                            <div class="checkbox custom-checkbox"><label><input type="checkbox" id="terms" name="terms" value="1"><span class="fa fa-check"></span> <?php printf( __( 'I agree with <a href="%s">Terms and Conditions</a>', 'reales' ), esc_url($terms) ); ?></label></div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <p class="help-block"><a href="#" class="text-green forgotPass"><?php _e('Forgot password?', 'reales') ?></a></p>
                    </div>
                    <?php wp_nonce_field('signup_ajax_nonce', 'securitySignup', true); ?>
                    <div class="form-group">
                        <div class="btn-group-justified">
                            <a class="btn btn-lg btn-green" id="submitSignup"><?php _e('Sign Up', 'reales') ?></a>
                        </div>
                    </div>
                    <p class="help-block"><?php _e('Already a member?', 'reales') ?> <a href="#" class="modal-si text-green"><?php _e('Sign In', 'reales') ?></a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="forgot" role="dialog" aria-labelledby="forgotLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="forgotLabel"><?php _e('Forgot Password', 'reales') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="userForgotPassForm" method="post">
                    <div class="forgotMessage" id="forgotMessage"></div>
                    <div class="form-group forgotField">
                        <input type="text" name="emailForgot" id="emailForgot" placeholder="<?php _e('Username or Email address', 'reales') ?>" class="form-control">
                    </div>
                    <?php wp_nonce_field('forgot_ajax_nonce', 'securityForgot', true); ?>
                    <div class="form-group forgotField">
                        <div class="btn-group-justified">
                            <a href="#" class="btn btn-lg btn-green" id="submitForgot"><?php _e('Get New Password', 'reales') ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resetpass" role="dialog" aria-labelledby="resetpassLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="resetpassLabel"><?php _e('Reset Password', 'reales') ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="userResetPassForm" method="post">
                    <div class="resetPassMessage" id="resetPassMessage"></div>
                    <div class="form-group">
                        <input type="password" name="resetPass_1" id="resetPass_1" placeholder="<?php _e('New Password', 'reales') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="resetPass_2" id="resetPass_2" placeholder="<?php _e('Confirm Password', 'reales') ?>" class="form-control">
                    </div>
                    <p class="help-block"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).', 'reales') ?></p>
                    <?php wp_nonce_field('resetpass_ajax_nonce', 'securityResetpass', true); ?>
                    <div class="form-group">
                        <div class="btn-group-justified">
                            <a href="#" class="btn btn-lg btn-green" id="submitResetPass"><?php _e('Reset Password', 'reales') ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="searches-modal" role="dialog" aria-labelledby="searches-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
                <h4 class="modal-title" id="searches-label"><?php esc_html_e('My Searches', 'reales') ?></h4>
            </div>
            <div class="modal-body"></div>
            <input type="hidden" name="modal-user-id" id="modal-user-id" value="<?php echo esc_attr($current_user->ID); ?>">
            <?php wp_nonce_field('deletesearch_ajax_nonce', 'securityDeleteSearch', true); ?>
            <div class="modal-footer">
                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-gray"><?php esc_html_e('Close', 'reales'); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="propertyModal" role="dialog" aria-labelledby="propertyLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="save_response">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <div class="icon"><span class="fa fa-ban"></span></div>
                        <button type="button" class="close close-modal" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <?php esc_html_e('Agent account needed!', 'reales'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delPropModal" role="dialog" aria-labelledby="dialogLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
                <h4 class="modal-title" id="dialogLabel"><?php echo __('Delete property', 'reales'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __('Are you sure?', 'reales'); ?>
                <input type="hidden" id="del-prop-id" name="del-prop-id">
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-gray"><?php esc_html_e('No', 'reales'); ?></a>
                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-green" id="del-prop-yes"><?php esc_html_e('Yes', 'reales'); ?></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delSinglePropModal" role="dialog" aria-labelledby="dialogSingleLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
                <h4 class="modal-title" id="dialogSingleLabel"><?php echo __('Delete property', 'reales'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo __('Are you sure?', 'reales'); ?>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-gray"><?php esc_html_e('No', 'reales'); ?></a>
                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-green" id="del-single-prop-yes"><?php esc_html_e('Yes', 'reales'); ?></a>
            </div>
        </div>
    </div>
</div>