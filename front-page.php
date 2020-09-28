<?php

use Timber\Timber;

$context = Timber::context();
$context['post'] = new TimberPost();

Timber::render('front-page.twig', $context);
