<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gourmet_Artistry
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info row">
				<div class="medium-6 columns">
						<?php wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'menu_id' => 'footer-menu',
								'items_wrap' => '<ul id="%1$s" class="%2$s vertical medium-horizontal menu text-center">%3$s</ul>',
						));
						?>
				</div>

				<div class="medium-6 columns">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social-menu',
							'container' => 'div',
							'container_id' => 'menu-social',
							'container_class' => 'menu',
							'menu_id' => 'social-menu',
							'menu_class' => 'menu-items',
							'depth' => 1,
							'link_before' => '<span class="screen-reader-text">',
							'link_after' => '</span>',
							'fallback_cb' => '',
							'items_wrap' => '<ul id="%1$s" class="%2$s menu float-right">%3$s</ul>',
 						) );
					?>

				</div>


		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
