<?php

add_action("wp_ajax_seigal_get_object_slider", "seigal_get_object_slider");
add_action("wp_ajax_nopriv_seigal_get_object_slider", "seigal_get_object_slider");
function seigal_get_object_slider() {
  $data = $_REQUEST;
  $html = '';
  if($data['action'] != 'seigal_get_object_slider') :
    exit;
  endif;
  $images = get_field('images', $data['postID']);

  $slides = array();
  $thumbs = array();
  if (has_post_thumbnail( $data['postID'] )) :
    $slides[] = array(
      'html' => wp_get_attachment_image( get_post_thumbnail_id($data['postID']), 'large'),
      'orientation' => 'vertical'
    );
    $thumbs[] = wp_get_attachment_image( get_post_thumbnail_id($data['postID']), 'thumbnal-square');
  endif;
  if($images) :
    foreach ($images as $key => $image) :
      $width = $image['sizes']['large-width'];
      $height = $image['sizes']['large-height'];
      $orientation = (($width/$height) >= 1 ? 'horizontal' : 'vertical');
      $slides[] = array(
        'html' => wp_get_attachment_image( $image['image']['ID'], 'large'),
        'orientation' => $orientation
      );

      $thumbs[] = wp_get_attachment_image( $image['image']['ID'], 'thumbnal-square');
    endforeach;
  endif;



    $html = '<div class="object-slides">';
      foreach ($slides as $key => $slide) :
        $html .= '<div class="slide ' . $slide['orientation'] .'">';
          $html .= $slide['html'];
        $html .= '</div>';
      endforeach;
    $html .= '</div>';

    $html .= '<div class="object-information d-none d-md-block">';
      $html .= '<div class="container px-0">';
        $html .= '<div class="row">';
          $html .= '<div class="col-12 px-3">';
            $html .= '<h3 class="object-title">';
              $html .= get_the_title($data['postID']);
            $html .= '</h3>';
            $html .= siegal_object_info($data['postID']);

          $html .= '</div>';
        $html .= '</div>';
      $html .= '</div>';
    $html .= '</div>';




    if(count($thumbs) > 1) :
      $html .= '<div class="slide-controls">';
        $html .= '<div class="interaction slide-prev"><i class="fal fa-angle-left"></i></div>';
        $html .= '<div class="interaction slide-next"><i class="fal fa-angle-right"></i></div>';
      $html .= '</div>';
      $html .= '<div class="object-slides-navigation d-none d-md-flex">';
        foreach ($thumbs as $key => $thumb) :
          $html .= '<div class="slide-nav ' . ($key == 0 ? 'current' : '') . '" data-slide="' . $key . '">';
            $html .= $thumb;
          $html .= '</div>';
        endforeach;
      $html .= '</div>';
    endif;

  wp_send_json_success( $html );
}




function siegal_object_info($post_id, $echo = false) {
  $regions = wp_get_object_terms( $post_id, 'regions', array());
  $cultures = wp_get_object_terms( $post_id, 'cultures', array());
  $meta_data = get_fields($post_id);
  $html ='<div class="object-info">';

    $html .='<div class="local">';
    if($regions) :
      foreach ($regions as $key => $region) :
        $html .='<span class="region">' . $region->name . '</span>';
        if(next($regions)) :
          $html .=' | ';
        endif;
      endforeach;
    endif;

    if($cultures) :
      foreach ($cultures as $key => $culture) :
        $html .=', <span class="culture">' . $culture->name . '</span>';
        if(next($cultures)) :
          $html .=' | ';
        endif;
      endforeach;
    endif;
    $html .='</div>';

    $html .=($meta_data['creation_date'] ? '<span class="creation">' . $meta_data['creation_date'] . '</span>' : '');
    $html .=($meta_data['material'] ? '<span class="material">' . $meta_data['material'] . '</span>' : '');

    if($meta_data['dimensions_old']) :
      $dim = $meta_data['dimensions_old'];
      $html .='<div class="dimensions">';
        $html .= '<span>' . $dim . '</span>';
        // $html .=($dim['width'] ? '<span class="width">' . $dim['width'] . '</span>' : '');
        //
        //
        // $html .=($dim['width'] && $dim['height'] ? ' x ' : '');  //'x before the value'
        // $html .=($dim['height'] ? '<span class="height">' . $dim['height'] . '</span>' : '');
        //
        //
        // $html .=(($dim['height'] || $dim['width']) && $dim['length'] ? ' x ' : '');  //'x before the value'
        // $html .=($dim['length'] ? '<span class="length">' . $dim['length'] . '</span>' : '');
      $html .='</div>';
    endif;
    $html .= '<a href="' . get_permalink($post_id) . '" class="small mt-3 d-block text-white">View Information Page</a>';
  $html .='</div>';

  if($echo) :
    echo $html;
  else :
    return $html;
  endif;
}




