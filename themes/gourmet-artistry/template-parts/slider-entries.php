<div class="row">
  <div class="orbit" data-orbit>
      <ul class="orbit-container">

        <?php $i == 0; ?>
        <?php $slider = new WP_Query('posts_per_page=4'); while($slider->have_posts() ): $slider->the_post();  ?>

        <li class="<?php echo $i == 0 ? 'is-active' : '' ?> orbit-slide">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('slider'); ?>
            <div>
                <h3 class="orbit-caption text-center"><?php the_title(); ?></h3>
            </div>

            </a>
        </li>

        <?php $i++;  endwhile; wp_reset_postdata(); ?>
      </ul>
      <nav class="orbit-bullets">
          <?php $entries = $slider->post_count; ?>

          <?php for($i=0; $i<$entries; $i++) { ?>
              <button class="<?php echo $i==0 ? 'is-active' : '' ?>" data-slide="<?php echo $i; ?>"></button>
          <?php } ?>

      </nav>
  </div>
</div>
