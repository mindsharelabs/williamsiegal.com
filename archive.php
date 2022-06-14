<?php get_header(); ?>

<main role="main" aria-label="Content">
  <section <?php post_class('container mt-5'); ?>>
    <div class="row mt-5">
      <?php
      $object = get_queried_object();
      while (have_posts()) : the_post();
        get_template_part('loop-' . $object->name);
      endwhile;
      ?>
      </div>
      <?php get_template_part('pagination'); ?>
    </div>
  </section>
</main>
<?php
get_footer();
