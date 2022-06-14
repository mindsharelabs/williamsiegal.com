<?php get_header(); ?>
<main role="main" aria-label="Content">
  <header class="object-archive-header">

    <div class="row mx-0 w-100">
      <div class="object-header-close container">
        <div class="row">
          <span class="object-header-toggle"><i class="fas fa-times fa-2x"></i></span>
        </div>
      </div>
      <div class="object-archive-slider px-0  w-100"></div>
    </div>
  </header>

  <section class="object-archive-posts container mt-5">
    <div class="row">
      <?php
      if(have_posts()) :
        while (have_posts()) : the_post();
          get_template_part('loop-object');
        endwhile;
      else :
        echo '<h2>Nothing found</h2>';
      endif;
      ?>
    </div>
    <?php get_template_part('pagination'); ?>
  </section>
</main>
<?php
get_footer();
