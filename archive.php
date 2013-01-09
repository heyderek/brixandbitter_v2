<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <h1 class="entry-title"><?php
            if ( is_day() ) :
              printf( __( 'Daily Archives: %s', 'brixnbitter' ), '<span>' . get_the_date() . '</span>' );
              elseif ( is_month() ) :
              printf( __( 'Monthly Archives: %s', 'brixnbitter' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
              elseif ( is_year() ) :
              printf( __( 'Yearly Archives: %s', 'brixnbitter' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
              else :
              _e( 'Archives', 'brixnbitter' );
            endif; ?>
          </h1>
          <?php while(have_posts()):the_post(); ?>
          <article class="post">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <h4><?php the_date('F Y'); ?></h4>
            <?php the_content(); ?>
            <footer class="entry-meta">
              <?php $tags_list = get_the_tag_list( '', __( ', ', 'brixnbitter' ) );
              if ( $tags_list ) : ?>
              <span class="tag-links">
              <?php printf( __( 'Tagged %1$s', 'bnb' ), $tags_list ); ?>
              </span>
              <span class="sep">. </span>
              <?php endif; // End if $tags_list ?>
              <?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
              <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bnb' ), __( '1 Comment', 'brixnbitter' ), __( '% Comments', 'brixnbitter' ) ); ?></span>
              <span class="sep">. </span>
              <?php endif; ?>
            </footer><!-- /.entry-meta -->
          </article>
          <?php endwhile; ?>
          <?php brixnbitter_content_nav( 'nav-below' ); ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>