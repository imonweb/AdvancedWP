<?php
/*
Plugin Name: Gourmet Artistry Post Types & Taxonomies
Plugin URI:
Description: Adds Custom Post Types to site.
Version: 1.0
Author: Juan De la torre Valdez
License: GPL2
License: URI: https://www.gnu.org/licenses/gpl-2.0.html
*/



add_action('init', 'ga_recipe_post_type', 0 );
add_action('init', 'ga_events_post_type', 0 );
add_action('init', 'meal_type_taxonomy');
add_action('init', 'course_taxonomy');
add_action('init', 'mood_taxonomy');
add_action( 'init', 'type_event', 0 );

function type_event() {

	$labels = array(
		'name'                       => _x( 'Types of Event', 'Taxonomy General Name', 'gourmet-artist' ),
		'singular_name'              => _x( 'Type of Event', 'Taxonomy Singular Name', 'gourmet-artist' ),
		'menu_name'                  => __( 'Type of Event', 'gourmet-artist' ),
		'all_items'                  => __( 'All Types of Event', 'gourmet-artist' ),
		'parent_item'                => __( 'Parent Type of Event', 'gourmet-artist' ),
		'parent_item_colon'          => __( 'Parent Type of Event:', 'gourmet-artist' ),
		'new_item_name'              => __( 'New Type of Event', 'gourmet-artist' ),
		'add_new_item'               => __( 'Add Type of Event', 'gourmet-artist' ),
		'edit_item'                  => __( 'Edit Type of Event', 'gourmet-artist' ),
		'update_item'                => __( 'Update Type of Event', 'gourmet-artist' ),
		'view_item'                  => __( 'View Type of Event', 'gourmet-artist' ),
		'separate_items_with_commas' => __( 'Separate Type of Event with commas', 'gourmet-artist' ),
		'add_or_remove_items'        => __( 'Add or remove Type of Event', 'gourmet-artist' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'gourmet-artist' ),
		'popular_items'              => __( 'Popular Types of Event', 'gourmet-artist' ),
		'search_items'               => __( 'Search Types of Event', 'gourmet-artist' ),
		'not_found'                  => __( 'Not Found', 'gourmet-artist' ),
		'no_terms'                   => __( 'No Types of Event', 'gourmet-artist' ),
		'items_list'                 => __( 'Type of Event list', 'gourmet-artist' ),
		'items_list_navigation'      => __( 'Type of Event list navigation', 'gourmet-artist' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'type_event', array( 'events' ), $args );

}


function meal_type_taxonomy() {
  $labels = array(
  	'name'              => _x( 'Meal Type', 'taxonomy general name' ),
  	'singular_name'     => _x( 'Meal Type', 'taxonomy singular name' ),
  	'search_items'      => __( 'Search Meal Type' ),
  	'all_items'         => __( 'All Meal Types' ),
  	'parent_item'       => __( 'Parent Meal Type' ),
  	'parent_item_colon' => __( 'Parent Meal Type:' ),
  	'edit_item'         => __( 'Edit Meal Type' ),
  	'update_item'       => __( 'Update Meal Type' ),
  	'add_new_item'      => __( 'Add Meal Type' ),
  	'new_item_name'     => __( 'New Meal Type' ),
  	'menu_name'         => __( 'Meal Type' ),
  );

  $args = array(
    'hierarchical'  => true, //like categories or tags
    'labels'        => $labels,
    'show_ui'       => true, //add the default UI to this taxonomy
    'show_admin_column' => true, //add the taxonomies to the wordpress admin
    'query_var'         => true,
    'rewrite'       => array('slug' =>'meal'),
  );

  register_taxonomy( 'meal-type', 'recipes', $args );
}

function course_taxonomy() {
  $labels = array(
  	'name'              => _x( 'Course', 'taxonomy general name' ),
  	'singular_name'     => _x( 'Course', 'taxonomy singular name' ),
  	'search_items'      => __( 'Search Course' ),
  	'all_items'         => __( 'All Courses' ),
  	'parent_item'       => __( 'Parent Course' ),
  	'parent_item_colon' => __( 'Parent Course:' ),
  	'edit_item'         => __( 'Edit Course' ),
  	'update_item'       => __( 'Update Course' ),
  	'add_new_item'      => __( 'Add Course' ),
  	'new_item_name'     => __( 'New Course' ),
  	'menu_name'         => __( 'Course' ),
  );

  $args = array(
    'hierarchical'  => true, //like categories or tags
    'labels'        => $labels,
    'show_ui'       => true, //add the default UI to this taxonomy
    'show_admin_column' => true, //add the taxonomies to the wordpress admin
    'query_var'         => true,
    'rewrite'       => array('slug' =>'course'),
  );

  register_taxonomy( 'course', 'recipes', $args );
}


function mood_taxonomy() {
  $labels = array(
  	'name'              => _x( 'Mood', 'taxonomy general name' ),
  	'singular_name'     => _x( 'Mood', 'taxonomy singular name' ),
  	'search_items'      => __( 'Search Mood' ),
  	'all_items'         => __( 'All Moods' ),
  	'parent_item'       => __( 'Parent Mood' ),
  	'parent_item_colon' => __( 'Parent Mood:' ),
  	'edit_item'         => __( 'Edit Mood' ),
  	'update_item'       => __( 'Update Mood' ),
  	'add_new_item'      => __( 'Add Mood' ),
  	'new_item_name'     => __( 'New Mood' ),
  	'menu_name'         => __( 'Mood' ),
  );

  $args = array(
    'hierarchical'  => false, //like categories or tags
    'labels'        => $labels,
    'show_ui'       => true, //add the default UI to this taxonomy
    'show_admin_column' => true, //add the taxonomies to the wordpress admin
    'query_var'         => true,
    'rewrite'       => array('slug' =>'mood'),
  );

  register_taxonomy( 'mood', 'recipes', $args );
}

function ga_recipe_post_type() {

      // Labels for the Post Type
    $labels = array(
      'name'                => _x( 'Recipes', 'Post Type General Name', 'gourmet-artist' ),
      'singular_name'       => _x( 'Recipe', 'Post Type Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Recipes', 'gourmet-artist' ),
      'parent_item_colon'   => __( 'Parent Recipe', 'gourmet-artist' ),
      'all_items'           => __( 'All Recipes', 'gourmet-artist' ),
      'view_item'           => __( 'View Recipe', 'gourmet-artist' ),
      'add_new_item'        => __( 'Add New Recipe', 'gourmet-artist' ),
      'add_new'             => __( 'Add New Recipe', 'gourmet-artist' ),
      'edit_item'           => __( 'Edit Recipe', 'gourmet-artist' ),
      'update_item'         => __( 'Update Recipe', 'gourmet-artist' ),
      'search_items'        => __( 'Search Recipe', 'gourmet-artist' ),
      'not_found'           => __( 'No recipes found', 'gourmet-artist' ),
      'not_found_in_trash'  => __( 'Not found in trash', 'gourmet-artist' ),
    );

    // Another Customizations
    $args = array(
        'label'   => __('Recipes','gourmet-artist' ),
        'description' => __('Recipes for Gourmet Artistry', 'gourmet-artist'),
        'labels'  => $labels,
        'supports' => array('title', 'editor', 'thumbnail','revisions',  ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menus' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-page',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'capability_type' => 'page',
    );

    // register the post Type
    register_post_type( 'recipes', $args);
}


function ga_events_post_type() {

      // Labels for the Post Type
    $labels = array(
      'name'                => _x( 'Events', 'Post Type General Name', 'gourmet-artist' ),
      'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Events', 'gourmet-artist' ),
      'parent_item_colon'   => __( 'Parent Event', 'gourmet-artist' ),
      'all_items'           => __( 'All Events', 'gourmet-artist' ),
      'view_item'           => __( 'View Event', 'gourmet-artist' ),
      'add_new_item'        => __( 'Add New Event', 'gourmet-artist' ),
      'add_new'             => __( 'Add New Event', 'gourmet-artist' ),
      'edit_item'           => __( 'Edit Event', 'gourmet-artist' ),
      'update_item'         => __( 'Update Event', 'gourmet-artist' ),
      'search_items'        => __( 'Search Event', 'gourmet-artist' ),
      'not_found'           => __( 'No events found', 'gourmet-artist' ),
      'not_found_in_trash'  => __( 'Not found in trash', 'gourmet-artist' ),
    );

    // Another Customizations
    $args = array(
        'label'   => __('Events','gourmet-artist' ),
        'description' => __('Events for Gourmet Artistry', 'gourmet-artist'),
        'labels'  => $labels,
        'supports' => array('title', 'editor',),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menus' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-calendar-alt',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'capability_type' => 'page',
    );

    // register the post Type
    register_post_type( 'events', $args);
}
