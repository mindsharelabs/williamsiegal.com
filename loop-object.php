<?php


echo '<article id="post-' . get_the_id() . '" data-postID="' . get_the_id() . '" class="' . esc_attr( implode( ' ', get_post_class( 'col-12 col-md-4 col-lg-4 mb-3 slider-toggle', get_the_id() ) ) ) . '">';
  echo '<div class="object-card h-100">';

    echo '<div class="image-container">';
      if(has_post_thumbnail( )) :
        the_post_thumbnail( 'thumbnal-square', array('class' => 'object-thumbnail'));
      else :
        $images = get_field('images');
        echo wp_get_attachment_image( $images[0]['image']['ID'], 'thumbnal-square');
      endif;
    echo '</div>';

    echo '<div class="card-information">';
      echo '<h3 class="object-title text-white">' . get_the_title() . '</h3>';
      echo siegal_object_info(get_the_id());

    echo '</div>';
  echo '</div>';
echo '</article>';
