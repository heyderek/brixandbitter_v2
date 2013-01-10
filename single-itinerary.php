<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <?php while(have_posts()):the_post(); ?>
          <article class="post">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php $it_time = get_post_meta($post->ID,'_cmb_test_datetime_timestamp',true); ?>
            <h4><?php echo date_i18n( 'l, F j, Y g:ia', $it_time ); ?></h4>
            <?php if (has_post_thumbnail()) : ?>
              <div id="featured_frame">
                <?php the_post_thumbnail('featured'); ?>		
              </div><!-- /#featured_frame -->
            <?php endif; ?>
            <?php the_content(); ?>
            <?php if ( !post_password_required() ) : ?>
            <h4>Itinerary</h4>
              <ul>
                <?php
                $dest = get_post_meta($post->ID,'_cmb_test_multicheckbox', false);
                $args = array (
                  'post_type' => 'destinations',
                  'post__in' => $dest
                );
                $gather_dest = new WP_Query( $args ); ?>
                <?php while($gather_dest->have_posts()) : $gather_dest->the_post(); ?>
                <li><a href="#<?php echo $post->post_name; ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
              </ul>
              <?php while($gather_dest->have_posts()) : $gather_dest->the_post(); ?>
              <h3><a name="<?php echo $post->post_name; ?>"><?php the_title(); ?></a></h3>
              <?php if (has_post_thumbnail()) : ?>
                <div class="featured-frame">
                  <?php the_post_thumbnail('featured'); ?>		
                </div><!-- /#featured_frame -->
              <?php endif; ?>              <?php the_content(); ?>
              <a href="#page" class="back-to-top-link">Back to top&raquo;</a>
                <?php endwhile; ?>
              <?php endif; ?>
          </article>
            <?php
              // If comments are open or we have at least one comment, load up the comment template
              if ( comments_open() || '0' != get_comments_number() )
                comments_template( '', true );
            ?>
          <?php endwhile; ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>