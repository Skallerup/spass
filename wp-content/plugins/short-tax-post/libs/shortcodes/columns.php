<?php
/**
 * Columns shortcode
 */
if( !function_exists('reales_column_shortcode') ): 
    function reales_column_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'type' => '',
        ), $attrs));

        $return_string = '';

        switch($type) {
            case 'one_half':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">' . $content . '</div>';
                break;
            case 'one_half_last':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pb20">' . $content . '</div>';
                $return_string .= '<div class="clearfix"></div>';
                break;
            case 'one_third':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pb20">' . $content . '</div>';
                break;
            case 'one_third_last':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pb20">' . $content . '</div>';
                $return_string .= '<div class="clearfix"></div>';
                break;
            case 'one_fourth':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pb20">' . $content . '</div>';
                break;
            case 'one_fourth_last':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pb20">' . $content . '</div>';
                $return_string .= '<div class="clearfix"></div>';
                break;
            case 'two_third':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 pb20">' . $content . '</div>';
                break;
            case 'two_third_last':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 pb20">' . $content . '</div>';
                $return_string .= '<div class="clearfix"></div>';
                break;
            case 'three_fourth':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 pb20">' . $content . '</div>';
                break;
            case 'three_fourth_last':
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 pb20">' . $content . '</div>';
                $return_string .= '<div class="clearfix"></div>';
                break;
        }

        wp_reset_query();
        return $return_string;
    }
endif;
?>