<header class="header top-header <?php echo (is_front_page() ? 'front-page' : ''); ?>" role="banner">
  <div class="container-fluid py-1">
    <div class="row">
      <div class="col-10 col-md-5 col-lg-4 logo pt-1 pb-1 my-auto mx-auto">
        <a href="<?php echo home_url(); ?>">
          <?php include(get_template_directory() . '/inc/logo-include.php'); ?>
        </a>
      </div>

      <div class="col d-none d-md-block my-auto">
        <nav class="desktop header-menu text-right">
          <a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>
          <?php mindblank_nav('header-menu'); ?>
        </nav>
      </div>

    </div>
  </div>
</header>
