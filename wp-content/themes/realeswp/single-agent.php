<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$reales_general_settings = get_option('reales_general_settings','');
$show_bc = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
$nomap = isset($reales_appearance_settings['reales_nomap_field']) ? $reales_appearance_settings['reales_nomap_field'] : '';
$sidebar_position = isset($reales_appearance_settings['reales_sidebar_field']) ? $reales_appearance_settings['reales_sidebar_field'] : '';
$show_rating = isset($reales_general_settings['reales_agents_rating_field']) ? $reales_general_settings['reales_agents_rating_field'] : '';
?>

<?php if($nomap != '1') { ?>
<div id="wrapper">
<?php } else { ?>
<div class="agent-no-map">
<?php } ?>

<?php while(have_posts()) : the_post();
    $agent_id = get_the_ID();
    $title = get_the_title();
    $avatar = get_post_meta($agent_id, 'agent_avatar', true);
    if($avatar != '') {
        $avatar_src = $avatar;
    } else {
        $avatar_src = get_template_directory_uri().'/images/avatar.png';
    }
    $phone = get_post_meta($agent_id, 'agent_phone', true);
    $mobile = get_post_meta($agent_id, 'agent_mobile', true);
    $email = get_post_meta($agent_id, 'agent_email', true);
    $skype = get_post_meta($agent_id, 'agent_skype', true);
    $facebook = get_post_meta($agent_id, 'agent_facebook', true);
    $twitter = get_post_meta($agent_id, 'agent_twitter', true);
    $google = get_post_meta($agent_id, 'agent_google', true);
    $linkedin = get_post_meta($agent_id, 'agent_linkedin', true);
    $specs = get_post_meta($agent_id, 'agent_specs', true);
    $agency = get_post_meta($agent_id, 'agent_agency', true);
