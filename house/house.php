<?php
/**
 * Plugin Name: House
 * Description: House with ajax filter
 * Version: 1.0.0
 * * Requires at least: 5.2
 * Requires PHP:7.2
 * License:GPL v2 or later
 * Author: MisterBR
 * Author URI: https://misterbr.ir
 */

//check house_with_ajax_filter_mrbr function exists
if ( ! function_exists( 'house_with_ajax_filter_mrbr' ) ) {

	function house_with_ajax_filter_mrbr() {
		//define labels string
		$labels = array(
			'name'                  => _x( 'Houses', 'House Type General Name', 'house_with_ajax_filter_mrbr' ),
			'singular_name'         => _x( 'House', 'House Type Singular Name', 'house_with_ajax_filter_mrbr' ),
			'menu_name'             => __( 'Houses', 'house_with_ajax_filter_mrbr' ),
			'name_admin_bar'        => __( 'Houses', 'house_with_ajax_filter_mrbr' ),
			'archives'              => __( 'House Archives', 'house_with_ajax_filter_mrbr' ),
			'attributes'            => __( 'House Attributes', 'house_with_ajax_filter_mrbr' ),
			'parent_item_colon'     => __( 'Parent House:', 'house_with_ajax_filter_mrbr' ),
			'all_items'             => __( 'All Houses', 'house_with_ajax_filter_mrbr' ),
			'add_new_item'          => __( 'Add New House', 'house_with_ajax_filter_mrbr' ),
			'add_new'               => __( 'Add New', 'house_with_ajax_filter_mrbr' ),
			'new_item'              => __( 'New House', 'house_with_ajax_filter_mrbr' ),
			'edit_item'             => __( 'Edit House', 'house_with_ajax_filter_mrbr' ),
			'update_item'           => __( 'Update House', 'house_with_ajax_filter_mrbr' ),
			'view_item'             => __( 'View House', 'house_with_ajax_filter_mrbr' ),
			'view_items'            => __( 'View Houses', 'house_with_ajax_filter_mrbr' ),
			'search_items'          => __( 'Search House', 'house_with_ajax_filter_mrbr' ),
			'not_found'             => __( 'Not found', 'house_with_ajax_filter_mrbr' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'house_with_ajax_filter_mrbr' ),
			'featured_image'        => __( 'House Image', 'house_with_ajax_filter_mrbr' ),
			'set_featured_image'    => __( 'Set house image', 'house_with_ajax_filter_mrbr' ),
			'remove_featured_image' => __( 'Remove house image', 'house_with_ajax_filter_mrbr' ),
			'use_featured_image'    => __( 'Use as house image', 'house_with_ajax_filter_mrbr' ),
			'insert_into_item'      => __( 'Insert into house', 'house_with_ajax_filter_mrbr' ),
			'uploaded_to_this_item' => __( 'Uploaded to this house', 'house_with_ajax_filter_mrbr' ),
			'items_list'            => __( 'House list', 'house_with_ajax_filter_mrbr' ),
			'items_list_navigation' => __( 'House list navigation', 'house_with_ajax_filter_mrbr' ),
			'filter_items_list'     => __( 'Filter House list', 'house_with_ajax_filter_mrbr' ),
		);

		//set rewrite
		$rewrite = array(
			'slug'       => 'houses',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);

		//set args
		$args = array(
			'label'               => __( 'House', 'house_with_ajax_filter_mrbr' ),
			'description'         => __( 'House with ajax filter', 'house_with_ajax_filter_mrbr' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'thumbnail',
				'comments',
			),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 21,
			'menu_icon'           => 'dashicons-admin-home',
			'show_in_nav_column'  => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_tagcloud'       => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'show_in_rest'        => true,
		);

		//register post type (house)
		register_post_type( 'house', $args );
	}

	add_action( 'init', 'house_with_ajax_filter_mrbr', 0 );

}

