<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artistry
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>

	<?php if ( is_single() ) { ?>
			<div class="large-12 columns">
					<?php the_post_thumbnail('single-image', array('class' => 'thumbnail')); ?>
			</div>
		<?php } else { ?>
			<div class="large-6 columns">
				<?php the_post_thumbnail('entry'); ?>
			</div>
	<?php } ?>

	<div class="<?php echo is_single() ? 'large-12' : 'large-6' ?> columns">

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title text-center separator">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gourmet_artistry_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if(is_single()) {
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gourmet-artistry' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			} else {
				the_excerpt();
				echo '<a class="button" href='.get_the_permalink() . ">Read More</a>";
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gourmet-artistry' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	</div>
</article><!-- #post-## -->
