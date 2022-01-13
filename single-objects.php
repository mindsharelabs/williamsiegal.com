<?php
get_header();
$object_data = get_fields(get_the_id());
if(have_posts()) : while(have_posts()) : the_post(); ?>
  <main role="main" aria-label="Content">
    <header class="object-header">

      <?php
      if($object_data['images']) :
        echo '<div class="object-header-images">';
          foreach ($object_data['images'] as $key => $image) :
            echo '<div class="image-cont">';
              echo wp_get_attachment_image( $image['image']['ID'], 'large');
            echo '</div>';
          endforeach;
        echo '</div>';
      endif;
      ?>
      <div class="object-information">
        <h1 class="object-title"><?php the_title(); ?></h1>
        <?php echo siegal_object_info(get_the_id()); ?>
      </div>
    </header>
    <div class="container my-0">
      <div class="row my-0">
        <div class="col-12 my-0 spacer-item">
        </div>
      </div>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
      <div class="row">
        <div class="col-12 col-md-4">

        </div>
        <div class="col-12 col-md-8">
          <?php the_content(); ?>
        </div>
      </div>

    </article>
  </main>
<?php endwhile; endif;

get_footer();
