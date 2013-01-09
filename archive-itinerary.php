<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <article class="post">
            <h3 class="entry-title">Itineraries</h3>
            <?php
              $itin = 'itinerary';
              $mnth = 'month';
              $mnth_txs = get_terms($mnth);
              if ($mnth_txs) {
              foreach ($mnth_txs as $mnth_tx) {
                $args=array(
                  'post_type' => $itin,
                  "$mnth" => $mnth_tx->slug,
                  'post_status' => 'published',
                  'posts_per_page' => -1,
                  'orderby' => 'meta_value_num',
                  'meta_key' => '_cmb_test_datetime_timestamp',
                  'order' => 'ASC'
                );
              $my_query = null;
              $my_query = new WP_Query($args);
              if( $my_query->have_posts() ) {
                echo '<h2>' . $mnth_tx->name . '</h2>';
                echo '<ul>';
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
              <?php $stuff = get_post_meta($post->ID,'_cmb_test_datetime_timestamp',true); ?>
                  <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    &nbsp;
                    <em>
                <?php echo date_i18n( 'l, F j, Y g:ia', $stuff ); ?>
                    </em>
                  </li>
                  <?php endwhile;
                  echo '</ul>';
                  }
                wp_reset_query();
                  }
                }
            ?>
          </article>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>