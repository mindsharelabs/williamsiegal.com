<?php get_header(); ?>

<main role="main" aria-label="Content">
  <section <?php post_class('container mt-5'); ?>>
    <div class="row mt-5">
      <?php
      $object = get_queried_object();
      if(have_posts()) :
        while (have_posts()) : the_post();
          get_template_part('loop-' . $object->name);
        endwhile;
      else :
        echo '<h2>Nothing found</h2>';  
      endif;
      ?>
      </div>
      <?php get_template_part('pagination'); ?>
    </div>
  </section>
</main>
<?php
get_footer();
