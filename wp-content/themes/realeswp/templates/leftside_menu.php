<?php
/**
 * @package WordPress
 * @subpackage Reales
 */
?>

<div id="leftSide">
    <nav class="leftNav scrollable">
        <?php 
        wp_nav_menu( array( 
            'theme_location'    => 'leftside',
            'link_before'       => '<span class="navIcon"></span><span class="navLabel">',
            'link_after'        => '</span>'
        ) );
        ?>
    </nav>
</div>
<div class="closeLeftSide"></div>