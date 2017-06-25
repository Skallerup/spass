<?php
/*
Template Name: Contact Page
*/

/**
 * @package WordPress
 * @subpackage Reales
 */


global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$sidebar_position = isset($reales_appearance_settings['reales_sidebar_field']) ?  $reales_appearance_settings['reales_sidebar_field'] : '';
$show_bc = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
$reales_contact_settings = get_option('reales_contact_settings','');
$c_name = isset($reales_contact_settings['reales_company_name_field']) ? $reales_contact_settings['reales_company_name_field'] : '';
$c_email = isset($reales_contact_settings['reales_company_email_field']) ? $reales_contact_settings['reales_company_email_field'] : '';
$c_phone = isset($reales_contact_settings['reales_company_phone_field']) ? $reales_contact_settings['reales_company_phone_field'] : '';
$c_mobile = isset($reales_contact_settings['reales_company_mobile_field']) ? $reales_contact_settings['reales_company_mobile_field'] : '';
$c_skype = isset($reales_contact_settings['reales_company_skype_field']) ? $reales_contact_settings['reales_company_skype_field'] : '';
$c_address = isset($reales_contact_settings['reales_company_address_field']) ? $reales_contact_settings['reales_company_address_field'] : '';
$c_facebook = isset($reales_contact_settings['reales_company_facebook_field']) ? $reales_contact_settings['reales_company_facebook_field'] : '';
$c_twitter = isset($reales_contact_settings['reales_company_twitter_field']) ? $reales_contact_settings['reales_company_twitter_field'] : '';
$c_google = isset($reales_contact_settings['reales_company_google_field']) ? $reales_contact_settings['reales_company_google_field'] : '';
$c_linkedin = isset($reales_contact_settings['reales_company_linkedin_field']) ? $reales_contact_settings['reales_company_linkedin_field'] : '';
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
                <?php while(have_posts()) : the_post(); ?>

                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if($show_bc != '') {
                        reales_breadcrumbs();
                    } ?>
                    <h2 class="pageHeader"><?php echo esc_html($c_name); ?></h2>

                    <div class="row pb20">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h4><?php esc_html_e('Contact Details', 'reales'); ?></h4>
                            <?php if($c_phone && $c_phone != '') { ?>
                                <div class="contact-details"><span class="contact-icon fa fa-phone"></span> <?php echo esc_html($c_phone); ?></div>
                            <?php } ?>
                            <?php if($c_mobile && $c_mobile != '') { ?>
                                <div class="contact-details"><span class="contact-icon fa fa-mobile"></span> <?php echo esc_html($c_mobile); ?></div>
                            <?php } ?>
                            <?php if($c_email && $c_email != '') { ?>
                                <div class="contact-details"><span class="contact-icon fa fa-envelope-o"></span> <?php echo esc_html($c_email); ?></div>
                            <?php } ?>
                            <?php if($c_skype && $c_skype != '') { ?>
                                <div class="contact-details"><span class="contact-icon fa fa-skype"></span> <?php echo esc_html($c_skype); ?></div>
                            <?php } ?>
                            <?php if($c_address && $c_address != '') { ?>
                                <div class="contact-details"><span class="contact-icon fa fa-map-marker"></span> <?php echo esc_html($c_address); ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <?php if(($c_facebook && $c_facebook != '') || ($c_twitter && $c_twitter != '') || ($c_google && $c_google != '') || ($c_linkedin && $c_linkedin != '')) { ?>
                                <h4><?php esc_html_e('Follow Us', 'reales'); ?></h4>
                                <?php if($c_facebook && $c_facebook != '') { ?>
                                    <div class="contact-details"><a href="<?php echo esc_url($c_facebook); ?>" class="text-facebook"><span class="contact-icon fa fa-facebook"></span> Facebook</a></div>
                                <?php } ?>
                                <?php if($c_twitter && $c_twitter != '') { ?>
                                    <div class="contact-details"><a href="<?php echo esc_url($c_twitter); ?>" class="text-twitter"><span class="contact-icon fa fa-twitter"></span> Twitter</a></div>
                                <?php } ?>
                                <?php if($c_google && $c_google != '') { ?>
                                    <div class="contact-details"><a href="<?php echo esc_url($c_google); ?>" class="text-google"><span class="contact-icon fa fa-google-plus"></span> Google+</a></div>
                                <?php } ?>
                                <?php if($c_linkedin && $c_linkedin != '') { ?>
                                    <div class="contact-details"><a href="<?php echo esc_url($c_linkedin); ?>" class="text-linkedin"><span class="contact-icon fa fa-linkedin"></span> LinkedIn</a></div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="entry-content">
                        <?php the_content(); ?>
                        <div class="clearfix"></div>
                    </div>

                    <h4><?php esc_html_e('Send Us a Message', 'reales'); ?></h4>
                    <form class="contactPageForm">
                        <input type="hidden" id="company_email" name="company_email" value="<?php echo esc_attr($c_email); ?>">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="cp_response"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="cp_name"><?php esc_html_e('Name', 'reales'); ?> <span class="text-red">*</span></label>
                                    <input type="text" id="cp_name" name="cp_name" placeholder="<?php esc_html_e('Enter your name', 'reales'); ?>" class="form-control">
                                </div>
                             </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="cp_email"><?php esc_html_e('Email', 'reales'); ?> <span class="text-red">*</span></label>
                                    <input type="text" id="cp_email" name="cp_email" placeholder="<?php esc_html_e('Enter your email', 'reales'); ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="cp_subject"><?php esc_html_e('Subject', 'reales'); ?> <span class="text-red">*</span></label>
                                    <input type="text" id="cp_subject" name="cp_subject" placeholder="<?php esc_html_e('Enter the subject', 'reales'); ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="cp_message"><?php esc_html_e('Message', 'reales'); ?> <span class="text-red">*</span></label>
                                    <textarea id="cp_message" name="cp_message" placeholder="<?php esc_html_e('Type your message', 'reales'); ?>" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        $reales_captcha_settings = get_option('reales_captcha_settings');
                        $show_captcha = isset($reales_captcha_settings['reales_captcha_contact_field']) ? $reales_captcha_settings['reales_captcha_contact_field'] : false;
                        $site_key = isset($reales_captcha_settings['reales_captcha_site_key_field']) ? $reales_captcha_settings['reales_captcha_site_key_field'] : '';
                        $secret_key = isset($reales_captcha_settings['reales_captcha_secret_key_field']) ? $reales_captcha_settings['reales_captcha_secret_key_field'] : '';

                        if($show_captcha && $site_key != '' && $secret_key != '') {
                        ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <a href="javascript:void(0);" class="btn btn-green" id="sendContactMessageBtn"><?php esc_html_e('Send Message', 'reales'); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php wp_nonce_field('contact_page_ajax_nonce', 'securityContactPage', true); ?>
                    </form>
                </div>

                <?php endwhile; ?>
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