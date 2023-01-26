<?php
/*
Plugin Name: Gourmet Artistry Post Types REST API
Plugin URI:
Description: Adds REST API to The Post Type
Version: 1.0
Author: Juan De la torre Valdez
License: GPL2
License: URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_action( 'rest_api_init', 'ga_previous_recipe' );

function ga_previous_recipe() {
    register_rest_field( 'recipes',
        'ga_recipes_previous_ID',
        array(
          'get_callback'    => 'ga_previous_recipe_ID',
          'schema'          => null,
          'update_callback' => null,
        )
    );

    register_rest_field( 'recipes',
        'ga_recipes_meta',
        array(
            'get_callback'    => 'ga_previous_recipe_meta',
            'schema'          => null,
            'update_callback' => null,
        )
    );

    register_rest_field( 'recipes',
        'ga_recipes_taxonomies',
        array(
            'get_callback'    => 'ga_previous_recipe_taxonomies',
            'schema'          => null,
            'update_callback' => null,
        )
    );

    /** Register Taxonomy Fields */
    register_rest_field( 'recipes',
        'ga_recipes_term_price_range',
        array(
            'get_callback'    => 'ga_previous_recipe_price_range',
            'schema'          => null,
            'update_callback' => null,
        )
    );

    register_rest_field( 'recipes',
        'ga_recipes_term_meal_type',
        array(
            'get_callback'    => 'ga_previous_recipe_meal_type',
            'schema'          => null,
            'update_callback' => null,
        )
    );

    register_rest_field( 'recipes',
        'ga_recipes_term_course',
        array(
            'get_callback'    => 'ga_previous_recipe_course',
            'schema'          => null,
            'update_callback' => null,
        )
    );

    register_rest_field( 'recipes',
        'ga_recipes_term_mood',
        array(
            'get_callback'    => 'ga_previous_recipe_mood',
            'schema'          => null,
            'update_callback' => null,
        )
    );
}

function ga_previous_recipe_ID() {
    $post = get_previous_post();
    return $post->ID;
}

function ga_previous_recipe_meta() {
    global $post;
    $post_id = $post->ID;
    return get_post_meta( $post_id );
}

function ga_previous_recipe_taxonomies() {
    global $post;
    return get_object_taxonomies( $post );
}

/** TAXONOMY TERMS */
function ga_previous_recipe_price_range() {
    global $post;
    $post_id = $post->ID;
    return get_the_term_list( $post_id, 'price_range' );
}

function ga_previous_recipe_meal_type() {
    $post_id = $post->ID;
    return get_the_term_list( $post_id, 'meal-type' );
}

function ga_previous_recipe_course() {
    $post_id = $post->ID;
    return get_the_term_list( $post_id, 'course' );
}

function ga_previous_recipe_mood() {
    $post_id = $post->ID;
    return get_the_term_list( $post_id, 'mood' );
}



add_action('wp_enqueue_scripts', 'ga_previous_post_scripts');

function ga_previous_post_scripts() {
    wp_enqueue_script( 'jquery');

    if(is_single()):
    wp_enqueue_script( 'ga-recipes-js',  plugin_dir_url( __FILE__ ) . 'ga-recipes.js' );

    wp_localize_script(
        'ga-recipes-js',
        'previous_posts',
        array(
            'post_id' => get_the_ID(),
            'rest_url' => rest_url( 'wp-json/v2/recipes-api/' )
        )
    );

    endif;
}
