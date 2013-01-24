<?php get_header(); ?>
    <section id="fp_1" class="front-page">
      <div class="wrapper">
        <section class="fp-text">
          <h3><?php echo of_get_option('heading_fp_1'); ?></h3>
          <?php echo of_get_option('editor_1'); ?>
        </section><!-- /.fp-text -->
        <section class="fp-graphic">
          <img src="<?php bloginfo('template_url'); ?>/images/brixandbitter.png" alt="Brix and Bitter Graphic with Logo." />
        </section><!-- /.fp-graphic -->
      </div><!-- /.wrapper -->
    </section><!-- /.front-page -->
    <section id="fp_2" class="front-page">
      <div class="wrapper">
        <section class="fp-graphic">
          <img src="<?php bloginfo('template_url'); ?>/images/wa-graphic.png" alt="Graphic of winery regions we tour in Washington." />
        </section><!-- /.fp-graphic -->
        <section class="fp-text">
          <h3><?php echo of_get_option('heading_fp_2'); ?></h3>
          <?php echo of_get_option('editor_2'); ?>
        </section><!-- /.fp-text -->
      </div><!-- /.wrapper -->
    </section><!-- /.front-page -->
    <section id="fp_3" class="front-page">
      <div class="wrapper">
        <section class="fp-text">
          <h3><?php echo of_get_option('heading_fp_3'); ?></h3>
          <?php echo of_get_option('editor_3'); ?>
        </section><!-- /.fp-text -->
        <section class="fp-graphic">
          <img src="<?php bloginfo('template_url'); ?>/images/bottle.png" alt="Graphic featuring wine and beer." />
        </section><!-- /.fp-graphic -->
      </div><!-- /.wrapper -->
    </section><!-- /.front-page -->
    <section id="fp_4" class="front-page">
      <div class="wrapper">
        <section class="fp-text">
          <h3><?php echo of_get_option('heading_fp_4'); ?></h3>
          <?php echo of_get_option('editor_4'); ?>
          <?php if (function_exists('serveCustomContactForm')) { serveCustomContactForm(1); } ?>
        </section><!-- /.fp-text -->
      </div><!-- /.wrapper -->
    </section><!-- /.front-page -->
<?php get_footer(); ?>