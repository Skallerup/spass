<?php
/**
 * @package WordPress
 * @subpackage Reales
 */


get_header();
?>

<div id="" class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <h2 class="pageHeader"><?php esc_html_e('Sorry, we have a broken link!', 'reales'); ?></h2>
                <p><?php esc_html_e('The page you are looking for was moved, removed, renamed, or might never existed.', 'reales'); ?></p>
                <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-green"><?php esc_html_e('Go Home', 'reales'); ?></a></p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>