<?php
$object = get_queried_object();
$description = get_field($object->name . '_archive_description', 'options');
 ?>
<header class="archive-header container  mt-5 pt-5">
  <div class="row">
    <div class="col-12 col-md-8">
      <h1 class="archive-title"><?php the_archive_title(); ?></h1>
      <?php echo $description; ?>
    </div>
  </div>
</header>
