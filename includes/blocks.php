<?php

use Timber\Timber;
use Timber\PostQuery;

class PayaBlock
{
  private $title;
  private $slug;
  private $example;

  public function __construct($title, $slug, $example = [])
  {
    $this->title = $title;
    $this->slug = $slug;
    $this->example = $example;
  }

  public function register_block()
  {
    acf_register_block_type([
      'name' => $this->slug,
      'title' => $this->title,
      'align' => 'full',
      'category' => 'trybatec',
      'icon' => '<svg width="67px" height="29px" viewBox="0 0 67 29" font-family="TitilliumWeb-SemiBold, Titillium Web" font-size="40" font-weight="500"><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#39c199">TRY</text></svg>',
      'supports' => [
        'jsx' => true,
      ],
      'render_callback' => [$this, 'render'],
      'example' => [
        'attributes' => [
          'mode' => 'preview',
          'data' => $this->example,
        ]
      ],
    ]);
  }

  public function render($block, $content = '', $is_preview = false, $post_id)
  {
    $context = Timber::context();
    $post = new TimberPost($post_id);

    $fields = get_fields();

    $context['post'] = $post;
    $context['block'] = $block;
    $context['fields'] = !empty($fields) ? $fields : $block['example']['attributes']['data'];
    $context['is_preview'] = $is_preview;

    if ($block['name'] == 'acf/news') {
      $context['news'] = new PostQuery([
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order'   => 'DESC',
      ]);
    }

    Timber::render(sprintf('blocks/%s.twig', $this->slug), $context);
  }
}


function lorem($length = 3)
{
  $sentence = implode(' ', array_slice(explode(' ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et facere eius quos saepe! Magni explicabo alias error excepturi rerum maxime, nam quam ratione ullam, ad illo. Architecto mollitia eaque sit alias rerum reiciendis. Fugit assumenda autem magnam expedita voluptate nam labore ipsa sunt error! Dolorum repudiandae fugiat unde mollitia distinctio.'), 0, $length));
  return substr($sentence, -1) == '.' ? $sentence : $sentence . '.';
}

function placeholder($width = 300, $height = 300)
{
  return  'https://via.placeholder.com/' . $width . 'x' . $height . '&text=Placeholder';
}

function register_blocks()
{
  $blocks = [
    [
      'title' => 'Hero',
      'slug' => 'hero',
      'example' => [
        'content' => lorem(14),
        'image' => placeholder(600, 200),
      ],
    ],
    [
      'title' => 'Hero page d\'accueil',
      'slug' => 'homepage-hero',
      'example' => [
        'content' => lorem(14),
        'image' => placeholder(600, 200),
      ],
    ],
    [
      'title' => 'Contrats',
      'slug' => 'contracts',
      'example' => [
        'content' => lorem(14),
      ],
    ],
    [
      'title' => 'Bandeau contact',
      'slug' => 'contact-banner',
      'example' => [
        'content' => lorem(14),
      ],
    ],
    [
      'title' => 'Services',
      'slug' => 'services',
      'example' => [
        'content' => lorem(14),
        'services' => [
          ['image' => placeholder(), 'content' => lorem(20)],
          ['image' => placeholder(), 'content' => lorem(20)],
          ['image' => placeholder(), 'content' => lorem(20)],
        ],
      ],
    ],
    [
      'title' => 'Image + texte',
      'slug' => 'image-text',
      'example' => ['image' => placeholder(), 'content' => lorem(32)],
    ],
    [
      'title' => 'Titre',
      'slug' => 'title',
      'example' => ['title' => lorem(12)],
    ],
    [
      'title' => 'Slider contrats',
      'slug' => 'contracts-slider',
    ],
    [
      'title' => 'Fond',
      'slug' => 'background',
    ],
    [
      'title' => 'Actualités',
      'slug' => 'news',
    ],
  ];

  foreach ($blocks as $block_config) {
    $block = new PayaBlock($block_config['title'], $block_config['slug'], isset($block_config['example']) ? $block_config['example'] : []);
    $block->register_block();
  }
}

add_action('acf/init', 'register_blocks');
