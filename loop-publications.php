<?php $fields = get_fields(get_the_id()); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 mb-5'); ?>>
  <div class="row">
    <?php
    if (has_post_thumbnail()) :
      echo '<div class="col-5 col-md-4">';
        echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
          echo get_the_post_thumbnail(get_the_id(), 'medium', array('class' => 'publication-cover w-100'));
        echo '</a>';
      echo '</div>';
    endif;
    ?>
    <div class="col-12 col-md d-flex justify-content-between flex-column">
      <div class="main-content">
        <h3 class="publication-title">
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h3>
        <?php
        if($fields['author'] || count($fields['contributors']) > 0) :
          echo '<div class="contributors">';
            echo ($fields['author'] ? '<span class="author">By: ' . $fields['author'] . '</span> (author)' : '');
            if(count($fields['contributors']) > 0) :
              echo ', ';
              foreach ($fields['contributors'] as $key => $cont) :
                echo '<span class="contributor">' . $cont['contributor_name'] . '</span> (contributor)';
                if(next($fields['contributors'])) :
                  echo ', ';
                endif;
              endforeach;
            endif;
          echo '</div>';
        endif;

        echo '<div class="excerpt mt-3">';
          the_excerpt();
        echo '</div>';


        ?>
      </div>


      <?php
      if($fields['purchase_link']) :
        echo '<div class="publication-footer">';
          echo '<a class="btn btn-outline-primary" href="' . $fields['purchase_link']['url'] . '" target="' . $fields['purchase_link']['target'] . '" title="' . $fields['purchase_link']['title'] . '">' . $fields['purchase_link']['title'] . '</a>';
        echo '</div>';

      endif;
      ?>



    </div>


  </div>
</article>
