<?php

use Timber\Site;
use Timber\Timber;
use Timber\Menu;
use OzdemirBurak\Iris\Color\Hex;

$timber = new Timber;

class Theme extends Site
{
  public function __construct()
  {
    add_action('init', array($this, 'add_menus'));
    add_action('after_setup_theme', array($this, 'theme_supports'));
    add_filter('timber/context', array($this, 'add_to_context'));
    add_filter('timber/twig', array($this, 'add_to_twig'));

    parent::__construct();
  }

  public function add_menus()
  {
    register_nav_menu('top_menu', __('Menu du haut'));
    register_nav_menu('main_menu', __('Menu principal'));
    register_nav_menu('footer_menu', __('Menu footer'));
    register_nav_menu('bottom_menu', __('Menu du bas'));
  }

  public function theme_supports()
  {
    add_theme_support('editor-styles');
    add_theme_support('title-tag');
    add_theme_support('align-wide');
  }

  public function add_to_context($context)
  {
    $menu_slugs = ['top_menu', 'main_menu', 'footer_menu', 'bottom_menu'];

    foreach ($menu_slugs as $menu_slug) {
      $context[$menu_slug] = new Menu($menu_slug);
    }

    if (function_exists('get_fields')) {
      $context['options'] = get_fields('option');
    }

    return $context;
  }

  public function add_to_twig($twig)
  {
    $twig->addExtension(new Twig\Extension\StringLoaderExtension());
    $twig->addFilter(new Twig\TwigFilter('darken', function ($color) {
      $hex = new Hex($color);
      $hex = $hex->darken(5);
      $hex = $hex->desaturate(6);

      return $hex;
    }));

    return $twig;
  }
}

new Theme();
