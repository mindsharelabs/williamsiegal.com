<?php get_header(); ?>
<main role="main" aria-label="Content">
  <header class="object-archive-header">

    <div class="row">
      <div class="object-archive-slider">

      </div>
    </div>
  </header>
  <section class="object-filters container">
    <div class="row">
      <div class="col-12">
        <div class="facet-container">
          <span class="label">Object Type</span>
          <?php echo facetwp_display( 'facet', 'object_type' ); ?>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="facet-container">
          <span class="label">Region</span>
          <?php echo facetwp_display( 'facet', 'region' ); ?>
        </div>
      </div>
      <div class="col-12 col-md-8">
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
