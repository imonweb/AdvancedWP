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

<div class="meal-recipes row">
	<h2 id="time" class="text-center">Make this for: </h2>
	<ul id="meal-per-hour" class="no-bullet">

	</ul>
</div>

<div id="filter">
		<h2 class="text-center">Filter by Course: </h2>

				<div class="menu-centered">
						<ul class="menu">
						<?php
							$terms = get_terms(array(
									'taxonomy' => 'course'
							) );
							foreach($terms as $term){
								echo "<li><a href='#{$term->slug}'>{$term->name}</a></li>";
							}
						?>
						</ul>
				</div> <!--.menu-centered-->
				<div id="recipes">
					<?php foreach($terms as $term){
							filter_course_terms($term->slug);
					} ?>
				</div> <!--#recipes-->
</div> <!--#filter-->


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
