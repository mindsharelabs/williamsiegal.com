<?php
get_header();
?>
<main role="main" aria-label="Content">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <header class="page-header container mt-5">
      <div class="row pt-5">
        <div class="col-12 col-md-10 col-lg-8 offset-0 offset-md-1 offset-lg-2">
          <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
      </div>
    </header>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="row">
        <div class="col-12 col-md-10 col-lg-8 offset-0 offset-md-1 offset-lg-2">
          <?php the_content(); ?>
        </div>
      </div>

    </article>
  <?php endwhile; endif; ?>
</main>
<?php
get_footer();
