<?php get_header(); ?>
<main role="main" aria-label="Content">
  <header class="object-archive-header">

    <div class="row mx-0">
      <div class="object-header-close container">
        <div class="row">
          <span class="object-header-toggle"><i class="fas fa-times fa-2x"></i></span>
        </div>
      </div>
      <div class="object-archive-slider px-0"></div>
    </div>
  </header>
  <section class="object-filters mt-5 pt-5 container">
    <div class="row">
      <div class="col-12">
        <div class="facet-container">
          <?php echo facetwp_display( 'facet', 'object_type' ); ?>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="facet-container">
          <span class="label">Culture</span>
          <?php echo facetwp_display( 'facet', 'culture' ); ?>
        </div>
      </div>
    </div>
  </section>
  <section class="object-archive-posts container">
    <div class="row">
      <?php
      while (have_posts()) : the_post();
        get_template_part( 'loop-object');
      endwhile;
      ?>
    </div>
    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php
get_footer();
