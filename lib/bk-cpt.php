<?php
// Register Custom Post Type
function trp_deals_post_type() {

	$labels = array(
		'name'                  => _x( 'Deals', 'Post Type General Name', 'trp' ),
		'singular_name'         => _x( 'Deal', 'Post Type Singular Name', 'trp' ),
		'menu_name'             => __( 'Deals', 'trp' ),
		'name_admin_bar'        => __( 'Deals', 'trp' ),
		'archives'              => __( 'Deal Archives', 'trp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'trp' ),
		'all_items'             => __( 'All Deals', 'trp' ),
		'add_new_item'          => __( 'Add New Deal', 'trp' ),
		'add_new'               => __( 'Add New', 'trp' ),
		'new_item'              => __( 'New Deal', 'trp' ),
		'edit_item'             => __( 'Edit Deal', 'trp' ),
		'update_item'           => __( 'Update Deal', 'trp' ),
		'view_item'             => __( 'View Deal', 'trp' ),
		'search_items'          => __( 'Search Deal', 'trp' ),
		'not_found'             => __( 'Not found', 'trp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'trp' ),
		'featured_image'        => __( 'Featured Image', 'trp' ),
		'set_featured_image'    => __( 'Set featured image', 'trp' ),
		'remove_featured_image' => __( 'Remove featured image', 'trp' ),
		'use_featured_image'    => __( 'Use as featured image', 'trp' ),
		'insert_into_item'      => __( 'Insert into deal', 'trp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this deal', 'trp' ),
		'items_list'            => __( 'Deals list', 'trp' ),
		'items_list_navigation' => __( 'Deals list navigation', 'trp' ),
		'filter_items_list'     => __( 'Filter deals list', 'trp' ),
	);
	$args = array(
		'label'                 => __( 'Deal', 'trp' ),
		'description'           => __( 'Deals and Discounts', 'trp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-image-filter',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'trp_deals', $args );

}
add_action( 'init', 'trp_deals_post_type', 0 );
