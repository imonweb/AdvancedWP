<?php
/**
 * Template Name: Recipes
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artistry
 */

get_header(); ?>

<div class="row column">
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">

      <?php 	the_title( '<h1 class="entry-title text-center separator">', '</h1>' );    ?>

        <?php
            $terms = get_terms('course');
        ?>

        <ul class="simplefilter menu row">
          <li class="active" data-filter="all">All</li>
          <?php foreach($terms as $term): ?>
                <li data-filter="<?php echo $term->term_taxonomy_id; ?>"><?php echo $term->name; ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="row">
              Recipe Filter:
              <input type="text" class="filtr-search" name="filtr-search" data-search>
        </div>

        <?php
        $args = array(
          'post_type' => 'recipes',
          'posts_per_page' => -1,
          'orderby' => 'title',
          'order' => 'ASC'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : ?>

            <div class="row">
                  <div class="filtr-container">
                        <div class="row small-up-2 medium-up-3 large-up-4">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                          <?php $terms = wp_get_post_terms( get_the_ID(), 'course' ); ?>
                            <?php $catIds = array();
                                  foreach($terms as $term):
                                  $catIds[] = $term->term_taxonomy_id;
                                  endforeach;
                                  $ids = implode(" , ", $catIds);
                            ?>
                            <div class="column filtr-item" data-category="<?php echo $ids; ?>">
                                  <a href="<?php the_permalink(); ?>">
                                          <?php the_post_thumbnail('entry'); ?>
                                        <p class="text-center">
                                          <?php  the_title(); ?>
                                        </p>
                                  </a>

                            </div>

                        <?php  endwhile; ?>

                      </div>
                </div>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
echo "</div>";
get_footer();
