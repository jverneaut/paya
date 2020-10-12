<?php

function load_services_default_content($value, $post_id, $field)
{
  if (!$value) {
    $default_content = get_field('services_default_content', 'options');
    $value = $default_content['content'];
  }

  return $value;
}

add_filter('acf/load_value/key=field_5f81d48b52c08', 'load_services_default_content', 10, 3);

function load_services_default_services($value, $post_id, $field)
{
  if (!$value) {
    $default_content = get_field('services_default_content', 'options');
    $default_services = $default_content['services'];

    $value = [];
    foreach ($default_services as $default_service) {
      $value[] = [
        'field_5f81d49a52c0a' => $default_service['image']['ID'],
        'field_5f81d49e52c0b' => $default_service['content'],
      ];
    }
  }

  return $value;
}

add_filter('acf/load_value/key=field_5f81d49252c09', 'load_services_default_services', 10, 3);
