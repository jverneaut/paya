<?php

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
  require_once $composer_autoload;
}

if (file_exists(__DIR__ . '/.env')) {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}

require_once(__DIR__ . '/includes/setup.php');
require_once(__DIR__ . '/includes/editor-styles.php');
require_once(__DIR__ . '/includes/blocks.php');
require_once(__DIR__ . '/includes/options-page.php');
require_once(__DIR__ . '/includes/services-default-content.php');
require_once(__DIR__ . '/includes/contact-banner-default-content.php');
