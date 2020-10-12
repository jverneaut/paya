<?php

function load_contact_banner_default_content($value, $post_id, $field)
{
  if (!$value) {
    $default_content = get_field('contact_banner_default_content', 'options');
    $value = $default_content['contact_banner_content'];
  }

  return $value;
}

add_filter('acf/load_value/key=field_5f81ca07747b4', 'load_contact_banner_default_content', 10, 3);
