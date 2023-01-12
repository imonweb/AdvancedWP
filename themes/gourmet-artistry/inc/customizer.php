<?php
/**
 * Gourmet Artistry Theme Customizer.
 *
 * @package Gourmet_Artistry
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gourmet_artistry_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_setting(
		'ga_header_color',
		array(
			'default' => '#FFFFFF'
		)
	);

	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					'link_color',
					array(
						'label' => __('Header Background Color'),
						'section' => 'colors',
						'settings' => 'ga_header_color'
					)
			)
	);
}
add_action( 'customize_register', 'gourmet_artistry_customize_register' );

function ga_customzer_header() {
	?>
		<style type="text/css">
				header.site-header .no-image {
					background-color: <?php echo get_theme_mod('ga_header_color') ?>;
				}
		</style>
	<?php
}

add_action('wp_head', 'ga_customzer_header');
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gourmet_artistry_customize_preview_js() {
	wp_enqueue_script( 'gourmet_artistry_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'gourmet_artistry_customize_preview_js' );
