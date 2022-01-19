<?php
get_header();
if(have_posts()) :
  if(!wp_is_mobile()) :
    $featured_image = get_the_post_thumbnail_url( get_the_id(), 'large' );
  else :
    $featured_image = get_field('mobile_featured_image', get_the_id());
    $featured_image = $featured_image['sizes']['large'];
  endif;
  if($featured_image) :
    echo '<div class="front-page-container" style="background-image: url(' . $featured_image . ')">';
  endif;
    while(have_posts()) :
      the_post();
        the_content();
    endwhile;
  if($featured_image) :
    echo '</div>';
  endif;
endif;

get_footer();
