    <footer id="colophon">
      <div class="wrapper">
        <div id="footer_lft">
          <aside class="container">
              <?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?>
            </aside><!-- /.container -->
          <span>&copy;2012 Brix &amp; Bitter.  <?php wp_loginout(); ?>.  All Rights Reserved.</span>
        </div><!-- /#footer_lft -->
        <aside id="ft_logo">
          <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/bnb_logo-ft.png" /></a>
        </aside>
        <div id="footer_rt">
          <aside class="container">
              <ul>
                <li>PO Box 5249, Kennewick, WA, 99336</li>
                <li>509.554.3875</li>
                <li><a href="mailto:info@brixandbitter.com" title="Email Brix &amp; Bitter.">info@brixandbitter.com</a></li>
              </ul>
            </aside><!-- /.container -->
          <span>this has been another <a href="http://dereknelson.net" target="_blank" title="Visit Derek&rsquo;s portfolio...">Derek Nelson</a> project.</span>
        </div><!-- /#footer_lft -->
      </div><!-- /.wrapper -->
      <?php wp_footer(); ?>
    </footer>
    </div><!-- /#page -->
  </body>
</html>
