<?php
/**
 * Register invoice custom post type
 */
if( !function_exists('reales_register_invoice_type_init') ): 
    function reales_register_invoice_type_init() {
        wp_enqueue_style('reales_plugin_style', PLUGIN_PATH . '/css/style.css', false, '1.0', 'all');
    }
endif;
add_action('init', 'reales_register_invoice_type_init');

if( !function_exists('reales_register_invoice_type') ): 
    function reales_register_invoice_type() {
        register_post_type('invoice', array(
            'labels' => array(
                'name'                  => __('Invoices','reales'),
                'singular_name'         => __('Invoice','reales'),
                'add_new'               => __('Add New Invoice','reales'),
                'add_new_item'          => __('Add Invoice','reales'),
                'edit'                  => __('Edit','reales'),
                'edit_item'             => __('Edit Invoice','reales'),
                'new_item'              => __('New Invoice','reales'),
                'view'                  => __('View','reales'),
                'view_item'             => __('View Invoice','reales'),
                'search_items'          => __('Search Invoices','reales'),
                'not_found'             => __('No Invoices found','reales'),
                'not_found_in_trash'    => __('No Invoices found in Trash','reales'),
                'parent'                => __('Parent Invoice', 'reales'),
            ),
            'public'                => true,
            'exclude_from_search '  => true,
            'has_archive'           => true,
            //'rewrite'               => array('slug' => 'invoices'),
            'rewrite'               => array('slug' => _x('invoices', 'URL SLUG', 'reales')),
            'supports'              => array('title'),
            'can_export'            => true,
            'register_meta_box_cb'  => 'reales_add_invoice_metaboxes',
            'menu_icon'             => PLUGIN_PATH . '/images/invoice-icon.png'
        ));
    }
endif;
add_action('init', 'reales_register_invoice_type');

function reales_add_invoice_metaboxes() {
    add_meta_box('invoice-details-section', __('Details', 'reales'), 'reales_invoice_details_render', 'invoice', 'normal', 'default');
}

if( !function_exists('reales_invoice_details_render') ): 
    function reales_invoice_details_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'invoice_noncename');

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label style="font-weight: bold;">' . __('Invoice ID', 'reales') . ': ' . $post->ID . '</label> 
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="invoice_item_type">' . __('Item Type', 'reales') . '</label><br />';
                            print reales_item_types(esc_html(get_post_meta($post->ID, 'invoice_item_type', true)));
                            print '
                        </div>
                    </td>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="invoice_item_id">' . __('Item ID', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="invoice_item_id" name="invoice_item_id" placeholder="' . __('Enter Item ID', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'invoice_item_id', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="invoice_item_price">' . __('Item Price', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="invoice_item_price" name="invoice_item_price" placeholder="' . __('Enter Item Price', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'invoice_item_price', true)) . '" />
                        </div>
                    </td>
                    <td width="50%" valign="top" align="left">
                        <div class="adminField">
                            <label for="invoice_agent_id">' . __('Agent ID', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="invoice_agent_id" name="invoice_agent_id" placeholder="' . __('Enter Agent ID', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'invoice_agent_id', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_invoice_meta_save') ): 
    function reales_invoice_meta_save($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['invoice_noncename']) && wp_verify_nonce($_POST['invoice_noncename'], PLUGIN_BASENAME)) ? 'true' : 'false';

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        if(isset($_POST['invoice_item_type'])) {
            update_post_meta($post_id, 'invoice_item_type', sanitize_text_field($_POST['invoice_item_type']));
        }
        if(isset($_POST['invoice_item_id'])) {
            update_post_meta($post_id, 'invoice_item_id', sanitize_text_field($_POST['invoice_item_id']));
        }
        if(isset($_POST['invoice_item_price'])) {
            update_post_meta($post_id, 'invoice_item_price', sanitize_text_field($_POST['invoice_item_price']));
        }
        if(isset($_POST['invoice_agent_id'])) {
            update_post_meta($post_id, 'invoice_agent_id', sanitize_text_field($_POST['invoice_agent_id']));
        }
    }
endif;
add_action('save_post', 'reales_invoice_meta_save');

if( !function_exists('reales_item_types') ): 
    function reales_item_types($selected) {
        $types = array('Standard Listing', 'Listing Upgraded to Featured', 'Featured Listing', 'Membership Plan');
        $type_select = '<select id="invoice_item_type" name="invoice_item_type">';

        foreach ($types as $type) {
            $type_select .= '<option value="' . esc_attr($type) . '"';
            if ($selected == $type) {
                $type_select .= 'selected="selected"';
            }
            $type_select .= '>' . esc_html($type) . '</option>';
        }
        $type_select.='</select>';

        return $type_select;
    }
endif;

