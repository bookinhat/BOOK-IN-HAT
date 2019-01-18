<?php
include('settings.php');
add_theme_support( 'woocommerce' );
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
	register_nav_menu('header-menu','Header Menu');
//	register_nav_menu('footer-menu','Footer Menu');
	add_theme_support( 'post-thumbnails' );
	add_image_size('home-small-box',370,370,true);
	add_image_size('st-blog-image',890,276,true);
    add_image_size('pt-home-left-image',580,576,true);
    add_image_size('pt-home-top-right',272,273,true);
    add_image_size('pt-home-bottom-right',580,272,true);
    add_image_size('is-home-prod-box',205,275,true );
    add_image_size('is-slide-image',890,370,true );
}
/*
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );
 
function custom_woocommerce_get_catalog_ordering_args( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	 
	if ( 'price-desc' == $orderby_value ) {
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'desc';
		$args['meta_key'] = '_price';
	} elseif ( 'price' == $orderby_value ) {
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'asc';
		$args['meta_key'] = '_price';
	}
	 
	return $args;
}*/
function ds_get_excerpt($num_chars) {
    $temp_str = substr(strip_tags(strip_shortcodes(get_the_content())),0,$num_chars);
    $temp_parts = explode(" ",$temp_str);
    $temp_parts[(count($temp_parts) - 1)] = '';
    
    if(strlen(strip_tags(strip_shortcodes(get_the_content()))) > $num_chars)
      return implode(" ",$temp_parts) . '...';
    else
      return implode(" ",$temp_parts);
}
if ( function_exists('register_sidebar') ) {
        register_sidebar(array(
                'name'=>'Sidebar',
		'before_widget' => '<div class="side_box">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="side_title">',
		'after_title' => '</h3>',
	));
        register_sidebar(array(
                'name'=>'Footer Widget 1',
        'before_widget' => '<div class="footer_box">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer_title">',
        'after_title' => '</h3>',
    ));
        register_sidebar(array(
                'name'=>'Footer Widget 2',
        'before_widget' => '<div class="footer_box">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer_title">',
        'after_title' => '</h3>',
    ));
        register_sidebar(array(
                'name'=>'Footer Widget 3',
        'before_widget' => '<div class="footer_box">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer_title">',
        'after_title' => '</h3>',
    ));        
        register_sidebar(array(
                'name'=>'Footer Widget 4',
        'before_widget' => '<div class="footer_box">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer_title">',
        'after_title' => '</h3>',
    ));        
}
// EX POST CUSTOM FIELD START
$prefix = 'ex_';
$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Custom meta box',
    'page' => 'product',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Show in slideshow',
            'id' => $prefix . 'show_in_slideshow',
            'type' => 'checkbox'
        ),
        array(
            'name' => 'Show in homepage',
            'id' => $prefix . 'show_in_homepage',
            'type' => 'checkbox'
        )
    )
);
add_action('admin_menu', 'mytheme_add_box');
// Add meta box
function mytheme_add_box() {
    global $meta_box;
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" value="Yes" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    echo '</table>';
}
add_action('save_post', 'mytheme_save_data');
// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
// EX POST CUSTOM FIELD END
add_action( 'after_setup_theme', 'ishopp_wc_gallery' );

function ishopp_wc_gallery() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

?>