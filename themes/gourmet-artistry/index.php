<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artistry
 */

get_header(); ?>

<?php get_template_part('template-parts/slider', 'entries'); ?>

<div class="row">
	<ul class="menu">
		<?php 
		$terms = get_terms(array(
			'taxonomy'	=> 'course'
		));
		foreach($terms as $term) {
			// echo $term->name . "<br />";
			echo "<li><a href='#{$term->slug}'>{$term->name}</a></li>";
		}
		?>
	</ul>
</div>

<div class="row">
	<?php 
	filter_course_terms('main-dishes');
	/*
		$args = array(
			'posts_per_page'	=>	4,
			'post_type'				=>	'recipes',
			'order'						=>	'rand',
			'tax_query'				=>	array(
				array(
					'taxonomy'	=>	'course',
					'field'			=>	'slug',
					'terms'			=>	'main-dishes',
				)
			)
		);

		$query = new WP_Query($args);
		while( $query->have_posts() ):
			$query->the_post();
			the_title('<h1>', '</h1>');
		endwhile; 
		wp_reset_postdata();
	*/
	?>
</div>


<div class="row">
	<div id="primary" class="content-area medium-8 columns">
		<main id="main" class="site-main" role="main">
			<h2 class="latest-entries text-center separator">Latest Entries</h2>
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>

				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
echo "</div>";
get_footer();
