<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <h2 class="page-title"><?php printf( __( '%s', 'bnb' ), '<span>' . single_cat_title( '', false ) . '<span>' ); ?></h2>
          <blockquote>
          <?php $category_description = category_description(); 
            if ( ! empty( $category_description ) )
            echo apply_filters( 'category_archive_meta', '<p>' . $category_description . '</p>' ); ?>
          </blockquote>
          <?php while(have_posts()):the_post() ?>
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
      <?php get_sidebar('sidebar'); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>