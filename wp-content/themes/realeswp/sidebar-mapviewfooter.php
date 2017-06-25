<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if (!is_active_sidebar('first-mapview-footer-widget-area') && 
    !is_active_sidebar('second-mapview-footer-widget-area')) {
        return;
}
?>

<?php if (is_active_sidebar('first-mapview-footer-widget-area')) : ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <ul class="footer-nav pb20">
            <?php dynamic_sidebar('first-mapview-footer-widget-area'); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (is_active_sidebar('second-mapview-footer-widget-area')) : ?>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <ul class="footer-nav pb20">
            <?php dynamic_sidebar('second-mapview-footer-widget-area'); ?>
        </ul>
    </div>
<?php endif; ?>


