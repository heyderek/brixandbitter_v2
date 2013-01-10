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
            
            while($posts->have_posts()) : $posts->the_post();
              
              echo '<h3>' . $term->name . '</h3><div class="featured-frame">', the_post_thumbnail('featured'), '</div>';
              
              $args = array(
                'posts_per_page' => -1,
                'tax_query' => array(
                  array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $slug
                  )
                )
              );
              
              $subpost = new WP_Query($args);
              $parentterm = $wp_query->queried_object;
              
              echo '<h4 class="learnmore"><button>' . $term->name . ' in the ' . $parentterm->name . '&nbsp;<span>(Click to Learn More.)</span></button></h4>';
              
              echo '<ul class="destination-list">';
              
              while($subpost->have_posts()) : $subpost->the_post();
                echo '<li><h4><a href="', the_permalink(), '">' , the_title(), '</a></h4>', the_excerpt(),'</li>';
              endwhile;
              
              echo '<button class="close button">Close</button><a href="#page" class="button">Back to top &raquo;</a>';
              
              echo '</ul>';
              
              
            endwhile;
            
          endforeach;
          ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>