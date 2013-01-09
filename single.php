<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <?php while(have_posts()):the_post(); ?>
          <article class="post">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <h4><?php the_date('F Y'); ?></h4>
            <?php if (has_post_thumbnail()) : ?>
              <div id="featured_frame">
                <?php the_post_thumbnail('featured'); ?>		
              </div><!-- /#featured_frame -->
            <?php endif; ?>
            <?php the_content(); ?>
            <footer class="entry-meta">
              <?php $tags_list = get_the_tag_list( '', __( ', ', 'brixnbitter' ) );
              if ( $tags_list ) : ?>
              <span class="tag-links">
              <?php printf( __( 'Tagged %1$s', 'bnb' ), $tags_list ); ?>
              </span>
              <span class="sep">. </span>
              <?php endif; // End if $tags_list ?>
            </footer><!-- /.entry-meta -->
            <?php brixnbitter_content_nav( 'nav-below' ); ?>
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