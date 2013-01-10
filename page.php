<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
        <?php while(have_posts()):the_post(); ?>
        <h3 class="page-title"><?php the_title(); ?></h3>
            <?php if (has_post_thumbnail()) : ?>
              <div class="featured-frame">
                <?php the_post_thumbnail('featured'); ?>		
              </div><!-- /#featured_frame -->
            <?php endif; ?>
          <?php the_content(); ?>
          <?php endwhile; ?>
        </section><!-- /#primary -->
      <?php get_sidebar('pages'); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>