// Dropdown arrows to parent menu items
add_filter( 'wp_nav_menu_objects', function ($sorted_menu_items, $args) {
  foreach ($sorted_menu_items as $menu_item) {
    if (array_search('menu-item-has-children', $menu_item->classes) != FALSE) {
      $menu_item->title = '<span class="d-block mb-1">' . $menu_item->title . '</span><i class="fal fa-angle-down"></i>';
    }
  }
  return $sorted_menu_items;
}, 10, 2);




function mind_format_phone($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree.'-'.$lastFour;
    }

    return $phoneNumber;
}


add_filter( 'render_block', 'mapi_block_wrapper', 10, 2 );
function mapi_block_wrapper( $block_content, $block ) {
  $noWrapper = array(
    'core/cover',
    // 'core/button',
    'acf/leep-full-width-notice',
    'acf/container',
    'core/wp-block-column',
    'core/wp-block-media-text'
  );
  mapi_write_log($block['blockName']);
  if(!in_array($block['blockName'], $noWrapper)) :
    $content = '<div class="container">';
      $content .= '<div class="row">';
        $content .= '<div class="col-12">';
          $content .= $block_content;
        $content .= '</div>';
      $content .= '</div>';
    $content .= '</div>';
  else :
    return $block_content;
  endif;
  return $content;



}


add_action('wp_footer', function() {
  if(function_exists('the_field')) :
    the_field('footer_scripts', 'options');
  endif;
});
add_action('wp_header', function() {
  if(function_exists('the_field')) :
    the_field('header_scripts', 'options');
  endif;
});

add_action( 'pre_get_posts', function ($query) {
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'team' ) ) {
      $query->set( 'posts_per_page', -1 );
    }
});

/**
 * Gutenberg scripts and styles
 *
 */
function be_gutenberg_scripts() {
	wp_enqueue_script( 'theme-editor', get_template_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-dom' ), THEME_VERSION, true );
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );

/**
 * Gravity Forms Bootstrap Styles
 *
 * Applies bootstrap classes to various common field types.
 * Requires Bootstrap to be in use by the theme.
 *
 * Using this function allows use of Gravity Forms default CSS
 * in conjuction with Bootstrap (benefit for fields types such as Address).
 *
 * @see  gform_field_content
 * @link http://www.gravityhelp.com/documentation/page/Gform_field_content
 *
 * @return string Modified field content
 */
add_filter("gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5);
function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){

	// Currently only applies to most common field types, but could be expanded.

	if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
		$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
	}

	if($field["type"] == 'name' || $field["type"] == 'address') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
	}

	if($field["type"] == 'textarea') {
		$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
	}

	if($field["type"] == 'checkbox') {
		$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}

	if($field["type"] == 'radio') {
		$content = str_replace('li class=\'', 'li class=\'radio ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}

	return $content;

} // End bootstrap_styles_for_gravityforms_fields()




if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_615e22b23c24f',
	'title' => 'Additional Scripts',
	'fields' => array(
		array(
			'key' => 'field_615e22bde1731',
			'label' => 'Header Scripts',
			'name' => 'header_scripts',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_615e22c2e1732',
			'label' => 'Footer Scripts',
			'name' => 'footer_scripts',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'website-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
