<section id="secondary">
  <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
  <?php endif; ?>
</section><!-- /#secondary -->