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
          
          $region = $wp_query->queried_object_id;
          $children = get_term_children( $region, 'region' );
          
          foreach($children as $child) :
          
            $term = get_term_by( 'id', $child, 'region' );
            
            echo $term->name;
            
          endforeach;
          ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>