?>

    <?php if($nomap != '1') { ?>
    <div id="mapAgentView" class="mob-min">
        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
    </div>
    <?php } ?>

    <?php wp_nonce_field('app_map_ajax_nonce', 'securityAppMap', true); ?>

    <?php if($nomap != '1') { ?>
    <div id="content" class="mob-max">
        <?php get_template_part('templates/city_form'); ?>
    <?php } else { ?>
    <div class="page-wrapper no-map">
        <div class="page-content">
    <?php } ?>

        <?php if($nomap == '1') { ?>
            <div class="row">
                <?php if($sidebar_position == 'left') { ?>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <?php } ?>

        <div class="singleTop <?php if($nomap != '1') { echo esc_attr('p20'); }?>">
            <input type="hidden" name="agent_id" id="agent_id" value="<?php echo esc_attr($agent_id); ?>" />

            <?php if($show_bc != '') {
                reales_breadcrumbs();
            } ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">
                    <?php if($nomap != '1') { ?>
                        <h1 class="pageTitle pb20"><?php echo esc_html($title); ?></h1>
                    <?php } ?>
                    <?php if($agency && $agency != '') { ?>
                    <div class="row pb10">
                        <div class="col-xs-4"><span class="contact-icon fa fa-building-o"></span> <strong><?php esc_html_e('Agency', 'reales'); ?></strong></div>
                        <div class="col-xs-8 align-right"><?php echo esc_html($agency); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($phone && $phone != '') { ?>
                    <div class="row pb10">
                        <div class="col-xs-4"><span class="contact-icon fa fa-phone"></span> <strong><?php esc_html_e('Phone', 'reales'); ?></strong></div>
                        <div class="col-xs-8 align-right"><?php echo esc_html($phone); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($mobile && $mobile != '') { ?>
                    <div class="row pb10">
                        <div class="col-xs-4"><span class="contact-icon fa fa-mobile"></span> <strong><?php esc_html_e('Mobile', 'reales'); ?></strong></div>
                        <div class="col-xs-8 align-right"><?php echo esc_html($mobile); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($email && $email != '') { ?>
                    <div class="row pb10">
                        <div class="col-xs-4"><span class="contact-icon fa fa-envelope-o"></span> <strong><?php esc_html_e('Email', 'reales'); ?></strong></div>
                        <div class="col-xs-8 align-right"><?php echo esc_html($email); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($skype && $skype != '') { ?>
                    <div class="row pb10">
                        <div class="col-xs-4"><span class="contact-icon fa fa-skype"></span> <strong><?php esc_html_e('Skype', 'reales'); ?></strong></div>
                        <div class="col-xs-8 align-right"><?php echo esc_html($skype); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($specs && $specs != '') { ?>
                    <h3 style="padding-top:20px;"><?php esc_html_e('Specialities', 'reales'); ?></h3>
                    <p class="pb20"><?php echo esc_html($specs); ?></p>
                    <?php } ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">
                    <div class="agent">
                        <div class="agent-avatar">
                            <img src="<?php echo esc_url($avatar_src); ?>" alt="<?php echo esc_attr($title); ?>">
                        </div>
                        <?php if($show_rating != '') { ?>
                            <div class="ratingContainer">
                                <?php 
                                print reales_display_agent_rating(reales_get_agent_ratings($agent_id), true);
                                if(comments_open()) {
                                    if(is_user_logged_in()) {
                                        $user_review = get_comments(array('user_id' => $current_user->ID, 'post_id' => $post->ID));
                                        if(!$user_review) {
                                            print '<a href="#reviews" class="btn btn-green btn-round btn-sm">' . __('Write a review', 'reales') . '</a>';
                                        }
                                    } else {
                                        print '<a href="#" class="btn btn-green btn-round btn-sm" data-toggle="modal" data-target="#signin">' . __('Write a Review', 'reales') . '</a>';
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="agent-contact">
                        <?php if($facebook && $facebook != '') { ?>
                            <a href="<?php echo esc_url($facebook); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-facebook" target="_blank"><span class="fa fa-facebook"></span></a>
                        <?php } ?>
                        <?php if($twitter && $twitter != '') { ?>
                            <a href="<?php echo esc_url($twitter); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-twitter" target="_blank"><span class="fa fa-twitter"></span></a>
                        <?php } ?>
                        <?php if($google && $google != '') { ?>
                            <a href="<?php echo esc_url($google); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-google" target="_blank"><span class="fa fa-google-plus"></span></a>
                        <?php } ?>
                        <?php if($linkedin && $linkedin != '') { ?>
                            <a href="<?php echo esc_url($linkedin); ?>" class="btn btn-sm btn-icon btn-round btn-o btn-linkedin" target="_blank"><span class="fa fa-linkedin"></span></a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <h3><?php esc_html_e('About', 'reales') . ' ' . $title; ?></h3>
            <div class="entry-content">
                <?php the_content(); ?>
                <div class="clearfix"></div>
            </div>
            <h3><?php esc_html_e('Contact', 'reales') . ' ' . esc_html($title); ?></h3>
            <form class="contactForm">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="ca_response"></div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="ca_name"><?php esc_html_e('Name', 'reales'); ?> <span class="text-red">*</span></label>
                            <input type="text" id="ca_name" name="ca_name" placeholder="<?php esc_html_e('Enter your name', 'reales'); ?>" class="form-control">
                        </div>
                     </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="ca_email"><?php esc_html_e('Email', 'reales'); ?> <span class="text-red">*</span></label>
                            <input type="text" id="ca_email" name="ca_email" placeholder="<?php esc_html_e('Enter your email', 'reales'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="ca_phone"><?php esc_html_e('Phone', 'reales'); ?> <span class="text-red">*</span></label>
                            <input type="text" id="ca_phone" name="ca_phone" placeholder="<?php esc_html_e('Enter your phone number', 'reales'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="ca_subject"><?php esc_html_e('Subject', 'reales'); ?> <span class="text-red">*</span></label>
                            <input type="text" id="ca_subject" name="ca_subject" placeholder="<?php esc_html_e('Enter the subject', 'reales'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="ca_message"><?php esc_html_e('Message', 'reales'); ?> <span class="text-red">*</span></label>
                            <textarea id="ca_message" name="ca_message" placeholder="<?php esc_html_e('Type your message', 'reales'); ?>" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <?php
                    $reales_captcha_settings = get_option('reales_captcha_settings');
                    $show_captcha = isset($reales_captcha_settings['reales_captcha_contact_field']) ? $reales_captcha_settings['reales_captcha_contact_field'] : false;
                    $site_key = isset($reales_captcha_settings['reales_captcha_site_key_field']) ? $reales_captcha_settings['reales_captcha_site_key_field'] : '';
                    $secret_key = isset($reales_captcha_settings['reales_captcha_secret_key_field']) ? $reales_captcha_settings['reales_captcha_secret_key_field'] : '';

                    if($show_captcha && $site_key != '' && $secret_key != '') {
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <a href="javascript:void(0);" class="btn btn-green" id="sendMessageBtn"><?php esc_html_e('Send Message', 'reales'); ?></a>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="agent_email" name="agent_email" value="<?php echo esc_attr($email); ?>" />
                <?php wp_nonce_field('agent_message_ajax_nonce', 'securityAgentMessage', true); ?>
            </form>
        </div>

        <?php get_template_part('templates/agent_properties'); ?>

        <?php if($show_rating != '' && (comments_open() || get_comments_number())) {
            print '<div class="comments" id="reviews">';
            comments_template();
            print '</div>';
        } ?>

        <?php if($nomap == '1') { ?>
            </div>
            <?php if($sidebar_position == 'right') { ?>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
            </div>
        <?php } ?>

    <?php if($nomap == '1') { ?>
    </div></div>
    <?php } else {
        get_template_part('templates/mapview_footer'); ?>
    </div>
    <?php } ?>

    <?php endwhile; ?>
</div>

<?php
if($nomap != '1') {
    get_template_part('templates/app_footer');
} else {
    get_footer();
}
?>