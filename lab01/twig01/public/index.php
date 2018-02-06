<?php
// autoloader
// ------------
require_once __DIR__ . '/../vendor/autoload.php';

// my settings
// ------------
$myTemplatesPath = __DIR__ . '/../templates';

// setup twig
// ------------
$loader = new Twig_Loader_Filesystem($myTemplatesPath);
$twig = new Twig_Environment($loader);

//-----
$template = 'home.html.twig';
$args = [
    'name' => 'Matt Smith'
];

$html = $twig->render($template, $args);
print $html;