if( !function_exists('reales_insert_invoice') ):
    function reales_insert_invoice($item_type, $item_id, $agent_id, $is_featured, $is_upgrade) {
    $post = array(
        'post_type' => 'invoice', 
        'post_status' => 'publish',
    );
    $post_id = wp_insert_post($post);

    $reales_membership_settings = get_option('reales_membership_settings');
    $submission_price = isset($reales_membership_settings['reales_submission_price_field']) ? floatval($reales_membership_settings['reales_submission_price_field']) : 0;
    $featured_submission_price = isset($reales_membership_settings['reales_featured_price_field']) ? floatval($reales_membership_settings['reales_featured_price_field']) : 0;

    if($item_type == 'Membership Plan') {
        $price= get_post_meta($item_id, 'membership_plan_price', true);
    } else {
        if($is_upgrade == 1) {
            $price = $featured_submission_price;
        } else {
            if($is_featured == 1) {
                $price = $submission_price + $featured_submission_price;
            } else {
                $price = $submission_price;
            }
        }
    }

    update_post_meta($post_id, 'invoice_item_type', $item_type);
    update_post_meta($post_id, 'invoice_item_id', $item_id);
    update_post_meta($post_id, 'invoice_item_price', $price);
    update_post_meta($post_id, 'invoice_agent_id', $agent_id);

    $new_post = array(
       'ID' => $post_id,
       'post_title' => 'Invoice ' . $post_id,
    );
    wp_update_post($new_post);
}
endif;

/**
 * Add item type column in WP-Admin
 */
if( !function_exists('reales_invoices_column_type') ): 
    function reales_invoices_column_type($defaults) {
        $defaults['post_type'] = __('Item Type', 'reales');
        return $defaults;
    }
endif;
add_filter('manage_invoice_posts_columns', 'reales_invoices_column_type');
if( !function_exists('reales_invoices_custom_column_type') ): 
    function reales_invoices_custom_column_type($column_name, $id) {
        if($column_name === 'post_type') {
            echo get_post_meta($id, 'invoice_item_type', true);
        }
    }
endif;
add_action('manage_invoice_posts_custom_column', 'reales_invoices_custom_column_type', 5, 2);
if( !function_exists('reales_sortable_invoice_type_column') ): 
    function reales_sortable_invoice_type_column($columns) {
        $columns['post_type'] = 'post_type';
      
        return $columns;
    }
endif;
add_filter( 'manage_edit-invoice_sortable_columns', 'reales_sortable_invoice_type_column' );
if( !function_exists('reales_invoice_type_orderby') ): 
    function reales_invoice_type_orderby($query) {
        if(!is_admin()) {
            return;
        }

        $orderby = $query->get('orderby');

        if('post_type' == $orderby) {
            $query->set('meta_key', 'invoice_item_type');
            $query->set('orderby', 'meta_value');
        }
    }
endif;
add_action( 'pre_get_posts', 'reales_invoice_type_orderby' );

/**
 * Add item price column in WP-Admin
 */
if( !function_exists('reales_invoices_column_price') ): 
    function reales_invoices_column_price($defaults) {
        $defaults['post_price'] = __('Price', 'reales');
        return $defaults;
    }
endif;
add_filter('manage_invoice_posts_columns', 'reales_invoices_column_price');
if( !function_exists('reales_invoices_custom_column_price') ): 
    function reales_invoices_custom_column_price($column_name, $id) {
        if($column_name === 'post_price') {
            echo get_post_meta($id, 'invoice_item_price', true);
        }
    }
endif;
add_action('manage_invoice_posts_custom_column', 'reales_invoices_custom_column_price', 5, 2);
if( !function_exists('reales_sortable_invoice_price_column') ): 
    function reales_sortable_invoice_price_column($columns) {
        $columns['post_price'] = 'post_price';

        return $columns;
    }
endif;
add_filter( 'manage_edit-invoice_sortable_columns', 'reales_sortable_invoice_price_column' );
if( !function_exists('reales_invoice_price_orderby') ): 
    function reales_invoice_price_orderby($query) {
        if(!is_admin()) {
            return;
        }

        $orderby = $query->get('orderby');

        if('post_price' == $orderby) {
            $query->set('meta_key', 'invoice_item_price');
            $query->set('orderby', 'meta_value_no');
        }
    }
endif;
add_action( 'pre_get_posts', 'reales_invoice_price_orderby' );

/**
 * Add item agent column in WP-Admin
 */
if( !function_exists('reales_invoices_column_agent') ): 
    function reales_invoices_column_agent($defaults) {
        $defaults['post_agent'] = __('Purchased By', 'reales');
        return $defaults;
    }
endif;
add_filter('manage_invoice_posts_columns', 'reales_invoices_column_agent');
if( !function_exists('reales_invoices_custom_column_agent') ): 
    function reales_invoices_custom_column_agent($column_name, $id) {
        if($column_name === 'post_agent') {
            $agent_id = get_post_meta($id, 'invoice_agent_id', true);
            echo get_the_title($agent_id);
        }
    }
endif;
add_action('manage_invoice_posts_custom_column', 'reales_invoices_custom_column_agent', 5, 2);
if( !function_exists('reales_sortable_invoice_agent_column') ): 
    function reales_sortable_invoice_agent_column($columns) {
        $columns['post_agent'] = 'post_agent';

        return $columns;
    }
endif;
add_filter( 'manage_edit-invoice_sortable_columns', 'reales_sortable_invoice_agent_column' );
if( !function_exists('reales_invoice_agent_orderby') ): 
    function reales_invoice_agent_orderby($query) {
        if(!is_admin()) {
            return;
        }

        $orderby = $query->get('orderby');

        if('post_agent' == $orderby) {
            $query->set('meta_key', 'invoice_agent_id');
            $query->set('orderby', 'meta_value_no');
        }
    }
endif;
add_action( 'pre_get_posts', 'reales_invoice_agent_orderby' );

?>