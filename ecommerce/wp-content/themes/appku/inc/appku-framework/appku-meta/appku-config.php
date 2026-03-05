<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

 /**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function appku_set_checkbox_default_for_new_post( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

add_action( 'cmb2_admin_init', 'appku_register_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

function appku_register_metabox() {

	$prefix = '_appku_';

	$prefixpage = '_appkupage_';
	
	$appku_service_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'service_page_control',
		'title'         => esc_html__( 'Service Page Controller', 'appku' ),
		'object_types'  => array( 'carvis_service' ), // Post type
		'closed'        => true
	) );
	$appku_service_meta->add_field( array(
		'name' => esc_html__( 'Write Flaticon Class', 'appku' ),
	   	'desc' => esc_html__( 'Write Flaticon Class For The Icon', 'appku' ),
	   	'id'   => $prefix . 'flat_icon_class',
		'type' => 'text',
    ) );
	
	$appku_post_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'blog_post_control',
		'title'         => esc_html__( 'Post Thumb Controller', 'appku' ),
		'object_types'  => array( 'post' ), // Post type
		'closed'        => true
	) );
	$appku_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Video', 'appku' ),
		'desc' => esc_html__( 'Use This Field When Post Format Video', 'appku' ),
		'id'   => $prefix . 'post_format_video',
        'type' => 'text_url',
    ) );
	$appku_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Audio', 'appku' ),
		'desc' => esc_html__( 'Use This Field When Post Format Audio', 'appku' ),
		'id'   => $prefix . 'post_format_audio',
        'type' => 'oembed',
    ) );
	$appku_post_meta->add_field( array(
		'name' => esc_html__( 'Post Thumbnail For Slider', 'appku' ),
		'desc' => esc_html__( 'Use This Field When You Want A Slider In Post Thumbnail', 'appku' ),
		'id'   => $prefix . 'post_format_slider',
        'type' => 'file_list',
    ) );
	
	$appku_page_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_meta_section',
		'title'         => esc_html__( 'Page Meta', 'appku' ),
		'object_types'  => array( 'page' ), // Post type
        'closed'        => true
    ) );

    $appku_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Area', 'appku' ),
		'desc' => esc_html__( 'check to display page breadcrumb area.', 'appku' ),
		'id'   => $prefix . 'page_breadcrumb_area',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','appku'),
            '2'     => esc_html__('Hide','appku'),
        )
    ) );


    $appku_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Settings', 'appku' ),
		'id'   => $prefix . 'page_breadcrumb_settings',
        'type' => 'select',
        'default'   => 'global',
        'options'   => array(
            'global'   => esc_html__( 'Global Settings', 'appku' ),
            'page'     => esc_html__( 'Page Settings', 'appku' ),
        )
	) );
	
	$appku_page_meta->add_field( array(
	    'name'    => esc_html__( 'Breadcumb Image', 'appku' ),
	    'desc'    => esc_html__( 'Upload an image or enter an URL.', 'appku' ),
	    'id'      => $prefix . 'breadcumb_image',
	    'type'    => 'file',
	    // Optional:
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	    ),
	    'text'    => array(
	        'add_upload_file_text' => __( 'Add File', 'appku' ) // Change upload button text. Default: "Add or Upload File"
	    ),
	    'preview_size' => 'large', // Image size to use when previewing in the admin.
	) );
	
    $appku_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title', 'appku' ),
		'desc' => esc_html__( 'check to display Page Title.', 'appku' ),
		'id'   => $prefix . 'page_title',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   	=> esc_html__( 'Show','appku'),
            '2'     => esc_html__( 'Hide','appku'),
        )
	) );

    $appku_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title Settings', 'appku' ),
		'id'   => $prefix . 'page_title_settings',
        'type' => 'select',
        'options'   => array(
            'default'  => esc_html__('Default Title','appku'),
            'custom'  => esc_html__('Custom Title','appku'),
        ),
        'default'   => 'default'
    ) );

    $appku_page_meta->add_field( array(
		'name' => esc_html__( 'Custom Page Title', 'appku' ),
		'id'   => $prefix . 'custom_page_title',
        'type' => 'text'
    ) );

    $appku_page_meta->add_field( array(
		'name' => esc_html__( 'Breadcrumb', 'appku' ),
		'desc' => esc_html__( 'Select Show to display breadcrumb area', 'appku' ),
		'id'   => $prefix . 'page_breadcrumb_trigger',
        'type' => 'switch_btn',
        'default' => appku_set_checkbox_default_for_new_post( true ),
    ) );

    $appku_layout_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'appku' ),
        'context' 		=> 'side',
        'priority' 		=> 'high',
        'object_types'  => array( 'page' ), // Post type
        'closed'        => true
	) );

	$appku_layout_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'appku' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => esc_html__( 'Container', 'appku' ),
            '2' => esc_html__( 'Container Fluid', 'appku' ),
            '3' => esc_html__( 'Fullwidth', 'appku' ),
        ),
	) );

	$appku_product_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'product_meta_section',
		'title'         => esc_html__( 'Swap Image', 'appku' ),
		'object_types'  => array( 'product' ), // Post type
		'closed'        => true,
		'context'		=> 'side',
		'priority'		=> 'default'
	) );

	$appku_product_meta->add_field( array(
		'name' 		=> esc_html__( 'Product Swap Image', 'appku' ),
		'desc' 		=> esc_html__( 'Set Product Swap Image', 'appku' ),
		'id'   		=> $prefix.'product_swap_image',
		'type'    	=> 'file',
		// Optional:
		'options' 	=> array(
			'url' 		=> false, // Hide the text input for the url
		),
		'text'    	=> array(
			'add_upload_file_text' => __( 'Add Swap Image', 'appku' ) // Change upload button text. Default: "Add or Upload File"
		),
	) );
}

add_action( 'cmb2_admin_init', 'appku_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function appku_register_taxonomy_metabox() {

    $prefix = '_appku_';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$appku_term_meta = new_cmb2_box( array(
		'id'               => $prefix.'term_edit',
		'title'            => esc_html__( 'Category Metabox', 'appku' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'category'),
	) );
	$appku_term_meta->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'appku' ),
		'id'       => $prefix.'term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	$appku_term_meta->add_field( array(
		'name' => esc_html__( 'Category Image', 'appku' ),
		'desc' => esc_html__( 'Set Category Image', 'appku' ),
		'id'   => $prefix.'term_avatar',
        'type' => 'file',
        'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','appku') // Change upload button text. Default: "Add or Upload File"
		),
	) );


	/**
	 * Metabox for the user profile screen
	 */
	$appku_user = new_cmb2_box( array(
		'id'               => $prefix.'user_edit',
		'title'            => esc_html__( 'User Profile Metabox', 'appku' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
	$appku_user->add_field( array(
		'name'     => esc_html__( 'Social Profile', 'appku' ),
		'id'       => $prefix.'user_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$group_field_id = $appku_user->add_field( array(
        'id'          => $prefix .'social_profile_group',
        'type'        => 'group',
        'description' => __( 'Social Profile', 'appku' ),
        'options'     => array(
            'group_title'       => __( 'Social Profile {#}', 'appku' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Add Another Social Profile', 'appku' ),
            'remove_button'     => __( 'Remove Social Profile', 'appku' ),
            'closed'         => true
        ),
    ) );

    $appku_user->add_group_field( $group_field_id, array(
        'name'        => __( 'Select Icon', 'appku' ),
        'id'          => $prefix .'social_profile_icon',
        'type'        => 'fontawesome_icon', // This field type
    ) );

    $appku_user->add_group_field( $group_field_id, array(
        'desc'       => esc_html__( 'Set social profile link.', 'appku' ),
        'id'         => $prefix . 'lawyer_social_profile_link',
        'name'       => esc_html__( 'Social Profile link', 'appku' ),
        'type'       => 'text'
    ) );
}