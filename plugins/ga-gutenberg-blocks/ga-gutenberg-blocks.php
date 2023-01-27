<?php
/**
 * Plugin Name: Gourmet Artist Gutenberg Blocks
 * Plugin URI: https://github.com/imonweb/ga-gutenberg-blocks
 * Description: Gourmet Artist Gutenberg Blocks
 * Author: Imon
 * Author URI: https://www.imonweb.co.uk
 * Text-Domain: ga-gutenberg-blocks
 * Version: 0.1.0
 * License: GPL2
 * License URL: https://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: ga-gutenberg-blocks
 **/

 /*  Prevent the execution */
 if(!defined('ABSPATH')) exit;

 /*  Register The Gutenberg Blocks and CSS */

 add_action('init', 'ga_register_gutenberg_blocks');

 function ga_register_gutenberg_blocks() {
  // Check if gutenberg is installed
  if( !function_exists('register_block_type')){
    return;
  }

  // Register the Block editor script
  wp_register_script(
    'ga-editor-script',
    plugins_url( 'build/index.js', __FILE__ ), //url to file
    array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'), //dependencies
    filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js') // version
  );

  // Gutenberg Editor CSS
  wp_register_style(
    'ga-editor-style', // name
    plugins_url( 'build/editor.css', __FILE__ ), // file
    array(), // dependencies
    filemtime( plugin_dir_path( __FILE__ ) . 'build/editor.css') // version
  );

  // Front-End Stylesheet
   wp_register_style(
    'ga-front-end-styles', // name
    plugins_url( 'build/style.css', __FILE__ ), // file
    array(), // dependencies
    filemtime( plugin_dir_path( __FILE__ ) . 'build/style.css') // version
  );

  // Create an array of blocks
  $blocks = array(
    'ga/testimonial'
  );

  // Add the blocks and register the stylesheets
  foreach($blocks as $block) {
    register_block_type( $block, array(
      'editor_script' =>  'ga-editor-script',
      'editor_style'  =>  'ga-editor-style',
      'style'         =>  'ga-front-end-style'
    ) );
  }
 }