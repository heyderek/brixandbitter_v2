<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <?php while(have_posts()):the_post(); ?>
          <article class="post">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if (has_post_thumbnail()) : ?>
              <div id="featured_frame">
                <?php the_post_thumbnail('featured'); ?>		
              </div><!-- /#featured_frame -->
            <?php endif; ?>
            <?php the_content(); ?>
          </article>
          <?php endwhile; ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>