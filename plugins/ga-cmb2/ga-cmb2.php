<?php
/**
 * Plugin Name: Gourmet Artist Metaboxes CMB2
 * Plugin URI: https://github.com/imonweb/ga-cmb2
 * Description: Custom Metaboxes 2
 * Author: Imon
 * Author URI: https://www.imonweb.co.uk
 * Text-Domain: Gourmet Artist CMB2
 * Version: 0.1.0
 * License: GPL2
 * License URL: https://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: ga-cmb2
 **/

if( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ){
  require_once dirname( __FILE__ ) . '/cmb2/init.php';
}
add_action('cmb2_admin_init', 'metaboxes_events_cmb2');

function metaboxes_events_cmb2() {
  $perfix = 'ga_fields_events_';

  $metabox_events = new_cmb2_box( array(
    'id'    =>    $prefix . 'metabox',
    'title' =>    __('Events Metaboxes', 'cmb2'),
    'object_types'  =>  array('events')
  ) );

  $metabox_events->add_field(array(
    'name'    =>  __('City', 'cmb2'),
    'desc'    =>  __('City where the event takes place', 'cmb2'),
    'id'      =>  $prefix . 'city',
    'type'    =>  'text',
  ));

  $metabox_events->add_field(array(
    'name'    =>  __('Event Date', 'cmb2'),
    'desc'    =>  __('Event Date (pick from the calendar)', 'cmb2'),
    'id'      =>  $prefix . 'date',
    'type'    =>  'text_datetime_timestamp',
  ));

  $metabox_events->add_field(array(
    'name'    =>  __('Seats Available', 'cmb2'),
    'desc'    =>  __('Enter the number of seats available', 'cmb2'),
    'id'      =>  $prefix . 'seats',
    'type'    =>  'text',
  ));

  $metabox_events->add_field(array(
    'name'    =>  __('Program', 'cmb2'),
    'desc'    =>  __('Add the Program for this Event', 'cmb2'),
    'id'      =>  $prefix . 'program',
    'type'    =>  'text',
    'repeatable' => true
  ));
 
}

/*  Querying Metaboxes Fields */

add_shortcode('upcoming-events', 'upcoming_events');

function upcoming_events($text){
  $args = array(
    'post_type'     =>  'events',
    'orderby'       =>  'meta_value',
    'meta_key'      =>  'ga_fields_events_date',
    'order'         =>  'ASC',
    'post_per_page' =>  -1,
    'meta_query'    =>  array(
      array(
        'key'     =>  'ga_fields_events_date',
        'value'   =>  time(),
        'compare' =>  '>=',
        'type'    =>  'NUMERIC'
      )
    ),
  );
  echo "<ul class='list-events no-bullet'>";
  $events = new WP_Query($args); while($events->have_posts()): $events->the_post();
  echo the_title('<h3 class="text-center">', '</h3>');
  endwhile; wp_reset_postdata();
  echo "</ul>";

}

 
?>  