function house_features_meta_boxes_save( $post_id ) {
	//when auto save
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	//check meta_box_nonce
	if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'house_features_meta_box_nonce' ) ) {
		return;
	}

	// if our current user can't edit this post, bail
	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}

	//allow tags and attribute (can only have href)
	$allowed = array(
		'a' => array(
			'href' => array()
		)
	);

	// This saving select-boxes (house_features_floor)
	if ( isset( $_POST['house_features_floor'] ) ) {
		update_post_meta( $post_id, 'house_features_floor', esc_attr( $_POST['house_features_floor'] ) );
	}

	// This saving select-boxes (house_features_bedroom)
	if ( isset( $_POST['house_features_bedroom'] ) ) {
		update_post_meta( $post_id, 'house_features_bedroom', esc_attr( $_POST['house_features_bedroom'] ) );
	}

	// This saving check-boxes (house_features_parking)
	$chk = isset( $_POST['house_features_parking'] ) && $_POST['house_features_parking'] ? 'on' : 'off';
	update_post_meta( $post_id, 'house_features_parking', $chk );

	// This saving check-boxes (house_features_elevator)
	$chk = isset( $_POST['house_features_elevator'] ) && $_POST['house_features_elevator'] ? 'on' : 'off';
	update_post_meta( $post_id, 'house_features_elevator', $chk );
}

function house_features_meta_boxes_callback( $post ) {
	// set meta box form in custom post page
	include plugin_dir_path( __FILE__ ) . "templates/metabox.php";

}

add_action( 'save_post', 'house_features_meta_boxes_save' );

function house_features_meta_boxes_mrbr() {
	//	create metabox
	add_meta_box( 'house-features-meta-boxes', 'Features', 'house_features_meta_boxes_callback', 'house', 'side', 'high' );
}

add_action( 'add_meta_boxes', 'house_features_meta_boxes_mrbr' );

function shortcode_house_with_ajax_filter() {
	//load shortcode
	include plugin_dir_path( __FILE__ ) . "templates/filter-form.php";
	include plugin_dir_path( __FILE__ ) . "templates/houses.php";
	wp_reset_postdata();

}

//create shortcode
add_shortcode( 'HouseAjaxFilter', 'shortcode_house_with_ajax_filter' );

//set ajax config for admin and frontend
add_action( 'wp_ajax_house_filter_data', 'house_filter_function' );
add_action( 'wp_ajax_nopriv_house_filter_data', 'house_filter_function' );

function house_filter_function() {

	//ge post data from house filter page
	$house_floor    = esc_attr( $_POST['house_features_floor'] );
	$house_bedroom  = esc_attr( $_POST['house_features_bedroom'] );
	$house_parking  = esc_attr( $_POST['house_features_parking'] );
	$house_elevator = esc_attr( $_POST['house_features_elevator'] );
	$filter_list    = array();

	//	check exist input for house_features_floor
	if ( isset( $_POST['house_features_floor'] ) && $_POST['house_features_floor'] != null ) {
		$filter_list[] = array(
			'key'   => 'house_features_floor',
			'value' => $house_floor,
		);
	}

	//	check exist input for house_features_floor
	if ( isset( $_POST['house_features_bedroom'] ) && $_POST['house_features_bedroom'] != null ) {
		$filter_list[] = array(
			'key'   => 'house_features_bedroom',
			'value' => $house_bedroom,
		);
	}

	//	check exist input house_features_parking
	if ( isset( $_POST['house_features_parking'] ) && $_POST['house_features_parking'] != null ) {
		$filter_list[] = array(
			'key'   => 'house_features_parking',
			'value' => $house_parking,
		);
	}

	//	check exist input for house_features_elevator
	if ( isset( $_POST['house_features_elevator'] ) && $_POST['house_features_elevator'] != null ) {
		$filter_list[] = array(
			'key'   => 'house_features_elevator',
			'value' => $house_elevator,
		);
	}

	//	create args data for qurey
	if ( array_filter( $filter_list ) ) {
		$args = array(
			'post_type'      => array( 'house' ),
			'post_status'    => 'publish',
			'meta_query'     => array( $filter_list ),
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => 20,
		);
	} else {
		$args = array(
			'post_type'      => array( 'house' ),
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => 20,
		);
	}

	//	get query
	$houses = new WP_Query( $args );
	if ( $houses->have_posts() ) :
		include plugin_dir_path( __FILE__ ) . "templates/filtered.php";
		wp_reset_postdata();
	else :
		echo 'No House found';
	endif;
	die();
}

//load asset data in function
function house_ajax_filter_assets_file() {

	//load css file
	wp_register_style( 'ajax_house_filter_style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
	wp_enqueue_style( 'ajax_house_filter_style' );

	//load js file
	wp_register_script( 'ajax_house_filter_script', plugin_dir_url( __FILE__ ) . 'assets/js/ajax.js', [ 'jquery' ] );
	wp_enqueue_script( 'ajax_house_filter_script' );
}

add_action( 'wp_enqueue_scripts', 'house_ajax_filter_assets_file' );