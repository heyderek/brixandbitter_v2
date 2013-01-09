<?php
//Add Comment functionality
if ( ! function_exists( 'brixnbitter_comment' ) ) :
function brixnbitter_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
  case 'pingback' :
  case 'trackback' : ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'brixnbitter' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'bnb' ), ' ' ); ?></p>
  <?php
    break;
    default : ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer>
        <div class="comment-author vcard">
          <?php echo get_avatar( $comment, 40 ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em><?php _e( 'Your comment is awaiting moderation.', 'brixnbitter' ); ?></em>
        <br />
      <?php endif; ?>
      </footer>
      <?php printf( __( '%s <span class="says">says:</span>', 'brixnbitter' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
      <div class="comment-meta commentmetadata">
        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
        <?php printf( __( '%1$s at %2$s', 'brixnbitter' ), get_comment_date(), get_comment_time() ); ?>
        </time></a>
        <?php edit_comment_link( __( '(Edit)', 'brixnbitter' ), ' ' );
        ?>
      </div><!-- .comment-meta .commentmetadata -->
      <div class="comment-content"><?php comment_text(); ?></div>
      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
  </article><!-- #comment-## -->
  <?php
  break;
  endswitch;
}
endif; // ends check for brixnbitter_comment()