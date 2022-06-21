<?php
get_header();
$object_data = get_fields(get_the_id());
if(have_posts()) : while(have_posts()) : the_post(); ?>
  <main role="main" aria-label="Content">
    <header class="object-header">

      <?php
      if($object_data['images']) :
        if(has_post_thumbnail()) :
          //if we have a post thumbnail, make sure it's part of the header
          $featured_image = array(
            'image' => array(
              'ID' => get_post_thumbnail_id(get_the_id())
            )
          );
          array_unshift($object_data['images'], $featured_image);
        endif;

        echo '<div class="object-header-images displaying ' . (count($object_data['images']) == 1 ? 'text-center' : '') . '">';
          foreach ($object_data['images'] as $key => $image) :
            echo '<div class="image-cont">';
              echo wp_get_attachment_image( $image['image']['ID'], 'large');
            echo '</div>';
          endforeach;
        echo '</div>';
      endif;
      ?>

    </header>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="row my-0">
          <div class="col-12 my-0 spacer-item">
            <div class="object-information">
              <h1 class="object-title"><?php the_title(); ?></h1>
              <?php echo siegal_object_info(get_the_id()); ?>

            </div>
          </div>
          <?php the_content(); ?>
        </div>
      </div>




    </article>
  </main>
<?php endwhile; endif;

get_footer();
