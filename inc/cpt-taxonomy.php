<?php

//CUSTOM POST TYPES
function fit_register_custom_post_types() {
    
    // Register Staff
    $labels = array(
        'name'                  => _x( 'Our Team', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name'),
        'menu_name'             => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'staff' ),
        'add_new_item'          => __( 'Add New Staff' ),
        'new_item'              => __( 'New Staff' ),
        'edit_item'             => __( 'Edit Staff' ),
        'view_item'             => __( 'View Staff' ),
        'all_items'             => __( 'All Staff' ),
        'search_items'          => __( 'Search Staff' ),
        'parent_item_colon'     => __( 'Parent Staff:' ),
        'not_found'             => __( 'No staff found.' ),
        'not_found_in_trash'    => __( 'No staff found in Trash.' ),
        'archives'              => __( 'Staff Archives'),
        'insert_into_item'      => __( 'Insert into staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this staff'),
        'filter_item_list'      => __( 'Filter staff list'),
        'items_list_navigation' => __( 'Staff list navigation'),
        'items_list'            => __( 'Staff list'),
        'featured_image'        => __( 'Staff featured image'),
        'set_featured_image'    => __( 'Set staff featured image'),
        'remove_featured_image' => __( 'Remove staff featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'our-staff' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail' ),
    );

    register_post_type( 'fit-staff', $args );

    // Register Testimonial
    $labels = array(
        'name'                  => _x( 'Testimonial', 'post type general name' ),
        'singular_name'         => _x( 'Testimonial', 'post type singular name'),
        'menu_name'             => _x( 'Testimonial', 'admin menu' ),
        'name_admin_bar'        => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'testimonial' ),
        'add_new_item'          => __( 'Add New Testimonial' ),
        'new_item'              => __( 'New Testimonial' ),
        'edit_item'             => __( 'Edit Testimonial' ),
        'view_item'             => __( 'View Testimonial' ),
        'all_items'             => __( 'All Testimonial' ),
        'search_items'          => __( 'Search Testimonial' ),
        'parent_item_colon'     => __( 'Parent Testimonial:' ),
        'not_found'             => __( 'No testimonial found.' ),
        'not_found_in_trash'    => __( 'No testimonial found in Trash.' ),
        'archives'              => __( 'Testimonial Archives'),
        'insert_into_item'      => __( 'Insert into testimonial'),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial'),
        'filter_item_list'      => __( 'Filter testimonial list'),
        'items_list_navigation' => __( 'Testimonial list navigation'),
        'items_list'            => __( 'Testimonial list'),
        'featured_image'        => __( 'Testimonial featured image'),
        'set_featured_image'    => __( 'Set testimonial featured image'),
        'remove_featured_image' => __( 'Remove testimonial featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-status',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'fit-testimonial', $args );

}
add_action( 'init', 'fit_register_custom_post_types' );



//CUSTOM TAXONOMIES
function fit_register_taxonomies() {

    // Add Service Taxonomy
    $labels = array(
        'name'              => _x( 'Service Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Service Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Service Categories' ),
        'all_items'         => __( 'All Service Category' ),
        'parent_item'       => __( 'Parent Service Category' ),
        'parent_item_colon' => __( 'Parent Service Category:' ),
        'edit_item'         => __( 'Edit Service Category' ),
        'view_item'         => __( 'View Service Category' ),
        'update_item'       => __( 'Update Service Category' ),
        'add_new_item'      => __( 'Add New Service Category' ),
        'new_item_name'     => __( 'New Service Category Name' ),
        'menu_name'         => __( 'Service Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'service-categories' ),
    );
    register_taxonomy( 'fit-service-category', array( 'fit-service' ), $args );

    // Add Testimonial Taxonomy
    $labels = array(
        'name'              => _x( 'Testimonial Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Testimonial Categories' ),
        'all_items'         => __( 'All Testimonial Category' ),
        'parent_item'       => __( 'Parent Testimonial Category' ),
        'parent_item_colon' => __( 'Parent Testimonial Category:' ),
        'edit_item'         => __( 'Edit Testimonial Category' ),
        'view_item'         => __( 'View Testimonial Category' ),
        'update_item'       => __( 'Update Testimonial Category' ),
        'add_new_item'      => __( 'Add New Testimonial Category' ),
        'new_item_name'     => __( 'New Testimonial Category Name' ),
        'menu_name'         => __( 'Testimonial Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'testimonial-categories' ),
    );
    register_taxonomy( 'fit-testimonial-category', array( 'fit-testimonial' ), $args );
}
add_action( 'init', 'fit_register_taxonomies');

//Flushing permalinks in case of new theme...
function fit_rewrite_flush() {
    fit_register_custom_post_types();
    fit_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fit_rewrite_flush' );