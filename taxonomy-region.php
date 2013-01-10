<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <h1 class="entry-title"><?php printf( __( '%s', '' ),  single_term_title( '', false ) ); ?></h1>
          <header>
              <p><?php
              $category_description = category_description();
                if ( ! empty( $category_description ) )
                echo apply_filters( 'category_archive_meta', $category_description ); ?>
              </p>
          </header>
          <?php
          $taxonomy = 'region';
          $region = $wp_query->queried_object_id;
          $children = get_term_children( $region, $taxonomy );
          
          foreach($children as $child) :
          
            $term = get_term_by( 'id', $child, $taxonomy );
            $slug = $term->slug;
            $args = array(
              'posts_per_page' => 1,
              'tax_query' => array(
                array(
                  'taxonomy' => $taxonomy,
                  'field' => 'slug',
                  'terms' => $slug
                )
              )
            );
            $posts = new WP_Query($args);
            
            /* echo '<h4>' . $term->name . '</h4>'; */
            
            while($posts->have_posts()) : $posts->the_post();
              
              echo '<h4>' . $term->name . '</h4>';
              echo the_post_thumbnail('featured');
              
            endwhile;
            
          endforeach;
          ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>