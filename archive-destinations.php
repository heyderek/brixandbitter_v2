<?php get_header(); ?>
    <section class="main">
      <div class="wrapper">
        <section id="primary">
          <h1 class="entry-title">Regions we Tour</h1>
          <article><?php echo of_get_option('editor_5'); ?></article>
          <?php 
            $post_type = 'destinations';
            // Get all the taxonomies for this post type
            $taxonomies = get_object_taxonomies( (object) array( 'post_type' => $post_type ) );
            foreach( $taxonomies as $taxonomy ) : 
                // Gets every "category" (term) in this taxonomy to get the respective posts
                $terms = get_terms( $taxonomy, 'parent=0' );
                foreach( $terms as $term ) : 
                    $posts = new WP_Query( "taxonomy=$taxonomy&term=$term->slug&posts_per_page=1" );
                    if( $posts->have_posts() ): while( $posts->have_posts() ) : $posts->the_post();
                        //Do you general query loop here  
                        echo '<a href="'. home_url() . '/region/' .$term->slug.'"><article class="cat-thumbs"><h3>' . $term->name . '</h3><div class="featured-frame">',  the_post_thumbnail('featured'), '</div></article></a>';
                    endwhile; endif;
                endforeach;
            endforeach;    
          ?>
        </section><!-- /#primary -->
      <?php get_sidebar(); ?>
      </div><!-- /.wrapper -->
    </section><!-- /.main -->
<?php get_footer(); ?>