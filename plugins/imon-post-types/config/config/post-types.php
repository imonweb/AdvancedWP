<?php
/**
 * Plugin Name: Imon Post Types & Taxonomies
 * Plugin URI: https://github.com/imonweb/advancedwp
 * Description: Adds Custom Post Types to site.
 * Author: Imon
 * Author URI: https://www.imonweb.co.uk
 * Text-Domain: imon-post-types
 * Version: 0.1.0
 * License: GPL2
 * License URL: https://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: pot
 **/

 
class DM_Project_Post_Types {
  
  public function __construct() {
    add_action( 'init', array( $this, 'all_post_types' ) );
  }

  public function all_post_types() {
    $post_types = [
            [
                'post_type' => 'director',
                'singular'  => 'Director',
                'slug'      => 'director',
            ],
            [
                'post_type' => 'photographer',
                'singular'  => 'Photographer',
                'slug'      => 'photographer',
            ],


        ];

        foreach ($post_types as $key => $post_type) {
            $this -> dm_register_post_type( $post_type );
        }
  }

  private function dm_register_post_type( $data ) {

        $singular  = $data['singular'];
        $plural    = ( isset( $data['plural'] ) ) ? $data['plural'] : $data['singular'] . 's';
        $post_type = $data['post_type'];
        $slug      = $data['slug'];

        $labels = array(
            'name'               => _x( $plural, 'post type general name', 'dm-artillerie-theme' ),
            'singular_name'      => _x( $singular, 'post type singular name', 'dm-artillerie-theme' ),
            'menu_name'          => _x( $plural, 'admin menu', 'dm-artillerie-theme' ),
            'name_admin_bar'     => _x( $singular, 'add new on admin bar', 'dm-artillerie-theme' ),
            'add_new'            => _x( 'Add New', $singular, 'dm-artillerie-theme' ),
            'add_new_item'       => __( 'Add New ' . $singular, 'dm-artillerie-theme' ),
            'new_item'           => __( 'New ' . $singular, 'dm-artillerie-theme' ),
            'edit_item'          => __( 'Edit ' . $singular, 'dm-artillerie-theme' ),
            'view_item'          => __( 'View ' . $singular, 'dm-artillerie-theme' ),
            'all_items'          => __( 'All ' . $plural, 'dm-artillerie-theme' ),
            'search_items'       => __( 'Search ' . $plural, 'dm-artillerie-theme' ),
            'parent_item_colon'  => __( 'Parent ' . $plural . ':', 'dm-artillerie-theme' ),
            'not_found'          => __( 'No ' . $plural . ' found.', 'dm-artillerie-theme' ),
            'not_found_in_trash' => __( 'No ' . $plural . ' found in Trash.', 'dm-artillerie-theme' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( $singular .'.', 'dm-artillerie-theme' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $slug ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'author', 'editor', 'thumbnail', 'excerpt', 'comments' )
        );

        register_post_type( $post_type, $args );

    }

 

} // End class


 
    new DM_Project_Post_Types;